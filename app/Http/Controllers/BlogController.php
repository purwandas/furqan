<?php

namespace App\Http\Controllers;

use App\Components\Filters\BlogFilter;
use App\Components\Helpers\DatatableBuilderHelper;
use App\Components\Helpers\FormBuilderHelper;
use App\Components\Traits\ApiController;
use App\Exports\BlogExportPdf;
use App\Exports\BlogExportXls;
use App\Imports\BlogImport;
use App\Models\BlogHasCategory;
use App\Templates\BlogImportSheetTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use \App\Models\Blog;

class BlogController extends Controller
{
    use ApiController;

    public $type, $label = "Blog", $icon = 'fa fa-globe';

    public function index()
    {
        $data = [
            'title' => $this->label,
            'icon'  => $this->icon,
            'breadcrumb' => [
                ['label' => $this->label],
            ]
        ];

        $customFormBuilder = [
            'blog_category_id' => [
                'type'      => 'select2',
                'name'      => 'blog_category_id',
                'text'      => 'obj.name',
                'options'   => 'blog-category.select2',
                'keyTerm'   => '_name',
                'elOptions' => [
                    'placeholder' => 'Blog Category',
                    'required'    => 'required',
                ],
                'pluginOptions' => [
                    'multiple' => true,
                ]
            ],
            'url' => [
                'type' => 'select',
                'name' => 'protocol',
                'options' => [
                    'http://'  => 'http://',
                    'https://' => 'https://',
                ],
                'elOptions' => [
                    'class'       => 'col-md-3 form-control',
                    'required'    => 'required',
                    'placeholder' => 'Select Protocol',
                ],
                    'inputContainerClass' => 'row col-md-10 padding-left-15px padding-right-0',
            ]
        ];

        $additionalDatatableolumns = ['blog_category'];
        $exceptDatatable           = ['protocol'];
        $exceptForm                = ['protocol'];

        if (isAdmin()) {
            $additionalDatatableolumns[] = 'select';

            $customFormBuilder['user_id'] = [
                'type'      => 'select2',
                'name'      => 'user_id',
                'text'      => 'obj.name',
                'options'   => 'user.select2',
                'keyTerm'   => '_name',
                'elOptions' => [
                    'placeholder' => 'User',
                    'required'    => 'required',
                ]
            ];

        } else {
            $exceptDatatable[]           = 'user_id';
            $customFormBuilder['user_id'] = [
                'type'  => 'hidden',
                'name'  => 'user_id',
                'value' => \Auth::user()->id
            ];
        }


        $customOrder = ['name', 'protocol', 'url', 'blog_category_id', 'language_id', 'user_id'];
        $tableOrder  = ['name', 'protocol', 'url', 'blog_category', 'language_id', 'user_id'];
        $tableColumnDefs = [['width' => '20px', 'targets' => [0]]];

        $form_data = new FormBuilderHelper(Blog::class,$data);
        $final     = $form_data
                    ->setCustomFormBuilder($customFormBuilder)
                    ->setCustomOrderFormBuilder($customOrder)
                    ->setExceptFormBuilderColumns($exceptForm)
                    ->setExceptDatatableColumns($exceptDatatable)
                    ->setAdditionalDatatableColumns($additionalDatatableolumns)
                    ->setOrderDatatableColumns($tableOrder)
                    ->setDatatableColumnDefs($tableColumnDefs)
                    ->injectView(['inject/blog-form', 'inject/datatable-select' => ['tableId' => 'blog_datatable'] ])
                    ->get();
        
        return view('components.global_form', $final);
    }

    public function list(BlogFilter $filter)
    {
        $blog = Blog::generateQuery($filter)->get();
        return $this->sendResponse($blog, 'Get Data Success!');
    }

    public function select2(BlogFilter $filter)
    {
        return Blog::generateQuery($filter)->get();
    }

    public function datatable(BlogFilter $filter, $type = null)
    {
        $data = Blog::generateQuery($filter);

        return \DataTables::of($data)
            ->editColumn('url', function ($item){
                return $item->protocol.$item->url;
            })
            ->addColumn('select', function ($item){
                if (isAdmin()){ // && !empty($type)) {
                    return tableCheckbox('blog_datatable', $item->id);
                }
            })
            ->addColumn('action', function ($item) use ($type){
                $buttons = [];

                $buttons = array_merge($buttons, [
                                'edit' => [
                                    'onclick' => "editModalBlog('".route('blog.edit',['id'=>$item->id])."')",
                                    'data-target' => '#modalFormBlog',
                                    'icon' => getSvgIcon('fa-pencil-alt','mt-m-2'),
                                ],
                                'delete' => [
                                    'data-url' => route('blog.delete',['id'=>$item->id]),
                                    'icon' => getSvgIcon('fa-trash','mt-m-2'),
                                ],
                            ]);

                return DatatableBuilderHelper::button($buttons);
            })
            ->rawColumns(['action','select'])
            ->make(true);
    }

    public function store(Request $request)
    {
        try{
            $blog = DB::transaction(function () use ($request) {
                $blog = new Blog;
                $blog->fillAndValidate($request->except(['blog_category_id']))->save();

                foreach ($request->blog_category_id as $key => $value) {
                    BlogHasCategory::firstOrCreate([
                        'blog_id'          => $blog->id,
                        'blog_category_id' => $value,
                    ]);
                }
                return $blog;
            });
        }catch(\Exception $ex){
            return $this->sendError('Insert Data Error!', $ex, 500);
        }

        return $this->sendResponse($blog, 'Insert Data Success!');
    }

    public function detail($id)
    {
        $blog = Blog::generateQuery()->findOrFail($id);

        $blog['blog_categories'] = BlogHasCategory::whereBlogId($id)->generateQuery()->get();
        return $this->sendResponse($blog, 'Get Data Success!');
    }

    public function update(Request $request, $id)
    {
        try{
            $blog = DB::transaction(function () use ($request, $id) {
                $blog = Blog::findOrFail($id);
                $blog->fillAndValidate($request->except(['blog_category_id']), Blog::ruleUpdate())->save();

                BlogHasCategory::whereBlogId($id)->delete();
                foreach ($request->blog_category_id as $key => $value) {
                    BlogHasCategory::firstOrCreate([
                        'blog_id'          => $blog->id,
                        'blog_category_id' => $value,
                    ]);
                }
                return $blog;
            });
        }catch(\Exception $ex){
            return $this->sendError('Update Data Error!', $ex, 500);
        }

        return $this->sendResponse($blog, 'Update Data Success!');
    }

    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $blog = Blog::findOrFail($id);
                $blog->delete();
            });
        }catch(\Exception $ex){
            return $this->sendError('Delete Data Error!', $ex, 500);
        }

        return $this->sendResponse([], 'Delete Data Success!');
    }

    public function exportXls(Request $request)
    {
        processing_jobs([
            'title'   => 'Download '.$this->label,
            'filters' => $request->all(),
            'model'   => BlogExportXls::class,
            'module'  => $this->label,
            'path'    => 'exports/blog/xlsx',
            'ext'     => 'xlsx',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');

    }

    public function exportPdf(Request $request)
    {
        processing_jobs([
            'title'   => 'Download '.$this->label,
            'filters' => $request->all(),
            'model'   => BlogExportPdf::class,
            'module'  => $this->label,
            'path'    => 'exports/blog/pdf',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');
    }

    public function import(Request $request)
    {
        processing_jobs([
            'title'  => 'Upload '.$this->label,
            'model'  => BlogImport::class,
            'module' => $this->label,
            'path'   => 'imports/blog',
        ]);
        
        return $this->sendResponse([], 'Upload '.$this->label.' has been processed.');
    }

    public function importTemplate()
    {
        return Excel::download(new BlogImportSheetTemplate, 'Template For Import '.$this->label.' Data.xlsx');
    }
}

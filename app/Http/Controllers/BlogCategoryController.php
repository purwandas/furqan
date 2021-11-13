<?php

namespace App\Http\Controllers;

use App\Components\Filters\BlogCategoryFilter;
use App\Components\Helpers\DatatableBuilderHelper;
use App\Components\Helpers\FormBuilderHelper;
use App\Components\Traits\ApiController;
use App\Exports\BlogCategoryExportPdf;
use App\Exports\BlogCategoryExportXls;
use App\Imports\BlogCategoryImport;
use App\Templates\BlogCategoryImportSheetTemplate;
use \App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BlogCategoryController extends Controller
{
    use ApiController;

    public $type, $label = "Blog Category", $icon = 'fa fa-user-md';

    public function index()
    {
        $data = [
            'title' => $this->label,
            'icon'  => $this->icon,
            'breadcrumb' => [
                ['label' => $this->label],
            ]
        ];

        $form_data = new FormBuilderHelper(BlogCategory::class,$data);
        $final     = $form_data->get();
        
        return view('components.global_form', $final);
    }

    public function list(BlogCategoryFilter $filter)
    {
        $blogCategory = BlogCategory::generateQuery($filter)->get();
        return $this->sendResponse($blogCategory, 'Get Data Success!');
    }

    public function select2(BlogCategoryFilter $filter)
    {
        return BlogCategory::generateQuery($filter)->get();
    }

    public function datatable(BlogCategoryFilter $filter)
    {
        $data = BlogCategory::generateQuery($filter);

        return \DataTables::of($data)
            ->addColumn('action', function ($data){
                $buttons = [];

                $buttons = array_merge($buttons, [
                                'edit' => [
                                    'onclick' => "editModalBlogCategory('".route('blog-category.edit',['id'=>$data->id])."')",
                                    'data-target' => '#modalFormBlogCategory',
                                    'icon' => getSvgIcon('fa-pencil-alt','mt-m-2'),
                                ],
                                'delete' => [
                                    'data-url' => route('blog-category.delete',['id'=>$data->id]),
                                    'icon' => getSvgIcon('fa-trash','mt-m-2'),
                                ],
                            ]);

                return DatatableBuilderHelper::button($buttons);
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        try{
            $blogCategory = DB::transaction(function () use ($request) {
                $blogCategory = new BlogCategory;
                $blogCategory->fillAndValidate()->save();
                return $blogCategory;
            });
        }catch(\Exception $ex){
            return $this->sendError('Insert Data Error!', $ex, 500);
        }

        return $this->sendResponse($blogCategory, 'Insert Data Success!');
    }

    public function detail($id)
    {
        $blogCategory = BlogCategory::generateQuery()->findOrFail($id);
        return $this->sendResponse($blogCategory, 'Get Data Success!');
    }

    public function update(Request $request, $id)
    {
        try{
            $blogCategory = DB::transaction(function () use ($request, $id) {
                $blogCategory = BlogCategory::findOrFail($id);
                $blogCategory->fillAndValidate($request->all(), BlogCategory::ruleUpdate())->save();
                return $blogCategory;
            });
        }catch(\Exception $ex){
            return $this->sendError('Update Data Error!', $ex, 500);
        }

        return $this->sendResponse($blogCategory, 'Update Data Success!');
    }

    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $blogCategory = BlogCategory::findOrFail($id);
                $blogCategory->delete();
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
            'model'   => BlogCategoryExportXls::class,
            'module'  => $this->label,
            'path'    => 'exports/blog-category/xlsx',
            'ext'     => 'xlsx',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');

    }

    public function exportPdf(Request $request)
    {
        processing_jobs([
            'title'   => 'Download '.$this->label,
            'filters' => $request->all(),
            'model'   => BlogCategoryExportPdf::class,
            'module'  => $this->label,
            'path'    => 'exports/blog-category/pdf',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');
    }

    public function import(Request $request)
    {
        processing_jobs([
            'title'  => 'Upload '.$this->label,
            'model'  => BlogCategoryImport::class,
            'module' => $this->label,
            'path'   => 'imports/blog-category',
        ]);
        
        return $this->sendResponse([], 'Upload '.$this->label.' has been processed.');
    }

    public function importTemplate()
    {
        return Excel::download(new BlogCategoryImportSheetTemplate, 'Template For Import '.$this->label.' Data.xlsx');
    }
}

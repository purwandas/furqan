<?php

namespace App\Http\Controllers;

use App\Components\Filters\LanguageFilter;
use App\Components\Helpers\DatatableBuilderHelper;
use App\Components\Helpers\FormBuilderHelper;
use App\Components\Traits\ApiController;
use App\Exports\LanguageExportPdf;
use App\Exports\LanguageExportXls;
use App\Imports\LanguageImport;
use App\Templates\LanguageImportSheetTemplate;
use \App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LanguageController extends Controller
{
    use ApiController;

    public $type, $label = "Language", $icon = 'fa fa-user-md';

    public function index()
    {
        $data = [
            'title' => $this->label,
            'icon'  => $this->icon,
            'breadcrumb' => [
                ['label' => $this->label],
            ]
        ];

        $form_data = new FormBuilderHelper(Language::class,$data);
        $final     = $form_data->get();
        
        return view('components.global_form', $final);
    }

    public function list(LanguageFilter $filter)
    {
        $language = Language::generateQuery($filter)->get();
        return $this->sendResponse($language, 'Get Data Success!');
    }

    public function select2(LanguageFilter $filter)
    {
        return Language::generateQuery($filter)->get();
    }

    public function datatable(LanguageFilter $filter)
    {
        $data = Language::generateQuery($filter);

        return \DataTables::of($data)
            ->addColumn('action', function ($data){
                $buttons = [];

                $buttons = array_merge($buttons, [
                                'edit' => [
                                    'onclick' => "editModalLanguage('".route('language.edit',['id'=>$data->id])."')",
                                    'data-target' => '#modalFormLanguage',
                                    'icon' => getSvgIcon('fa-pencil-alt','mt-m-2'),
                                ],
                                'delete' => [
                                    'data-url' => route('language.delete',['id'=>$data->id]),
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
            $language = DB::transaction(function () use ($request) {
                $language = new Language;
                $language->fillAndValidate()->save();
                return $language;
            });
        }catch(\Exception $ex){
            return $this->sendError('Insert Data Error!', $ex, 500);
        }

        return $this->sendResponse($language, 'Insert Data Success!');
    }

    public function detail($id)
    {
        $language = Language::generateQuery()->findOrFail($id);
        return $this->sendResponse($language, 'Get Data Success!');
    }

    public function update(Request $request, $id)
    {
        try{
            $language = DB::transaction(function () use ($request, $id) {
                $language = Language::findOrFail($id);
                $language->fillAndValidate($request->all(), Language::ruleUpdate())->save();
                return $language;
            });
        }catch(\Exception $ex){
            return $this->sendError('Update Data Error!', $ex, 500);
        }

        return $this->sendResponse($language, 'Update Data Success!');
    }

    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $language = Language::findOrFail($id);
                $language->delete();
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
            'model'   => LanguageExportXls::class,
            'module'  => $this->label,
            'path'    => 'exports/language/xlsx',
            'ext'     => 'xlsx',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');

    }

    public function exportPdf(Request $request)
    {
        processing_jobs([
            'title'   => 'Download '.$this->label,
            'filters' => $request->all(),
            'model'   => LanguageExportPdf::class,
            'module'  => $this->label,
            'path'    => 'exports/language/pdf',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');
    }

    public function import(Request $request)
    {
        processing_jobs([
            'title'  => 'Upload '.$this->label,
            'model'  => LanguageImport::class,
            'module' => $this->label,
            'path'   => 'imports/language',
        ]);
        
        return $this->sendResponse([], 'Upload '.$this->label.' has been processed.');
    }

    public function importTemplate()
    {
        return Excel::download(new LanguageImportSheetTemplate, 'Template For Import '.$this->label.' Data.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Components\Filters\ProvinceFilter;
use App\Components\Helpers\DatatableBuilderHelper;
use App\Components\Helpers\FormBuilderHelper;
use App\Components\Traits\ApiController;
use App\Exports\ProvinceExportPdf;
use App\Exports\ProvinceExportXls;
use App\Imports\ProvinceImport;
use App\Templates\ProvinceImportSheetTemplate;
use \App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProvinceController extends Controller
{
    use ApiController;

    public $type, $label = "Province", $icon = 'fa fa-user-md';

    public function index()
    {
        $data = [
            'title' => $this->label,
            'icon'  => $this->icon,
            'breadcrumb' => [
                ['label' => $this->label],
            ]
        ];

        $form_data = new FormBuilderHelper(Province::class,$data);
        $final     = $form_data->get();
        
        return view('components.global_form', $final);
    }

    public function list(ProvinceFilter $filter)
    {
        $province = Province::filter($filter)->get();
        return $this->sendResponse($province, 'Get Data Success!');
    }

    public function select2(ProvinceFilter $filter)
    {
        return Province::filter($filter)->get();
    }

    public function datatable(ProvinceFilter $filter)
    {
        $data = Province::filter($filter);

        return \DataTables::of($data)
            ->addColumn('action', function ($data){
                $buttons = [];

                $buttons = array_merge($buttons, [
                                'edit' => [
                                    'onclick' => "editModalProvince('".route('province.edit',['id'=>$data->id])."')",
                                    'data-target' => '#modalFormProvince',
                                    'icon' => getSvgIcon('fa-pencil-alt','mt-m-2'),
                                ],
                                'delete' => [
                                    'data-url' => route('province.delete',['id'=>$data->id]),
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
            $province = DB::transaction(function () use ($request) {
                $province = new Province;
                $province->fillAndValidate()->save();
                return $province;
            });
        }catch(\Exception $ex){
            return $this->sendError('Insert Data Error!', $ex, 500);
        }

        return $this->sendResponse($province, 'Insert Data Success!');
    }

    public function detail($id)
    {
        $province = Province::findOrFail($id);
        return $this->sendResponse($province, 'Get Data Success!');
    }

    public function update(Request $request, $id)
    {
        try{
            $province = DB::transaction(function () use ($request, $id) {
                $province = Province::findOrFail($id);
                $province->fillAndValidateUpdate()->save();
                return $province;
            });
        }catch(\Exception $ex){
            return $this->sendError('Update Data Error!', $ex, 500);
        }

        return $this->sendResponse($province, 'Update Data Success!');
    }

    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $province = Province::findOrFail($id);
                $province->delete();
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
            'model'   => ProvinceExportXls::class,
            'module'  => $this->label,
            'path'    => 'exports/province/xlsx',
            'ext'     => 'xlsx',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');

    }

    public function exportPdf(Request $request)
    {
        processing_jobs([
            'title'   => 'Download '.$this->label,
            'filters' => $request->all(),
            'model'   => ProvinceExportPdf::class,
            'module'  => $this->label,
            'path'    => 'exports/province/pdf',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');
    }

    public function import(Request $request)
    {
        processing_jobs([
            'title'  => 'Upload '.$this->label,
            'model'  => ProvinceImport::class,
            'module' => $this->label,
            'path'   => 'imports/province',
        ]);
        
        return $this->sendResponse([], 'Upload '.$this->label.' has been processed.');
    }

    public function importTemplate()
    {
        return Excel::download(new ProvinceImportSheetTemplate, 'Template For Import '.$this->label.' Data.xlsx');
    }
}

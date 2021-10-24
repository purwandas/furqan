<?php

namespace App\Http\Controllers;

use App\Components\Filters\CityFilter;
use App\Components\Helpers\DatatableBuilderHelper;
use App\Components\Helpers\FormBuilderHelper;
use App\Components\Traits\ApiController;
use App\Exports\CityExportPdf;
use App\Exports\CityExportXls;
use App\Imports\CityImport;
use App\Templates\CityImportSheetTemplate;
use \App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CityController extends Controller
{
    use ApiController;

    public $type, $label = "City", $icon = 'fa fa-user-md';

    public function index()
    {
        $data = [
            'title' => $this->label,
            'icon'  => $this->icon,
            'breadcrumb' => [
                ['label' => $this->label],
            ]
        ];

        $form_data = new FormBuilderHelper(City::class,$data);
        $final     = $form_data->get();
        
        return view('components.global_form', $final);
    }

    public function list(CityFilter $filter)
    {
        $city = City::join('provinces', 'provinces.id', 'cities.province_id')
			->select('cities.*', 'provinces.name as province_name')
			->filter($filter)->get();
        return $this->sendResponse($city, 'Get Data Success!');
    }

    public function select2(CityFilter $filter)
    {
        return City::join('provinces', 'provinces.id', 'cities.province_id')
			->select('cities.*', 'provinces.name as province_name')
			->filter($filter)->get();
    }

    public function datatable(CityFilter $filter)
    {
        $data = City::join('provinces', 'provinces.id', 'cities.province_id')
			->select('cities.*', 'provinces.name as province_name')
			->filter($filter);

        return \DataTables::of($data)
            ->addColumn('action', function ($data){
                $buttons = [];

                $buttons = array_merge($buttons, [
                                'edit' => [
                                    'onclick' => "editModalCity('".route('city.edit',['id'=>$data->id])."')",
                                    'data-target' => '#modalFormCity',
                                    'icon' => getSvgIcon('fa-pencil-alt','mt-m-2'),
                                ],
                                'delete' => [
                                    'data-url' => route('city.delete',['id'=>$data->id]),
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
            $city = DB::transaction(function () use ($request) {
                $city = new City;
                $city->fillAndValidate()->save();
                return $city;
            });
        }catch(\Exception $ex){
            return $this->sendError('Insert Data Error!', $ex, 500);
        }

        return $this->sendResponse($city, 'Insert Data Success!');
    }

    public function detail($id)
    {
        $city = City::join('provinces', 'provinces.id', 'cities.province_id')
			->select('cities.*', 'provinces.name as province_name')
			->findOrFail($id);
        return $this->sendResponse($city, 'Get Data Success!');
    }

    public function update(Request $request, $id)
    {
        try{
            $city = DB::transaction(function () use ($request, $id) {
                $city = City::findOrFail($id);
                $city->fillAndValidateUpdate()->save();
                return $city;
            });
        }catch(\Exception $ex){
            return $this->sendError('Update Data Error!', $ex, 500);
        }

        return $this->sendResponse($city, 'Update Data Success!');
    }

    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $city = City::findOrFail($id);
                $city->delete();
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
            'model'   => CityExportXls::class,
            'module'  => $this->label,
            'path'    => 'exports/city/xlsx',
            'ext'     => 'xlsx',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');

    }

    public function exportPdf(Request $request)
    {
        processing_jobs([
            'title'   => 'Download '.$this->label,
            'filters' => $request->all(),
            'model'   => CityExportPdf::class,
            'module'  => $this->label,
            'path'    => 'exports/city/pdf',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');
    }

    public function import(Request $request)
    {
        processing_jobs([
            'title'  => 'Upload '.$this->label,
            'model'  => CityImport::class,
            'module' => $this->label,
            'path'   => 'imports/city',
        ]);
        
        return $this->sendResponse([], 'Upload '.$this->label.' has been processed.');
    }

    public function importTemplate()
    {
        return Excel::download(new CityImportSheetTemplate, 'Template For Import '.$this->label.' Data.xlsx');
    }
}

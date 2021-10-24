<?php

namespace App\Http\Controllers;

use App\Components\Filters\RoleFilter;
use App\Components\Helpers\DatatableBuilderHelper;
use App\Components\Helpers\FormBuilderHelper;
use App\Components\Traits\ApiController;
use App\Exports\RoleExportPdf;
use App\Exports\RoleExportXls;
use App\Imports\RoleImport;
use App\Templates\RoleImportSheetTemplate;
use \App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    use ApiController;

    public $type, $label = "Permission", $icon = 'fa fa-user-md';

    public function index()
    {
        $data = [
            'title' => $this->label,
            'icon'  => $this->icon,
            'breadcrumb' => [
                ['label' => $this->label],
            ]
        ];

        $form_data = new FormBuilderHelper(Role::class,$data);
        $final     = $form_data->get();
        
        return view('components.global_form', $final);
    }

    public function list(RoleFilter $filter)
    {
        $role = Role::generateQuery($filter)->get();
        return $this->sendResponse($role, 'Get Data Success!');
    }

    public function select2(RoleFilter $filter)
    {
        return Role::generateQuery($filter)->get();
    }

    public function datatable(RoleFilter $filter)
    {
        $data = Role::generateQuery($filter);

        return \DataTables::of($data)
            ->addColumn('action', function ($data){
                $buttons = [];

                $buttons = array_merge($buttons, [
                                'edit' => [
                                    'onclick' => "editModalRole('".route('role.edit',['id'=>$data->id])."')",
                                    'data-target' => '#modalFormRole',
                                    'icon' => getSvgIcon('fa-pencil-alt','mt-m-2'),
                                ],
                                'delete' => [
                                    'data-url' => route('role.delete',['id'=>$data->id]),
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
            $role = DB::transaction(function () use ($request) {
                $role = new Role;
                $role->fillAndValidate()->save();
                return $role;
            });
        }catch(\Exception $ex){
            return $this->sendError('Insert Data Error!', $ex, 500);
        }

        return $this->sendResponse($role, 'Insert Data Success!');
    }

    public function detail($id)
    {
        $role = Role::generateQuery()->findOrFail($id);
        return $this->sendResponse($role, 'Get Data Success!');
    }

    public function update(Request $request, $id)
    {
        try{
            $role = DB::transaction(function () use ($request, $id) {
                $role = Role::findOrFail($id);
                $role->fillAndValidate($request->all(), Role::ruleUpdate())->save();
                return $role;
            });
        }catch(\Exception $ex){
            return $this->sendError('Update Data Error!', $ex, 500);
        }

        return $this->sendResponse($role, 'Update Data Success!');
    }

    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $role = Role::findOrFail($id);
                $role->delete();
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
            'model'   => RoleExportXls::class,
            'module'  => $this->label,
            'path'    => 'exports/role/xlsx',
            'ext'     => 'xlsx',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');

    }

    public function exportPdf(Request $request)
    {
        processing_jobs([
            'title'   => 'Download '.$this->label,
            'filters' => $request->all(),
            'model'   => RoleExportPdf::class,
            'module'  => $this->label,
            'path'    => 'exports/role/pdf',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');
    }

    public function import(Request $request)
    {
        processing_jobs([
            'title'  => 'Upload '.$this->label,
            'model'  => RoleImport::class,
            'module' => $this->label,
            'path'   => 'imports/role',
        ]);
        
        return $this->sendResponse([], 'Upload '.$this->label.' has been processed.');
    }

    public function importTemplate()
    {
        return Excel::download(new RoleImportSheetTemplate, 'Template For Import '.$this->label.' Data.xlsx');
    }
}

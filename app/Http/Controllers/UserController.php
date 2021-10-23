<?php

namespace App\Http\Controllers;

use App\Components\Filters\UserFilter;
use App\Components\Helpers\DatatableBuilderHelper;
use App\Components\Helpers\FormBuilderHelper;
use App\Components\Traits\ApiController;
use App\Exports\UserExportPdf;
use App\Exports\UserExportXls;
use App\Imports\UserImport;
use App\Templates\UserImportSheetTemplate;
use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    use ApiController;

    public $type, $label = "User";

    public function index()
    {
        $data = [
            'title' => $this->label,
            'icon'  => 'fa fa-user-md',
            'breadcrumb' => [
                ['label' => $this->label],
            ]
        ];

        $form_data = new FormBuilderHelper(User::class,$data);
        $final     = $form_data
            ->setCustomFormBuilder([
                'password' => [
                    'type' => 'password'
                ],
                'retype_password' => [
                    'type' => 'password'
                ]
            ])
            ->setExceptDatatableColumns(['password'])
            ->setExceptFilter(['password'])
            ->useUtilities(false)
            ->useFilter(false)
            ->get();
        
        return view('components.global_form', $final);
    }

    public function list(UserFilter $filter)
    {
        $user = User::join('roles', 'roles.id', 'users.role_id')
			->select('users.*', 'roles.name as role_name')
			->filter($filter)->get();
        return $this->sendResponse($user, 'Get Data Success!');
    }

    public function select2(UserFilter $filter)
    {
        return User::join('roles', 'roles.id', 'users.role_id')
			->select('users.*', 'roles.name as role_name')
			->filter($filter)->get();
    }

    public function datatable(UserFilter $filter)
    {
        $data = User::join('roles', 'roles.id', 'users.role_id')
			->select('users.*', 'roles.name as role_name')
			->filter($filter);

        return \DataTables::of($data)
            ->addColumn('action', function ($data){
                $buttons = [];

                $buttons = array_merge($buttons, [
                                'edit' => [
                                    'onclick' => "editModalUser('".route('user.edit',['id'=>$data->id])."')",
                                    'data-target' => '#modalFormUser',
                                    'icon' => getSvgIcon('fa-pencil-alt','mt-m-2'),
                                ],
                                'delete' => [
                                    'data-url' => route('user.delete',['id'=>$data->id]),
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
            $user = DB::transaction(function () use ($request) {

                if ($request->password != $request->retype_password) {
                    return $this->sendError('Password did not match!', $ex, 500);
                }
                $user = new User;
                $user->fillAndValidate($request->except(['retype_password']))->save();
                return $user;
            });
        }catch(\Exception $ex){
            return $this->sendError('Insert Data Error!', $ex, 500);
        }

        return $this->sendResponse($user, 'Insert Data Success!');
    }

    public function detail($id)
    {
        $user = User::join('roles', 'roles.id', 'users.role_id')
			->select('users.*', 'roles.name as role_name')
			->findOrFail($id);
        return $this->sendResponse($user, 'Get Data Success!');
    }

    public function update(Request $request, $id)
    {
        try{
            $user = DB::transaction(function () use ($request, $id) {
                $user = User::findOrFail($id);
                $user->fillAndValidate($request->except(['retype_password']))->save();
                return $user;
            });
        }catch(\Exception $ex){
            return $this->sendError('Update Data Error!', $ex, 500);
        }

        return $this->sendResponse($user, 'Update Data Success!');
    }

    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $user = User::findOrFail($id);
                $user->delete();
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
            'model'   => UserExportXls::class,
            'module'  => $this->label,
            'path'    => 'exports/user/xlsx',
            'ext'     => 'xlsx',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');

    }

    public function exportPdf(Request $request)
    {
        processing_jobs([
            'title'   => 'Download '.$this->label,
            'filters' => $request->all(),
            'model'   => UserExportPdf::class,
            'module'  => $this->label,
            'path'    => 'exports/user/pdf',
        ]);
        
        return $this->sendResponse([], 'Download '.$this->label.' has been processed.');
    }

    public function import(Request $request)
    {
        processing_jobs([
            'title'  => 'Upload '.$this->label,
            'model'  => UserImport::class,
            'module' => $this->label,
            'path'   => 'imports/user',
        ]);
        
        return $this->sendResponse([], 'Upload '.$this->label.' has been processed.');
    }

    public function importTemplate()
    {
        return Excel::download(new UserImportSheetTemplate, 'Template For Import '.$this->label.' Data.xlsx');
    }
}

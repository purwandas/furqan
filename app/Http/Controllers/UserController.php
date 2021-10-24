<?php

namespace App\Http\Controllers;

use App\Components\Filters\UserFilter;
use App\Components\Helpers\DatatableBuilderHelper;
use App\Components\Helpers\FormBuilderHelper;
use App\Components\Traits\ApiController;
use App\Exports\UserExportPdf;
use App\Exports\UserExportXls;
use App\Imports\UserImport;
use App\Models\Role;
use App\Templates\UserImportSheetTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use \App\User;

class UserController extends Controller
{
    use ApiController;

    public $type, $label = "User", $icon = 'fa fa-user-md';

    public function index()
    {
        $data = [
            'title' => $this->label,
            'icon'  => $this->icon,
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
            ])
            ->setExceptDatatableColumns(['password'])
            ->setExceptFilter(['password'])
            ->useUtilities(false)
            ->useFilter(false)
            ->get();
        
        return view('components.global_form', $final);
    }

    public function updateProfile()
    {
        $user = \Auth::user();

        $label = 'Profile';
        $data = [
            'title' => $label,
            'icon'  => $this->icon,
            'breadcrumb' => [
                ['label' => 'Update '.$label],
            ],
            'customVariables' => [
                'id' => $user->id,
            ],
        ];

        $customFormBuilder = [];
        $exceptColumn      = [];

        if (! ($user->role_id == Role::ADMIN) ){
            $exceptColumn = ['password', 'role_id'];
        } else {
            $customFormBuilder['role_id'] = [
                'type'      => 'select2',
                'value'     => [Role::ADMIN, Role::ADMIN_LABEL],
                'name'      => 'role_id',
                'text'      => 'obj.name',
                'options'   => 'role.select2',
                'keyTerm'   => '_name',
                'elOptions' => [
                    'placeholder' => 'Permission',
                ]
            ];

            $customFormBuilder['city_id'] = [
                'type'      => 'select2',
                'value'     => [$user->city_id, @$user->city->name],
                'name'      => 'city_id',
                'text'      => 'obj.name',
                'options'   => 'city.select2',
                'keyTerm'   => '_name',
                'ajaxParams'   => ['province_id' => "$('#user_province_id').val()"],
                'elOptions' => [
                    'placeholder' => 'City',
                    'required'    => 'required',
                ]
            ];
        }

        $customOrder = ['name', 'email', 'phone_number', 'password', 'province_id', 'city_id', 'role_id'];

        $form_data = new FormBuilderHelper(User::class,$data);
        $final     = $form_data
                    ->setFormPage(true)
                    ->useModal(false)
                    ->useDatatable(false)
                    ->setExceptFormBuilderColumns($exceptColumn)
                    ->setCustomFormBuilder($customFormBuilder)
                    ->setCustomOrderFormBuilder($customOrder)
                    // ->injectView('inject/sales-form')
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
                $request['password'] = bcrypt($request['password']);

                $user = new User;
                $user->fillAndValidate()->save();
                return $user;
            });
        }catch(\Exception $ex){
            return $this->sendError('Insert Data Error!', $ex, 500);
        }

        return $this->sendResponse($user, 'Insert Data Success!');
    }

    public function detail($id)
    {
        $user = User::leftJoin('roles', 'roles.id', 'users.role_id')
            ->leftJoin('provinces', 'provinces.id', 'users.province_id')
            ->leftJoin('cities', 'cities.id', 'users.city_id')
			->select('users.*', 'roles.name as role_name', 'provinces.name as province_name', 'cities.name as city_name')
			->findOrFail($id);
        return $this->sendResponse($user, 'Get Data Success!');
    }

    public function update(Request $request, $id)
    {
        try{
            $user = DB::transaction(function () use ($request, $id) {

                if (empty($request['password'])) {
                    unset($request['password']);
                } else {
                    $request['password'] = bcrypt($request['password']);
                }

                $user = User::findOrFail($id);
                $user->fillAndValidateUpdate()->save();
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

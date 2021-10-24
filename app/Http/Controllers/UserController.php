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
use Illuminate\Support\Facades\Hash;
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
        $exceptColumn      = ['password'];

        if (! ($user->role_id == Role::ADMIN) ){

            $customFormBuilder['role_id'] = [
                'type'      => 'select2',
                'value'     => [$user->role_id, $user->role->name],
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

        } else {
            $exceptColumn = array_merge($exceptColumn, ['role_id','phone_number','province_id','city_id']);
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

    public function updatePassword()
    {
        $user = \Auth::user();

        $label = 'Password';
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
        $exceptColumn      = ['name','email','phone_number','province_id','city_id','role_id'];

            $customFormBuilder['password'] = [
                'type' => 'password',
                'elOptions' => [
                    'placeholder' => 'Current Password',
                    'required'    => 'required',
                ],
                'labelContainerClass' => 'col-md-3',
                'inputContainerClass' => 'col-md-9',
            ];

            $customFormBuilder['new_password'] = [
                'type' => 'password',
                'elOptions' => [
                    'placeholder' => 'New Password',
                    'required'    => 'required',
                ],
                'labelContainerClass' => 'col-md-3',
                'inputContainerClass' => 'col-md-9',
            ];

            $customFormBuilder['new_password_confirmation'] = [
                'type' => 'password',
                'elOptions' => [
                    'placeholder' => 'New Password (re-type)',
                    'required'    => 'required',
                ],
                'labelContainerClass' => 'col-md-3',
                'inputContainerClass' => 'col-md-9',
            ];

        $form_data = new FormBuilderHelper(User::class,$data);
        $final     = $form_data
                    ->setFormPage(true)
                    ->useModal(false)
                    ->useDatatable(false)
                    ->setExceptFormBuilderColumns($exceptColumn)
                    ->setCustomFormBuilder($customFormBuilder)
                    ->get();
        
        return view('components.global_form', $final);
    }

    public function list(UserFilter $filter)
    {
        $user = User::generateQuery($filter)->get();

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
        $data = User::generateQuery($filter);

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
        $user = User::generateQuery()->findOrFail($id);

        return $this->sendResponse($user, 'Get Data Success!');
    }

    public function update(Request $request, $id)
    {
        try{
            $user = DB::transaction(function () use ($request, $id) {

                $user = User::findOrFail($id);

                if (isset($request->new_password)) { // update password only
                    
                    $this->validateRequest($request->all(),[
                        'password'     => 'required|string',
                        'new_password' => 'required|string|confirmed',
                    ]);

                    if (Hash::check($request->password, $user->password)) {
                        $user->password = bcrypt($request['new_password']);
                        $user->save();
                    } else {
                        return ['success' => false, 'response' => $this->sendError('Current Password was wrong!', null, 500)];
                    }

                } else {

                    if (empty($request['password'])) {
                        unset($request['password']);
                    } else {
                        $request['password'] = bcrypt($request['password']);
                    }

                    $user->fillAndValidateUpdate()->save();

                }
                return $user;
            });
        }catch(\Exception $ex){
            return $this->sendError('Update Data Error!', $ex, 500);
        }

        if (array_key_exists('success', $user)) {
            return $user['response'];
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

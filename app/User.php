<?php

namespace App;

use App\Components\Filters\QueryFilters;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'province_id', 'city_id', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rule(){
        return [
            'name'         => 'required|string|min:8|max:50',
            'email'        => 'required|email|sometimes|unique:users,email',
            'password'     => 'required',
            'phone_number' => 'required|numeric',
            'province_id'  => 'required|exists:provinces,id',
            'city_id'      => 'required|exists:cities,id',
            'role_id'      => 'nullable|exists:roles,id',
        ];
    
    }

    public static function ruleUpdate(){
        return [
            'name'         => 'required|string|min:8|max:50',
            'email'        => 'required|email|sometimes',
            'password'     => 'nullable',
            'phone_number' => 'required|numeric',
            'province_id'  => 'required|exists:provinces,id',
            'city_id'      => 'required|exists:cities,id',
            'role_id'      => 'nullable|exists:roles,id',
        ];
    
    }

    public function role()
    {
        return $this->belongsTo($this->_role(), 'role_id');
    }

    public static function _role()
    {
        return '\\App\Models\Role';
    }

    public function province()
    {
        return $this->belongsTo($this->_province(), 'province_id');
    }

    public static function _province()
    {
        return '\\App\Models\Province';
    }

    public function city()
    {
        return $this->belongsTo($this->_city(), 'city_id');
    }

    public static function _city()
    {
        return '\\App\Models\City';
    }

    public static function toKey()
    {
        $classModel = explode('\\', static::class);
        $string     = end($classModel);
        $kebab      = Str::kebab($string);

        return [
            'class' => $string,
            'route' => $kebab,
            'snake' => Str::snake($string),
            'title' => str_replace('-', ' ', $kebab),
        ];
    }

    public function fillAndValidate($customData = null, $rule = null)
    {
        $rule = $rule ?? static::rule($this);
        $data = $customData ?? request()->all();
        $attributes = method_exists(static::class, 'attributes') ? static::attributes() : [];

        $validatedData = \Validator::make($data, $rule, [], $attributes)->validate();

        return parent::fill($validatedData);
    }

    public function fillAndValidateUpdate($customData = null, $rule = null)
    {
        $rule = $rule ?? static::ruleUpdate($this);
        $data = $customData ?? request()->all();
        $attributes = method_exists(static::class, 'attributes') ? static::attributes() : [];

        $validatedData = \Validator::make($data, $rule, [], $attributes)->validate();

        return parent::fill($validatedData);
    }

    public function scopeFilter($query, QueryFilters $filters)
    {
        return $filters->apply($query);
    }

    public function scopeGenerateQuery($query, $filter = [])
    {
        $query->leftJoin('roles', 'roles.id', 'users.role_id')
            ->leftJoin('provinces', 'provinces.id', 'users.province_id')
            ->leftJoin('cities', 'cities.id', 'users.city_id')
            ->select('users.*', 'roles.name as role_name', 'provinces.name as province_name', 'cities.name as city_name')
            ->when(!empty($filter), function($q) use ($filter){
                $q->filter($filter);
            });
    }

    public static function labelText()
    {
        return ['name'];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}

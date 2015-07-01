<?php

namespace TeachersAsTutors;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['is_admin', 'is_tutor', 'is_parent'];

    protected $casts = ['is_admin' => 'boolean', 'is_tutor' => 'boolean', 'is_parent' => 'boolean'];

    public function permission()
    {
        return $this->hasOne('TeachersAsTutors\UserPermission', 'id', 'permission');
    }

    public function getIsAdminAttribute()
    {
        return $this->permission->name === 'Admin';
    }

    public function getIsTutorAttribute()
    {
        return $this->permission->name === 'Tutor';
    }

    public function getIsParentAttribute()
    {
        return $this->permission->name === 'Parent';
    }
}

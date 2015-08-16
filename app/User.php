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
    protected $fillable = ['name', 'email', 'password', 'is_enabled',];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['is_admin', 'is_tutor', 'is_parent'];

    protected $casts
        = [
            'is_admin' => 'boolean',
            'is_tutor' => 'boolean',
            'is_parent' => 'boolean',
            'is_enabled' => 'boolean',
        ];

    public function permission()
    {
        return $this->hasOne(UserPermission::class, 'id', 'permission_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'tutor_id', 'id');
    }

    // TODO: Don't hardcode keys!
    public function getIsAdminAttribute()
    {
        return $this->permission_id === 1;
    }

    public function getIsTutorAttribute()
    {
        return $this->permission_id === 2;
    }

    public function getIsParentAttribute()
    {
        return $this->permission_id === 3;
    }
}

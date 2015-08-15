<?php

namespace TeachersAsTutors;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lessons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tutor_id', 'parent_id', 'started_at', 'ended_at', 'is_completed', 'created_by', 'updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $casts = ['is_completed' => 'boolean'];

    public function parent()
    {
        return $this->belongsTo(User::class, 'id', 'parent_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'id', 'tutor_id');
    }
}

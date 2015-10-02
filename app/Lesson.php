<?php

namespace TeachersAsTutors;

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
    protected $fillable = ['tutor_id', 'parent_id', 'started_at', 'hours', 'hourly_rate', 'created_by', 'updated_by',];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $casts = ['hours' => 'float', 'hourly_rate' => 'float'];

    protected $dates = ['started_at',];

    protected $appends = ['cost'];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id', 'id');
    }

    public function getCostAttribute()
    {
        return $this->hours * $this->hourly_rate;
    }
}

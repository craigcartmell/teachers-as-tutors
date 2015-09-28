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
    protected $fillable = ['tutor_id', 'parent_id', 'started_at', 'ended_at', 'hourly_rate', 'created_by', 'updated_by',];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $casts = [];

    protected $dates = ['started_at', 'ended_at',];

    protected $appends = ['total_hours', 'cost'];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id', 'id');
    }

    public function getTotalHoursAttribute()
    {
        // TODO: Work out hours, speak to Alexa
        $hours = $this->started_at->diffInHours($this->ended_at);

        return empty($hours) ? 1 : $hours;
    }

    public function getCostAttribute()
    {
        return $this->getTotalHoursAttribute() * $this->hourly_rate;
    }
}

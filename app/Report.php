<?php

namespace TeachersAsTutors;

class Report extends Model
{
    protected $parsedown;

    protected $appends = ['report_formatted'];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->parsedown = new \Parsedown();
    }

    public function getReportFormattedAttribute()
    {
        return $this->parsedown->text($this->report);
    }
}

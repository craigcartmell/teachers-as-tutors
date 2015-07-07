<?php namespace TeachersAsTutors;

class Model extends \Illuminate\Database\Eloquent\Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function creator()
    {
        return $this->belongsTo('TeachersAsTutors\User', 'created_by', 'id');
    }

    public function updater()
    {
        return $this->belongsTo('TeachersAsTutors\User', 'updated_by', 'id');
    }
}
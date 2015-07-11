<?php

namespace TeachersAsTutors;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function parent()
    {
        return $this->belongsTo('TeachersAsTutors\User', 'parent_id', 'id');
    }
}

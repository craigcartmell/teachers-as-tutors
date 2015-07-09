<?php

namespace TeachersAsTutors;

class Resource extends Model
{
    protected $appends = ['size_formatted'];

    public function getSizeFormattedAttribute()
    {
        return human_filesize($this->size);
    }
}

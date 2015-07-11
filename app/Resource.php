<?php

namespace TeachersAsTutors;

class Resource extends Model
{
    protected $appends = ['size_formatted', 'full_file_path'];

    public function getSizeFormattedAttribute()
    {
        return human_filesize($this->size);
    }

    public function getFullFilePathAttribute()
    {
        return storage_path('app/resources/' . $this->filename);
    }
}

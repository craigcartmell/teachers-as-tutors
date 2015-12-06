<?php

namespace TeachersAsTutors;

class Folder extends Model
{
    public function resources()
    {
        return $this->hasMany('TeachersAsTutors\Resource', 'folder_id', 'id');
    }
}
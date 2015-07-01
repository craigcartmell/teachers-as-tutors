<?php namespace TeachersAsTutors\Database\Schema;

class Blueprint extends \Illuminate\Database\Schema\Blueprint
{
    public function authors()
    {
        $this->integer('created_by')->unsigned()->nullable();
        $this->integer('updated_by')->unsigned()->nullable();

        $this->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        $this->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
    }
}
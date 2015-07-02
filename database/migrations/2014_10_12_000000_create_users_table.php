<?php

use TeachersAsTutors\Database\Migration;
use TeachersAsTutors\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->integer('permission_id')->unsigned()->nullable();
            $table->boolean('is_enabled');
            $table->authors();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('users');
    }
}

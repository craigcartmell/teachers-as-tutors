<?php

use TeachersAsTutors\Database\Migration;
use TeachersAsTutors\Database\Schema\Blueprint;

class CreateLessonsTable extends Migration
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
        $this->schema->create('lessons', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->integer('tutor_id', false, true)->nullable();
            $table->integer('parent_id', false, true)->nullable();
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->boolean('is_completed');
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
        $this->schema->dropIfExists('lessons');
    }
}

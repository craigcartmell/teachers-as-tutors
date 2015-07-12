<?php

use TeachersAsTutors\Database\Migration;
use TeachersAsTutors\Database\Schema\Blueprint;

class CreateReportsTable extends Migration
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
        $this->schema->create('reports', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('report');
            $table->boolean('is_enabled')->default(0);
            $table->authors();
            $table->timestamps();

            $table->unique(['name', 'slug']);
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('reports');
    }
}

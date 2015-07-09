<?php

use TeachersAsTutors\Database\Migration;
use TeachersAsTutors\Database\Schema\Blueprint;

class CreateResourcesTable extends Migration
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
        $this->schema->create('resources', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->string('desc');
            $table->string('original_filename');
            $table->string('filename')->unique();
            $table->integer('size');
            $table->string('extension', 10);
            $table->string('mime_type', 50);
            $table->boolean('is_enabled')->default(0);
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
        $this->schema->dropIfExists('resources');
    }
}

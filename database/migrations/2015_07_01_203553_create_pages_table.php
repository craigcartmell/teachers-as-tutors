<?php

use TeachersAsTutors\Database\Migration;
use TeachersAsTutors\Database\Schema\Blueprint;

class CreatePagesTable extends Migration
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
        $this->schema->create('pages', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->string('name');
            $table->string('uri')->unique();
            $table->string('hero_image_uri');
            $table->text('hero_text');
            $table->text('content');
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
        $this->schema->dropIfExists('pages');
    }
}

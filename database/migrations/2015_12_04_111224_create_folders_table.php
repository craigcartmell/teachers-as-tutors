<?php

use TeachersAsTutors\Database\Migration;
use TeachersAsTutors\Database\Schema\Blueprint;

class CreateFoldersTable extends Migration
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
        $this->schema->create('folders', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->string('name');
            $table->authors();
            $table->timestamps();

            $table->unique(['name']);
        });

        $this->schema->table('resources', function (Blueprint $table) {
            $table->integer('folder_id', false, true)->nullable()->after('id');
        });

        $this->schema->table('resources', function (Blueprint $table) {
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            $this->schema->table('resources', function (Blueprint $table) {
                $table->dropForeign('resources_folder_id_foreign');
            });
        } catch (Exception $e) {

        }

        $this->schema->dropIfExists('folders');
    }
}

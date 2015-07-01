<?php

use TeachersAsTutors\Database\Migration;
use TeachersAsTutors\Database\Schema\Blueprint;

class CreateUserPermissionsTable extends Migration
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
        $this->schema->create('user_permissions', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->string('name');
            $table->text('desc');
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
        try {
            $this->schema->table('users', function (Blueprint $table) {
                $table->dropForeign('users_permission_foreign');
            });
        } catch (Exception $e) {

        }

        $this->schema->dropIfExists('user_permissions');
    }
}

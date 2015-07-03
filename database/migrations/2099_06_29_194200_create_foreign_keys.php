<?php

use TeachersAsTutors\Database\Migration;
use TeachersAsTutors\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
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
        $this->schema->table('users', function (Blueprint $table) {
            $table->foreign('permission_id')->references('id')->on('user_permissions')->onDelete('set null');
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
                $table->dropForeign('users_created_by_foreign');
                $table->dropForeign('users_updated_by_foreign');
                $table->dropForeign('users_permission_id_foreign');
            });
        } catch (Exception $e) {

        }

        try {
            $this->schema->table('user_permissions', function (Blueprint $table) {
                $table->dropForeign('user_permissions_created_by_foreign');
                $table->dropForeign('user_permissions_updated_by_foreign');
            });
        } catch (Exception $e) {

        }

        try {
            $this->schema->table('pages', function (Blueprint $table) {
                $table->dropForeign('pages_created_by_foreign');
                $table->dropForeign('pages_updated_by_foreign');
                $table->dropForeign('pages_parent_id_foreign');
            });
        } catch (Exception $e) {

        }
    }
}

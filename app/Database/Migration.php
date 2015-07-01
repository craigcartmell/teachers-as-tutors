<?php namespace TeachersAsTutors\Database;

use Illuminate\Support\Facades\DB;
use TeachersAsTutors\Database\Schema\Blueprint;

class Migration extends \Illuminate\Database\Migrations\Migration
{
    protected $schema;

    public function __construct()
    {
        $this->schema = DB::connection()->getSchemaBuilder();

        $this->schema->blueprintResolver(function ($table, $callback) {
            return new Blueprint($table, $callback);
        });
    }
}
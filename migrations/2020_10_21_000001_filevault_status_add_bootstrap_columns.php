<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class FilevaultStatusAddBootstrapColumns extends Migration
{
    private $tableName = 'filevault_status';

    public function up()
    {
        $capsule = new Capsule();
        
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->boolean('bootstraptoken_supported')->nullable();
            $table->boolean('bootstraptoken_escrowed')->nullable();
        });

        // Create indexes
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->index('bootstraptoken_supported');
            $table->index('bootstraptoken_escrowed');
        });
        
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('bootstraptoken_supported');
            $table->dropColumn('bootstraptoken_escrowed');
       });
    }
}

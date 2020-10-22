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
            $table->dropColumn('auth_restart_support');
            $table->dropColumn('fv_master_keychain');
            $table->dropColumn('has_institutional_recovery_key');
            $table->dropColumn('has_personal_recovery_key');
            $table->dropColumn('using_recovery_key');
            $table->dropColumn('conversion_percent');
            $table->dropColumn('bytes_converted');
            $table->dropColumn('volume_size');
            $table->dropColumn('conversion_state_detail');
            $table->dropColumn('conversion_state');
            $table->dropColumn('fv_progress_status');
            $table->dropColumn('device_identifier');
            $table->dropColumn('pvdeviceid');
            $table->dropColumn('volume_name');
            $table->dropColumn('lvf_uuid');
            $table->dropColumn('lvg_uuid');
            $table->dropColumn('pv_uuid');
            $table->dropColumn('uuid');
            $table->dropColumn('filevault_users');
            $table->dropColumn('crypto_users');
            $table->dropColumn('deferral_info');
            $table->dropColumn('bootstraptoken_supported');
            $table->dropColumn('bootstraptoken_escrowed');
       });
    }
}

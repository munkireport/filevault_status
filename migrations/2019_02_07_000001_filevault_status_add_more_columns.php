<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class FilevaultStatusAddMoreColumns extends Migration
{
    private $tableName = 'filevault_status';

    public function up()
    {
        $capsule = new Capsule();
        
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->boolean('auth_restart_support')->nullable();
            $table->boolean('fv_master_keychain')->nullable();
            $table->boolean('has_institutional_recovery_key')->nullable();
            $table->boolean('has_personal_recovery_key')->nullable();
            $table->boolean('using_recovery_key')->nullable();
            $table->integer('conversion_percent')->nullable();
            $table->bigInteger('bytes_converted')->nullable();
            $table->bigInteger('volume_size')->nullable();
            $table->string('conversion_state')->nullable();
            $table->string('fv_progress_status')->nullable();
            $table->string('device_identifier')->nullable();
            $table->string('pvdeviceid')->nullable();
            $table->string('volume_name')->nullable();
            $table->string('lvf_uuid')->nullable();
            $table->string('lvg_uuid')->nullable();
            $table->string('pv_uuid')->nullable();
            $table->string('uuid')->nullable();
            $table->text('crypto_users')->nullable();
            $table->text('deferral_info')->nullable();
        });

        // Create indexes
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->index('auth_restart_support');
            $table->index('fv_master_keychain');
            $table->index('has_institutional_recovery_key');
            $table->index('has_personal_recovery_key');
            $table->index('using_recovery_key');
            $table->index('conversion_percent');
            $table->index('conversion_state');
            $table->index('fv_progress_status');
            $table->index('device_identifier');
            $table->index('pvdeviceid');
            $table->index('volume_name');
            $table->index('lvf_uuid');
            $table->index('lvg_uuid');
            $table->index('pv_uuid');
            $table->index('uuid');
        });
        
        // Change existing columns
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->string('filevault_status')->nullable()->change();
            $table->string('filevault_users')->nullable()->change();
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
        });
    }
}

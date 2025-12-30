<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->enum('status', ['pending','diterima','ditolak'])
                ->default('pending')
                ->after('dosen_id');
        });
    }

    public function down()
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

};

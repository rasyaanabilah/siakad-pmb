<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
    Schema::create('dosens', function (Blueprint $table) {
        $table->id();
        $table->string('nama_dosen');
        $table->timestamps();
    });

    }

    public function down()
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropForeign(['dosen_id']);
            $table->dropColumn('dosen_id');
        });
    }
};

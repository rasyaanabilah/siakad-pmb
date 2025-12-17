<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('pendaftars', function (Blueprint $table) {
        $table->string('foto')->nullable()->after('prodi_id');
        $table->string('dokumen')->nullable()->after('foto');
    });
}

public function down(): void
{
    Schema::table('pendaftars', function (Blueprint $table) {
        $table->dropColumn(['foto', 'dokumen']);
    });
}

};

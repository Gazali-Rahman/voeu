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
        Schema::table('catalogs', function (Blueprint $table) {
            // Menambah kolom views_count dengan default 0
            $table->unsignedBigInteger('views_count')->default(0)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catalogs', function (Blueprint $table) {
            //
        });
    }
};

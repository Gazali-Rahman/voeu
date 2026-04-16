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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Contoh: DISKONNIKAH
            $table->enum('type', ['fixed', 'percent']); // Potongan harga tetap atau persen
            $table->decimal('value', 15, 2); // Nominal potongan
            $table->integer('limit')->default(0); // Batas kuota penggunaan
            $table->integer('used')->default(0); // Jumlah yang sudah terpakai
            $table->date('expires_at')->nullable(); // Tanggal kadaluarsa
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};

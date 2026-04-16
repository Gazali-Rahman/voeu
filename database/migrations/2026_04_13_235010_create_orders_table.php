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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan ke user
            $table->foreignId('catalog_id')->constrained()->onDelete('cascade');

            // Tambahkan kolom promo_id di sini
            $table->foreignId('promo_id')->nullable()->constrained()->onDelete('set null');
            // Detail Pemesan
            $table->string('customer_name');
            $table->string('customer_phone');

            // Detail Isi Undangan (Mempelai)
            $table->string('groom_name')->nullable();
            $table->string('bride_name')->nullable();
            $table->string('slug')->unique()->nullable(); // Link: wedding.voeu.id/slug

            // Info Pembayaran
            $table->decimal('amount', 12, 2);
            $table->string('status')->default('pending');
            $table->string('checkout_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

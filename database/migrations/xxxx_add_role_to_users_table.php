<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Tambahkan semua kolom yang dibutuhkan
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->bigInteger('price');
            $table->string('condition');
            $table->text('description');
            $table->string('seller_name');
            $table->string('seller_contact');
            $table->string('image')->nullable();
            $table->boolean('is_sold')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus kolom jika rollback
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id', 'name', 'price', 'condition', 
                'description', 'seller_name', 'seller_contact', 
                'image', 'is_sold'
            ]);
        });
    }
};
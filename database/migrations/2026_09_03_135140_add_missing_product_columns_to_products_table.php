<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Tambahkan kolom yang hilang (semua kecuali id, created_at, updated_at, name, category_id)
            if (!Schema::hasColumn('products', 'price')) {
                $table->bigInteger('price');
            }
            if (!Schema::hasColumn('products', 'condition')) {
                $table->string('condition');
            }
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description');
            }
            if (!Schema::hasColumn('products', 'seller_name')) {
                $table->string('seller_name');
            }
            if (!Schema::hasColumn('products', 'seller_contact')) {
                $table->string('seller_contact');
            }
            if (!Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('products', 'is_sold')) {
                $table->boolean('is_sold')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'price', 'condition', 'description', 
                'seller_name', 'seller_contact', 'image', 'is_sold'
            ]);
        });
    }
};
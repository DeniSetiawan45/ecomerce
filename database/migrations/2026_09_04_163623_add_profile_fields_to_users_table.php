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
        Schema::table('users', function (Blueprint $table) {
            $table->string('location')->nullable()->after('name');
        $table->string('wa_number')->nullable()->after('location');
        $table->float('rating')->default(0)->after('wa_number');
        $table->integer('total_ratings')->default(0)->after('rating');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['location', 'wa_number', 'rating', 'total_ratings']);
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * використана команда - php artisan make:migration alter_fields_to_user_table
     * зверни увагу - метод change() в кінці кожної зміни.
     * а в методі down() потрібно встановити старі налаштування
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name',  50)->change();
            $table->string('email',  50)->from(10)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name',  150)->change();
            $table->string('email',  150)->from(10)->change();
        });
    }
};

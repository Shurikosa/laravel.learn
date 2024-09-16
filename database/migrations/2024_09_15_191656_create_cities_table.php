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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ascii_name');
            $table->integer('population')->nullable();
            $table->string('admin_name')->nullable();
            $table->string('capital')->nullable();
            $table->decimal('lng', 7,4);
            $table->decimal('lat', 7,4);
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};

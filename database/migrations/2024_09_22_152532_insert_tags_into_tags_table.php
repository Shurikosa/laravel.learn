<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('tags')->insert([
            [
                'title' => 'title 1',
                'slug' => 'slug-1',
            ],
            [
                'title' => 'title 2',
                'slug' => 'slug-2',
            ],
            [
                'title' => 'title 3',
                'slug' => 'slug-3',
            ],
            [
                'title' => 'title 4',
                'slug' => 'slug-4',
            ],
            [
                'title' => 'title 5',
                'slug' => 'slug-5',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

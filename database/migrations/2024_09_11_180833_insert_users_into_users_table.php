<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; // Додаємо для використання DB

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Заповнення таблиці 10 користувачами
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password1',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => 'password2',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tom Johnson',
                'email' => 'tom@example.com',
                'password' => 'password3',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily@example.com',
                'password' => 'password4',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'password' => 'password5',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sarah Wilson',
                'email' => 'sarah@example.com',
                'password' => 'password6',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Lee',
                'email' => 'david@example.com',
                'password' => 'password7',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sophia Martinez',
                'email' => 'sophia@example.com',
                'password' => 'password8',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'James Taylor',
                'email' => 'james@example.com',
                'password' => 'password9',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Olivia Garcia',
                'email' => 'olivia@example.com',
                'password' => 'password10',
                'avatar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Видалення користувачів за email (якщо потрібно скасувати міграцію)
        DB::table('users')->whereIn('email', [
            'john@example.com',
            'jane@example.com',
            'tom@example.com',
            'emily@example.com',
            'michael@example.com',
            'sarah@example.com',
            'david@example.com',
            'sophia@example.com',
            'james@example.com',
            'olivia@example.com',
        ])->delete();
    }
};

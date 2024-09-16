<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
     * Основні методи для створення таблиць у міграціях Laravel:
     *
     * 1. $table->id();
     * - Створює стовпець 'id', який є первинним ключем (primary key) та автоінкрементним цілим числом.
     *
     * 2. $table->string('column_name', $length);
     * - Створює стовпець типу VARCHAR з максимальною довжиною символів, яку ви вказуєте у другому параметрі. Якщо параметр не вказано, за замовчуванням використовується 255 символів.
     * - Приклад: string('email', 150) — створює стовпець 'email' типу VARCHAR(150).
     *
     * 3. $table->integer('column_name');
     * - Створює стовпець типу INTEGER.
     *
     * 4. $table->boolean('column_name');
     * - Створює стовпець типу BOOLEAN, який може містити значення true або false.
     *
     * 5. $table->timestamps();
     * - Додає два стовпці: created_at та updated_at, які автоматично оновлюються при створенні або зміні запису.
     *
     * 6. $table->decimal('column_name', $precision, $scale);
     * - Створює стовпець типу DECIMAL. Перший параметр — це точність (кількість цифр), другий — кількість цифр після коми.
     *
     * 7. $table->date('column_name');
     * - Створює стовпець для збереження дати (DATE).
     *
     * 8. $table->foreignId('column_name')->constrained();
     * - Створює стовпець для збереження зовнішнього ключа (foreign key) з автоматичним створенням зв'язків між таблицями.
     *
     * 9. $table->enum('column_name', ['option1', 'option2']);
     * - Створює стовпець типу ENUM, який може містити одне із заданих значень.
     *
     * 10. $table->text('column_name');
     * - Створює стовпець типу TEXT для зберігання великої кількості тексту.
     *
     * 11. $table->softDeletes();
     * - Додає стовпець deleted_at, що дозволяє здійснювати м'яке видалення (soft delete), коли запис не видаляється з бази, але відмічається як видалений.
     *
     * Популярні модифікатори для стовпців:
     *
     * 1. nullable()
     * - Дозволяє стовпцю приймати значення NULL.
     * - Приклад: $table->string('email')->nullable();
     *
     * 2. default($value)
     * - Встановлює значення за замовчуванням для стовпця.
     * - Приклад: $table->boolean('is_active')->default(true);
     *
     * 3. unique()
     * - Створює унікальний індекс для стовпця.
     * - Приклад: $table->string('email')->unique();
     *
     * 4. index()
     * - Додає індекс для стовпця для прискорення пошуку.
     * - Приклад: $table->string('email')->index();
     *
     * 5. unsigned()
     * - Вказує, що значення стовпця є лише додатними (для числових полів).
     * - Приклад: $table->integer('votes')->unsigned();
     *
     * Приклад правильної міграції:
     *
     * Schema::create('users', function (Blueprint $table) {
     * $table->id();
     * $table->string('name', 150);
     * $table->string('email', 150);
     * $table->timestamps();
     * });
 */



    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',  150);
            $table->string('email',  150)->from(10);
            $table->string('password')->from(8);
            $table->string('avatar')->nullable();
            $table->timestamps();
            $table->timestamp('updated')->nullable()->useCurrent()
                ->useCurrentOnUpdate();// поле яке показує час останніх змін
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

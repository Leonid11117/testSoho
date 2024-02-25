<?php

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Book::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Book::COLUMN_AUTHOR_ID)->references(Author::COLUMN_ID)
                ->on(Author::TABLE_NAME)->cascadeOnDelete()->cascadeOnUpdate();
            $table->string(Book::COLUMN_TITLE);
            $table->text(Book::COLUMN_DESCRIPTION);
            $table->integer(Book::COLUMN_PRICE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Book::TABLE_NAME);
    }
};

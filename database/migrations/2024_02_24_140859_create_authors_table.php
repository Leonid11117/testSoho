<?php

use App\Models\Author;
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
        Schema::create(Author::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(Author::COLUMN_NAME);
            $table->text(Author::COLUMN_BIOGRAPHY);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Author::TABLE_NAME);
    }
};

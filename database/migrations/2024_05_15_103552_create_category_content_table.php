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
        Schema::create('category_content', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id')->unique();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->longText('description');
            $table->longText('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_content');
    }
};

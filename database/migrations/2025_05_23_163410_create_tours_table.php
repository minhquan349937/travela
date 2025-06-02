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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('price_adult');
            $table->integer('price_children');
            $table->integer('quantity');
            $table->string('vehicle', 100)->nullable();
            $table->date('departure_date');
            $table->date('return_date');
            $table->string('tour_code', 50)->unique();
            $table->string('tour_form', 100)->nullable();
            $table->string('tour_to', 100)->nullable();
            $table->string('tour_time', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};

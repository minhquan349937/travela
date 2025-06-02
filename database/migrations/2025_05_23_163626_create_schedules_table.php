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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->text('lichtrinh')->nullable();
            $table->text('chinhsach')->nullable();
            $table->text('baogom')->nullable();
            $table->text('khongbaogom')->nullable();
            $table->timestamps();

            $table->foreign('tour_id')
                  ->references('id')
                  ->on('tours')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};

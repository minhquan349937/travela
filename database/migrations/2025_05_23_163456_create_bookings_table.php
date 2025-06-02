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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->date('date_departure');
            $table->string('fullname', 100);
            $table->string('email', 100);
            $table->text('note')->nullable();
            $table->string('phone', 20);
            $table->integer('adult');
            $table->integer('children');
            $table->decimal('total_price', 10, 2);
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
        Schema::dropIfExists('bookings');
    }
};

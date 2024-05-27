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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airline', 2);
            $table->string('number', 4);
            $table->string('departure_airport');
            $table->time('departure_time');
            $table->string('arrival_airport');
            $table->time('arrival_time');
            $table->decimal('price', 8, 2);
            $table->timestamps();

            $table->unique(['airline', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};

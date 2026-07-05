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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unique('appointment_id');
            $table->foreignId('appointment_id')->constrained('appointments')->cascadeOnDelete();
            $table->string('street', 150);
            $table->string('number', 10);
            $table->string('neighborhood', 100);
            $table->string('complement', 100)->nullable();
            $table->string('preferred_time', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

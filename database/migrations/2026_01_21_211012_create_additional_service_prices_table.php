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
        Schema::create('additional_service_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('additional_service_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('vehicle_type', ['carro', 'moto', 'suv', 'caminhonete']);
            $table->unsignedInteger('price');

            $table->unique(
                ['additional_service_id', 'vehicle_type'],
                'asp_service_vehicle_unique'
            );

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_service_prices');
    }
};

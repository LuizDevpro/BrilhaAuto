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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services');
            $table->string('phone', 20);
            $table->enum('vehicle_type', ['Carro','Moto','Caminhonete','SUV']);
            $table->string('vehicle_brand', 50);
            $table->string('vehicle_model', 50);
            $table->smallInteger('vehicle_year')->nullable();
            $table->string('vehicle_color', 30);
            $table->string('vehicle_plate', 10)->nullable();
            $table->dateTime('appointment_datetime');
            $table->enum('payment_method', ['pix', 'debito', 'credito', 'dinheiro']);
            $table->unsignedInteger('total_price');
            $table->enum('status', ['agendado', 'em_lavagem', 'finalizado', 'entregue', 'cancelado'])->default('agendado');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->string('responsible', 100)->nullable();
            $table->text('observations')->nullable();
            $table->index('appointment_datetime');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

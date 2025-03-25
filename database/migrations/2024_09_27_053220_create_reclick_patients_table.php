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
        Schema::create('reclick_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patient_registrations')->onDelete('cascade');
            $table->string('patients_name');
            $table->string('email');
            $table->integer('age');
            $table->integer('contact')->length(50);
            $table->string('first_payment');
            $table->string('registration_date');
            $table->enum('gender', ['male', 'female']);
            $table->text('medicine_list')->nullable();
            $table->text('describe_problem')->nullable();
            $table->text('address')->nullable();
            $table->string('status')->nullable();
            $table->integer('manual_session')->length(50);
            $table->integer('cost_manual_session')->length(50);
            $table->integer('robotics')->length(50);
            $table->integer('cost_robotics')->length(50);
            $table->string('assessment');
            $table->integer('cost_assessment')->length(50);
            $table->string('muscle_test');
            $table->integer('cost_muscle_test')->length(50);
            $table->string('ms');
            $table->integer('cost_ms')->length(50);
            $table->string('us');
            $table->integer('cost_us')->length(50);
            $table->string('ayurvedic');
            $table->integer('cost_ayurvedic')->length(50);
            $table->string('harness');
            $table->integer('cost_harness')->length(50);
            $table->integer('total_cost')->length(50);
            $table->integer('package_price')->length(50);
            $table->integer('given_discount')->length(50);
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclick_patients');
    }
};

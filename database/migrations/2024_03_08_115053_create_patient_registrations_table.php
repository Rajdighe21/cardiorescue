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
        Schema::create('patient_registrations', function (Blueprint $table) {

            $table->id();
            $table->string('patient_image')->nullable();
            $table->string('patient_name');
            $table->string('regi_date');
            $table->string('gender');
            $table->integer('date_of_birth');
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('contact');
            $table->string('email');
            $table->enum('get_medicine', ['Yes', 'No']);
            $table->string('medicine_list')->nullable();
            $table->string('describe_problem');
            $table->string('address');
            $table->string('emg_contact_name');
            $table->string('emg_contact_number');
            $table->string('relationship')->nullable();
            $table->string('payment_amt');
            $table->string('session_numbers')->nullable();
            $table->string('cost_of_session')->nullable();
            $table->string('number_of_robotics')->nullable();
            $table->string('cost_of_robotic')->nullable();
            $table->string('assessment')->nullable();
            $table->string('cost_of_assessment')->nullable();
            $table->string('machine_test')->nullable();
            $table->string('cost_machine_test')->nullable();
            $table->string('ms')->nullable();
            $table->string('cost_of_ms')->nullable();
            $table->string('us')->nullable();
            $table->string('cost_of_us')->nullable();
            $table->string('ayurvedic')->nullable();
            $table->string('cost_ayurvedic')->nullable();
            $table->string('harness')->nullable();
            $table->string('harness_cost')->nullable();
            $table->string('total_amt')->nullable();
            $table->string('discount_amt')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('paid_amt')->nullable();
            $table->string('balance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_registrations');
    }
};

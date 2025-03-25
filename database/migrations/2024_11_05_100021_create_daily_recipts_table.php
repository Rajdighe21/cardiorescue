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
        Schema::create('daily_recipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('name');
            $table->string('age');
            $table->string('contact');
            $table->string('getpayment');
            $table->string('duepayment');
            $table->date('registreation_date');
            $table->text('description');
            $table->string('payment_mode');
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patient_registrations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_recipts');
    }
};

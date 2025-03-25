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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->text('diagnosis')->nullable();
            $table->string('percentage')->nullable();
            $table->text('treatment_protocol')->nullable();
            $table->text('after_treatment_protocol')->nullable();
            $table->string('prevideo')->nullable();
            $table->string('postvideo')->nullable();
            $table->dateTime('session_start');
            $table->dateTime('session_end')->nullable();
            $table->foreign('patient_id')->references('id')->on('patient_registrations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};

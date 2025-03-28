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
        Schema::create('session_plannings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patient_registrations')->onDelete('cascade');
            $table->string('time');
            $table->date('date');
            $table->string('day');
            $table->string('month');
            $table->string('status');
            $table->text('description')->nullable();
            $table->enum('frequency', ['once', 'twice'])->default('once');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_plannings');
    }
};

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
        Schema::create('patient_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('which_side');
            $table->string('which_area');
            $table->string('sit-to-stand');
            $table->string('walking_condition');
            $table->string('hand_finger_condition');
            $table->string('elebow_condition');
            $table->string('shoulder_condition');
            $table->foreignId('conditions_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_conditions');
    }
};

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
        Schema::create('userinfo', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('phone');
            $table->string('address');
            $table->string('age');
            $table->string('weight');
            $table->string('gender');
            $table->string('patient_suffering');
            $table->string('which_side');
            $table->string('which_area');
            $table->string('sit-to-stand-condition');
            $table->string('walking_condition');
            $table->string('hand_fingre');
            $table->string('elebow');
            $table->string('shoulder');
            $table->string('how_long');
            $table->string('current_goal');
            $table->string('health_quality');
            $table->string('patient_stressed');
            $table->string('vitamin_deficiency');
            $table->string('below_suffering');
            $table->string('sleep_time');
            $table->string('price')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userinfo');
    }
};

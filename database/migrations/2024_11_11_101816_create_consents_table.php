<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patient_registrations')->onDelete('cascade');
            $table->string('name');
            $table->string('age');
            $table->string('contact');
            $table->text('address');
            $table->datetime('start_date');
            $table->string('body_part');
            $table->string('number_of_session');
            $table->string('session_in_day');
            $table->string('gender');
            $table->text('describe_problem');
            $table->text('aware_that');
            $table->text('patient_signature')->nullable();
            $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consents');
    }
};

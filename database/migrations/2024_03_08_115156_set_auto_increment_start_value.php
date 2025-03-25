<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE 	patient_registrations AUTO_INCREMENT = 000011111140;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

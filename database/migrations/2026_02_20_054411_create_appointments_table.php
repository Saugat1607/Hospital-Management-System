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

          // / relations
        $table->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
        

        // appointment details
        $table->dateTime('appointment_date');
        $table->string('reason')->nullable();

                // status system (important for dashboard)
        $table->enum('status', ['pending','completed','cancelled'])
              ->default('pending');




            $table->timestamps();
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

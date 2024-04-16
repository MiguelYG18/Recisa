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
        Schema::create('apointmenties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_doctor')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_patient')->constrained('patients')->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->foreignId('id_ticket_status')->constrained('status_ticket')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apointmenties');
    }
};

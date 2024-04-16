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
        Schema::create('user_specialization', function (Blueprint $table) {
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_specialization')->constrained('specializations')->onDelete('cascade');  
            $table->integer('cupo_doctor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_specialization');
    }
};

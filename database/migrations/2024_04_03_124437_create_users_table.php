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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('dni',8)->unique();
            $table->string('names', 25);
            $table->string('surnames', 25);
            $table->char('phone',9)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image', 255)->nullable();
            /*****************Relación****************/
            $table->unsignedInteger('user_level'); 
            $table->foreign('user_level')
                  ->references('group_level')
                  ->on('user_groups')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            /*****************************************/            
            $table->char('status',1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

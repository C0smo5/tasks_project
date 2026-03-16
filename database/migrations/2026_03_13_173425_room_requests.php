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
        Schema::create('room_request', function(Blueprint $table){

            $table->id();
            $table->foreignId('room_id')->constrained('room');
            $table->foreignId('user_id')->constrained('users');
            $table->string('status')->default('pendente');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

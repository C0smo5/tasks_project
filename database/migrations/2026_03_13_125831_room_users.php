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
        Schema::create('room_users', function(Blueprint $table)
        {
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('room');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::create('room_users', function(Blueprint $table){
            $table->dropForeign('room_users_room_id_foreign');
        });
        Schema::dropIfExists('room_users');
    }
};

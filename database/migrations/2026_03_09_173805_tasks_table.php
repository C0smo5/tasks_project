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
        Schema::create('tasks', function(Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('by_make');
            $table->foreign('by_make')->references('id')->on('users');
            $table->unsignedBigInteger('who_does');
            $table->foreign('who_does')->references('id')->on('users');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('room');
            $table->string('name');
            $table->string('type');
            $table->string('priority');
            $table->string('stats')->default('pendente');
            $table->string('descri_task');
            $table->date('date_expiration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('tasks', function(Blueprint $table){
            $table->dropForeign('tasks_by_make_foreign');
        });
        Schema::dropIfExists('tasks');
        
    }
};

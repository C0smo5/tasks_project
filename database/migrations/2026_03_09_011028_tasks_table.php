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
        Schema::create('tasks', function(Blueprint $table){
                $table->id();
                $table->unsignedBigInteger('by_make');
                $table->foreign('by_make')->references('id')->on('users');
                $table->string('nome');
                $table->string('descri_task');
                $table->date('data_entrega');
                $table->string('status_task');
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

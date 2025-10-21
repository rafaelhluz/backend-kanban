<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            
            $table->foreignId('id_users')->constrained(table: 'users');
            $table->foreignId('id_positions')->constrained(table: 'positions');
            $table->foreignId('asign_users')->constrained(table: 'users');

            $table->timestamp('dt_start');
            $table->timestamp('dt_end');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
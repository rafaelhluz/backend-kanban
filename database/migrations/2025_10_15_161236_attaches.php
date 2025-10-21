<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attaches', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_users')->constrained(table: 'users');
            $table->foreignId('id_tasks')->constrained(table: 'tasks');
            
            $table->string('file_url');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attaches');
    }
};
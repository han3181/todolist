<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Kolom ID untuk tugas
            $table->string('title'); // Kolom untuk judul tugas
            $table->string('status')->default('pending'); // Status tugas, default 'pending'
            $table->boolean('completed')->default(false); // Status completed, default false
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kolom user_id yang mengaitkan dengan tabel users
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks'); // Menghapus tabel jika rollback
    }
}

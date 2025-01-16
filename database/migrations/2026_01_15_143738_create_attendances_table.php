<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User (staff or lecturer)
            $table->enum('type', ['lecturer', 'staff']); // Attendance type
            $table->date('date'); // The date of the attendance
            $table->time('clock_in'); // Clock-in time
            $table->time('clock_out')->nullable(); // Clock-out time (nullable if not clocked out yet)
            $table->string('room')->nullable();//room nullable cause only for dosen
            $table->integer('id_matkul')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};

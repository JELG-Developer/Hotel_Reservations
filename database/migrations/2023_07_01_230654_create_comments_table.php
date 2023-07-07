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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment',255);
            $table->enum('status',['visible' ,'draft','hidden'])->default('draft');
            $table->unsignedBigInteger('bokking_id')->nullabe();  //Desde el seeder de Reservaciones
            $table->foreign('bokking_id')->references('id')->on('bokkings')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

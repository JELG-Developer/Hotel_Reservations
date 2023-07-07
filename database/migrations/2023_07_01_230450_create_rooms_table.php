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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('price');

            $table->biginteger('number');
            $table->enum('status',['disponible' ,'ocupada' ,'limpieza','mantenimiento'])->default('disponible');
            $table->string('ubication');
            
            $table->unsignedBigInteger('category_id');  //Estatico porque una habitacion tiene una categoria como simple-doble-matrimonial
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

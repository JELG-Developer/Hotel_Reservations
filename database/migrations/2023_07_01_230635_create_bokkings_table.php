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
        Schema::create('bokkings', function (Blueprint $table) {
            $table->id();
            $table->string('entry');
            $table->string('departure');   
            $table->integer('amount');
            
            $table->unsignedBigInteger('user_id');  //identificador de usurios
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('room_id');  //identificador de paquetes
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('costo'); 

            $table->unsignedBigInteger('paymenth_id');  //identificador de pagos
            $table->foreign('paymenth_id')->references('id')->on('paymenths')->onDelete('cascade')->onUpdate('cascade');              
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bokkings');
    }
};

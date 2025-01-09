<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestationNotSendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestation_notSend', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('title');
            $table->decimal('prix', 10, 2); // Assuming price is a decimal
            $table->text('description');
            $table->decimal('surface', 8, 2); // Assuming surface is a decimal
            $table->decimal('total', 10, 2); // Assuming total is a decimal
            $table->date('date1');
            $table->date('date2');
            $table->date('date3');
            $table->date('date4');
            $table->string('adress');
            $table->timestamps();
            $table->string('telephone');
            $table->string('status')->default('Encour');
            $table->unsignedBigInteger('vistID'); // Foreign key or a unique identifier
            
            // Optional: Add foreign key constraint if needed
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestation_notSend');
    }
}

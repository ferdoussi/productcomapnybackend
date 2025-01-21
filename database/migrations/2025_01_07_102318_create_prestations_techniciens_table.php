<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestationsTechniciensTable extends Migration
{
    public function up()
    {
        Schema::create('prestations_techniciens', function (Blueprint $table) {
            $table->id('id_prestation'); // auto-incrementing id for the primary key
            $table->string('title');
            $table->decimal('prix', 8, 2); // for pricing, you can adjust the precision if needed
            $table->decimal('surface', 8, 2); // for surface, adjust as needed
            $table->string('telephone');
            $table->string('adress');
            $table->unsignedBigInteger('vistID')->nullable(); // Add the vistID column
            $table->text('description');
            $table->date('date_prestation');
            $table->string('userName');
            $table->string('status')->default('active'); 
            $table->unsignedBigInteger('user_id'); // Foreign key column
            $table->timestamps(); // for created_at and updated_at

            // Define the foreign key constraint
            $table->foreign('user_id')->references('id')->on('techniciens')->onDelete('cascade');
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('prestations_techniciens');
    }
}

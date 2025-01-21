<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechniciensTable extends Migration
{
    
    public function up()
    {
        Schema::create('techniciens', function (Blueprint $table) {
            $table->id(); 
            $table->string('nom'); 
            $table->string('prenom'); 
            $table->string('email')->unique(); 
            $table->string('password');
            $table->string('role'); 
            $table->text('address'); 
            $table->string('telephone'); 
            $table->boolean('disponible')->default(true); 
            $table->string('specialite');
            $table->string('url_calendar', 255)->nullable();
            $table->timestamps(); 
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('techniciens');
    }
}

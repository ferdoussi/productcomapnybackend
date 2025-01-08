<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

  public function up()
  {
      Schema::create('send_prestations', function (Blueprint $table) {
          $table->id();
          $table->foreignId('user_id')->constrained()->onDelete('cascade');
          $table->string('title');
          $table->decimal('prix', 10, 2);
          $table->text('description');
          $table->decimal('surface', 10, 2);
          $table->decimal('total', 10, 2); 
          $table->timestamp('date1');
          $table->timestamp('date2')->nullable();
          $table->timestamp('date3')->nullable();
          $table->timestamp('date4')->nullable();
          $table->string('adress')->nullable();
          $table->string('telephone');
          $table->timestamps();
      });
  }
  


    public function down()
    {
        Schema::dropIfExists('send_prestations');
    }
};

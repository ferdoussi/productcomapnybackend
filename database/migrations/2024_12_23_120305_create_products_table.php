<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
      Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('image')->nullable();
        $table->string('description');
        $table->decimal('prix', 10, 2);
        $table->timestamps();
    });
    
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};

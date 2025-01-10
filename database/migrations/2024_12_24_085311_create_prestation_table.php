<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('prestations', function (Blueprint $table) {
        $table->id(); 
        $table->unsignedBigInteger('user_id'); 
        $table->string('title'); 
        $table->decimal('prix', 10, 2); 
        $table->text('description')->nullable(); 
        $table->integer('surface'); 
        $table->datetime('date1');
        $table->datetime('date2')->nullable();
        $table->datetime('date3')->nullable(); 
        $table->datetime('date4')->nullable(); 
        $table->string('adress'); 
        $table->string('telephone');
        $table->enum('status')->default('active'); // إضافة العمود status
        $table->timestamps(); // created_at و updated_at
    
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
        Schema::dropIfExists('prestation');
    }
};

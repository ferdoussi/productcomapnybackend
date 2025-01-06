<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechniciensTable extends Migration
{
    
    public function up()
    {
        Schema::create('techniciens', function (Blueprint $table) {
            $table->id(); // عمود ID تلقائي
            $table->string('nom'); // الاسم
            $table->string('prenom'); // اللقب
            $table->string('email')->unique(); // البريد الإلكتروني
            $table->string('password');
            $table->string('role'); // الدور
            $table->text('address'); // العنوان
            $table->string('telephone'); // رقم الهاتف
            $table->boolean('disponible')->default(true); // متاح أو غير متاح
            $table->string('specialite');
            $table->timestamps(); // وقت الإنشاء والتحديث
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('techniciens');
    }
}

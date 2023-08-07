<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieenTable extends Migration
{
    public function up()
    {
        Schema::create('categorieen', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorieen');
    }
}


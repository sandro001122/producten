<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategorieTable extends Migration
{
    public function up()
    {
        Schema::create('product_categorie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producten_id')->constrained('producten');
            $table->foreignId('categorieen_id')->constrained('categorieen');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_categorie');
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTagTable extends Migration
{
    public function up()
    {
        Schema::create('product_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producten_id')->constrained('producten');
            $table->foreignId('tags_id')->constrained('tags');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_tag');
    }
}


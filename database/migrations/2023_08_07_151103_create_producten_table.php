<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductenTable extends Migration
{
    public function up()
    {
        Schema::create('producten', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->text('beschrijving');
            $table->decimal('prijs', 10, 2); // Adjust the precision and scale as needed.
            $table->decimal('korting', 10, 2)->nullable();
            $table->json('afbeeldingen')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('producten');
    }
}

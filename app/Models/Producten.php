<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producten extends Model
{
    protected $fillable = ['naam', 'beschrijving', 'prijs', 'korting', 'images'];

    protected $table = 'Producten';

    public function categorieen()
    {
        return $this->belongsToMany(Categorieen::class, 'product_categorie');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'product_tag');
    }
}

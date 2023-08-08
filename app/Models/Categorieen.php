<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorieen extends Model
{
    protected $fillable = ['naam'];

    protected $table = 'categorieen';

    public function producten()
    {
        return $this->belongsToMany(Producten::class, 'product_categorie');
    }
}

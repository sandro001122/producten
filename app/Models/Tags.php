<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable = ['naam'];

    protected $table = 'tags';

    public function producten()
    {
        return $this->belongsToMany(Producten::class, 'product_tag');
    }
}

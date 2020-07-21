<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    //
    protected $fillable = ['image'];
    public function product()
    {
        // essa imagem pertence a um produto
        return $this->belongsTo(Product::class);
    }
}

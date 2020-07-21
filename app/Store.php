<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    // php artisan make:model Store
    /* 
    * por padrão o nome da tabela é o plural do nome do model
    * EX: Nome da Model: Store, Nome da tabela: stores
    *
    * caso seja diferente
    * EX: protected $table = 'lojas'
    */ 
    protected $fillable = ['name','description','phone','mobile_phone','slug'];
    public function user() {
        return $this->belongsTo(User::class); // return $this->belongsTo(User::class,'nome_chaveid');
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

}

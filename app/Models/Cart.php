<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $guarded = 'id';

    public function cart_atribut()
    {
        return $this->hasMany(CartAtribut::class);
    }
}

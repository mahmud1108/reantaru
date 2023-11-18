<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartAtribut extends Model
{
    use HasFactory;

    protected $guarded = 'id';

    public function atribut()
    {
        return $this->belongsTo(Atribut::class);
    }
}

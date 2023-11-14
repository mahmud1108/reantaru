<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Produk extends Model
{
    use HasSlug;
    use HasFactory;
    use Searchable;

    protected $guarded = 'id';

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('produk_nama')
            ->saveSlugsTo('produk_slug');
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function varian()
    {
        return $this->hasMany(Varian::class);
    }
}

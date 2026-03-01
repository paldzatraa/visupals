<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Menentukan kolom yang boleh diisi
    protected $fillable = ['name', 'slug'];

    // Relasi ke tabel portfolios
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
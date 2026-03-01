<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'title', 
        'slug', 
        'description', 
        'client_name', 
        'date_taken'
    ];

    // Relasi balik ke tabel categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke tabel media (foto/video)
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
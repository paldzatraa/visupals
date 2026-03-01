<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id', 
        'type', 
        'file_path', 
        'video_url', 
        'is_featured'
    ];

    // Relasi balik ke tabel portfolios
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
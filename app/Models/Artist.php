<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bio'];

    // Relacion Un Artista TIENE MUCHOS Tatuajes
    public function tattoos()
    {
        return $this->hasMany(Tattoo::class);
    }
    
    // Un Artista "PERTECE A MUCHOS" Estilos preferidos
    public function styles()
    {
        return $this->belongsToMany(Style::class);
    }
}
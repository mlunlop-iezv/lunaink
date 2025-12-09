<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    //Relacion un Estilo TIENE MUCHOS Tatuajes
    public function tattoos()
    {
        return $this->hasMany(Tattoo::class);
    }

    // Un Estilo "PERTENECE A MUCHOS" Artistas
    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
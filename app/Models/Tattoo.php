<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tattoo extends Model
{
    use HasFactory;

    // Campos que permitimos llenar masivamente
    protected $fillable = [
        'title', 
        'artist_id', 
        'style_id', 
        'image_url',
        'duration'
    ];

    // Relación: Un tatuaje pertenece a un Artista
    public function artist() {
        return $this->belongsTo(Artist::class);
    }

    // Relación: Un tatuaje tiene un Estilo
    public function style() {
        return $this->belongsTo(Style::class);
    }

    // devuelve la URL correcta de la imagen 
    public function getPath()
    {
        // Si no hay foto, ponemos el placeholder
        if (!$this->image_url) {
            return asset('assets/img/noimage.png');
        }

        if (str_starts_with($this->image_url, 'http')) {
            return $this->image_url;
        }

        // Si es local generamos la ruta pública
        return asset($this->image_url);
    }
}
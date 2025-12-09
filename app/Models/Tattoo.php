<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tattoo extends Model
{
    use HasFactory;

protected $fillable = [
    'title', 
    'artist_id', 
    'style_id', 
    'image_url',
    'duration'
];

    public function artist() {
        return $this->belongsTo(Artist::class);
    }

    public function style() {
        return $this->belongsTo(Style::class);
    }

    // --- ¡ESTA ES LA FUNCIÓN QUE TE FALTA! ---
    public function getPath()
    {
        // Si la imagen es nula, devolvemos una imagen por defecto
        if (!$this->image_url) {
            return asset('assets/img/noimage.png'); // Asegúrate de tener esta imagen o borra esta línea
        }

        // Si la imagen viene de internet (faker/seeders) devolvemos la url tal cual
        if (str_starts_with($this->image_url, 'http')) {
            return $this->image_url;
        }

        // Si es una imagen subida por nosotros, usamos asset()
        return asset($this->image_url);
    }
}
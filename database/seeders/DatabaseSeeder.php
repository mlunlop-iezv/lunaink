<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Style;
use App\Models\Tattoo;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $styles = Style::all();

        if ($styles->isEmpty()) {
            $this->call(StyleSeeder::class); 
            $styles = Style::all(); 
        }

        Artist::factory(5)->create()->each(function ($artist) use ($styles) {

            if ($styles->count() > 0) {
                $artist->styles()->attach(
                    $styles->random(rand(1, 3))->pluck('id')->toArray()
                );

                Tattoo::factory(8)->create([
                    'artist_id' => $artist->id,
                    'style_id' => $styles->random()->id, 
                ]);
            }
        });
    }
}
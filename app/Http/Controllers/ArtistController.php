<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Style;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class ArtistController extends Controller
{
    // Carga el listado completo de artistas
    public function index()
    {
        $artists = Artist::all();
        return view('artists.index', compact('artists'));
    }

    // Prepara el formulario, enviando los estilos para el select
    public function create()
    {
        $styles = Style::all();
        return view('artists.create', compact('styles'));
    }

    // Procesa el guardado con validación manual y manejo de excepciones
    public function store(Request $request)
    {
        // Definimos las reglas: nombre único y estilos deben existir en DB
        $rules = [
            'name'   => 'required|string|min:3|max:50|unique:artists,name',
            'bio'    => 'required|string|min:10|max:1000',
            'styles' => 'array',
            'styles.*' => 'exists:styles,id'
        ];

        // Mensajes amigables para que el usuario sepa qué pasó
        $messages = [
            'name.unique' => 'An artist with this name already exists.',
            'name.min'    => 'The name is too short (minimum 3 characters).',
            'bio.min'     => 'Tell us a bit more in the biography.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            // Guardamos al artista
            $artist = new Artist();
            $artist->name = $request->name;
            $artist->bio = $request->bio;
            $artist->save();

            // Si hay estilos, los vinculamos (attach añade relaciones)
            if ($request->has('styles')) {
                $artist->styles()->attach(array_filter($request->styles));
            }

            return redirect()->route('artists.index')->with('success', 'Artist created successfully!');

        } catch (QueryException $e) {
            // Fallo técnico de base de datos
            return back()->withInput()->withErrors(['general' => 'Database error. Please try again.']);
        
        } catch (\Exception $e) {
            // Cualquier otro imprevisto
            return back()->withInput()->withErrors(['general' => 'An unexpected error occurred: ' . $e->getMessage()]);
        }
    }

    // Muestra el perfil individual
    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }

    // Formulario de edición cargando datos previos
    public function edit(Artist $artist)
    {
        $styles = Style::all();
        return view('artists.edit', compact('artist', 'styles'));
    }

    // Actualización blindada: ignora el ID actual en la validación unique
    public function update(Request $request, Artist $artist)
    {
        $rules = [
            'name'   => ['required', 'string', 'min:3', 'max:50', Rule::unique('artists')->ignore($artist->id)],
            'bio'    => 'required|string|min:10',
            'styles' => 'array'
        ];

        $messages = [
            'name.unique' => 'This name is already in use by another artist.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            // Actualizamos datos básicos
            $artist->name = $request->name;
            $artist->bio = $request->bio;
            $artist->save();

            // Sync es magia: borra relaciones viejas y pone las nuevas
            // Si no envían estilos, detach() limpia todo
            if ($request->has('styles')) {
                $artist->styles()->sync(array_filter($request->styles));
            } else {
                $artist->styles()->detach();
            }

            return redirect()->route('artists.index')->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general' => 'Error updating: ' . $e->getMessage()]);
        }
    }

    // Eliminación segura controlando errores
    public function destroy(Artist $artist)
    {
        try {
            $artist->delete();
            return redirect()->route('artists.index')->with('success', 'Artist deleted successfully.');
        
        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'The artist could not be deleted.']);
        }
    }
}
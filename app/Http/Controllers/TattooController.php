<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tattoo;
use App\Models\Artist;
use App\Models\Style;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TattooController extends Controller
{
    private function upload(Request $request): ?string
    {
        $path = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = 'storage/' . $request->file('image')->store('tattoos', 'public');
        }
        return $path;
    }

    // Eliminar la foto si existe para no dejar basura
    private function destroyImage(?string $path): void
    {
        if ($path) {
            $realPath = str_replace('storage/', '', $path);
            Storage::disk('public')->delete($realPath);
        }
    }

    // Listado principal, aplica filtros de estilo si vienen en la URL
    public function index()
    {
        $styles = Style::all();
        $query = Tattoo::with(['artist', 'style']);

        if (request()->has('style')) {
            $query->where('style_id', request('style'));
        }

        $tattoos = $query->get();
        return view('tattoos.index', compact('tattoos', 'styles'));
    }

    // Renderiza el formulario de creación
    public function create()
    {
        $artists = Artist::all();
        $styles = Style::all();
        return view('tattoos.create', compact('artists', 'styles'));
    }

    // Procesa el guardado: valida, sube imagen y persiste en BD
    public function store(Request $request)
    {
        // Reglas de validación
        $rules = [
            'title' => 'required|string|min:3|max:60',
            'artist_id' => 'required|exists:artists,id',
            'style_id' => 'required|exists:styles,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'duration' => 'nullable|string|max:50',
        ];

        // Mensajes custom
        $messages = [
            'title.required' => 'The tattoo title is required.',
            'title.min' => 'The title must be at least 3 characters long.',
            'artist_id.required' => 'You must select an artist.',
            'style_id.required' => 'You must select a style.',
            'image.required' => 'It is mandatory to upload a photo of the tattoo.',
            'image.image' => 'The file must be a valid image (jpg, png, webp).',
            'image.max' => 'The image cannot be larger than 2MB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            // Instanciamos sin la imagen, la procesamos aparte
            $tattoo = new Tattoo($request->except('image'));

            $tattoo->image_url = $this->upload($request);
            $tattoo->save();

            return redirect()->route('tattoos.index')->with('success', '¡Tatuaje subido correctamente a la galería!');

        } catch (QueryException $e) {
            // Fallo a nivel de SQL
            return back()->withInput()->withErrors(['general' => 'Error al guardar en la base de datos. Inténtalo de nuevo.']);

        } catch (\Exception $e) {
            // Cualquier otro crash inesperado
            return back()->withInput()->withErrors(['general' => 'Ha ocurrido un error inesperado: ' . $e->getMessage()]);
        }
    }

    // Muestra el detalle de un tattoo
    public function show(Tattoo $tattoo)
    {
        return view('tattoos.show', compact('tattoo'));
    }

    // Formulario de edición con datos precargados
    public function edit(Tattoo $tattoo)
    {
        $artists = Artist::all();
        $styles = Style::all();
        return view('tattoos.edit', compact('tattoo', 'artists', 'styles'));
    }

    // Actualiza el registro. Si cambian la foto, gestiona el borrado de la vieja
    public function update(Request $request, Tattoo $tattoo)
    {
        $rules = [
            'title' => 'required|string|min:3|max:60',
            'artist_id' => 'required|exists:artists,id',
            'style_id' => 'required|exists:styles,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
            'duration' => 'nullable|string|max:50',
        ];

        $messages = [
            'title.required' => 'El título no puede estar vacío.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            $tattoo->fill($request->except('image'));

            // Swap de imagenes
            if ($request->hasFile('image')) {
                $this->destroyImage($tattoo->image_url);
                $tattoo->image_url = $this->upload($request);
            }

            $tattoo->save();

            return redirect()->route('tattoos.index')->with('success', '¡Tatuaje actualizado con éxito!');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

    // Borrado total de bd
    public function destroy(Tattoo $tattoo)
    {
        try {
            $this->destroyImage($tattoo->image_url);
            $tattoo->delete();

            return redirect()->route('tattoos.index')->with('success', 'Tatuaje eliminado definitivamente.');

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'No se pudo eliminar el tatuaje.']);
        }
    }
}
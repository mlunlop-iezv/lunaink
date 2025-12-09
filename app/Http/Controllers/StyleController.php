<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Style;
class StyleController extends Controller
{

    public function index()
    {
        $styles = Style::all();

        $selectedStyle = null;

        if (request()->has('view_style')) {
            $selectedStyle = Style::with('tattoos.artist')->find(request('view_style'));
        }

        return view('styles.index', compact('styles', 'selectedStyle'));
    }
}

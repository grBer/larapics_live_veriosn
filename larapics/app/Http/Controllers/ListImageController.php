<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ListImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $images = Image::published()->latest()->paginate(15)->withQueryString();
        return view('image-list', compact('images'));
    }
}

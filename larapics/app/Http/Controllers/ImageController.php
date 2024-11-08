<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Requests\ImageRequest;

class ImageController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
        $this->authorizeResource(Image::class);
    }

    public function index(){
        $images = Image::visibleFor(request()->user())->latest()->paginate(15)->withQueryString();
        return view('images.index', compact('images'));
    }

    public function create(){
        return view("images.create");
    }

    public function store(ImageRequest $request){
        Image::create($request->getData());
        return to_route('images.index')->with('message', "Image has been uploaded successfuly");
    }

    public function edit(Image $image){

        return view("images.edit", compact('image'));
    }

    public function update (Image $image, ImageRequest $request){
        $image->update($request->getData());
        return to_route('images.index')->with('message', "Image has been updated successfuly");
    }

    public function destroy (Image $image){
        $image->delete();
        return to_route('images.index')->with('message', "Image has been removed successfuly");
    }
}

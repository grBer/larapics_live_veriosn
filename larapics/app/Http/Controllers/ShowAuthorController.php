<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ShowAuthorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $user->load('images');
        $images = $user->images()->paginate(15);
        return view("author-show", compact('user', 'images'));
    }
}

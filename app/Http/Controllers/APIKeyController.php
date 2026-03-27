<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIKeyController extends Controller
{
    public function generate(Request $req) {
        $user = $req->user(); // That's if the user has been authenticated
        $key = $user->generateAPIKey();

        // return response()->json([ 'api_key' => $key]);
        return redirect('/')->with('api_key', $key); // Temporary
    }
}

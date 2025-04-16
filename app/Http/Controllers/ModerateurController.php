<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModerateurController extends Controller
{
    //

    public function show(Request $request)
{
    $user = $request->user();

    $data = [
        'infos' => $user,
        'status' => $user->moderateurStatus,
        'centres' => $user->centreInterets,
    ];

    return response()->json($data);
}

}

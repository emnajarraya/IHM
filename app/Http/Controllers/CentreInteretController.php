<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentreInteret;

class CentreInteretController extends Controller
{
    //

    public function index()
{
    return CentreInteret::all();
}

public function store(Request $request)
{
    $validated = $request->validate(['nom' => 'required']);
    return CentreInteret::create($validated);
}

public function update(Request $request, $id)
{
    $centre = CentreInteret::findOrFail($id);
    $centre->update($request->all());
    return $centre;
}

public function destroy($id)
{
    $centre = CentreInteret::findOrFail($id);
    $centre->delete();
    return response()->json(['message' => 'Centre supprimé']);
}

}

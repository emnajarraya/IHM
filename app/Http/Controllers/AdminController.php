<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //

    public function indexModerateurs()
    {
        // Log::info('AdminController@indexModerateurs called');
        try {
            $moderateurs = User::whereHas('roles', fn($q) => $q->where('name', 'moderateur'))

                ->get();

            Log::info('Moderateurs found: ' . $moderateurs->count());
            return response()->json($moderateurs);
        } catch (\Exception $e) {
            Log::error('Error in indexModerateurs: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {

        try {
            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'statut' => $request->statut,
            ]);

            // Update centres d'intérêt
            $user->centreInterets()->sync($request->centre_interets);

            DB::commit();
            return response()->json(['message' => 'Modérateur mis à jour avec succès']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erreur lors de la mise à jour', 'details' => $e->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            // Optionnel : détacher les centres d'intérêt si relation exists
            $user->centreInterets()->detach();

            // Optionnel : détacher les rôles (si nécessaire)
            $user->roles()->detach();

            $user->delete();

            DB::commit();

            return response()->json(['message' => 'Modérateur supprimé avec succès'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Erreur lors de la suppression',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function attribuerCentres(Request $request, $id)
    {
        // $request->validate([
        //     'centre_interets' => 'required|array',
        //     'centre_interets.*' => 'exists:centre_interets,id',
        // ]);

        $user = User::findOrFail($id);

        // On remplace les anciens centres par les nouveaux
        $user->centreInterets()->sync($request->centre_interets);

        return response()->json([
            'message' => 'Centres d’intérêt attribués avec succès'
        ], 200);
    }


}

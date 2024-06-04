<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use App\Models\Groupe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupeController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer le formateur connecté
        $formateur = Auth::user();

        // Récupérer les groupes associés à ce formateur via la table formateur_groupe
        $groupes = $formateur->groupes;

        // Récupérer le code du groupe sélectionné
        $selectedCodeG = $request->input('groupe');
        $selectedGroup = null;
        $modules = [];

        if ($selectedCodeG) {
            $selectedGroup = Groupe::where('codeG', $selectedCodeG)->first();
            // Récupérer les modules associés au formateur et au groupe sélectionné via la table formateur_groupe_module
            if ($selectedGroup) {
                $modules = $selectedGroup->modules()->wherePivot('formateur_id', $formateur->id)->get();
            }
        }

        return view('Pages.acceuil', compact('groupes', 'selectedGroup', 'modules'));
    }
}

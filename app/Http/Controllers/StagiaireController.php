<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use Illuminate\Http\Request;

class StagiaireController extends Controller
{
    public function rechercher_stagiaire(Request $request){
        $request->validate([
            'cef' => 'nullable|numeric',
        ]);
        $searchStag = $request->input('cef');
        $groupe = Groupe::findOrFail($request->groupe_id);

        // Filter the stagiaire based on CEF
        $stagiaire = $groupe->stagiaires()->where('cef', $searchStag)->first();
        return view('');
    }
}

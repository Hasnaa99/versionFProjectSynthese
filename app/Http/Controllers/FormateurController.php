<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FormateurController extends Controller
{
    public function index(){
        $formateur = Auth::user();
        return view('Pages.monCompte',compact('formateur'));
    }

public function update(Request $request, string $id)
{
    $formateur = Formateur::find($id);
    if ($formateur && Hash::check($request->password, $formateur->password) && $request->new_password === $request->new_password_confirmation) {
        $formateur->password = Hash::make($request->new_password);
        $formateur->save();
        return redirect()->route('formateur')->with('success', 'Mot de passe mis à jour avec succès!');
    }
    return redirect()->back()->with('error', 'Le mot de passe actuel est incorrect.');
}
}

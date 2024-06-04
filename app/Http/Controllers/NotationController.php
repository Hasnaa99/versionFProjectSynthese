<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Groupe;
use App\Models\Module;
use App\Models\Notation;
use Illuminate\Http\Request;

class NotationController extends Controller
{
    public function saveNotes(Request $request)
    {
        $notes = $request->input('notes', []);
        $hasCCEmpty = false;
        $ccEvaluations = [];

        foreach ($notes as $stagiaire_id => $evaluations) {
            foreach ($evaluations as $key => $note) {
                if (preg_match('/^evaluation_(\d+)$/', $key, $matches)) {
                    $evaluation_id = $matches[1];
                    $evaluation = Evaluation::find($evaluation_id);

                    // Skip empty notes but not zero
                    if (!isset($note) || trim($note) === '') {
                        if ($evaluation->type === 'CC') {
                            $hasCCEmpty = true;
                        }
                        continue;
                    }

                    // Validate notes
                    if ($evaluation->type === 'CC') {
                        if ($note < 0 || $note > 20) {
                            return redirect()->back()->with('error', 'Les notes des contrôles continus doivent être comprises entre 0 et 20.');
                        }
                    } elseif ($evaluation->type === 'EFM') {
                        if ($note < 0 || $note > 40) {
                            return redirect()->back()->with('error', 'La note de l\'EFM doit être comprise entre 0 et 40.');
                        }
                    }

                    // Check for empty CC notes if EFM note is present
                    if ($evaluation->type === 'EFM' && !empty($note) && $hasCCEmpty) {
                        return redirect()->back()->with('error', 'Veuillez remplir toutes les notes des contrôles continus avant d’entrer la note de l’EFM.');
                    }

                    // Convert note to float if it's not empty
                    $note = floatval($note);

                    // Check if evaluation exists for this stagiaire and evaluation_id
                    $existingNotation = Notation::where('stagiaire_id', $stagiaire_id)
                        ->where('evaluation_id', $evaluation_id)
                        ->first();

                    if ($existingNotation) {
                        $existingNotation->note = $note;
                        $existingNotation->save();
                    } else {
                        Notation::create([
                            'stagiaire_id' => $stagiaire_id,
                            'evaluation_id' => $evaluation_id,
                            'note' => $note
                        ]);
                    }
                }
            }
        }
        session(['notes_saved' => true]);

        return redirect()->back()->with('success', 'Notes sauvegardées avec succès.');
    }
    
}

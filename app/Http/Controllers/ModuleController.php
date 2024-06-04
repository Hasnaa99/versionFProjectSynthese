<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluatationRequest;
use App\Models\Evaluation;
use App\Models\Groupe;
use App\Models\Module;

class ModuleController extends Controller
{
    public function calculateModuleAverages($stagiaires, $evaluations)
    {
        $moyennes = [];
    
        foreach ($stagiaires as $stagiaire) {
            $totalNotesCC = 0;
            $nbEvaluationsCC = 0;
            $noteEFM = 0;
  
            // Vérifier si le stagiaire a des notations
            if ($stagiaire->notations) {
                foreach ($evaluations as $evaluation) {
                    // Vérifier si l'évaluation a été notée pour ce stagiaire
                    $notation = $stagiaire->notations->where('evaluation_id', $evaluation->id)->first();
                    if ($notation) {
                        if ($evaluation->type === 'CC') {
                            $totalNotesCC += $notation->note;
                            $nbEvaluationsCC++;
                        } elseif ($evaluation->type === 'EFM') {
                            $noteEFM = $notation->note;
                        }
                    }
                }
            }
    
            // Calculer la moyenne de module
            $moyenneCC = ($nbEvaluationsCC > 0) ? ($totalNotesCC / $nbEvaluationsCC) : 0;
            $moyenneModule = ($moyenneCC + $noteEFM) / 3;
            $moyennes[$stagiaire->id] = $moyenneModule;
        }
    
        return $moyennes;
    }
    
public function show(Groupe $groupe, Module $module)
{
    // Récupérer toutes les évaluations pour ce groupe et ce module
    $evaluations = Evaluation::where('groupe_id', $groupe->id)
        ->where('module_id', $module->id)
        ->orderByRaw("FIELD(type, 'CC', 'EFM')") // Trier par type pour s'assurer que les CC viennent avant les EFM
        ->orderBy('numero_ctrl') // Puis par numéro de contrôle
        ->get();

    // Récupérer tous les stagiaires pour ce groupe
    $stagiaires = $groupe->stagiaires;

    // Calculer les moyennes de module pour chaque stagiaire
    $moyennes = $this->calculateModuleAverages($stagiaires, $evaluations);
    return view('module.show', compact('groupe', 'module', 'evaluations', 'moyennes'));
}

    public function create_evaluation($groupe_id, $module_id)
    {
        $groupe = Groupe::findOrFail($groupe_id);
        $module = Module::findOrFail($module_id);
        return view('createEvaluation', compact('groupe', 'module'));
    }
    public function store_evaluation(EvaluatationRequest $request)
    {
        $validatedData = $request->validated();

        // Créer l'évaluation standard avec type 'CC'
        Evaluation::create(array_merge($validatedData, ['type' => 'CC','bareme'=>20]));

        // Rediriger vers la page des stagiaires
        return redirect()->route('module.show', ['groupe' => $validatedData['groupe_id'], 'module' => $validatedData['module_id']])
            ->with('success', 'Évaluation ajoutée avec succès.');
    }
    public function imprimerFiche($groupe_id, $module_id)
    {
        // Récupérer le groupe et le module par leurs IDs
        $groupe = Groupe::find($groupe_id);
        $module = Module::find($module_id);

        // Récupérer toutes les évaluations pour ce groupe et ce module
        $evaluations = Evaluation::where('groupe_id', $groupe->id)
            ->where('module_id', $module->id)
            ->orderByRaw("FIELD(type, 'CC', 'EFM')") // Trier par type pour s'assurer que les CC viennent avant les EFM
            ->orderBy('numero_ctrl') // Puis par numéro de contrôle
            ->get();
        

            

        // Récupérer tous les stagiaires pour ce groupe
        $stagiaires = $groupe->stagiaires;

        // Calculer les moyennes de module pour chaque stagiaire
        $moyennes = $this->calculateModuleAverages($stagiaires, $evaluations);
        
        return view('module.ficheComplete', compact('groupe', 'module', 'evaluations', 'moyennes'));
    }
}

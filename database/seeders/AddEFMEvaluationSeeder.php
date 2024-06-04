<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evaluation;
use App\Models\Groupe;
use App\Models\Module;

class AddEFMEvaluationSeeder extends Seeder
{
    public function run()
    {
        $groupes = Groupe::all();
        $modules = Module::all();

        foreach ($groupes as $groupe) {
            foreach ($modules as $module) {
                $existingEFMEvaluation = Evaluation::where('groupe_id', $groupe->id)
                    ->where('module_id', $module->id)
                    ->where('type', 'EFM')
                    ->first();

                if (!$existingEFMEvaluation) {
                    Evaluation::create([
                        'date' => now(),  // Ajustez la date par défaut si nécessaire
                        'duree' => 3,  // Durée par défaut de l'EFM, ajustez si nécessaire
                        'groupe_id' => $groupe->id,
                        'module_id' => $module->id,
                        'numero_ctrl' => 0,  // Numéro de contrôle pour l'EFM
                        'type' => 'EFM'
                    ]);
                }
            }
        }
    }
}

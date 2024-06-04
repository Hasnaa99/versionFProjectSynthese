<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Groupe;
use App\Models\Module;
use App\Models\GroupeModule;
class GroupeModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Générer les modules pour les groupes Dev101, Dev102, Dev103
        $this->generateModulesForGroupe('Dev101', 6);
        $this->generateModulesForGroupe('Dev102', 6);
        $this->generateModulesForGroupe('Dev103', 6);

        // Générer les modules pour les groupes Id101, Id102, Id103
        $this->generateModulesForGroupe('Id101', 6);
        $this->generateModulesForGroupe('Id102', 6);
        $this->generateModulesForGroupe('Id103', 6);

        // Générer les modules pour les groupes DevOFS101, DevOFS102, DevOFS103
        $this->generateModulesForGroupe('DEVOWFS1', 6);
        $this->generateModulesForGroupe('DEVOWFS2', 6);
        $this->generateModulesForGroupe('DEVOWFS3', 6);

        // Générer les modules pour le groupe DEVOAM1
        $this->generateModulesForGroupe('DEVOAM1', 6);
    }

    /**
     * Générer les modules pour un groupe spécifique.
     *
     * @param string $codeG Le code du groupe
     * @param int $count Le nombre de modules à générer
     */
    private function generateModulesForGroupe($codeG, $count)
    {
        // Récupérer les modules aléatoirement
        $modules = Module::inRandomOrder()->take($count)->get();

        // Récupérer le groupe
        $groupe = Groupe::where('codeG', $codeG)->first();

        // Associer les modules au groupe
        foreach ($modules as $module) {
            GroupeModule::create([
                'groupe_id' => $groupe->id,
                'module_id' => $module->id,
            ]);
        }
    }
}

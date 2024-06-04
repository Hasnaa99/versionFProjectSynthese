<?php

namespace Database\Seeders;

use App\Models\Formateur;
use App\Models\Groupe;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormateurGroupeModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all formateurs, groupes, and modules from the database
        $formateurs = Formateur::all();
        $groupes = Groupe::all();
        $modules = Module::all();

        // Create a collection to track assigned modules for each group
        $assignedModulesByGroup = [];

        // Initialize the collection for each group
        foreach ($groupes as $groupe) {
            $assignedModulesByGroup[$groupe->id] = collect();
        }

        // For each formateur, assign 5 random groupes
        foreach ($formateurs as $formateur) {
            $assignedGroupes = $groupes->random(5); // Select 5 random groupes

            foreach ($assignedGroupes as $groupe) {
                // Ensure we have enough modules to assign to this formateur for the group
                $availableModules = $modules->diff($assignedModulesByGroup[$groupe->id]);
                
                // If there are not enough available modules for the next formateur, continue to the next group
                if ($availableModules->count() < 3) {
                    continue;
                }

                // Assign between 2 and 3 random available modules to the formateur for this group
                $assignedModules = $availableModules->random(rand(2, 3));

                foreach ($assignedModules as $module) {
                    // Insert the association
                    DB::table('formateur_groupe_module')->insert([
                        'formateur_id' => $formateur->id,
                        'groupe_id' => $groupe->id,
                        'module_id' => $module->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Track the assigned module for this group
                    $assignedModulesByGroup[$groupe->id]->push($module);
                }
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Formateur;
use App\Models\Groupe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupeFormateur extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérez tous les groupes et les formateurs de la base de données
        $groupes = Groupe::all();
        $formateurs = Formateur::all();

        // Bouclez à travers chaque groupe
        foreach ($groupes as $groupe) {
            // Générez un nombre aléatoire entre 3 et 5 pour le nombre de formateurs
            $nombreFormateurs = rand(3, 5);

            // Sélectionnez aléatoirement $nombreFormateurs formateurs
            $formateursAssignes = $formateurs->random($nombreFormateurs);

            // Attachez les formateurs sélectionnés au groupe actuel
            $groupe->formateurs()->attach($formateursAssignes);
        }
    }
}


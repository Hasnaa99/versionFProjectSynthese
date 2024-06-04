<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            ['codeM' => 'GTS202', 'intitule' => 'Français', 'masse_horaire' => 115],
            ['codeM' => 'EGTS203', 'intitule' => 'Anglais technique', 'masse_horaire' => 50],
            ['codeM' => 'EGTS204', 'intitule' => 'Culture entrepreneuriale', 'masse_horaire' => 45],
            ['codeM' => 'EGTS205', 'intitule' => 'Compétences comportementales', 'masse_horaire' => 30],
            ['codeM' => 'EGTS208', 'intitule' => 'Entrepreneuriat-PIE 2', 'masse_horaire' => 80],
            ['codeM' => 'EGTSA206', 'intitule' => 'Culture et techniques avancées du numérique', 'masse_horaire' => 30],
            ['codeM' => 'M201', 'intitule' => 'Préparation d’un projet web', 'masse_horaire' => 60],
            ['codeM' => 'M202', 'intitule' => 'Approche agile', 'masse_horaire' => 120],
            ['codeM' => 'M203', 'intitule' => 'Gestion des données', 'masse_horaire' => 90],
            ['codeM' => 'M204', 'intitule' => 'Développement front-end', 'masse_horaire' => 90],
            ['codeM' => 'M205', 'intitule' => 'Développement back-end', 'masse_horaire' => 120],
            ['codeM' => 'M206', 'intitule' => 'Création d’une application Cloud native', 'masse_horaire' => 90],
            ['codeM' => 'M207', 'intitule' => 'Projet de synthèse', 'masse_horaire' => 60],
            ['codeM' => 'M208', 'intitule' => 'Intégration du milieu professionnel', 'masse_horaire' => 160],
            ['codeM' => 'M101', 'intitule' => 'Se situer au regard du métier et de la démarche de formation', 'masse_horaire' => 90],
            ['codeM' => 'M102', 'intitule' => 'Comprendre les enjeux d’un système d’information', 'masse_horaire' => 100],
            ['codeM' => 'M103', 'intitule' => 'Concevoir un réseau informatique', 'masse_horaire' => 90],
            ['codeM' => 'M104', 'intitule' => 'Fonctionnement du système d’exploitation', 'masse_horaire' => 75],
            ['codeM' => 'M105', 'intitule' => 'Gérer une infrastructure virtualisée', 'masse_horaire' => 100],
            ['codeM' => 'M106', 'intitule' => 'Automatiser les tâches d’administration', 'masse_horaire' => 102],
            ['codeM' => 'M107', 'intitule' => 'Sécuriser un système d’information', 'masse_horaire' => 100],
            ['codeM' => 'M108', 'intitule' => 'Développer une veille technologique', 'masse_horaire' => 120],
            ['codeM' => 'M101', 'intitule' => 'Se situer au regard du métier et de la démarche de formation', 'masse_horaire' => 35],
            ['codeM' => 'M102', 'intitule' => 'Acquérir les bases de l’algorithmique', 'masse_horaire' => 100],
            ['codeM' => 'M103', 'intitule' => 'Programmer en Orienté Objet', 'masse_horaire' => 100],
            ['codeM' => 'M104', 'intitule' => 'Développer des sites web statiques', 'masse_horaire' => 100],
            ['codeM' => 'M105', 'intitule' => 'Programmer en JavaScript', 'masse_horaire' => 100],
            ['codeM' => 'M106', 'intitule' => 'Manipuler des bases de données', 'masse_horaire' => 90],
            ['codeM' => 'M107', 'intitule' => 'Développer des sites web dynamiques', 'masse_horaire' => 100],
            ['codeM' => 'M108', 'intitule' => 'S’initier à la sécurité des systèmes d’information', 'masse_horaire' => 120],
        ];

        foreach ($modules as $module) {
            DB::table('modules')->insert([
                'codeM' => $module['codeM'],
                'intitule' => $module['intitule'],
                'masse_horaire' => $module['masse_horaire'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

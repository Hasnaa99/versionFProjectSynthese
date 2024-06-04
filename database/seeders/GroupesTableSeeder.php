<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupes = [
            ['codeG' => 'Dev101', 'niveauF' => '1ere', 'specialite' => 'développement digital', 'annee_scolaire' => '2023-2024'],
            ['codeG' => 'Dev102', 'niveauF' => '1ere', 'specialite' => 'développement digital', 'annee_scolaire' => '2023-2024'],
            ['codeG' => 'Dev103', 'niveauF' => '1ere', 'specialite' => 'développement digital', 'annee_scolaire' => '2023-2024'],
            ['codeG' => 'Id101', 'niveauF' => '1ere', 'specialite' => 'infrastructure digital', 'annee_scolaire' => '2023-2024'],
            ['codeG' => 'Id102', 'niveauF' => '1ere', 'specialite' => 'infrastructure digital', 'annee_scolaire' => '2023-2024'],
            ['codeG' => 'Id103', 'niveauF' => '1ere', 'specialite' => 'infrastructure digital', 'annee_scolaire' => '2023-2024'],
            ['codeG' => 'DEVOWFS1', 'niveauF' => '2eme', 'specialite' => 'Full stack', 'annee_scolaire' => '2023-2024'],
            ['codeG' => 'DEVOWFS2', 'niveauF' => '2eme', 'specialite' => 'Full stack', 'annee_scolaire' => '2023-2024'],
            ['codeG' => 'DEVOWFS3', 'niveauF' => '2eme', 'specialite' => 'Full stack', 'annee_scolaire' => '2023-2024'],
            ['codeG' => 'DEVOAM1', 'niveauF' => '2eme', 'specialite' => 'application mobile', 'annee_scolaire' => '2023-2024'],
        ];

        foreach ($groupes as $groupe) {
            DB::table('groupes')->insert([
                'codeG' => $groupe['codeG'],
                'niveauF' => $groupe['niveauF'],
                'specialite' => $groupe['specialite'],
                'annee_scolaire' => $groupe['annee_scolaire'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

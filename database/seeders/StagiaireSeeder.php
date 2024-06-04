<?php
// database/seeders/StagiaireSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Groupe;
use App\Models\Stagiaire;

class StagiaireSeeder extends Seeder
{
    public function run()
    {
        Groupe::all()->each(function ($groupe) {
            Stagiaire::factory()->count(10)->create(['groupe_id' => $groupe->id]);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->integer('bareme')->default(20); // Ajoutez la colonne "barème" avec une valeur par défaut de 20
        });

        // Mettez à jour le barème pour les évaluations de type EFM
        DB::table('evaluations')->where('type', 'EFM')->update(['bareme' => 40]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn('bareme'); // Supprimez la colonne "barème" si la migration est annulée
        });
    }
};

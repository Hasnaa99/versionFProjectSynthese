<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formateur_groupe_module', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formateur_id');
            $table->unsignedBigInteger('groupe_id');
            $table->unsignedBigInteger('module_id');
            $table->timestamps();

            // Définir les clés étrangères avec cascade sur delete
            $table->foreign('formateur_id')->references('id')->on('formateurs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('groupe_id')->references('id')->on('groupes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formateur_groupe_module');
    }
};

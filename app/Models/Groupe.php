<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class Groupe extends Model
{
    use HasFactory;

    protected $fillable = ['codeG','niveauF','specialite','annee_scolaire'];

    //groupe avec formateur (formateur encadre plusieurs groupes)
    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class, 'formateur_groupe')->withTimestamps();
    }

    //groupe avec module (groupe étudier plusieurs module)
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'formateur_groupe_module')
                    ->withPivot('formateur_id')
                    ->withTimestamps();
    }
    //groupe avec stagiaire(groupe contient plusieurs stagiaire)
    public function stagiaires(){
        return $this->hasMany(Stagiaire::class);
    }
}

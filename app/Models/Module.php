<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = ['codeM','intitule','masse_horaire'];
    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class, 'formateur_groupe_module')
                    ->withPivot('groupe_id')
                    ->withTimestamps();
    }
    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'formateur_groupe_module')
                    ->withPivot('formateur_id')
                    ->withTimestamps();
    }
}

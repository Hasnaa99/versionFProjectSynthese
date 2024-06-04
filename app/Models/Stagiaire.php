<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Groupe;
class Stagiaire extends Model
{
    use HasFactory;
    protected $fillable = ['cef','nom','prenom','date_naissance','groupe_id'];
    
    //un stagiaire est appartient d'un groupe
    public function groupe(){
        return $this->belongsTo(Groupe::class);
    }
    public function notations()
    {
        return $this->hasMany(Notation::class);
    }
}

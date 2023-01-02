<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'dateNaissance',
        'lieuNaissance',
        'nationalite',
        'ville',
        'pays',
        'adresse',
        'pieceIdentite',
        'noPieceIdentite',
        'telephone1',
        'telephone2',
        'email',
        
    ];

    public function locations(){
        return $this->hasMany(Location::class);
    }
}

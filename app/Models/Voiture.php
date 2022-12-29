<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    use HasFactory;
    public $fillable = [
        "titre", "matricule", "type_voiture_id", "modele","image","kilometrage","nbrPlace","description","estDisponible"
    ];
    
    public function type(){
      return  $this->belongsTo(TypeVoiture::class,"type_voiture_id","id");
    }

    public function tarification(){
      return $this->hasMany(Tarification::class);
  }
  
  public function locations(){
    return $this->belongsToMany(Location::class,"voiture_location","voiture_id","location_id");
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public $fillable = [
        "client_id", "voiture_id", "dateDebut", "dateFin"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function statut(){
        return $this->belongsTo(StatutLocation::class,"statut_location_id","id");
    }

    public function paiements(){
        return $this->hasMany(Paiement::class);
    }

    public function voitures(){
        return $this->belongsToMany(Voiture::class,"voiture_location","location_id","voiture_id");
      }

      public function voiture(){
        return $this->belongsTo(Voiture::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVoiture extends Model
{
    use HasFactory;
    protected $fillable = ["nom"];

    public function voitures(){
      return  $this->hasMany(Voiture::class);
    }
}


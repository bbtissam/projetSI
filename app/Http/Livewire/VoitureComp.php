<?php

namespace App\Http\Livewire;

use App\Models\Voiture;
use App\Models\TypeVoiture;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VoitureComp extends Component
{
    use WithPagination;

    protected $paginationTheme="bootstrap";
    public $search="";
    public $filtreType="", $filtreEtat="";
    public function render()
    {
        Carbon::setLocale("fr");


        $voitureQuery=Voiture::query();
        if($this->search!=""){
            $voitureQuery->where("titre","LIKE","%".$this->search."%")
            ->orWhere("modele","Like","%".$this->search."%");
        }
        if($this->filtreType!=""){
            $voitureQuery->where("estDisponible",$this->filtreType);
            
        }
       
        if($this->filtreEtat!=""){
            $voitureQuery->where("type_voiture_id",$this->filtreEtat);
            
        }

        return view('livewire.voitures.index',[
            "voitures"=>$voitureQuery->latest()->paginate(5),
            "typevoitures"=>TypeVoiture::orderBy("nom","ASC")->get()
        ])
                ->extends("layouts.master")
                ->section("contenu");
    }

    public function editVoiture(Voiture $voiture){
        
    }

    public function confirmDelete(Voiture $voiture){
        
    }
}

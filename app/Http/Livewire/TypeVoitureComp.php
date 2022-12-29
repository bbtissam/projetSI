<?php

namespace App\Http\Livewire;

use App\Models\TypeVoiture;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TypeVoitureComp extends Component
{
    use WithPagination;
    public $search="";
    public $isAddTypeVoiture=false;
    public $newTypeVoitureName="";
    public $newValue = "";

    protected $paginationTheme="bootstrap";

    public function render()
    {
        Carbon::setLocale("fr");

        $searchCriteria = "%".$this->search."%";

        $data = [
            "typevoitures" => TypeVoiture::where("nom", "like", $searchCriteria)->latest()->paginate(5),
        ];
        return view('livewire.typevoitures.index', $data)
                ->extends("layouts.master")
                ->section("contenu");
    }

    public function toggleShowAddTypeVoitureForm(){
        if($this->isAddTypeVoiture){
           $this->isAddTypeVoiture = false;
           $this->newTypeVoitureName = "";
           $this->resetErrorBag(["newTypeVoitureName"]);
        }else{
           $this->isAddTypeVoiture = true;
        }
   }

    
public function addNewTypeVoiture(){
    $validated = $this->validate([
        "newTypeVoitureName" => "required|max:50|unique:type_voitures,nom"
    ]);

    TypeVoiture::create(["nom"=> $validated["newTypeVoitureName"]]);

    $this->toggleShowAddTypeVoitureForm();
$this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"la marque ajouté avec succès!"]);
}

public function editTypeVoiture(TypeVoiture $typeVoiture){
    
    $this->dispatchBrowserEvent("showEditForm",["typevoiture"=>$typeVoiture]);
}

public function updateTypeVoiture(TypeVoiture $typeVoiture, $valueFromJS){
    $this->newValue = $valueFromJS;
    $validated = $this->validate([
        "newValue" => ["required", "max:50", Rule::unique("type_voitures", "nom")->ignore($typeVoiture->id)]
    ]);

    $typeVoiture->update(["nom"=> $validated["newValue"]]);

    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"La marque mis à jour avec succès!"]);

}

public function confirmDelete($name, $id){
    $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
        "text" => "Vous êtes sur le point de supprimer $name de la liste des  marques. Voulez-vous continuer?",
        "title" => "Êtes-vous sûr de continuer?",
        "type" => "warning",
        "data" => [
            "type_voiture_id" => $id
        ]
    ]]);
}

public function deleteTypeVoiture(TypeVoiture $typeVoiture){
    $typeVoiture->delete();
    $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"la marque supprimé avec succès!"]);
}
}
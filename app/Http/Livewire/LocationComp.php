<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Location;
use Intervention\Image\Facades\Image;
use App\Models\Voiture;
use App\Models\TypeVoiture;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class LocationComp extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme="bootstrap";
    public $search="";
    public $filtreVoiture="", $filtreClient="";
    public $addLocation=[];
    public $inputFileIterator = 0;
    public $addPhoto = null;
    public $editLocation = [];
    public $editPhoto = null;
    public $inputEditFileIterator = 0;
    public $editHasChanged;
    public $editLocationOldValues = [];


    /**protected function rules () {
        return [
            
            "editVoiture.titre" => ["required", Rule::unique("voitures", "titre")->ignore($this->editVoiture["id"])],
            "editVoiture.matricule" => ["required", Rule::unique("voitures", "matricule")->ignore($this->editVoiture["id"])],
            
            "editVoiture.modele" => "required",
            "editVoiture.kilometrage" => "required",
            "editVoiture.nbrPlace" => "required",
            "editVoiture.description" => "required",
            "editVoiture.prix" => "required",
            'editVoiture.type_voiture_id' => 'required|exists:App\Models\TypeVoiture,id',

        ];
    } **/
    
    public function render()
    {
        Carbon::setLocale("fr");


        $locationQuery=Location::query();
        
        /**if($this->editVoiture != []){
            $this->showUpdateButton();
        }**/
        if($this->search!=""){
            $this->resetPage();
            $locationQuery->where("titre","LIKE","%".$this->search."%")
            ->orWhere("nom","Like","%".$this->search."%");
        }
        if($this->filtreVoiture !=""){
            $locationQuery->where("voiture_id",$this->filtreVoiture);
            
        }
       
        if($this->filtreClient !=""){
            $locationQuery->where("client_id",$this->filtreClient);
            
        }
        /**if($this->editVoiture != []){
            $this->showUpdateButton();
        }**/
        return view('livewire.locations.index',[
            "locations"=>$locationQuery->latest()->paginate(5),
            "voitures"=>Voiture::orderBy("titre","ASC")->get(),
            "clients"=>Client::orderBy("nom","ASC")->get()
        ])
                ->extends("layouts.master")
                ->section("contenu");
    }

    public function showAddLocationModal(){
        $this->resetValidation();
        $this->addLocation = [];
        $this->addPhoto = null;
        $this->inputFileIterator++;
        $this->dispatchBrowserEvent("showModal");
    }

    public function closeModal(){
        
        $this->dispatchBrowserEvent("closeModal");
    }

    public function ajoutLocation(){

        $validateArr = [
            "addLocation.client" => "required",
            "addLocation.voiture" => "required",
            "addLocation.dateDebut" => "required",
            "addLocation.dateFin" => "required",
            
        ];

        $validatedData = $this->validate($validateArr);
        $location = Location::create([
            "client_id" => $validatedData["addLocation"]["client"],
            "voiture_id" => $validatedData["addLocation"]["voiture"],
            "dateDebut" => $validatedData["addLocation"]["dateDebut"],
            "dateFin" => $validatedData["addLocation"]["dateFin"],
        ]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Vehicule ajouté avec succès!"]);

        $this->closeModal();
    }

   /**public function ajoutVoiture(){
        $validateArr = [
            "addVoiture.titre" => "string|min:3|required|unique:voitures,titre",
            "addVoiture.matricule" => "string|max:50|min:3|required",
            "addVoiture.modele" => "string|max:50|min:3|required",
            "addVoiture.kilometrage" => "integer|required",
            "addVoiture.nbrPlace" => "integer|required",
            "addVoiture.prix" => "integer|required",
            "addVoiture.description" => "string|required",
            "addVoiture.type" => "required",
            "addPhoto" => "image|max:10240" // 10mb

        ];

        $imagePath="images/téléchargement.png";

        $validatedData = $this->validate($validateArr);

        if($this->addPhoto != null){

            $path = $this->addPhoto->store('upload', 'public');
            
            $imagePath="storage/".$path;

            $image = Image::make(public_path($imagePath))->fit(200, 200);
            $image->save();

        }
        $voiture = Voiture::create([
            "titre" => $validatedData["addVoiture"]["titre"],
            "matricule" => $validatedData["addVoiture"]["matricule"],
            "modele" => $validatedData["addVoiture"]["modele"],
            "kilometrage" => $validatedData["addVoiture"]["kilometrage"],
            "nbrPlace" => $validatedData["addVoiture"]["nbrPlace"],
            "prix" => $validatedData["addVoiture"]["prix"],
            "description" => $validatedData["addVoiture"]["description"],
            "type_voiture_id" => $validatedData["addVoiture"]["type"],
            "image" => $imagePath
        ]);
    
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Vehicule ajouté avec succès!"]);

        $this->closeModal();
        
    }
    
    protected function cleanupOldUploads(){

        $storage = Storage::disk("local");

        foreach($storage->allFiles("livewire-tmp") as $pathFileName){

            if(! $storage->exists($pathFileName)) continue;

            $fiveSecondsDelete = now()->subSeconds(5)->timestamp;

            if($fiveSecondsDelete > $storage->lastModified($pathFileName)){
                $storage->delete($pathFileName);
            }
        }
    } 

    public function editVoiture($voitureId){
        $this->editVoiture = Voiture::with("type")->find($voitureId)->toArray();
        $this->editVoitureOldValues = $this->editVoiture;

        $this->editPhoto = null;
        $this->inputEditFileIterator++;
        $this->dispatchBrowserEvent("showEditModal");
    }

    
    function showUpdateButton(){
        $this->editHasChanged = false;

        
        if( 
            $this->editVoiture["titre"] != $this->editVoitureOldValues["titre"] ||
            $this->editVoiture["matricule"] != $this->editVoitureOldValues["matricule"] ||
            $this->editVoiture["type"] != $this->editVoitureOldValues["type"] ||
            $this->editVoiture["modele"] != $this->editVoitureOldValues["modele"] ||
            $this->editVoiture["kilometrage"] != $this->editVoitureOldValues["kilometrage"] ||
            $this->editVoiture["nbrPlace"] != $this->editVoitureOldValues["nbrPlace"] ||
            $this->editVoiture["prix"] != $this->editVoitureOldValues["prix"] ||
            $this->editVoiture["description"] != $this->editVoitureOldValues["description"] ||
            $this->editPhoto != null
        ){
            $this->editHasChanged = true;
        }

    }
   public function updateVoiture(){
        $this->validate();

        $voiture = Voiture::find($this->editVoiture["id"]);

        $voiture->fill($this->editVoiture);

        if($this->editPhoto != null){
            $path = $this->editPhoto->store("upload", "public");
            $imagePath = "storage/".$path;
            $image = Image::make(public_path($imagePath))->fit(200, 200);

            $image->save();

            Storage::disk("local")->delete(str_replace("storage/", "public/", $voiture->image));

            $voiture->image = $imagePath;
        }

        $voiture->save();

        
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=> "Vehicule mis à jour avec succès!"]);
        $this->dispatchBrowserEvent("closeEditModal");
        
       
    } 

    public function closeEditModal(){
        
        $this->dispatchBrowserEvent("closeEditModal");
    }

     

    public function confirmDelete(Voiture $voiture){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer ". $voiture->titre ." de la liste des articles. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "voiture_id" => $voiture->id
            ]
        ]]); 
    } 

    public function deleteVoiture(Voiture $voiture){
        if(count($voiture->locations)>0) return;

        
        
        if(count($voiture->tarification) > 0)
            $voiture->tarification()->where("voiture_id", $voiture->id)->delete();
        
        $voiture->delete();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"voiture supprimé avec succès!"]);
    }**/
}

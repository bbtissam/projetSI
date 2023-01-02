<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'une voiture </h5>

            </div>
            <form wire:submit.prevent="ajoutVoiture" enctype="multipart/form-data">
            <div class="modal-body">

                <div class="d-flex">
                    <div class=" my-4 bg-gray-light p-3 flex-grow-1">
                        @if($errors->any())
                                <div class="alert alert-danger">

                                    <h5><i class="icon fas fa-ban"></i> Erreurs!</h5>
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                    </ul>
                                </div>
                        @endif

                        <div class="form-group">
                            <label for="">Titre Vehicule</label>
                            <input type="text" wire:model="addVoiture.titre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Matricule</label>
                            <input type="text" wire:model="addVoiture.matricule" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Modele</label>
                            <input type="text" wire:model="addVoiture.modele" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">kilometrage</label>
                            <input type="text" wire:model="addVoiture.kilometrage" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nombre de places</label>
                            <input type="number" wire:model="addVoiture.nbrPlace" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" cols="100" rows="10" wire:model="addVoiture.description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Marque</label>
                            <select  class="form-control" wire:model="addVoiture.type">
                                <option value=""></option>
                                @foreach ($typevoitures as $typevoiture)
                                    <option value="{{$typevoiture->id}}">{{ $typevoiture->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Prix par jour</label>
                            <input type="number" wire:model="addVoiture.prix" class="form-control">
                        </div>
                        
                        

                    </div>

                    <div class="p-4" >
                                <div class="form-group">
                                    <input type="file" wire:model="addPhoto" id="image{{$inputFileIterator}}">
                                </div>
                                <div style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">
                                        @if ($addPhoto)

                                            <img src="{{ $addPhoto->temporaryUrl() }}" style="height:200px; width:200px;">
                                        @endif
                                </div>
                     </div>
            </div>


        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Ajouter</button>
            <button type="button" class="btn btn-danger" wire:click="closeModal">Fermer</button>
        </div>

        </form>

        </div>
    </div>
</div>

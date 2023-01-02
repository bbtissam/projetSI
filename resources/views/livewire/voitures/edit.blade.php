<div class="modal fade" id="editModal" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition d'une Vehicule </h5>

            </div>
            <form wire:submit.prevent="updateVoiture">
            <div class="modal-body ">

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
                                <input type="text" wire:model="editVoiture.titre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Matricule</label>
                                <input type="text" wire:model="editVoiture.matricule" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Modele</label>
                                <input type="text" wire:model="editVoiture.modele" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">kilometrage</label>
                                <input type="text" wire:model="editVoiture.kilometrage" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nombre de places</label>
                                <input type="number" wire:model="editVoiture.nbrPlace" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="100" rows="10" wire:model="editVoiture.description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Marque</label>
                                <select  class="form-control" wire:model="editVoiture.type_voiture_id">
                                    <option value="{{ $editVoiture["type_voiture_id"] }}">{{ $editVoiture["type"]["nom"] }}</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Prix par jour</label>
                                <input type="number" wire:model="editVoiture.prix" class="form-control">
                            </div>
                            {{-- Les champs dynamiques qui seront crées par rapport au type selectionné --}}
                            

                        </div>

                        <div class="p-4" >
                                    <div class="form-group">
                                        <input type="file" wire:model="editPhoto" id="image{{$inputEditFileIterator}}">
                                    </div>
                                    <div style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">
                                            @if (isset($editPhoto))

                                                <img src="{{ $editPhoto->temporaryUrl() }}" style="height:200px; width:200px;">

                                            @else

                                            <img src="{{ asset($editVoiture["image"]) }}" style="height:200px; width:200px;">

                                            @endif
                                    </div>
                                    @isset($editPhoto)
                                    <div>
                                        <button
                                        type="button" 
                                        class="btn btn-default btn-sm mt-2"
                                        wire:click="$set('editPhoto', null)"
                                        >Réinitialiser</button>    
                                    </div> 
                                    @endisset
                         </div>
                </div>


            </div>
            <div class="modal-footer" >
               <div>
                @if( $editHasChanged)
                    <button type="submit" class="btn btn-success" >Valider les modifications</button>
                @endif
               </div> 
                    <button type="button" class="btn btn-danger" wire:click="closeEditModal">Fermer</button>
            </div>

            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'une location </h5>

            </div>
            <form wire:submit.prevent="ajoutLocation">
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
                            <label for="">Client</label>
                            <select  class="form-control" wire:model="addLocation.client">
                                <option value=""></option>
                                @foreach ($clients as $client)
                                    <option value="{{$client->id}}">{{ $client->nom }} {{ $client->prenom }} </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Date Debut</label>
                            <input type="date" wire:model="addLocation.dateDebut" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Date Fin</label>
                            <input type="date" wire:model="addLocation.dateFin" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Voiture</label>
                            <select  class="form-control" wire:model="addLocation.voiture">
                                <option value=""></option>
                                @foreach ($voitures as $voiture)
                                    <option value="{{$voiture->id}}">{{ $voiture->titre }}</option>
                                @endforeach
                            </select>
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

<div class="row p-4 pt-5">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-warning d-flex align-items-center">
          <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des locations</h3>

          <div class="card-tools d-flex align-items-center ">
          <a class="btn btn-link text-white mr-4 d-block" wire:click="showAddLocationModal"><i class="fas fa-user-plus"></i> Nouvel location</a>
            <div class="input-group input-group-md" style="width: 250px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
            <div class="d-flex justify-content-end p-4 bg-indigo">
                <div class="form-group mr-3">
                    <label for="filtreVoiture">Filtrer par voiture</label>
                    <select  id="filtreVoiture" wire:model="filtreVoiture" class="form-control">
                            <option value=""></option>
                            @foreach ($voitures as $voiture)
                                <option value="{{$voiture->id}}">{{ $voiture->titre }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="filtreClient">Filtrer par client</label>
                    <select  id="filtreClient" wire:model="filtreClient" class="form-control">
                            <option value=""></option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{ $client->titre }}</option>
                            @endforeach
                    </select>
                </div>
            </div>
          <table class="table table-head-fixed">
            <thead>
                <tr>
                      
                    <th >Client</th>
                    <th >Voiture</th>
                    <th class="text-center">date debut</th>
                    <th class="text-center">date fin</th>
                    <th class="text-center">Paiement</th>
                    
                    <th  class="text-center">Action</th>
                  </tr>
            </thead>
            <tbody>
             

                @foreach($locations as $location )
                          
                <tr>
                     
                    
                    <td>{{$location->client->nom}} {{$location->client->prenom}}</td>
                    <td>{{$location->voiture->titre}}</td>
                    <td>{{$location->dateDebut}}</td>
                    <td>{{$location->dateFin}}</td>
                    <td>-------</td>
                    
  
                    <td class="text-center">
                        <button class="btn btn-link"  wire:click="editLocation({{$location->id}})"> <i class="far fa-edit"></i> </button>
                        <button class="btn btn-link"  wire:click="confirmDelete({{$location->id}})"> <i class="far fa-trash-alt"></i> </button>
                    </td>
                </tr>
               
                @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="float-right">
              {{ $locations->links() }}
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>


  



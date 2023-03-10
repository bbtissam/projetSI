<div class="row p-4 pt-5">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des vehicules</h3>

        <div class="card-tools d-flex align-items-center ">
        <a class="btn btn-link text-white mr-4 d-block" wire:click="showAddVoitureModal"><i class="fas fa-user-plus"></i> Ajouter une vehicule</a>
          <div class="input-group input-group-md" style="width: 250px;">
            <input type="text" name="table_search" wire:model.debounce.250ms="search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0 table-striped" >
        <div class="d-flex justify-content-end p-4 bg-indigo">
            <div class="form-group mr-3">
                <label for="filtreType">Filtrer par type</label>
                <select  id="filtreType" wire:model="filtreType" class="form-control">
                        <option value=""></option>
                        @foreach ($typevoitures as $typevoiture)
                            <option value="{{$typevoiture->id}}">{{ $typevoiture->nom }}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="filtreEtat">Filtrer par etat</label>
                <select  id="filtreEtat" wire:model="filtreEtat" class="form-control">
                    <option value=""></option>
                    <option value="1">Disponible</option>
                    <option value="0">Indisponible</option>
                </select>
            </div>
        </div>
        <div style="height:350px;">
            <table class="table table-head-fixed">
              <thead>
                <tr>
                  <th>image</th>
                  <th >Vehicule</th>
                  <th class="text-center">Marque</th>
                  <th class="text-center">Matricule</th>
                  <th class="text-center">Modele</th>
                  <th class="text-center">Kilometrage</th>
                  <th class="text-center">Nombre de places</th>
                  <th class="text-center">Description</th>
                  <th class="text-center">Prix par jour</th>
                  <th class="text-center">Etat</th>
                  
                  <th  class="text-center">Ajout??</th>
                  <th  class="text-center">Action</th>
                </tr>
              </thead>
            <tbody>



              
              @forelse ($voitures as $voiture )
                        
              <tr>
                  <td>
                    
                    <img src="{{asset($voiture->image)}}" alt="" style="width:60px;height:60px;">
                    
                  </td> 
                  <td>{{$voiture->titre}}</td>
                  <td>{{$voiture->type->nom}}</td>
                  <td>{{$voiture->matricule}}</td>
                  <td>{{$voiture->modele}}</td>
                  <td>{{$voiture->kilometrage}}</td>
                  <td>{{$voiture->nbrPlace}}</td>
                  <td>{{$voiture->description}}</td>
                  <td>{{$voiture->prix}}</td>
                  <td>
                      @if($voiture->estDisponible==1)
                          <span class="badge badge-success">Disponible</span>
                      @else
                          <span class="badge badge-danger">Indisponible</span>
                      @endif
                  </td>
                  <td class="text-center">{{optional($voiture->created_at)->diffForHumans()}}</td>

                  <td class="text-center">
                      <button class="btn btn-link"  wire:click="editVoiture({{$voiture->id}})"> <i class="far fa-edit"></i> </button>
                      <button class="btn btn-link"  wire:click="confirmDelete({{$voiture->id}})"> <i class="far fa-trash-alt"></i> </button>
                  </td>
              </tr>
              @empty
              <tr>
                  <td colspan="12">
                      <div class="alert alert-info">
                          
                          <h5><i class="icon fas fa-info"></i> Information!</h5>
                          Aucune donne?? trouv??e par rapport aux elements de recherche entr??e.
                          </div>
                  </td>
              </tr>

            @endforelse

            </tbody>
            </table>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="float-right">
            {{ $voitures->links() }}
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>


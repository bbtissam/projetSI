<div class="row p-4 pt-5">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-danger d-flex align-items-center">
          <h3 class="card-title flex-grow-1"><i class="fa fa-list fa-2x"></i> Liste des Marques des vehicules</h3>

          <div class="card-tools d-flex align-items-center ">
          <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="toggleShowAddTypeVoitureForm"><i class="fas fa-user-plus"></i> Nouvel marque</a>
            <div class="input-group input-group-md" style="width: 250px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search" wire:model.debounce.500ms="search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
          <table class="table table-head-fixed">
            <thead>
              <tr>
                
                <th style="width:50%;">Marques</th>
                <th style="width:20%;" class="text-center">Ajouté</th>
                <th style="width:30%;" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>

                @if ($isAddTypeVoiture)
                <tr>
                    <td colspan="2">
                        <input type="text" wire:keydown.enter="addNewTypeVoiture" class="form-control @error('newTypeVoitureName') is-invalid @enderror" wire:model="newTypeVoitureName">
                        @error('newTypeVoitureName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </td>
                    <td>
                        <button class="btn btn-link"  wire:click="addNewTypeVoiture"> <i class="fa fa-check"></i>Valider </button>
                        <button class="btn btn-link" wire:click="toggleShowAddTypeVoitureForm"> <i class="far fa-trash-alt"></i>Annuler </button>
                    </td>
                </tr>
                    
                @endif

              @foreach ($typevoitures as $typevoiture )
                  
                <tr>
                    <td>{{$typevoiture->nom}}</td>
                    <td class="text-center">{{optional($typevoiture->created_at)->diffForHumans()}}</td>
                    <td class="text-center">
                        <button class="btn btn-link"  wire:click="editTypeVoiture({{$typevoiture->id}})"> <i class="far fa-edit"></i> </button>
                        <button class="btn btn-link"  wire:click="confirmDelete('{{$typevoiture->nom}}', {{$typevoiture->id}})"> <i class="far fa-trash-alt"></i> </button>
                    </td>
                </tr>

              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="float-right">
            {{ $typevoitures->links() }}
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>

<script>

    window.addEventListener("showEditForm",function(e){
        Swal.fire({
  title: "Edition d'une marque",
  input: 'text',
  inputValue: e.detail.typevoiture.nom,
  
  showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Modifier <i class="fa fa-check"></i>',
        cancelButtonText: 'Annuler  <i class="fa fa-times"></i>',
  inputValidator: (value) => {
    if (!value) {
      return 'champ obligatoire'
    }
    @this.updateTypeVoiture(e.detail.typevoiture.id,value)
  }
})
    })
</script>
  
<script>
    window.addEventListener("showSuccessMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title: event.detail.message || "Opération effectuée avec succès!",
                showConfirmButton: false,
                timer: 5000
                }
            )
    })
</script>

<script>
    window.addEventListener("showConfirmMessage", event=>{
       Swal.fire({
        title: event.detail.message.title,
        text: event.detail.message.text,
        icon: event.detail.message.type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuer',
        cancelButtonText: 'Annuler'
        }).then((result) => {
        if (result.isConfirmed) {
            if(event.detail.message.data){
                @this.deleteTypeVoiture(event.detail.message.data.type_voiture_id)
            }

           

        }
        })
    })

</script>
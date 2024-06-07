<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
 <meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="{{ asset('assets\css\pfp.css') }}">

@include('components.navbar')
<x-header>Profile Edit</x-header>


<div class=" mt-4  background-container">
        <img src="{{ asset('assets\images\pfp.png') }}" id="profile-picture" alt="Centered Image" class="center-image">
    </div>
    
<form action="/infirmier/{{ $infirmier->INP }}/edit/validate" method="POST">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="secondcol col-lg bg-light p-0 d-flex justify-center align-items-center">

            <div class="container-lg">
                <div class="col-lg border-right row3">
                    <div class="p-2 py-3">
                        <div class="row mt-2 mrg">
                            <div class="col-md-6">
                                <label class="labels">Nom</label>
                                <input name="nom"  type="text" class="form-control" placeholder="{{ $infirmier->nom }}"
                                    value="{{ $infirmier->nom }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Prenom</label>
                                <input  name="prenom"  type="text" class="form-control" placeholder="{{ $infirmier->prenom }}"
                                    value="{{ $infirmier->prenom }}" />
                            </div>
                        </div>
                        <div class="row mt-2 mrg">
                            <div class="col-md-6">
                                <label class="labels">Nom d'Hopital</label>
                                <input name="nom_Hopital"  type="text" class="form-control" placeholder="{{ $infirmier->nom_Hopital }}"
                                    value="{{ $infirmier->nom_Hopital }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Ville</label>
                                <input name="Ville"  type="text" class="form-control" placeholder="{{ $infirmier->Ville }}"
                                    value="{{ $infirmier->Ville }}" />
                            </div>
                        </div>
    
                    </div>
                    <div class="mt-1 mb-4 text-center">
                        <button type="submit" class="btn btn-outline-primary profile-button" type="button">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
</form>



<script>
    // script.js
document.getElementById('upload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-picture').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

</script>
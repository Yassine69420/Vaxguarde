<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="{{ asset('assets\css\pfp.css') }}">

@include('components.navbar')
<x-header>
    <div class="d-flex justify-content-between">


        <div>Profile Edit</div>

        <button class="btn btn-outline-light  align-middle fs-5 " type="button" onclick="history.back()">
            Retour
        </button>
    </div>


</x-header>

<div class="mt-1 background-container">
    <label for="file-input" class="position-relative">
        @if ($infirmier->pfp)
            <img src="{{ asset($infirmier->pfp) }}" id="profile-picture" alt="Profile Picture" class="center-image">
        @else
            <img src="{{ asset('assets/images/pfp.png') }}" id="profile-picture" alt="Centered Image"
                class="center-image">
        @endif
        <span class="change-text">Changer</span>
    </label>
    <input type="file" id="file-input" form="edit" name="pfp" style="display: none;"
        onchange="previewImage(event)">
</div>


<form id="edit" action="/infirmier/{{ $infirmier->INP }}/edit/validate" method="POST"
    enctype="multipart/form-data" class="mt-3">
    @csrf
    @method('PATCH')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="secondcol col-lg bg-light p-0 d-flex justify-center align-items-center">
            <div class="container-lg">
                <div class="col-lg border-right row3">
                    <div class="p-2 py-3">
                        <div class="row mt-2 mrg">
                            <div class="col-md-6">
                                <label class="labels">Nom</label>
                                <input name="nom" type="text" class="form-control" placeholder="Nom"
                                    value="{{ old('nom', $infirmier->nom) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Prenom</label>
                                <input name="prenom" type="text" class="form-control" placeholder="Prenom"
                                    value="{{ old('prenom', $infirmier->prenom) }}">
                            </div>
                        </div>
                        <div class="row mt-2 mrg">
                            <div class="col-md-6">
                                <label class="labels">Nom d'Hopital</label>
                                <input name="nom_Hopital" type="text" class="form-control"
                                    placeholder="Nom d'Hopital"
                                    value="{{ old('nom_Hopital', $infirmier->nom_Hopital) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Ville</label>
                                <input name="Ville" type="text" class="form-control" placeholder="Ville"
                                    value="{{ old('Ville', $infirmier->Ville) }}">
                            </div>
                        </div>
                    </div>
                    <div class="mt-1 mb-4 text-center">
                        <button type="submit" class="btn btn-outline-primary profile-button">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profile-picture').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

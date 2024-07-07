<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
 <meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
    .secondcol {
        margin-top: 30px
    }

    .row3 {
        width: 100%;
    }
</style>


@include('components/navbar')

<x-header >
<div class="d-flex justify-content-between">

    
    <div>Ajouter parent</div>
    
    <button class="btn btn-outline-light  align-middle fs-5 " type="button" onclick="history.back()">
        Retour
    </button>
</div>
            
           
</x-header>


<form action="/infirmier/createParent/validation" method="POST">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="secondcol col-lg bg-light p-0 m-0 d-flex justify-center align-items-center">

       <div class="container-lg">
    <div class="col-lg border-right row3 ">
        <div class="p-2 py-3">
            <div class="row mt-2 mrg m-3">
                <div class="col-md-6">
                    <label class="labels">Nom</label>
                    <input type="text" name="nom" class="form-control" placeholder="Nom" value="{{ old('nom') }}" />
                </div>
                <div class="col-md-6">
                    <label class="labels">Prenom</label>
                    <input type="text" name="prenom" class="form-control" placeholder="Prenom" value="{{ old('prenom') }}" />
                </div>
            </div>

            <div class="row mt-2 mrg m-3">
                <div class="col-md-6">
                    <label class="labels">Adresse</label>
                    <input type="text" name="adress" class="form-control" placeholder="Ait ati 2 for exemple" value="{{ old('adress') }}" />
                </div>
                <div class="col-md-6">
                    <label class="labels">telephone</label>
                    <input type="text" name="telephone" class="form-control" placeholder="0657263527 for exemple" value="{{ old('telephone') }}" />
                </div>
            </div>

            <div class="row mt-2 mrg m-3">
                <div class="col-md-6">
                    <label class="labels">CIN</label>
                    <input type="text" name="CIN" class="form-control" placeholder="M29382 comme exemple" value="{{ old('CIN') }}" />
                </div>
                <div class="col-md-6">
                    <label class="labels">Date de naissance</label>
                    <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}" />
                </div>
            </div>
            <div class="row mt-2 mrg m-3">
                <div class="col-md-6">
                    <label class="labels">Email</label>
                    <input type="text" name="Email" class="form-control" placeholder="vaxguarde420@gmail.com comme exemple" value="{{ old('Email') }}" />
                </div>
                <div class="col-md-6">
                    <label class="labels">Ville</label>
                    <input type="text" class="form-control" name="Ville" placeholder="Errachidia comme example" value="{{ old('Ville') }}">
                </div>
            </div>

            <div class="d-flex justify-content-between  m-3   ">
                <a href="/infirmier/enfants" class="btn text-danger  pl-4 pr-4 ml-2 ">Cancel</a>
                <button type="submit" class="btn btn-outline-primary pl-4 pr-4 mr-2">SUIVANT</button>
            </div>
        </div>
    </div>
</div>

    </div>


</form>

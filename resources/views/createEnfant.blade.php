<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<style>
    .secondcol {
        margin-top: 30px
    }

    .row3 {
        width: 100%;
    }
</style>


@include('components/navbar')

<x-header>

    <div>ajouter Enfant</div>

</x-header>

 @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="/infirmier/createEnfant/validation" method="POST">
        @csrf

    <div class="row">
        <div class="secondcol col-lg bg-light p-0 d-flex justify-center align-items-center">
             
            <div class="container-lg">
                <div class="col-lg border-right row3 ">
                    <div class="p-2 py-3">
                        <div class="row mt-2 mrg m-5">
                            <div class="col-md-6">
                                <label class="labels">Nom</label>
                                <input type="text" name="nom" class="form-control" placeholder="Nom" />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Prenom</label>
                                <input type="text" name="prenom" class="form-control" placeholder="Prenom" />
                            </div>
                        </div>
                        <div class="row mt-2 mrg m-5">
                            <div class="col-md-6">
                                <label class="labels">CIN du Parent</label>
                                <input type="text"  name="CIN_Parent" class="form-control" placeholder="M29382 comme exemple" />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Date de naissance</label>
                                <input type="date" name="date_naissance" class="form-control" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-center ">
                             <button type="submit "  class="btn btn-outline-primary">Ajouter</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</form>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

@include('components/navbar')
<x-header>
    <div class="d-flex justify-content-between">
        <div>Liste des enfants</div>
        <div class="dropdown">
            <button class="btn btn-light align-middle fs-5 dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Ajouter Enfant
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item  btn btn-light align-middle fs-5" href="/infirmier/createParent">nouveau
                        Parent</a></li>
                <li><a class="dropdown-item btn btn-light align-middle fs-5" href="/infirmier/createEnfant">Parent deja
                        exist</a></li>
            </ul>
        </div>
    </div>
</x-header>
<div class="container-lg">
    <div class="row">
        <div class="col-md-12">
            <div class="row ">

                <table class="table table-striped m-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Date de Naissance</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enfants as $enfant)
                            <tr onclick="window.location='/infirmier/enfants/{{ $enfant->id }}'">
                                <td class="fs-4 align-middle">{{ $enfant->id }}</td>
                                <td class="fs-4 align-middle">{{ $enfant->nom }}</td>
                                <td class="fs-4 align-middle">{{ $enfant->prenom }}</td>
                                <td class="fs-4 align-middle">{{ $enfant->date_naissance }}</td>
                                <td>
                               


                                    <button form="delete" class="btn fs-5 btn-danger">delete</button>


                                </td>
                            </tr>
                            <form id="delete" action="/{{ $enfant->id }}/delete" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach
                    </tbody>
                </table>

                <div>
                    {{ $enfants->links('pagination::bootstrap-5') }}
                </div>



            </div>
        </div>
    </div>
</div>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Liste des enfants</title>
</head>

<body>
    @include('components/navbar')

    <x-header>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-2 mb-md-0">Liste des enfants</div>
            <div class="dropdown">
                <button class="btn btn-light align-middle fs-5 dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Ajouter Enfant
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item btn btn-light align-middle fs-5" href="/infirmier/createParent">Nouveau
                            Parent</a></li>
                    <li><a class="dropdown-item btn btn-light align-middle fs-5" href="/infirmier/createEnfant">Parent
                            déjà existant</a></li>
                </ul>
            </div>
        </div>
    </x-header>



    <div class="container-lg">
        <form id="searchForm" action="{{ url('/infirmier/enfants') }}" method="POST">
            @csrf
            <div class="input-group w-75 mt-4">
                <div class="row">
                    <!-- Element 1 -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ID</span>
                            </div>
                            <input type="search" name="id" class="form-control" placeholder="ID d'enfant"
                                aria-label="ID d'enfant" aria-describedby="basic-addon1">
                            <button type="submit" class="btn btn-outline-success">Trouver</button>
                        </div>
                    </div>

                    <!-- Element 2 -->
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nom</span>
                            </div>
                            <input type="search" name="nom" class="form-control" placeholder="Nom d'enfant"
                                aria-label="Nom d'enfant" aria-describedby="basic-addon1">
                            <button type="submit" class="btn btn-outline-success">Trouver</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-responsive p-0">
                <table class="table table-striped">
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
                            <tr>
                                <td class="fs-5 align-middle">{{ $enfant->id }}</td>
                                <td class="fs-5 align-middle">{{ $enfant->nom }}</td>
                                <td class="fs-5 align-middle">{{ $enfant->prenom }}</td>
                                <td class="fs-5 align-middle">{{ $enfant->date_naissance }}</td>
                                <td class="w-full">
                                    <div class="d-flex flex-column flex-md-row">
                                        <button class="btn fs-5 btn-info mb-2 mb-md-0 me-md-2"
                                            onclick="event.stopPropagation(); window.location='/infirmier/enfants/{{ $enfant->id }}'">Voir</button>
                                        <button type="button" class="btn fs-5 btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal"
                                            onclick="event.stopPropagation(); setDeleteForm('{{ $enfant->id }}')">Supprimer</button>
                                    </div>
                                </td>
                            </tr>
                            <form id="delete-{{ $enfant->id }}" action="/{{ $enfant->id }}/delete" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach
                    </tbody>
                </table>

                <div class="mb-5">
                    {{ $enfants->links('pagination::bootstrap-5') }}
                </div>
            </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet enfant ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setDeleteForm(enfantId) {
            document.getElementById('confirmDeleteButton').setAttribute('data-form-id', 'delete-' + enfantId);
        }

        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            const formId = this.getAttribute('data-form-id');
            document.getElementById(formId).submit();
        });
    </script>



    <script type="text/javascript" src="js/jquery-1.8.0.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>

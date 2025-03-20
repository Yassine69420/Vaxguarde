<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

    @include('components/navbar')
    <x-header>Requests</x-header>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-lg">
        <div class="row m-0">

            <form id="searchForm" class="mb-1" action="{{ url('/infirmier/Gestion') }}" method="GET">
                @csrf

                <div class="input-group w-75 mt-4">
                    <div class="row">
                        <!-- Element 1 -->
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">INP</span>
                                </div>
                                <input type="search" name="INP" class="form-control" placeholder="INP d'Infirmier"
                                    aria-label="INP d'Infirmier" aria-describedby="basic-addon1">
                                <button type="submit" class="btn btn-outline-success">Trouver</button>
                            </div>
                        </div>

                        <!-- Element 2 -->
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Nom</span>
                                </div>
                                <input type="search" name="nom" class="form-control" placeholder="Nom d'Infirmier"
                                    aria-label="Nom d'Infirmier" aria-describedby="basic-addon1">
                                <button type="submit" class="btn btn-outline-success">Trouver</button>
                            </div>
                        </div>
                    </div>
                </div>



            </form>

        </div>
        <div class="table-responsive p-0 ">

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th class="width default"></th>
                        <th scope="col">INP</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Hopitale</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($infirmiers as $infirmier)
                        <tr>
                            <td class="{{ $infirmier->isAdmin ? 'success' : 'danger' }} width"></td>
                            <td class="fs-5 align-middle">{{ $infirmier->INP }}</td>
                            <td class="fs-5 align-middle">{{ $infirmier->nom }}</td>
                            <td class="fs-5 align-middle">{{ $infirmier->prenom }}</td>
                            <td class="fs-5 align-middle">{{ $infirmier->nom_Hopital }}</td>
                            <td>

                                <form id="update-{{ $infirmier->INP }}" action="/{{ $infirmier->INP }}/makeadmin"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                </form>
                                <div class="d-flex flex-column flex-md-row">
                                    <button type="submit" form="update-{{ $infirmier->INP }}"
                                        class="btn  fs-5 mb-2 mb-md-0 me-md-2 {{ $infirmier->isAdmin ? 'btn-info' : 'btn-success' }}">
                                        {{ $infirmier->isAdmin ? 'Prohiber' : 'Autoriser' }}
                                    </button>
                                    <button type="button" class="btn fs-5  btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal"
                                        onclick="setDeleteForm('{{ $infirmier->INP }}')">Supprimer</button>
                                </div>
                                <form id="delete-{{ $infirmier->INP }}" action="/{{ $infirmier->INP }}/supprimer"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="mb-5">
                {{ $infirmiers->links('pagination::bootstrap-5') }}
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
                    Êtes-vous sûr de vouloir supprimer cet Infirmier ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function setDeleteForm(infirmierId) {
            document.getElementById('confirmDeleteButton').setAttribute('data-form-id', 'delete-' + infirmierId);
        }

        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            const formId = this.getAttribute('data-form-id');
            document.getElementById(formId).submit();
        });
    </script>

</body>

</html>

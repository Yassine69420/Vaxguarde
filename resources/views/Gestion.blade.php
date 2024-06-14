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

        <form id="searchForm" action="{{ url('/infirmier/Gestion') }}" method="GET">
            @csrf
            <div class="input-group w-75 mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">INP</span>
                </div>
                <input type="search" name="INP" class="form-control " placeholder="INP d'Infirmier"
                    aria-label="MX293234" aria-describedby="basic-addon1">
                <button type="submit" class="btn btn-outline-success mr-5">Trouver</button>
                <div class="input-group-prepend">
                    <span class="input-group-text">nom</span>
                </div>
                <input type="search" name="nom" class="form-control m" placeholder="nom d'Infirmier"
                    aria-label="MX293234" aria-describedby="basic-addon1">
                <button type="submit" class="btn btn-outline-success">Trouver</button>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="row ">

                    <table class="table table-striped m-3">
                        <thead>
                            <tr>
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
                                    <td class="fs-5 align-middle">{{ $infirmier->INP }}</td>
                                    <td class="fs-5 align-middle">{{ $infirmier->nom }}</td>
                                    <td class="fs-5 align-middle">{{ $infirmier->prenom }}</td>
                                    <td class="fs-5 align-middle">{{ $infirmier->nom_Hopital }}</td>
                                    <td>
                                        <form id="update-{{ $infirmier->INP }}"
                                            action="/{{ $infirmier->INP }}/makeadmin" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn w-9 fs-5 {{ $infirmier->isAdmin ? 'btn-info' : 'btn-success' }}">
                                                {{ $infirmier->isAdmin ? 'Prohiber' : 'Autoriser' }}
                                            </button>
                                        </form>
                                        <form id="delete-{{ $infirmier->INP }}" action="/{{ $infirmier->INP }}/delete"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn fs-5 btn-danger">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div>
                        {{ $infirmiers->links('pagination::bootstrap-5') }}
                    </div>



                </div>
            </div>
        </div>
    </div>

</body>

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
                                <tr onclick="window.location='/infirmier/enfants/{{ $infirmier->id }}'">
                                    <td class="fs-5 align-middle">{{ $infirmier->INP }}</td>
                                    <td class="fs-5 align-middle">{{ $infirmier->nom }}</td>
                                    <td class="fs-5 align-middle">{{ $infirmier->prenom }}</td>
                                    <td class="fs-5 align-middle">{{ $infirmier->date_naissance }}</td>
                                    <td>




                                        <button form="update" class="btn fs-5 btn-success">Autoriser</button>
                                        <button form="delete" class="btn fs-5 btn-danger">Supprimer</button>

                                    </td>
                                </tr>
                                <form id="update" action="/{{ $infirmier->INP }}/makeadmin" method="POST">
                                    @csrf
                                    @method('PATCH')
                                </form>
                                <form id="delete" action="/{{ $infirmier->INP }}/delete" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
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

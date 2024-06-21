<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets\css\pfp.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1" />
@include('components.navbar')
<x-header>
    <div class="d-flex justify-content-between">
        <div>Profile</div>
        <a class="btn btn-outline-light align-middle fs-5 " href="/infirmier/{{ $infirmier->INP }}/edit" type="button">
            Edit
        </a>
    </div>
</x-header>
@if ($infirmier->pfp)
    <div class="mt-1 background-container">
        <img src="{{ asset($infirmier->pfp) }}" alt="Profile Picture" class="pfpimage">
    </div>
@else
    <div class=" mt-1  background-container">
        <img src="{{ asset('assets\images\pfp.png') }}" alt="Centered Image" class="center-image">
    </div>
@endif

<div class="card mt-3 p-5">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <table class="table info-table">
                    <tbody>
                        <tr>
                            <td><strong>CIN</strong></td>
                            <td> <span class="me-2">:</span> {{ $infirmier->CIN }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nom</strong> </td>
                            <td> <span class="me-2">:</span> {{ $infirmier->nom }}
                                {{ $infirmier->prenom }}</td>
                        </tr>
                        <tr>
                            <td><strong>Date de naissance</strong></td>
                            <td> <span class="me-2">:</span>
                                {{ $infirmier->date_naissance }}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- End of .col -->
            <div class="col">
                <table class="table info-table">
                    <tbody>
                        <tr>
                            <td><strong>INP</strong></td>
                            <td> <span class="me-2">:</span> {{ $infirmier->INP }}</td>
                        </tr>
                        <tr>
                            <td><strong>nom d'Hopital</strong></td>
                            <td> <span class="me-2">:</span> {{ $infirmier->nom_Hopital }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ville</strong></td>
                            <td> <span class="me-2">:</span>{{ $infirmier->Ville }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

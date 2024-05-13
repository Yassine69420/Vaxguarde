<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets\css\pfp.css') }}">

@include('components.navbar')
<x-header>Profile</x-header>
<div class="profile-page pt-4 ">
    <div class="content mt-5 ">
        <div class="content__cover">
            <div class="content__avatar "></div>

        </div>
        <x-header></x-header>
        <div class="card mt-5 p-5">
            <div class="container">

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
                                    <td> <span class="me-2">:</span> {{$infirmier -> nom_Hopital}}</td>
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
             <div class="content__button m-0">
            <a class="btn  btn-primary" href="/infirmier/{{ $infirmier->INP }}/edit">
            Edit
            </a>
        </div>
        </div>


       
    </div>

</div>

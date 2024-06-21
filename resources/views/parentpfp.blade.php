<!DOCTYPE html>
<html lang="en" style="width: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parent and Kids Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets\css\pfp.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\navbar.css') }}">

</head>

<body>
    <div class="container-lg">
        <div style="flex-direction: row;"
            class="container bord card body-card p-3 my-4 d-flex justify-content-between align-items-center rounded">
            <img class="logo" height="60" src="{{ asset('assets\images\logot.png') }}" alt=""
                srcset="">
            <a class="nav-link " href="/">
                <button class="btn btn-danger ">Quitter</button>
            </a>
        </div>
        <!-- Profile and Parent Info Section -->

        <div class="mt-1 Parent-background-container">
            <label for="file-input" class="position-relative">
                @if ($parent->pfp)
                    {{-- Assuming $parent is the variable containing parent's data --}}
                    <img src="{{ asset($parent->pfp) }}" id="profile-picture" alt="Profile Picture"
                        class="center-image">
                @else
                    <img src="{{ asset('assets/images/family.png') }}" id="profile-picture" alt="Centered Image"
                        class="center-image">
                @endif

            </label>

        </div>

        <div class="card-body  mt-4 ">
            <div class="card-body bord">
                <div class="row">
                    <div class="col-6 col-md-4">
                        <small>NOM</small> <br>
                        <strong>{{ $parent->nom }} {{ $parent->prenom }}</strong> <br>
                    </div>
                    <div class="col-6 col-md-4">
                        <small>Ville:</small> <br>
                        <strong>{{ $parent->Ville }} - Maroc</strong> <br>
                    </div>
                    <div class="col-6 col-md-4">
                        <small>CIN:</small> <br>
                        <strong>{{ $parent->CIN }}</strong> <br>
                    </div>
                    <div class="col-6 col-md-4">
                        <small>EMAIL:</small> <br>
                        <strong class="small-email">{{ $parent->Email }}</strong> <br>
                    </div>
                    <div class="col-6 col-md-4">
                        <small>Telephone:</small> <br>
                        <strong>{{ $parent->telephone }}</strong> <br>
                    </div>
                    <div class="col-6 col-md-4">
                        <small>ADRESSE:</small> <br>
                        <strong>{{ $parent->adress }}</strong> <br>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-center m-5">
            <a href="/Parent/{{ $parent->CIN }}/edit" class="btn btn-outline-primary">Edit</a>
        </div>


        <!-- Table of Kids' Information -->
        <div class="kids-info mt-5">

            <table class="table  ">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="4" class="text-center fs-3">Enfants</th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enfants as $enfant)
                        <?php
                        $datenaissance = new DateTime($enfant->date_naissance);
                        $Datetoday = new DateTime();
                        
                        $ageInterval = $datenaissance->diff($Datetoday);
                        
                        if ($ageInterval->y < 2) {
                            $age = $ageInterval->m + $ageInterval->y * 12; // Convert years to months and add
                            $ageLabel = 'mois';
                        } else {
                            $age = $ageInterval->y * 12 + $ageInterval->m; // Convert age to total months
                            $ageLabel = 'mois'; // Keep it as months for consistency
                        }
                        ?>
                        <tr onclick="window.location='/Parent/{{ $parent->CIN }}/{{ $enfant->id }}'"
                            style="cursor: pointer;">
                            <td><strong>{{ $enfant->id }}</strong></td>
                            <td>{{ $enfant->nom }} {{ $enfant->prenom }}</td>
                            <td>{{ $age }} {{ $ageLabel }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

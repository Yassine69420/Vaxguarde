<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('assets\css\parent.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet" />
</head>

<body  >
    <div class="profile-page " >
        <div class="content mt-5 mb-4 h-75 ">
            <div class="content__cover">
                <div class="content__avatar"></div>
                <div class="content__bull">
                    <span></span><span></span><span></span><span></span><span></span>
                </div>

            </div>
            <div class="content__actions mb-5">

            </div>
            <div class="content__title">
                <h1>{{ $parent->nom }} {{ $parent->prenom }} </h1>
                <span>{{ $parent->Ville }} - Maroc </span>
            </div>
            <div class="content__description">
                <table class="table text-start m-0">
                    <tbody>
                        <tr>
                            <th scope="row">CIN &nbsp;:</th>
                            <td>{{ $parent->CIN }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email :</th>
                            <td>{{ $parent->Email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Adresse :</th>
                            <td>{{ $parent->adress }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="content__button m-4">
                <a href="" class="btn btn-primary">Edit</a>
            </div>

        </div>
        <div class="bg">
            <div>

                <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
            </div>

        </div>

    </div>
    <div class="container" >
        <table class="table  mb-5 table-hover table-striped ">
            <thead  class="table-success" >
                <tr >
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">age</th>

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
                        $ageLabel = 'moi' . ($age != 1 ? 's' : '');
                    } else {
                        $age = $ageInterval->y * 12 + $ageInterval->m; // Convert age to total months
                        $ageLabel = 'moi' . ($age != 1 ? 's' : ''); // Keep it as months for consistency
                    }
                    ?>
                    <tr scope="row" style="cursor: pointer"  onclick="window.location='/Parent/{{ $parent->CIN }}/{{ $enfant->id }}'">
                        <td ><strong> {{ $enfant->id }}</strong></td>
                        <td>{{ $enfant->nom }} {{ $enfant->prenom }}</td>
                        <td>{{ $age }} {{ $ageLabel }} </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>

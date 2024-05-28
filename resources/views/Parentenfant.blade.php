<html style="width:100%">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="{{ asset('assets\css\navbar.css') }}">

</head>

<body>

    <div class="container">

        <div style=" flex-direction: row;"
            class="container bord card body-card p-3 my-4 d-flex justify-content-between align-items-center rounded">
            <img class="logo" height="60" src="{{ asset('assets\images\logot.png') }}"
                alt="" srcset="">
            <a class="nav-link" onclick="history.back()">
                <button class="btn  btn-success">Retour</button>
            </a>
        </div>



        <div class="card-body bord ">
            <div class="row ">
                <div class="col-6 col-md-3">
                    <small>ID</small> <br>
                    <strong>{{ $enfant->id }}</strong> <br>
                </div>
                <!-- End of .col -->
                <div class="col-6 col-md-3">
                    <small>NOM</small> <br>
                    <strong>{{ $enfant->nom }} {{ $enfant->prenom }}</strong> <br>
                </div>
                <!-- End of .col -->
                <div class="col-6 col-md-3">
                    <small>Age</small> <br>
                    <?php
                    $datenaissance = new DateTime($enfant->date_naissance);
                    $Datetoday = new DateTime();
                    
                    $ageInterval = $datenaissance->diff($Datetoday);
                    
                    if ($ageInterval->y < 2) {
                        $age = $ageInterval->m + $ageInterval->y * 12; // Convert years to months and add
                        $ageLabel = 'month' . ($age != 1 ? 's' : '');
                    } else {
                        $age = $ageInterval->y * 12 + $ageInterval->m; // Convert age to total months
                        $ageLabel = 'month' . ($age != 1 ? 's' : ''); // Keep it as months for consistency
                    }
                    ?>
                    <strong>{{ $age }} {{ $ageLabel }} old</strong> <br>
                </div>

                <!-- End of .col -->
                <div class="col-6 col-md-3">
                    <small>DATE DE NAISSANCE</small> <br>
                    <strong>{{ $enfant->date_naissance }}</strong> <br>
                </div>
                <!-- End of .col -->
            </div>
            <!-- End of .row -->
        </div>

  



    <div class="container mt-4">
        @php
            $vaccinationStatuses = [
                'HepB_status' => ['status' => $enfant->HepB_status, 'age' => 0, 'name' => 'Hepatitis B'],
                'Rotavirus_1_status' => [
                    'status' => $enfant->Rotavirus_1_status,
                    'age' => 2,
                    'name' => 'Rotavirus (1ere dose)',
                ],
                'DTaP_1_status' => ['status' => $enfant->DTaP_1_status, 'age' => 2, 'name' => 'DTaP (1ere dose)'],
                'Hib_1_status' => ['status' => $enfant->Hib_1_status, 'age' => 2, 'name' => 'Hib (1ere dose)'],
                'IPV_1_status' => ['status' => $enfant->IPV_1_status, 'age' => 2, 'name' => 'Polio (1ere dose)'],
                'PCV1_1_status' => [
                    'status' => $enfant->PCV1_1_status,
                    'age' => 2,
                    'name' => 'Pneumococcal (1ere dose)',
                ],
                'Rotavirus_2_status' => [
                    'status' => $enfant->Rotavirus_2_status,
                    'age' => 4,
                    'name' => 'Rotavirus (2eme dose)',
                ],
                'DTaP_2_status' => ['status' => $enfant->DTaP_2_status, 'age' => 4, 'name' => 'DTaP (2eme dose)'],
                'Hib_2_status' => ['status' => $enfant->Hib_2_status, 'age' => 4, 'name' => 'Hib (2eme dose)'],
                'IPV_2_status' => ['status' => $enfant->IPV_2_status, 'age' => 4, 'name' => 'Polio (2eme dose)'],
                'PCV1_2_status' => [
                    'status' => $enfant->PCV1_2_status,
                    'age' => 4,
                    'name' => 'Pneumococcal (2eme dose)',
                ],
                'Rotavirus_3_status' => [
                    'status' => $enfant->Rotavirus_3_status,
                    'age' => 6,
                    'name' => 'Rotavirus (3eme dose)',
                ],
                'DTaP_3_status' => ['status' => $enfant->DTaP_3_status, 'age' => 6, 'name' => 'DTaP (3eme dose)'],
                'Hib_3_status' => ['status' => $enfant->Hib_3_status, 'age' => 6, 'name' => 'Hib (3eme dose)'],
                'IPV_3_status' => ['status' => $enfant->IPV_3_status, 'age' => 6, 'name' => 'Polio (3eme dose)'],
                'PCV1_3_status' => [
                    'status' => $enfant->PCV1_3_status,
                    'age' => 6,
                    'name' => 'Pneumococcal (3eme dose)',
                ],
                'MMR_status' => ['status' => $enfant->MMR_status, 'age' => 9, 'name' => 'Measles, Mumps, & Rubella'],
                'Varicella_status' => [
                    'status' => $enfant->Varicella_status,
                    'age' => 12,
                    'name' => 'Varicella (Chickenpox)',
                ],
            ];
        @endphp

        <table class="table mt-4 ">

            <tr>
                <th>Vaccin </th>
                <th>Age nécessaire (mois)</th>
                <th>Status</th>
            </tr>

            @foreach ($vaccinationStatuses as $vaccine => $details)
                <tr >
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['age'] }} mois</td>
                    <td
                        class="{{ $details['status'] ? 'text-success' : ($age < $details['age'] ? 'text-secondary' : 'text-danger') }}">
                        {{ $details['status'] ? 'déjà Vacciné' : ($age < $details['age'] ? 'en attendant' : 'Obligatoir')}}
                    </td>
                </tr>
            @endforeach

        </table>


    </div>





</body>

</html>

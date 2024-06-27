<!DOCTYPE html>
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
        <div style="flex-direction: row;"
            class="container bord card body-card p-3 my-4 d-flex justify-content-between align-items-center rounded">
            <img class="logo" height="60" src="{{ asset('assets\images\logot.png') }}" alt=""
                srcset="">
            <a class="nav-link" onclick="history.back()">
                <button class="btn btn-success">Retour</button>
            </a>
        </div>
        <div class="card-body bord">
            <div class="row">
                <div class="col-6 col-md-3">
                    <small>ID</small> <br>
                    <strong>{{ $enfant->id }}</strong> <br>
                </div>
                <div class="col-6 col-md-3">
                    <small>NOM</small> <br>
                    <strong>{{ $enfant->nom }} {{ $enfant->prenom }}</strong> <br>
                </div>
                <div class="col-6 col-md-3">
                    <small>Age</small> <br>
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
                    <strong>{{ $age }} {{ $ageLabel }} old</strong> <br>
                </div>
                <div class="col-6 col-md-3">
                    <small>Date DE NAISSANCE</small> <br>
                    <strong>{{ $enfant->date_naissance }}</strong> <br>
                </div>
            </div>
        </div>
        <div class="container mt-4 table-responsive">
            @php
                $vaccinationStatuses = [
                    'HepB_status' => [
                        'status' => $enfant->HepB_status,
                        'age' => 0,
                        'name' => 'Hepatitis B',
                        'Date' => isset($vaccinations[0]) ? $vaccinations[0]->Date : null,
                    ],
                    'Rotavirus_1_status' => [
                        'status' => $enfant->Rotavirus_1_status,
                        'age' => 2,
                        'name' => 'Rotavirus (1ere dose)',
                        'Date' => isset($vaccinations[1]) ? $vaccinations[1]->Date : null,
                    ],
                    'DTaP_1_status' => [
                        'status' => $enfant->DTaP_1_status,
                        'age' => 2,
                        'name' => 'DTaP (1ere dose)',
                        'Date' => isset($vaccinations[2]) ? $vaccinations[2]->Date : null,
                    ],
                    'Hib_1_status' => [
                        'status' => $enfant->Hib_1_status,
                        'age' => 2,
                        'name' => 'Hib (1ere dose)',
                        'Date' => isset($vaccinations[3]) ? $vaccinations[3]->Date : null,
                    ],
                    'IPV_1_status' => [
                        'status' => $enfant->IPV_1_status,
                        'age' => 2,
                        'name' => 'Polio (1ere dose)',
                        'Date' => isset($vaccinations[4]) ? $vaccinations[4]->Date : null,
                    ],
                    'PCV1_1_status' => [
                        'status' => $enfant->PCV1_1_status,
                        'age' => 2,
                        'name' => 'Pneumococcal (1ere dose)',
                        'Date' => isset($vaccinations[5]) ? $vaccinations[5]->Date : null,
                    ],
                    'Rotavirus_2_status' => [
                        'status' => $enfant->Rotavirus_2_status,
                        'age' => 4,
                        'name' => 'Rotavirus (2eme dose)',
                        'Date' => isset($vaccinations[6]) ? $vaccinations[6]->Date : null,
                    ],
                    'DTaP_2_status' => [
                        'status' => $enfant->DTaP_2_status,
                        'age' => 4,
                        'name' => 'DTaP (2eme dose)',
                        'Date' => isset($vaccinations[7]) ? $vaccinations[7]->Date : null,
                    ],
                    'Hib_2_status' => [
                        'status' => $enfant->Hib_2_status,
                        'age' => 4,
                        'name' => 'Hib (2eme dose)',
                        'Date' => isset($vaccinations[8]) ? $vaccinations[8]->Date : null,
                    ],
                    'IPV_2_status' => [
                        'status' => $enfant->IPV_2_status,
                        'age' => 4,
                        'name' => 'Polio (2eme dose)',
                        'Date' => isset($vaccinations[9]) ? $vaccinations[9]->Date : null,
                    ],
                    'PCV1_2_status' => [
                        'status' => $enfant->PCV1_2_status,
                        'age' => 4,
                        'name' => 'Pneumococcal (2eme dose)',
                        'Date' => isset($vaccinations[10]) ? $vaccinations[10]->Date : null,
                    ],
                    'Rotavirus_3_status' => [
                        'status' => $enfant->Rotavirus_3_status,
                        'age' => 6,
                        'name' => 'Rotavirus (3eme dose)',
                        'Date' => isset($vaccinations[11]) ? $vaccinations[11]->Date : null,
                    ],
                    'DTaP_3_status' => [
                        'status' => $enfant->DTaP_3_status,
                        'age' => 6,
                        'name' => 'DTaP (3eme dose)',
                        'Date' => isset($vaccinations[12]) ? $vaccinations[12]->Date : null,
                    ],
                    'Hib_3_status' => [
                        'status' => $enfant->Hib_3_status,
                        'age' => 6,
                        'name' => 'Hib (3eme dose)',
                        'Date' => isset($vaccinations[13]) ? $vaccinations[13]->Date : null,
                    ],
                    'IPV_3_status' => [
                        'status' => $enfant->IPV_3_status,
                        'age' => 6,
                        'name' => 'Polio (3eme dose)',
                        'Date' => isset($vaccinations[14]) ? $vaccinations[14]->Date : null,
                    ],
                    'PCV1_3_status' => [
                        'status' => $enfant->PCV1_3_status,
                        'age' => 6,
                        'name' => 'Pneumococcal (3eme dose)',
                        'Date' => isset($vaccinations[15]) ? $vaccinations[15]->Date : null,
                    ],
                    'MMR_status' => [
                        'status' => $enfant->MMR_status,
                        'age' => 9,
                        'name' => 'Measles, Mumps, & Rubella',
                        'Date' => isset($vaccinations[16]) ? $vaccinations[16]->Date : null,
                    ],
                    'Varicella_status' => [
                        'status' => $enfant->Varicella_status,
                        'age' => 12,
                        'name' => 'Varicella (Chickenpox)',
                        'Date' => isset($vaccinations[17]) ? $vaccinations[17]->Date : null,
                    ],
                ];

                function calculateVaccinationDate($birthDate, $requiredAge)
                {
                    $vaccinationDate = (new DateTime($birthDate))->modify("+{$requiredAge} months");
                    return $vaccinationDate->format('d/m/Y'); // Format to display day, month, and year
                }
            @endphp

            <table class="table mt-4">
                <tr>
                    <th scope="col">Vaccin</th>
                    <th scope="col">Age nécessaire (mois)</th>
                    <th scope="col">Status</th>
                </tr>
                @foreach ($vaccinationStatuses as $vaccine => $details)
                    @php
                        $vaccinationDate = calculateVaccinationDate($enfant->date_naissance, $details['age']);
                    @endphp
                    <tr>
                        <td class="col-4">{{ $details['name'] }}</td>
                        <td class="col-4">
                            {{ $details['age'] }} mois

                        </td >
                        <td 
                            class=" col-4 {{ $details['status'] ? 'text-success' : ($age < $details['age'] ? 'text-secondary' : 'text-danger') }}">
                            @if ($details['status'])
                                Déjà Vacciné le
                                {{ $details['Date'] ? date('d/m/Y', strtotime($details['Date'])) : '' }}
                            @else
                                {{ $age < $details['age'] ? 'doit être pris le ' . $vaccinationDate . ')' : 'Obligatoire' }}
                            @endif
                        </td>

                    </tr>
                @endforeach
            </table>
        </div>

    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vacciner un enfant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
</head>

<body>
    @include('components/navbar')

    <x-header>
        Vacciner un enfant
    </x-header>
    <div class="container-lg bord">
        <div class="card-body">
            <div class="row">
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
                        $ageLabel = 'mois';
                    } else {
                        $age = $ageInterval->y;
                        $ageLabel = 'an' . ($age != 1 ? 's' : ''); // Year(s) for consistency
                    }
                    ?>
                    <strong>{{ $age }} {{ $ageLabel }} </strong> <br>
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
    </div>

    <div class="container-lg mt-5 d-flex justify-content-center align-items-center">
        <form action="{{ route('submitVaccination') }}" method="POST" class="w-75 h-100" id="vaccinationForm">
            @csrf
            @method('PATCH')
            <div class="row mt-2 mrg">
                <div class="col-md-6">
                    <label class="labels">Date</label>
                    <input type="date" value="{{ $today }}" class="form-control" id="date" name="date">
                </div>
                <input type="text" class="d-none" value="{{ $enfant->id }}" name="id">
                <div class="col-md-6">
                    <label class="labels">Vaccin</label>
                    <input type="text" class="form-control" id="vaccine" name="vaccine"
                        value="{{ old('vaccine', $vaccine ?? '') }}">
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-primary mt-5" id="submitBtn">Confirmer</button>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir ajouter cette vaccination?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('submitBtn').addEventListener('click', function () {
                var myModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                myModal.show();
            });

            document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
                document.getElementById('vaccinationForm').submit();
            });
        });
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

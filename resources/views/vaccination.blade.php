<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<style>

</style>
@include('components/navbar')

<x-header>
    Vacciner un enfant
</x-header>
<div class="container-lg bord">
    <div class="card-body ">
        <div class="row  ">
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

</div>
</div>

<div class="container-lg mt-5   d-flex justify-content-center align-items-center">
    <form action="{{ route('submitVaccination') }}" method="POST" class="w-75 h-100">
        @csrf
        @method('PATCH')
        <div class="row mt-2 mrg">
        
         <div class="col-md-6">
            <label class="labels">Date</label>
            <input type="date" value="{{ $today }}" class="form-control" id="date" name="date">
        </div>
        <input type="text" class="d-none "  value="{{ $enfant->id }}" name="id">
   
        <div class="col-md-6">
            <label class="labels">Vaccin</label>
           <input type="text" class="form-control" id="vaccine" name="vaccine"
                value="{{ old('vaccine', $vaccine ?? '') }}">
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-primary mt-5">Confirmer</button>
    </div>
    </form>




   
</div>
{{-- 
 <script>
        // Get today's date
        let today = new Date();
        let day = ("0" + today.getDate()).slice(-2);
        let month = ("0" + (today.getMonth() + 1)).slice(-2);
        let year = today.getFullYear();
        
        // Format the date as yyyy-mm-dd
        let formattedDate = `${year}-${month}-${day}`;

        // Set the value of the input field to today's date
        document.getElementById('date').value = formattedDate;
    </script> --}}
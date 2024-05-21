<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

@include('components/navbar')

<x-header>
    Vacciner un enfant
</x-header>


<div class="container-lg mt-5   d-flex justify-content-center align-items-center">
    <form action="{{ route('submitVaccination') }}" method="POST" class="w-75 h-100">
        @csrf
        @method('PATCH')
        <div class="row mt-2 mrg">
        <div class="col-md-6">
            <label class="labels">ID d'Enfant</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $id ?? '') }}">
        </div>
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

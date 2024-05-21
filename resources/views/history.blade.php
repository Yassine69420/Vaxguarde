
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

@include('components/navbar')

<x-header>
    Historique
</x-header>

    <div class="container-lg">
    
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>INP Infirmier</th>
                    <th>ID Enfant</th>
                    <th>Type Vaccination</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vaccinations as $vaccination)
                    <tr>
                        <td>{{ $vaccination->Date }}</td>
                        <td>{{ $vaccination->INP_infirmier }}</td>
                        <td>{{ $vaccination->ID_enfant }}</td>
                        <td>{{ $vaccination->type_vaccination }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


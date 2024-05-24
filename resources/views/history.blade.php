
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
 <meta name="viewport" content="width=device-width, initial-scale=1" />

@include('components/navbar')

<x-header>
    Historique
</x-header>

    <div class="container-lg">
    
        <table class="table mt-4 table-bordered ">
            <thead style="background-color: #5DA9A2 ; color:white">
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
                        <td class="fs-5 align-middle" >{{ $vaccination->Date }}</td>
                        <td class="fs-5 align-middle" >{{ $vaccination->INP_infirmier }}</td>
                        <td class="fs-5 align-middle" >{{ $vaccination->ID_enfant }}</td>
                        <td class="fs-5 align-middle" >{{ $vaccination->type_vaccination }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


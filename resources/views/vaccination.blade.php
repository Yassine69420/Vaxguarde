<head>
    @include('components/navbar')


    <x-header>

        <div>Vacciner un enfant</div>

    </x-header>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Vaccination Form</h2>
        <form action="{{ route('submitVaccination') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="id"> ID d'Enfant</label>
                <input type="text" class="form-control" id="id" name="id"
                    value="{{ old('id', $id ?? '') }}">
            </div>
            <div class="form-group">
                <label for="vaccine">Vaccin</label>
                <input type="text" class="form-control" id="vaccine" name="vaccine"
                    value="{{ old('vaccine', $vaccine ?? '') }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

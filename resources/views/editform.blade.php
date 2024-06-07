<!DOCTYPE html>
<html lang="en" style="width: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parent Information Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="{{ asset('assets\css\pfp.css') }}">
</head>

<body>
    <div class="container pb-5">
        <!-- Profile and Parent Info Section -->
        <div class="profile-container">
            <div class="bg-image">
                <img src="https://wallpapers-clan.com/wp-content/uploads/2022/07/anime-default-pfp-2.jpg"
                    alt="Profile Picture" class="profile-img">
            </div>
            <div class="parent-info mt-4 ">
                <h1>{{ $parent->nom }} {{ $parent->prenom }}</h1 <strong>{{ $parent->Ville }} - Maroc </strong>

            </div>
        </div>

        <!-- Form to Edit Information -->
        <div class="form-container ">
            <h2 class="text-center mb-4 mt-4:   p-1">Modifier le infos</h2>
            <form class="row g-3" action="/edit/{{ $parent->CIN }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control" id="inputEmail4" value="{{ $parent->Email }}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">telephone</label>
                    <input type="text" name="telephone" class="form-control" id="inputPassword4" value="{{ $parent->telephone }}">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" name="adress" class="form-control" id="inputAddress" value="{{ $parent->adress }}">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress2" class="form-label">Ville</label>
                    <input type="text" name="Ville" class="form-control" id="inputAddress2" value="{{ $parent->Ville }}">
                </div>


                <div class="col-12 d-flex justify-content-between">
                    <button onclick="history.back()" class="btn btn-outline-danger">Abondonner</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

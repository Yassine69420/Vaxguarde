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
        <div style="flex-direction: row;"
            class="container bord card body-card p-3 my-4 d-flex justify-content-between align-items-center rounded">
            <img class="logo" height="60" src="{{ asset('assets\images\logot.png') }}" alt=""
                srcset="">
            <a class="nav-link" href="/Parent/{{$parent->CIN}}">
                <button class="btn btn-success">Retour</button>
            </a>
        </div>
        <!-- Profile and Parent Info Section -->
        <div class="profile-container">



            <div class="mt-1 background-container">
                <label for="file-input" class="position-relative">
                    @if ($parent->pfp)
                        <img src="{{ asset($parent->pfp) }}" id="profile-picture" alt="Profile Picture"
                            class="center-image pfpimage ">
                    @else
                        <img src="{{ asset('assets/images/family.png') }}" id="profile-picture" alt="Centered Image"
                            class="center-image pfpimage ">
                    @endif
                    <span class="change-text">Changer</span>
                </label>
                <input type="file" id="file-input" form="edit" name="pfp" style="display: none;"
                    onchange="previewImage(event)">
            </div>



            <div class="parent-info p-0 ">
                <h1>{{ $parent->nom }} {{ $parent->prenom }}</h1 <strong>{{ $parent->Ville }} - Maroc </strong>

            </div>
        </div>

        <!-- Form to Edit Information -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-container mt-5 mb-5">

            <form id="edit" enctype="multipart/form-data" class="row g-3" action="/edit/{{ $parent->CIN }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control" id="inputEmail4"
                        value="{{ $parent->Email }}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">telephone</label>
                    <input type="text" name="telephone" class="form-control" id="inputPassword4"
                        value="{{ $parent->telephone }}">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" name="adress" class="form-control" id="inputAddress"
                        value="{{ $parent->adress }}">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress2" class="form-label">Ville</label>
                    <input type="text" name="Ville" class="form-control" id="inputAddress2"
                        value="{{ $parent->Ville }}">
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
    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('profile-picture').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>

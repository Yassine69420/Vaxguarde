<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="cont">


        <div class="header">
            <h1>S'enregistrer Comme infirmier</h1>
        </div>

        <section class="container">


            <form action="/register" id="register" method="POST" class="form mt-0">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="column">
        <div class="input-box">
            <label>Nom :</label>
            <input type="text" name="nom" placeholder="Entrer Votre Nom" value="{{ old('nom') }}" />
        </div>
        <div class="input-box">
            <label>Prénom :</label>
            <input type="text" name="prenom" placeholder="Entrer votre Prénom" value="{{ old('prenom') }}" />
        </div>
    </div>
    <div class="column">
        <div class="input-box">
            <label>CIN :</label>
            <input type="text" name="CIN" placeholder="Entrer Votre CIN" value="{{ old('CIN') }}" />
        </div>
        <div class="input-box">
            <label>INP :</label>
            <input type="text" name="INP" placeholder="Entrer Votre INP" value="{{ old('INP') }}" />
        </div>
    </div>
    <div class="column">
        <div class="input-box">
            <label>Ville :</label>
            <input type="text" name="Ville" placeholder="Entrer Votre Ville" value="{{ old('Ville') }}" />
        </div>
        <div class="input-box">
            <label>Date De Naissance</label>
            <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" />
        </div>
    </div>
    <div class="input-box">
        <label>Email :</label>
        <input type="email" name="email" placeholder="Entrer votre email " value="{{ old('email') }}" />
    </div>
    <div class="input-box">
        <label>Nom d'Hopital</label>
        <input type="text" name="nom_Hopital" placeholder="Entrer le nom d'hopital" value="{{ old('nom_Hopital') }}" />
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">S'enregistrer</button>
</form>

    </section>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Comfirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Une fois que vous cliquez sur Valider, vous devez attendre jusqu'à ce que vous soyez autorisé. Nous
                    vous enverrons un email lorsque l'action sera terminée.
                </div>
                <div class="modal-footer">
                    <a href="/" type="button" class="btn btn-secondary" data-dismiss="modal">Abondonner</a>
                    <button type="submit" form="register" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>




<!-- Button trigger modal -->

<!-- Modal -->

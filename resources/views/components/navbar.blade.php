<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-lg">
            <img src="{{ asset('assets/images/logot.png') }}" alt="" class="logo">
            <a class="navbar-brand align-middle" style="cursor: pointer">Vaxguarde</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item align-middle">
                        <a class="nav-link m-2 {{ request()->is('infirmier') ? 'active' : '' }}"
                            href="/infirmier">Profile<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item align-middle">
                        <a class="nav-link m-2 {{ request()->is('infirmier/enfants') ? 'active' : '' }}"
                            href="/infirmier/enfants">Liste d'enfants</a>
                    </li>
                    <li class="nav-item align-middle">
                        <a class="nav-link m-2 {{ request()->is('infirmier/Historique') ? 'active' : '' }}"
                            href="/infirmier/Historique">Historique</a>
                    </li>
                    @if (request()->session()->get('INP') == '111111')
                        <li class="nav-item align-middle">
                            <a class="nav-link m-2 {{ request()->is('infirmier/Gestion') ? 'active' : '' }}"
                                href="/infirmier/Gestion">Gestion des infirmiers</a>
                        </li>
                    @endif
                    <li class="nav-item align-middle">
                        <a class="nav-link m-2" href="#" data-toggle="modal" data-target="#downloadModal">Manuel
                            d'Utulisation</a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Deconnecter</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="downloadModalLabel">Telecharger PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Vous voulez vraiment télécharger le document PDF du manuel d'utilisation ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <a href="{{ route('download.pdf') }}" class="btn btn-primary">Oui</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" href="{{ asset('assets\css\navbar.css') }}">

<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container-lg">
        <img src="{{ asset('assets/images/logot.png') }}" alt="" class="logo" >
        <a class="navbar-brand align-middle" href="/">Vaxguarde</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item align-middle ">
                    <a class="nav-link m-2 {{request()->is("/")? }} " href="/infirmier">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item align-middle">
                    <a class="nav-link m-2 " href="/infirmier/enfants">liste d'enfants</a>
                </li>
                <li class="nav-item align-middle">
                    <a class="nav-link m-2 " href="/infirmier/manuelDutulisation">Manuel d'utulisation</a>
                </li>
            </ul>
        </div>
    </div>
    </div>
</nav>






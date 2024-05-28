<link rel="stylesheet" href="{{ asset('assets\css\login.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<div class="form-container">

    <img src="{{ asset('assets/images/MS-Maroc.png') }}" alt="MS-MAroc" />
    <p class="title">Parent login</p>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form" id="loginForm" method="POST" action="{{ route('Parentlogin') }}">
        @csrf
        <div class="input-group">
            <label for="CIN" id="cinLabel">CIN </label>
            <input type="text" name="CIN" id="CIN" placeholder="Entez votre CIN">
        </div>
        <div class="input-group">
            <label for="date" id="dateLabel">Date de naissance</label>
            <input type="date" name="date" id="date" placeholder="Entez votre date de naissance">
        </div>
        <button type="submit" class="sign">Valider</button>
    </form>

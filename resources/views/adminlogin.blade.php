<link rel="stylesheet" href="{{ asset('assets\css\login.css') }}">

<div class="form-container">
  
   <img src="{{ asset('assets/images/MS-Maroc.png') }}" alt="MS-MAroc" />
    <p class="title">Se Connecter</p> 
      @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif 
    <form class="form" id="loginForm" method="POST" action="{{ route('adminlogin') }}">
    @csrf
    <div class="input-group">
        <label for="INP" id="cinLabel">INP</label>
        <input type="text" name="INP" id="INP" placeholder="Entez votre INP">
    </div>
    <div class="input-group">
        <label for="date" id="dateLabel">Date de naissance</label>
        <input type="date" name="date" id="date" placeholder="Entez votre date de naissance">
    </div>
    <button type="submit" class="sign">Valider</button>
</form>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="preload" href="{{ asset('assets/images/childbg.jpg') }}" as="image">
  </head>
  <body>
    <section>
      <div class="imagebx">
        <img src="{{ asset('assets/images/childbg.jpg') }}" alt="Background Image" loading="lazy" />
      </div>
      <div class="contentbx">
        <div class="formbx">
          <div class="logo-cnt">
            <img class="logo" src="{{ asset('assets/images/MS-Maroc.png') }}" />
          </div>
          <div class="title">
            <h2>Se Connecter</h2>
          </div>
          @if ($errors->any())
            <div class="error">
              <ul>
                @foreach ($errors->all() as $error)
                  <p>{{ $error }}</p>
                @endforeach
              </ul>
            </div>
          @endif
          <form method="POST" action="{{ route('Parentlogin') }}">
            @csrf
            <div class="inputbx">
              <span>CIN :</span>
              <input type="text" name="CIN" value="{{ old('CIN') }}" placeholder="CIN" />
            </div>
            <div class="inputbx mg">
              <span>Date De Naissance :</span>
              <input type="date" value="{{ old('date') }}" name="date" />
            </div>
            <div class="inputbx">
              <input type="submit" class="btn" value="Se Connecter" />
            </div>
          </form>
        </div>
      </div>
    </section>
  </body>
</html>

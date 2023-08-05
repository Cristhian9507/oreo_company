@extends('layouts.app')

@section('content')

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
          @if(isset($error))
            <div class="alert alert-danger">
              {{ $error }}
            </div>
          @endif
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
              <label for="email">Correo electrónico</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @if ($errors->has('email'))
              <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="form-group">
              <label for="password">Contraseña</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top:20px;">
              {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
            </a>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

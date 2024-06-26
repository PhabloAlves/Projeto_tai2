<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Marca Aí</title>

  <link rel="stylesheet" href="{{ url ('Assets/Styles/loginstyle.css')}}">
  <link rel="icon" type="image/x-icon" href=" {{ url ('Assets/Images/logoalone.png')}}">

</head>
<body>
  <div>
     <div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div>
  </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

  <div class="container">
    <div class="wrapper">
      <form method="POST" action="{{ route('login') }}>
      @csrf
      
        <img class="logo" src="{{ url ('Assets/Images/logofull.png')}}" alt="">
        <h2>Acesso ao sistema</h2>

          <!-- Email Address -->
        <div class="input-field">
        <input type="text" required>
        <label>
        <x-label for="email" :value="__('Email')" />
          <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </label>
          
        </div>

        <!-- Password -->
        <div class="input-field">
        <input type="password" required>
        <label>
        <x-label for="password" :value="__('Password')" />
          <x-input id="password"
                type="password"
                name="password"
                required autocomplete="current-password" />
        </label>
        </div>

        <!-- Remember Me -->
        <div class="forget">
          <label for="remember_me" class="inline-flex items-center">
                  <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200focus:ring-opacity-50" name="remember">
                  <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>


            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>

        <x-button class="ml-3">
                    {{ __('Log in') }}
        </x-button>

        <div class="register">
          <p>Não tem uma conta? <a href="#">Entre em contato</a></p>
        </div>
      </form>
    </div>
  </div>
  
</body>
</html>
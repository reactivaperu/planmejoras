<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('auth.name', 'SISTEMA DE AUTENTICACIÓN') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/dev.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="auth">
        <div class="auth-page">
            <div class="auth-form p-4">
                <h3 class="text-center">INICIAR SESIÓN</h3>
                <h5 class="text-center my-3">Sistema de seguimiento al plan de mejora</h5>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <a href="{{ url('auth/google') }}">
                            <div class="google-btn">
                                <div class="google-icon-wrapper">
                                    <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" />
                                </div>
                                <p class="btn-text"><b>Iniciar Sesión Google</b></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex flex-column text-center auth-form-data">
                        <label>2021 © uandina.edu.pe</label>
                        <div class="d-flex justify-content-around">
                            <a href="">Términos y condiciones</a>
                            <a href="">Soporte Web</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
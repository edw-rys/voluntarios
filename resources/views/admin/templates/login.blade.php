<!DOCTYPE html>
<html lang="{{ getLangLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Voluntarios</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-aweso me/5.13.0/css/all.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/alerts.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/client-login.css') }}">
</head>

<body>

    <!-- Form-->
    <div class="form">
        <div class="form-toggle"></div>
        <div class="form-panel one">
            <div class="form-header">
                <h1>Account Login</h1>
            </div>
            <div class="form-content">
                <form action="{{ route('admin.login.post') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="Username">{{ trans('auth.login.username') }}</label>
                        <input type="text" style="border-bottom: 1px solid #000" id="Username" name="Username"
                            required="required" />
                    </div>
                    <div class="form-group">
                        <label for="password_">{{ trans('auth.login.password') }}</label>
                        <input type="password" style="border-bottom: 1px solid #000" id="password" name="password"
                            required="required" />
                    </div>
                    <div class="form-group">
                        <button type="submit">Log In</button>
                    </div>
                </form>
            </div>

            <div class="mt-3">
                {{-- @dump($errors) --}}
                @if (isset($errors) && is_array($errors))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="callout callout-danger">
                            @foreach ($errors as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
                @include('alerts.errorSessions')
            </div>
        </div>
    </div>

</body>

</html>

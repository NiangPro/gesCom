<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <style>
    html,
    body {
        height: 100%;
        background: rgb(236, 238, 234);
        background-attachment: fixed;
        background: url('storage/images/bg.svg');
        background-size: cover;
        background-position: top;
    }
    .ff{
        font-family: Algerian;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="container col-md-6 pt-5">
        <h1 class="text-center text-uppercase text-warning ff"> BIENVENU <br> GESTION COMMERCIAL {{$data['name']}}</h1>
    </div>
    <div class="container col-md-3 pt-5">
        <div class="card mt-3 bg-light-gray">
            <div class="card-header text-center">
                <div class="row">
                    <div class="text-center col-12"><img class="logo-img" src="storage/images/{{$data['logo']}}" alt="logo" width="80" height="80"></div>                
                </div>
                <div class="row">
                    <span class="splash-description text-bold h3">Connexion</span></div>
                </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                             <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <span class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">
                                    Se connecter
                                </button>
                </form>
            </div>
        </div>
    </div>

   <script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
</body>

</html>


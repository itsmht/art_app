<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="../assets/images/quirky.png" alt="logo" style="height:70px;"></a><span class="splash-description">Please enter your user information.</span></div>
            @if (\Session::has('message'))
                    <div class="alert alert-danger">
                        {{\Session::get('message')}}
                    </div>
                @endif
            <div class="card-body">
                <form action="{{route('login.submit')}}" method="POST">
                    {{@csrf_field()}}
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="email" id="email" type="text" placeholder="Email" autocomplete="off">
                        @error('email')
                        <span class="text-danger">{{$message}}</span><br>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="password" id="password" type="password" placeholder="Password">
                        @error('password')
                        <span class="text-danger">{{$message}}</span><br>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
                </form>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>
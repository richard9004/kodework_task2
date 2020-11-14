<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="{{ URL::to('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ URL::to('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
<style type="">
  .error_message{
    color:red;
  }
</style>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    @if(session()->has('success'))
           <div  class="alert alert-success" style="text-align:center">  {{ session()->get('success') }} </div>
          @endif

               @if(session()->has('error'))
           <div  class="alert alert-danger" style="text-align:center">  {{ session()->get('error') }} </div>
          @endif
                    <h1 class="h4 text-gray-900 mb-4">Register New User</h1>
                  </div>
                  <form class="user" method="post" action="{{ url('save-user') }}">
                     {!! csrf_field() !!}
                     <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter Name..." value="{{ old('name') }}">
                      @if($errors->has('name'))
                      <div class="error_message">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="{{ old('email') }}">
                       @if($errors->has('email'))
                      <div class="error_message">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                       @if($errors->has('password'))
                      <div class="error_message">{{ $errors->first('password') }}</div>
                      @endif
                    </div>
                     <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="confirm_password" name="confirm_password" placeholder="Password">
                       @if($errors->has('confirm_password'))
                      <div class="error_message">{{ $errors->first('confirm_password') }}</div>
                      @endif
                    </div>
                   
                   
                    <input type="submit" name="save" value="Register" class="btn btn-primary btn-user btn-block"/>
                   
                  
                  </form>
                 
                <!--   <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div> -->
                  <div class="text-center">
                    <a class="small" href="{{ url('login') }}">Sign In</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ URL::to('assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ URL::to('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ URL::to('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ URL::to('assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>

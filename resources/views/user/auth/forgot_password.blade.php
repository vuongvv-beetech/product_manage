<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
      .form-gap {
        padding-top: 70px;
      }
    </style>
</head>
<body>
  <div class="form-gap"></div>
<form method="POST" action="{{ route('password.sendmail') }}">
  @csrf
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="text-center">
                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                    <h2 class="text-center">Forgot Password?</h2>
                    <p>You can reset your password here.</p>
                    <div class="panel-body">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                            <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                            @if($errors->has('email'))
                              <div class="alert alert-danger">
                                  <strong>{{$errors->first('email')}}</strong>
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                        </div>
                        @if(session('error'))
                          <h2>{{session('error')}}</h2>
                        @endif
                        @if(session('success'))
                          <h2>{{session('success')}}</h2>
                        @endif
                        <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
  </div>
</form>
</body>
</html>
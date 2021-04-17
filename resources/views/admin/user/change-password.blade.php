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
<form method="POST" action="{{ route('password.confirmuser') }}">
  @csrf
  <input type="hidden" name="_method" value="PUT">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="text-center">
                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                    <h2 class="text-center">Reset Password?</h2>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" class="form-control" name="password" placeholder = "Password" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <div>
                                    <ul>
                                        <li style="color:red;">{{ $errors->first('password') }}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder = "Password_Confirmation" value="{{ old('password_confirmation') }}">
                        </div>
                        <div class="form-group">
                          <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                        </div>
                        <input type="hidden" class="hide" name="token" id="token" value="{{$token}}"> 
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
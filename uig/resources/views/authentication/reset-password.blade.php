<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<title>Project 101 | Password Reset</title>
<!-- Bootstrap Core CSS -->
<link href="{{URL::asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- animation CSS -->
<link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
<!-- color CSS -->
<link href="{{URL::asset('css/colors/default.css')}}" id="theme"  rel="stylesheet">
<!-- Custom CSS -->
<link href="{{URL::asset('css/custom.css')}}" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="passwordReset" method="post">
      {{csrf_field()}}
        <h3 class="box-title m-b-20">Recover Password</h3>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="password" id="password" placeholder="Password">
          </div>
        </div>
         <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
            <p id="passnotmatch" style="padding: 5px;font-size: 13px;color: red;display: none;">* Password mismatch!</p>
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" id="passwordResetbtn" type="submit">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="{{URL::asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{URL::asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{URL::asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>

<!--slimscroll JavaScript -->
<script src="{{URL::asset('js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{URL::asset('js/waves.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{URL::asset('js/custom.min.js')}}"></script>
<!--Style Switcher -->
<script src="{{URL::asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>

<script type="text/javascript">
$(document).ready(function(){
    var button = $('#passwordResetbtn');
    var registerform = $('#passwordReset');
    registerform.on('submit', function(event){
     
      var username  = $('#username').val();
      var password  = $('#password').val();
      var cpassword = $('#password_confirmation').val();
   
      if(cpassword == ''){
        $('#password_confirmation').focus();
        event.preventDefault();
      }
      if(password == ''){
        $('#password').focus();
        event.preventDefault();
      }
      if(username == ''){
        $('#username').focus();
        event.preventDefault();
      }
    });

    $('#password_confirmation').on('keyup', function(){
        if($('#password').val() != $(this).val()){
          $('#passnotmatch').show();
          button.prop('disabled', 'disabled');
          button.css('background', '#ec8282');
        }else{
           $('#passnotmatch').hide();
           button.prop('disabled', false);
           button.css('background', '#d41414');
        }
    });
  });
  </script>
</body>

</html>

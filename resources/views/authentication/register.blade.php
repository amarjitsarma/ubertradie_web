<!DOCTYPE html>  
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<title>Project 101 | Registration</title>
<!-- Bootstrap Core CSS -->
<link href="{{URL::asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- animation CSS -->
<link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">
<!-- Wizard CSS -->
<link href="{{URL::asset('plugins/bower_components/register-steps/steps.css')}}" rel="stylesheet">
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
<section id="wrapper" class="step-register">
  <div class="register-box">
    <div class="">
      <img src="{{URL::asset('plugins/images/logo.png')}}">
      <!-- multistep form -->
        <form id="msform" method="post" action="{{route('register')}}">
            {{csrf_field()}}
            <!-- progressbar -->
            <ul id="eliteregister" style="text-align: center;">
                <li class="active">Account Setup</li>
                <li>Personal Details</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Create your account</h2>
                <input type="text" name="email" id="email" placeholder="Email" />
                <p id="invalidmail" style="display: none; color: red;">Invalid email entered!</p>
                <input type="password" name="password" id="password" placeholder="Password" />
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
                <p id="passnotmatch" style="display: none;color: red;">Password mismatch!</p>
                <input type="button" name="next" class="next action-button disabled" id="next" disabled="" value="Next" />
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Personal Details</h2>
                <input type="text" name="username" id="username" placeholder="Username" />
                <input type="text" name="phone" id="phone" placeholder="Phone" />
                <textarea name="address" id="address" placeholder="Address"></textarea>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <button type="submit" class="submit action-button">Submit </button>
            </fieldset>
            <input type="hidden" name="added_date" value="{{date('Y-m-d')}}">
            <input type="hidden" name="added_time" value="{{date('H:i:s')}}">
        </form>
        <div class="clear"></div>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="{{URL::asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{URL::asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{URL::asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/register-steps/jquery.easing.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/register-steps/register-init.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{URL::asset('js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{URL::asset('js/waves.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{URL::asset('js/custom.min.js')}}"></script>
<!--Style Switcher -->
<script src="{{URL::asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>

<script>
    $(document).ready(function(){
        var email       = $('#email');
        var password    = $('#password');
        var cpassword   = $('#password_confirmation');
        var username    = $('#username');
        var phone       = $('#phone');
        var next        = $('#next');
        var msform      = $('#msform');

        $('#email, #password, #password_confirmation').on('keyup', function(){
            if(email.val() != '' && password.val() != '' && cpassword.val() != ''){
                next.prop('disabled', '');
                next.removeClass('disabled');
            }
        });

        msform.on('submit', function(event){
            console.log('i am submitted!');
            if(email.val() == ''){
               email.addClass('borderRed').focus();
                event.preventDefault();
              }     
              if(cpassword.val() == ''){
                cpassword.addClass('borderRed').focus();
                event.preventDefault();
              }
              if(password.val() == ''){
                password.addClass('borderRed').focus();
                event.preventDefault();
              }
              if(phone.val() == ''){
                phone.addClass('borderRed').focus();
                event.preventDefault();
              }
              if(username.val() == ''){
                username.addClass('borderRed').focus();
                event.preventDefault();
              }
             
        });

        phone.on('keypress', function(){
            $(this).removeClass('borderRed');
        });
        username.on('keypress', function(){
            $(this).removeClass('borderRed');
        });
        email.on('keypress', function(){
            $(this).removeClass('borderRed');
        });
        password.on('keypress', function(){
            $(this).removeClass('borderRed');
        });
        cpassword.on('keypress', function(){
            $(this).removeClass('borderRed');
        });
        cpassword.on('keyup', function(){
            if(password.val() != $(this).val()){
              $('#passnotmatch').show();
             
            }else{
               $('#passnotmatch').hide();
              
            }
        });
        email.on('keyup', function(){
          var email = $(this).val();
          var filter = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
          if(!filter.test(email)){
            $('#invalidmail').show();
          
          }else{
            $('#invalidmail').hide();
           
          }

        });
        email.on('focusout', function(){
          var email = $(this).val();
          var filter = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
          if(!filter.test(email)){
            $('#invalidmail').show();
         
          }else{
            $('#invalidmail').hide();

          }
        });
    })
</script>
</body>

</html>

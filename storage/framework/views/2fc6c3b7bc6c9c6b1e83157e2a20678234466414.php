

<html>
   <head>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
      
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
      
      <meta charset="utf-8" name="csrf-token" content="<?php echo e(csrf_token()); ?>">
      <!------ Include the above in your HEAD tag ---------->
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row text-center">
                        <img class="img-rounded" src="assets/img/login-bg.jpg" width="100%" />
                        <h2 class="text-primary">LOGIN</h2>
                    </div>
                   <?php if(Session::has('message')): ?>
                        <div class="alert alert-success alert-dismissable">
                          <?php echo e(Session::get('message')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(Session::has('failed')): ?>
                        <div class="alert alert-danger alert-dismissable">
                          <?php echo e(Session::get('failed')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="alert alert-danger alert-dismissable" id="danger-msg" style="display: none;">
                </div>
              </div>
            </div>

               
          
            <div class="clearfix"></div>
            <div class="col-md-6 col-md-offset-3">
               <div class="panel panel-login">
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <form id="loginForm" role="form">
                              <?php echo e(csrf_field()); ?>

                              <div class="form-group">
                                 <input name="email" id="email" class="form-control" type="text" placeholder="Username/Email">
                              </div>
                              <div class="form-group">
                                 <input name="password" id="password" class="form-control" type="password" placeholder="Password">
                              </div>
                              <div class="form-group text-center">
                                 <input id="checkbox-signup" type="checkbox" name="remember_me" value="1">
                                 <label for="remember"> Remember Me</label>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                       <input type="submit" name="login-submit" id="loginButton" tabindex="4" class="form-control btn btn-login" value="Login">
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="text-center">
                                          <a href="forgot/password" tabindex="5" class="forgot-password">Forgot Password?</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#loginForm').submit(function(event){
    console.log($('input[name=remember_me]').is(':checked'));
    event.preventDefault()
    var email     = $('#email');
    var password  = $('#password');

    var postData = {
      'email' : $('input[name=email]').val(),
      'password' : $('input[name=password]').val(),
      'remember_me' : $('input[name=remember_me]').is(':checked'),
      'g_recaptcha_response' : $('#g-recaptcha-response').val(),
    }
    if(email.val() == '' && password.val() == ''){
      $('#danger-msg').show().text('Please fill up the following details.');
      email.addClass('borderRed');
      password.addClass('borderRed');
    }else{
      $.ajax({
        type: 'POST',
        url: '<?php echo e(route("login")); ?>',
        data: postData,
        beforeSend: function(){
          $("#loginButton").html('<i class="fa fa-spinner"></i> Processing...').prop('disabled', 'disabled');
        },
        
        success: function(response){
          console.log(response);
          window.location.href=response.redirect;
        },
        error: function(response){
          $("#loginButton").html('<i class="fa fa-sign-in"></i> Sign in').prop('disabled', false);

          $('#danger-msg').show().text(response.responseJSON.error_message);

          $('input[name=email]').val('').addClass('borderRed');
          $('input[name=password]').val('').addClass('borderRed');
          $('input[name=remember_me]').prop("checked", false)
        },
      });
    }
    
  });


  $('#email').on('keypress', function(){
    $(this).removeClass('borderRed');
    $('#password').removeClass('borderRed');
  })

  $('#password').on('keypress', function(){
    $(this).removeClass('borderRed');
    $('#email').removeClass('borderRed');
  })
</script>
</html>


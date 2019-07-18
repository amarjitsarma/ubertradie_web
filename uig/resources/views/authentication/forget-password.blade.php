

<html>
   <head>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
      
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

      <!------ Include the above in your HEAD tag ---------->
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row text-center">
                        <img class="img-rounded" src="/img/indian_rail.jpg" width="100%" />
                        <h2 class="text-primary">Password Recovery</h2>
                    </div>
                   @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                          {{Session::get('message')}}
                        </div>
                    @endif
                    
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
                           <form id="passwordRecoverForm" method="POST" action="{{route('forgot.password')}}" role="form">
                              {{csrf_field()}}
                              <div class="form-group">
                                 <input name="email" id="email" class="form-control" type="text" placeholder="Email">
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                       <input type="submit" name="login-submit" id="loginButton" tabindex="4" class="form-control btn btn-login" value="Send">
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
    $('#passwordRecoverForm').on('submit',function(event){
        
        if($('#email').val() == ''){
            event.preventDefault();
            $('#danger-msg').text('Cannot leave the field empty!').show();
        }
    })
</script>
</html>


@extends('Main.layouts.app')
@section("content")
<style type="text/css">
    table tr th{
        border:1px solid #000;
        background: #ddd;
    }
    table tr td{
        border:1px solid #000;
    }
    table tr{
        height: 20px;
    }
</style>
    <div id="main" class="columns clearfix">
        <main id="content-column" class="content-column" role="main">
            <!-- !Breadcrumbs -->
            <div class="bread_crumbs">
                <div class='wrapper'><a href="/">Home</a>View Way Leave Agreement</div>
            </div>
            <div class="content-inner wrapper">
                <!-- !Messages and Help -->
                <div class="full_width_secction">

                    <h1 class="static_page_head">
                        User login </h1>
                    <div class="tabs">
                        
                        <ul class="tabs primary">
                            <li><a href="register.html">Create new account</a></li>
                            <li class="active"><a href="../user.html" class="active">Log in<span class="element-invisible">(active tab)</span></a></li>
                            <li><a href="password.html">Request new password</a></li>
                        </ul>
                    </div>
                    <!-- !Secondary Content Region -->

                    <section id="main-content">

                        <div class="static_content">
                            <!-- !Main Content -->
                            <div id="content" class="region">

                                                         <div class="result">
                                                         
@if(!$WayLeave)
<!--img src="/Main/images/slider/slider-1.jpg" style="width:1000px; height: 600px; background: #aaa;" alt="test"/-->
@else
@if(sizeof($WayLeave)==0)
<h3>No Records Found For The Given Search</h3>
@else
<h3>{{count($WayLeave)}} Record(s) found</h3>
@foreach($WayLeave as $data)
<div class="log-main">
    <div class="user">
       <strong> Division:</strong> 
        <span>{{$data->Division}}</span>
    </div>
    <div class="user">
        <strong>State: </strong>  
        <span>{{$data->State}}</span>
    </div>
    <div class="user">
         <strong>Block Section From:</strong>  
        <span>{{$data->BlockSectionFrom}}</span>
    </div>
    <div class="user">
        <strong> Block Section To: </strong> 
        <span>{{$data->BlockSectionTo}}</span>
    </div>
    <div class="user">
         <strong>From: </strong> 
        <span>{{$data->FromKM}}.{{$data->FromM}} KM</span>
    </div>
    <div class="user">
         <strong>To: </strong> 
        <span>{{$data->ToKM}}.{{$data->ToM}} KM</span>
    </div>
    <div class="user">
        <strong>Size Of Crossing: </strong> 
        <span>{{$data->SizeOfCrossing}}</span>
    </div>
    <div  class="user">
         <strong>Organization: </strong> 
        <span>{{$data->Organization}}</span>
    </div>
    <div class="user">
         <strong>Date Of Execution: </strong> 
        <span>{{$data->DateOfExecution}}</span>
    </div>
    <div class="user">
         <strong>Agreement No: </strong> 
        <span>{{$data->AgreementNo}}</span>
    </div>
    <div class="user">
         <strong>Drawing No:</strong>  
        <span>{{$data->DrawingNo}}</span>
    </div>
    <div class="user">
         <strong>Validity:</strong>  
        <span>{{$data->Validity}}</span>
    </div>
    <div class="user">
        <strong> Remarks:</strong>  
        <span>{{$data->Remarks}}</span>
    </div>
    <div>
        
        @foreach($data->Photos as $Photo)
        <!--div id="Photo{{$data->ID}}" style="width:100%; display: none;">        
            <img src="{{$Photo->Photo}}"><br>       
            <a href="#" onclick="document.getElementById('Photo{{$data->ID}}').style.display='none';">Hide      Photo</a>
        </div>
        <!--view image-->

     <div class="views">
         
         <div class="main">

            <!-- Trigger/Open The Modal -->
               
                <a href="#" id="myBtn" onclick="document.getElementById('myModal{{$Photo->ID}}').style.display='block';">View Photo</a>

                <!-- The Modal -->
                <div id="myModal{{$Photo->ID}}" class="modal">

                  <!-- Modal content -->
                  <div class="modal-content">
                    <span class="close" onclick="document.getElementById('myModal{{$Photo->ID}}').style.display='none';"">&times;</span>
                    <p><img src="{{$Photo->Photo}}"></p>
                  </div>

                </div>
             

         </div>

     </div>

    <!--view image ends-->
        @endforeach
    </div>

</div>
@endforeach
@endif
@endif
                                                         </div>

                                                     <!--results ends-->

                                                </div>
                                            </div>
                                            <div style="display: none;"><input type="hidden" name="form_build_id" value="form-hTzTzcvN3_wuJaA1DejRYzRlsQAr1l9kqSf8UjCmV_Y" /> <input type="hidden" name="form_id" value="user_login" />
                                                <div class="form-actions form-wrapper" id="edit-actions"></div><a href="password//">Forgot your password?</a></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- !Feed Icons -->
                        </div>



                    </section>
                    <!-- /end #main-content -->

                    <!-- !Content Aside Region-->
                </div>
            </div>
            <!-- /end .content-inner -->
        </main>
        <!-- /end #content-column -->

        <!-- !Sidebar Regions -->

    </div>
@endsection
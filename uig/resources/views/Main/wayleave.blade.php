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
         <div class='wrapper'><a href="/">Home</a>Wey Leave Agreement</div>
      </div>
      <div class="content-inner wrapper">
         <!-- !Messages and Help -->
         <div class="full_width_secction">
            <h1 class="static_page_head">
               User login 
            </h1>
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
                     <div id="block-system-main" class="block block-system no-title">
                        <form autocomplete="off" action="/Home/WayLeaveAgreements" method="get" id="user-login" accept-charset="UTF-8">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <div>
                              <div class="static_content">
                                 <div class="page_content">
                                    <div class="result">
                                       @if(!$Wayleaves)
                                       <!--img src="/Main/images/slider/slider-1.jpg" style="width:1000px; height: 600px; background: #aaa;" alt="test"/-->
                                       @else
                                       @if(sizeof($Wayleaves)==0)
                                       <h3>No Records Found For The Given Search</h3>
                                       @else
                                       <h3>{{count($Wayleaves)}} Record(s) found</h3>
                                       <table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
                                          <thead>
                                             <tr>
                                                <th>Division</th>
                                                <th>State</th>
                                                <th>Block Section From</th>
                                                <th>Block Section To</th>
                                                <th>From KM</th>
                                                <th>From M</th>
                                                <th>To KM</th>
                                                <th>To M</th>
                                                <th>Size Of Crossing</th>
                                                <th>Organization</th>
                                                <th>Date Of Execution</th>
                                                <th>Agreement No</th>
                                                <th>Drawing No</th>
                                                <th>Validity</th>
                                                <th>Remarks</th>
                                                <th>View</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($Wayleaves as $WayLeave)
                                             <tr>
                                                <td>{{$WayLeave->Division}}</td>
                                                <td>{{$WayLeave->State}}</td>
                                                <td>{{$WayLeave->BlockSectionFrom}}</td>
                                                <td>{{$WayLeave->BlockSectionTo}}</td>
                                                <td>{{$WayLeave->FromKM}}</td>
                                                <td>{{$WayLeave->FromM}}</td>
                                                <td>{{$WayLeave->ToKM}}</td>
                                                <td>{{$WayLeave->ToM}}</td>
                                                <td>{{$WayLeave->SizeOfCrossing}}</td>
                                                <td>{{$WayLeave->Organization}}</td>
                                                <td>{{$WayLeave->DateOfExecution}}</td>
                                                <td>{{$WayLeave->AgreementNo}}</td>
                                                <td>{{$WayLeave->DrawingNo}}</td>
                                                <td>{{$WayLeave->Validity}}</td>
                                                <td>{{$WayLeave->Remarks}}</td>
                                                <td><a href="/Home/ViewWayLeave?ID={{$WayLeave->ID}}">View</a></td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
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
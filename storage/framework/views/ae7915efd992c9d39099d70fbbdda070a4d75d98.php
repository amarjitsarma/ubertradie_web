      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="/Dashboard" class="logo"><b>Universal Iron Gym</b></a>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="javascript:;">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
	        <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="/Profile"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">
				  <?php if($UserType=="admin"): ?>
					Super Admin
					<?php else: ?>
					Admin
					<?php endif; ?>
				  </h5>
              	  	
                  <li class="mt">
                      <a href="/Dashboard">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Master</span>
                      </a>
                      <ul class="sub">
						<?php if($UserType=="admin"): ?>
						  <li><a  href="/Places">Places</a></li>
						  <li><a  href="/Packages">Packages</a></li>
						  <li><a  href="/Users">Users</a></li>
						  <li><a  href="/Contacts">Contacts</a></li>
						<?php endif; ?>
                          <li><a  href="/Students">Students</a></li>
                          <li><a  href="/Staffs">Staffs</a></li>
						  
                      </ul>
                  </li>
				  
				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Attendance</span>
                      </a>
                      <ul class="sub">
						  <li><a  href="/StudnetAttendance">Student Attendance</a></li>
						  <li><a  href="/StaffAttendance">Staff Attendance</a></li>
                      </ul>
                  </li>
				  
				  <li class="mt">
                      <a href="/UploadExcel">
                          <i class="fa fa-dashboard"></i>
                          <span>Upload Excel Sheet</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Reports</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="/StudentAttendanceReport?FromDate=<?php echo e(date('Y-m-d')); ?>&ToDate=<?php echo e(date('Y-m-d')); ?>">Student Attendance</a></li>
                          <li><a  href="/StaffAttendanceReport?FromDate=<?php echo e(date('Y-m-d')); ?>&ToDate=<?php echo e(date('Y-m-d')); ?>">Staff Attendance</a></li>
                          <li><a  href="/StudentPaymentHistory">Student Fees</a></li>
						  <li><a  href="/StaffSalaryHistory">Staff Salary</a></li>
						  <li><a  href="/PersonalTrainerHistory">Personal Trainer History</a></li>
                      </ul>
                  </li>
				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Leave Application</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="/StudentLeave">Student Leave Application</a></li>
                          <li><a  href="/StaffLeave">Staff Leave Application</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Enquiry</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="/NewEnquiry">Add New Enquiry</a></li>
                          <li><a  href="/Enquiries">Enquiries</a></li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
<?php $__env->startSection("content"); ?>
<section id="main-content">
          <section class="wrapper">
		  <?php if(session()->has('message')): ?>
				<div class="alert alert-success">
					<?php echo e(session()->get('message')); ?>

				</div>
			<?php endif; ?>
			<?php if($UserType!="admin"): ?>
			  <?php echo e(Form::open(array('url' =>'/StudentAttendanceSheet',"class"=>"row", "method" => "GET"))); ?>

				<div class="col-md-4">
					<select name="PlaceID" class="form-control">
						<?php if($UserType=="admin"): ?>
								<?php $__currentLoopData = $Locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($Location->ID); ?>"><?php echo e($Location->LocationName); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<?php $__currentLoopData = $Locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($Location->ID==$LocationID): ?>
									<option value="<?php echo e($Location->ID); ?>"><?php echo e($Location->LocationName); ?></option>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
					</select>
				</div>
				<div class="col-md-8">
					<?php echo e(Form::submit('Enter Attendance',array('class'=>'btn btn-info'))); ?>

				</div>
			  <?php echo e(Form::close()); ?>

			<?php endif; ?>
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Location Name</th>
						<th>Code</th>
						<th>Name</th>
						<th>Mobile No</th>
						<th>DOB</th>
						<th>Entry Date</th>
						<th>Entry Time</th>
						<th>Exit Time</th>
						<th>Attended Duration</th>
						<th>Status</th>
						
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					<?php $__currentLoopData = $Attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Attendance->LocationName); ?></td>
						<td><?php echo e($Attendance->Code); ?></td>
						<td><?php echo e($Attendance->Name); ?></td>
						<td><?php echo e($Attendance->MobileNo); ?></td>
						<td><?php echo e($Attendance->DOB); ?></td>
						<td><?php echo e($Attendance->EntryDate); ?></td>
						<td><?php echo e($Attendance->EntryTime); ?></td>
						<td><?php echo e($Attendance->ExitTime); ?></td>
						<td><?php echo e($Attendance->AttendedDuration); ?></td>
						<td>
							<?php if($Attendance->Status==1): ?>
							Present
							<?php else: ?>
							Absent
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			  </div>
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
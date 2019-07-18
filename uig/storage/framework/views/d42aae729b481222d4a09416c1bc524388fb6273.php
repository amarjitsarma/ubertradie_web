
<?php $__env->startSection("content"); ?>
<section id="main-content">
          <section class="wrapper">
		  <?php if(session()->has('message')): ?>
				<div class="alert alert-success">
					<?php echo e(session()->get('message')); ?>

				</div>
			<?php endif; ?>
			  <?php echo e(Form::open(array('url' =>'/StudentAttendanceReport',"class"=>"row", "method" => "GET"))); ?>

				<div class="col-md-3">
					<div class="form-group">
						<label>From Date:</label>
						<input type="text" name="FromDate" value="<?php echo e($FromDate); ?>" class="form-control datepicker" onchange="this.form.submit();">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>To Date:</label>
						<input type="text" name="ToDate" value="<?php echo e($ToDate); ?>" class="form-control datepicker" onchange="this.form.submit();">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Location</label>
						<select name="PlaceID" class="form-control" onchange="this.form.submit();">
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
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Students</label>
						<select name="StudentID" class="form-control" onchange="this.form.submit();">
							<option value="0">All</option>
							<?php $__currentLoopData = $Students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($Student->ID); ?>"
							<?php if($Student->ID==$StudentID): ?>
								selected
							<?php endif; ?>
							><?php echo e($Student->Name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
			  <?php echo e(Form::close()); ?>

			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Entry Date</th>
						<th>Biometric Code</th>
						<th>Name</th>
						<th>Mobile No</th>
						<th>DOB</th>
						<th>Status</th>
						
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					<?php $__currentLoopData = $Attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Attendance->EntryDate); ?></td>
						<td><?php echo e($Attendance->BiometricCode); ?></td>
						<td><?php echo e($Attendance->Name); ?></td>
						<td><?php echo e($Attendance->MobileNo); ?></td>
						<td><?php echo e($Attendance->DOB); ?></td>
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
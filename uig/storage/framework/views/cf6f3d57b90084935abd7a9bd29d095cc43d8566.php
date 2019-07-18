
<?php $__env->startSection("content"); ?>
<section id="main-content">
          <section class="wrapper">
		  <?php if(session()->has('message')): ?>
				<div class="alert alert-success">
					<?php echo e(session()->get('message')); ?>

				</div>
			<?php endif; ?>
			  
			  <?php echo e(Form::open(array('url' =>'/StudentAttendanceSave?PlaceID='.$PlaceID,"class"=>"row", "method" => "POST"))); ?>

				<table class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Mark</th>
						<th>Biometric Code</th>
						<th>Name</th>
						<th>Mobile No</th>
						<th>DOB</th>
						
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					<?php $__currentLoopData = $Attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><input type="checkbox" name="chkStudent[]" value="<?php echo e($Attendance->ID); ?>" 
						<?php if($Attendance->Status!=null): ?>
							checked
						<?php endif; ?>
						></td>
						<td><?php echo e($Attendance->BiometricCode); ?></td>
						<td><?php echo e($Attendance->Name); ?></td>
						<td><?php echo e($Attendance->MobileNo); ?></td>
						<td><?php echo e($Attendance->DOB); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
				<?php echo e(Form::submit('Enter Attendance',array('class'=>'btn btn-info'))); ?>

			  <?php echo e(Form::close()); ?>

          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
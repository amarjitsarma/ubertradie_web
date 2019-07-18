<?php $__env->startSection("content"); ?>
<section id="main-content">
          <section class="wrapper">
		  <?php if($errors->any()): ?>
				<div class="alert alert-danger">
					<ul>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			<?php endif; ?>
			<?php if(session()->has('message')): ?>
				<div class="alert alert-success">
					<?php echo e(session()->get('message')); ?>

				</div>
			<?php endif; ?>
              <?php if(isset($_GET["ID"])): ?>
              <?php echo e(Form::open(array('url' => '/UpdateStaff?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php else: ?>
				<?php echo e(Form::open(array('url' => '/SaveStaff',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php endif; ?>
				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div id="my_camera"></div>
					<a onclick="take_snapshot()" class="btn btn-success">Take Snapshot</a>
					OR
					<input type="file" id="file" accept="image/*" onchange="LoadPhoto();" class="btn btn-danger">
				</div>
				<div class="col-sm-6" id="results">
				
				</div>
				<input type="hidden" value="" name="Photo" id="Photo">
				<script type="text/javascript" src="/js/webcam.js"></script>
				<script language="JavaScript">
					Webcam.set({
						width: 320,
						height: 240,
						image_format: 'jpeg',
						jpeg_quality: 90
					});
					Webcam.attach( '#my_camera' );
				</script>
				<div class="clearfix"></div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Location: </label>
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
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>ID No: </label>
						<input type="text" name="IDNo" class="form-control" value="<?php echo e($IDNo); ?>" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Biometric Code: </label>
						<input type="text" name="BiometricCode" class="form-control" value="<?php echo e($BiometricCode); ?>" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Name: </label>
						<input type="text" name="Name" class="form-control" value="<?php echo e($Name); ?>" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Age: </label>
						<input type="text" name="Age" class="form-control" value="<?php echo e($Age); ?>" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Date Of Birth: </label>
						<input type="text" name="DOB" class="form-control datepicker" value="<?php echo e($DOB); ?>" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Sex: </label>
						<select name="Sex" class="form-control">
							<option value="Male"
							<?php if($Sex=="Male"): ?>
							selected
							<?php endif; ?>
							>Male</option>
							<option value="Female"
							<?php if($Sex=="Female"): ?>
							selected
							<?php endif; ?>
							>Female</option>
							<option value="Other"
							<?php if($Sex=="Other"): ?>
							selected
							<?php endif; ?>
							>Others</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Address: </label>
						<textarea class="form-control" name="Address" required><?php echo e($Address); ?></textarea>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Mobile No: </label>
						<input type="text" name="MobileNo" class="form-control" value="<?php echo e($MobileNo); ?>" required maxLength="10" minLength="10">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Designation: </label>
						<select name="Designation" class="form-control">
							<option value="Staff"
							<?php if($Designation=="Staff"): ?>
							selected
							<?php endif; ?>
							>Staff</option>
							<option value="Trainer"
							<?php if($Designation=="Trainer"): ?>
							selected
							<?php endif; ?>
							>Trainer</option>
							<option value="Other"
							<?php if($Designation=="Other"): ?>
							selected
							<?php endif; ?>
							>Others</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Emergency Person Name: </label>
						<input type="text" name="EmergencyPerson" class="form-control" value="<?php echo e($EmergencyPerson); ?>" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Emergency Contact No: </label>
						<input type="text" name="EmergencyContactNo" class="form-control" value="<?php echo e($EmergencyContactNo); ?>" required maxLength="10" minLength="10">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Joining Date: </label>
						<input type="text" name="JoiningDate" class="form-control datepicker" value="<?php echo e($JoiningDate); ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Any Medical History:</label>
						<textarea class="form-control" name="AnyMedicalHistory" required><?php echo e($AnyMedicalHistory); ?></textarea>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Marital Status: </label>
						<select name="MaritalStatus" class="form-control">
							<option value="Married"
							<?php if($MaritalStatus=="Married"): ?>
							selected
							<?php endif; ?>
							>Married</option>
							<option value="Unmarried"
							<?php if($MaritalStatus=="Unmarried"): ?>
							selected
							<?php endif; ?>
							>Unmarried</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Blood Group: </label>
						<input type="text" name="BloodGroup" class="form-control" value="<?php echo e($BloodGroup); ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Salary: </label>
						<input type="text" name="Salary" class="form-control" value="<?php echo e($Salary); ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Absent Penalty: </label>
						<input type="text" name="AbsentPenalty" class="form-control" value="<?php echo e($AbsentPenalty); ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Total Work Days: </label>
						<input type="text" name="WorkDays" class="form-control" value="<?php echo e($WorkDays); ?>" required>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12">
					<?php echo e(Form::submit('Submit',array('class'=>'btn btn-info'))); ?>

				</div>
              <?php echo e(Form::close()); ?><!--/row -->
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer"); ?>
<script language="JavaScript">
	function take_snapshot() {
		// take snapshot and get image data
		Webcam.snap( function(data_uri) {
			// display results in page
			document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
			document.getElementById('Photo').value=data_uri;
		} );
	}
	function LoadPhoto()
	{
		var file=document.getElementById("file");
		if(file.files)
		{
			var FR= new FileReader();
    
			FR.addEventListener("load", function(e) {
				document.getElementById('results').innerHTML = '<img src="'+e.target.result+'" height="240px" width="320px"/>';
				document.getElementById('Photo').value=e.target.result;
			}); 
			
			FR.readAsDataURL( file.files[0] );
		}
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
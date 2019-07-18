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
              <?php echo e(Form::open(array('url' => '/UpdateStudent?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php else: ?>
				<?php echo e(Form::open(array('url' => '/SaveStudent',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php endif; ?>
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
						<label>Code: </label>
						<input type="text" name="Code" class="form-control" value="<?php echo e($Code); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Name: </label>
						<input type="text" name="Name" class="form-control" value="<?php echo e($Name); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Age: </label>
						<input type="text" name="Age" class="form-control" value="<?php echo e($Age); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Date Of Birth: </label>
						<input type="text" name="DOB" class="form-control datepicker" value="<?php echo e($DOB); ?>">
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
						<textarea class="form-control" name="Address"><?php echo e($Address); ?></textarea>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Home Phone: </label>
						<input type="text" name="HomePhone" class="form-control" value="<?php echo e($HomePhone); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Mobile No: </label>
						<input type="text" name="MobileNo" class="form-control" value="<?php echo e($MobileNo); ?>">
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label>Work Place: </label>
						<input type="text" name="WorkPlace" class="form-control" value="<?php echo e($WorkPlace); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Designation: </label>
						<input type="text" name="Designation" class="form-control" value="<?php echo e($Designation); ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Emergency Person Name: </label>
						<input type="text" name="EmergencyPerson" class="form-control" value="<?php echo e($EmergencyPerson); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Emergency Contact No: </label>
						<input type="text" name="EmergencyContactNo" class="form-control" value="<?php echo e($EmergencyContactNo); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>How You Know: </label>
						<input type="text" name="HowYouKnow" class="form-control" value="<?php echo e($HowYouKnow); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Program: </label>
						<select name="Program" class="form-control" id="Program" onchange="GetPackageDetail();">
						<?php $__currentLoopData = $Packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($Package->ID); ?>"
							<?php if($Package->ID==$Program): ?>
							selected
							<?php endif; ?>
							><?php echo e($Package->PackageName); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Start Date: </label>
						<input type="text" name="StartDate" class="form-control datepicker" value="<?php echo e($StartDate); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Expiry Date: </label>
						<input type="text" name="ExpiryDate" class="form-control datepicker" value="<?php echo e($ExpiryDate); ?>">
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
						<label>Any Medical History:</label>
						<textarea class="form-control" name="AnyMedicalHistory"><?php echo e($AnyMedicalHistory); ?></textarea>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Blood Group: </label>
						<input type="text" name="BloodGroup" class="form-control" value="<?php echo e($BloodGroup); ?>">
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label>Personal Trainer: </label>
						<select name="PersonalTrainer" class="form-control">
							<option value="0">None</option>
							<?php $__currentLoopData = $Trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($Trainer->ID); ?>"
							<?php if($Trainer->ID==$PersonalTrainer): ?>
							selected
							<?php endif; ?>
							><?php echo e($Trainer->Name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Program Fees:</label>
						<input type="text" name="ProgramFees" id="ProgramFees" class="form-control" value="<?php echo e($ProgramFees); ?>" readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Personal Trainer Fees: </label>
						<input type="text" name="PersonalTrainerFees" id="PersonalTrainerFees" class="form-control" value="<?php echo e($PersonalTrainerFees); ?>" readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Total Fees:</label>
						<input type="text" name="TotalFees" id="TotalFees" class="form-control" value="" readonly>
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
<script type="text/javascript">
	$(document).ready(function(){
		GetPackageDetail();
	});
	function GetPackageDetail()
	{
		$.ajax({
			url: "/GetPackageDetail?ID="+document.getElementById("Program").value,
			dataType: "json",
			success: function(Data)
			{
				document.getElementById("ProgramFees").value=Data[0].Price;
				document.getElementById("PersonalTrainerFees").value=Data[0].PersonalTrainer*Data[0].Duration;
				document.getElementById("TotalFees").value=parseFloat(document.getElementById("ProgramFees").value)+parseFloat(document.getElementById("PersonalTrainerFees").value);
			},
			error: function()
			{
				alert("fail");
			}
		});
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
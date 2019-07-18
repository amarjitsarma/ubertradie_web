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
				<?php echo e(Form::open(array('url' => '/StudentUpgradeSave?ID='.$ID.'&PlaceID='.$PlaceID,"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			
				<div class="col-md-3">
					<div class="form-group">
						<label>Program: </label>
						<select name="Program" class="form-control" id="Program" onchange="GetPackageDetail();">
						<?php $__currentLoopData = $Packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($Package->ID); ?>"><?php echo e($Package->PackageName); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Personal Trainer: </label>
						<select name="PersonalTrainer" class="form-control" id="PersonalTrainer">
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
				<div class="col-md-3">
					<div class="form-group">
						<label>Start Date: </label>
						<input type="text" name="StartDate" class="form-control datepicker" value="<?php echo e($StartDate); ?>">
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label>Expiry Date: </label>
						<input type="text" name="ExpiryDate" class="form-control datepicker">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Program Fees:</label>
						<input type="text" name="ProgramFees" id="ProgramFees" class="form-control" value="0" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Personal Trainer Fees: </label>
						<input type="text" name="PersonalTrainerFees" id="PersonalTrainerFees" class="form-control" value="0" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Discount:</label>
						<input type="text" name="Discount" id="Discount" class="form-control" value="0" onfocus="this.select();" onchange="GetPackageDetail();">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Total Fees:</label>
						<input type="text" name="TotalFees" id="TotalFees" class="form-control" value="" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Paid Amount:</label>
						<input type="text" name="PaidAmount" id="PaidAmount" class="form-control" value="">
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<label>Receipt No:</label>
						<input type="text" name="ReceiptNo" id="ReceiptNo" value="" class="form-control" value="" required>
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
		var Discount=parseFloat(document.getElementById("Discount").value);
		$.ajax({
			url: "/GetPackageDetail?ID="+document.getElementById("Program").value,
			dataType: "json",
			success: function(Data)
			{
				document.getElementById("ProgramFees").value=Data[0].Price;
				var PersonalTrainer=document.getElementById("PersonalTrainer").value;
				if(PersonalTrainer!="0")
				{
					document.getElementById("PersonalTrainerFees").value=Data[0].PersonalTrainer*Data[0].Duration;
				}
				else
				{
					document.getElementById("PersonalTrainerFees").value="0";
				}
				document.getElementById("TotalFees").value=parseFloat(document.getElementById("ProgramFees").value)+parseFloat(document.getElementById("PersonalTrainerFees").value)-Discount;
				document.getElementById("PaidAmount").value=document.getElementById("TotalFees").value;
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
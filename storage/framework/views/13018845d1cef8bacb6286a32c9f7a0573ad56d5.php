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
						<label>Start Date: </label>
						<input type="text" name="StartDate" id="StartDate" class="form-control datepicker" value="<?php echo e($StartDate); ?>">
					</div>
				</div>
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
						<label>Expiry Date: </label>
						<input type="text" name="ExpiryDate" id="ExpiryDate" class="form-control datepicker" onchange="GetPackageDetail();" readonly>
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label>Personal Trainer: </label>
						<select name="PersonalTrainer" class="form-control" id="PersonalTrainer" onchange="GetPackageDetail();">
							<option value="0">None</option>
							<?php $__currentLoopData = $Trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($Trainer->ID); ?>"><?php echo e($Trainer->Name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
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
				<div class="col-md-4">
					<div class="form-group">
						<label>From Date: </label>
						<input type="text" name="FromDate" id="FromDate" class="form-control datepicker"  onchange="GetPackageDetail();" value="<?php echo e(date('Y-m-d')); ?>" >
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Personal Trainer Duration in months: </label>
						<input type="text" name="Months" id="Months" class="form-control" value="0" onchange="GetPackageDetail();" onfocus="this.select();">
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
		var StartDate=document.getElementById("StartDate").value;
		$.ajax({
			url: "/GetPackageDetail?ID="+document.getElementById("Program").value,
			dataType: "json",
			success: function(Data)
			{
				document.getElementById("ProgramFees").value=Data[0].Price;
				var PersonalTrainer=document.getElementById("PersonalTrainer").value;
				if(PersonalTrainer!="0")
				{
					document.getElementById("PersonalTrainerFees").value=parseFloat(Data[0].PersonalTrainer)*parseFloat(document.getElementById("Months").value);
				}
				else
				{
					document.getElementById("PersonalTrainerFees").value="0";
				}
				document.getElementById("TotalFees").value=parseFloat(document.getElementById("ProgramFees").value)+parseFloat(document.getElementById("PersonalTrainerFees").value)-Discount;
				document.getElementById("PaidAmount").value=document.getElementById("TotalFees").value;
				var Duration=Data[0].Duration;
				var Expiry=StartDate.split("-");
				var ExpiryDate = new Date(Expiry[0], Expiry[1] - 1, Expiry[2]);
				var NewMonth=parseInt(ExpiryDate.getMonth())+parseInt(Duration);
				ExpiryDate=new Date(ExpiryDate.setMonth(NewMonth));
				var Year=ExpiryDate.getFullYear().toString();
				var Month=(ExpiryDate.getMonth()+1).toString();
				var Day=ExpiryDate.getDate().toString();
				if (Month.length < 2)
				{
					Month = "0" + Month.toString();
				}
				if (Day.length < 2)
				{
					Day = '0' + Day.toString();
				}
				document.getElementById("ExpiryDate").value=Year.toString()+"-"+Month.toString()+"-"+Day.toString();
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
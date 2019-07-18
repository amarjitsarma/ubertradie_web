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
				<?php echo e(Form::open(array('url' => '/UpdateStudentReceipt',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

				<!-- PlaceID	Name	Email	ContactNo	EnquiryDate	Message	ReminderOn -->
				<div class="col-md-12">
					<div class="col-md-3">
						<div class="form-group">
							<label>Program Fees: </label>
							<input type="text" name="ProgramFees" value="<?php echo e($ProgramFees); ?>" class="form-control" readonly>
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group">
							<label>Personal Trainer Fees: </label>
							<input type="text" name="PersonalTrainer" value="<?php echo e($PersonalTrainer); ?>" class="form-control" readonly>
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group">
							<label>Paid Amount: </label>
							<input type="text" name="PaidAmount" id="PaidAmount" value="<?php echo e($PaidAmount); ?>" class="form-control" readonly>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Balance: </label>
							<input type="text" name="Balance" id="Balance" value="<?php echo e($Balance); ?>" class="form-control" readonly>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Amount Paid Now: </label>
							<input type="text" name="AmountToPay" id="AmountToPay" value="0" class="form-control" onchange="Validate();" onfocus="this.select();">
						</div>
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
<script>
function Validate()
{
	var PaidAmount=parseFloat(document.getElementById("PaidAmount").value);
	var Balance=parseFloat(document.getElementById("Balance").value);
	var AmountToPay=parseFloat(document.getElementById("AmountToPay").value);
	if(AmountToPay>Balance)
	{
		alert("Amount to pay cannot be larger than balance");
		document.getElementById("AmountToPay").value=document.getElementById("Balance").value;
	}
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
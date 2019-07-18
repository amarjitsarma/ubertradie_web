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

			
				<div class="col-md-4">
					<div class="form-group">
						<label>Program: </label>
						<select name="Program" class="form-control">
						<?php $__currentLoopData = $Packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($Package->ID); ?>"><?php echo e($Package->PackageName); ?></option>
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
						<input type="text" name="ExpiryDate" class="form-control datepicker">
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label>Program Fees:</label>
						<input type="text" name="ProgramFees" class="form-control" >
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Personal Trainer Fees: </label>
						<input type="text" name="PersonalTrainerFees" class="form-control">
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
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
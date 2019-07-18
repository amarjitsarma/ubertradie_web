
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
				<?php echo e(Form::open(array('url' => '/SaveEnquiry',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

				<!-- PlaceID	Name	Email	ContactNo	EnquiryDate	Message	ReminderOn -->
				<div class="col-md-6">
					<div class="col-md-6">
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
					<div class="col-md-6">
						<div class="form-group">
							<label>Name: </label>
							<input type="text" name="Name" class="form-control">
						</div>
					</div>	
					<div class="col-md-6">
						<div class="form-group">
							<label>Email: </label>
							<input type="text" name="Email" class="form-control">
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group">
							<label>ContactNo: </label>
							<input type="text" name="ContactNo" class="form-control">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Reminder On: </label>
							<input type="text" name="ReminderOn" class="form-control datepicker">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Message: </label>
						<textarea class="form-control" name="Message"></textarea>
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
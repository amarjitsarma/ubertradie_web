<?php $__env->startSection("content"); ?>
<section id="main-content">
          <section class="wrapper">
		  <?php if(session()->has('message')): ?>
				<div class="alert alert-success">
					<?php echo e(session()->get('message')); ?>

				</div>
			<?php endif; ?>
			<hr/>
			<div class="row">
				<div class="col-md-3">
					Name: <?php echo e($Student[0]->Name); ?>

				</div>
				<div class="col-md-3">
					Code: <?php echo e($Student[0]->Code); ?>

				</div>
				<div class="col-md-3">
					Mobile No: <?php echo e($Student[0]->MobileNo); ?>

				</div>
				<div class="col-md-3">
					Date Of Birth: <?php echo e($Student[0]->DOB); ?>

				</div>
			</div>
			<hr/>
			<?php echo e(Form::open(array('url' =>'/SaveStudentLeave?PlaceID='.$PlaceID."&StudentID=".$StudentID,"class"=>"row", "method" => "POST"))); ?>

				<div class="col-md-6">
					<div class="form-group">
						<label>From Date:</label>
						<input type="text" class="datepicker form-control" name="FromDate" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>To Date:</label>
						<input type="text" class="datepicker form-control" name="ToDate" required>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Reason:</label>
						<textarea class="form-control" name="Reason" required></textarea>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12">
					<?php echo e(Form::submit('Submit',array('class'=>'btn btn-info'))); ?>

				</div>
			  <?php echo e(Form::close()); ?>

          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
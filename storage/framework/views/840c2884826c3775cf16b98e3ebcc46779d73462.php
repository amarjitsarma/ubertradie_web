<?php $__env->startSection("content"); ?>
<section id="main-content">
    <section class="wrapper">
		<div class="row">
			<div class="col-md-12">
				<?php echo e(Form::open(array('url' =>'/PersonalTrainerHistory',"class"=>"row", "method" => "GET"))); ?>

					<div class="col-md-3">
						<div class="form-group">
							<select name="PlaceID" class="form-control" id="PlaceID" onchange="this.form.submit();">
							<?php if($UserType=="admin"): ?>
								<?php $__currentLoopData = $Locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($Location->ID); ?>" 
								<?php if($Location->ID==$PlaceID): ?>
									selected
								<?php endif; ?>
								><?php echo e($Location->LocationName); ?></option>
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
				<?php echo e(Form::close()); ?>

			</div>
			<div class="col-md-12" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<td>Code</td>
						<td>Name</td>
						<td>Address</td>
						<td>Age</td>
						<td>DOB</td>
						<td>Sex</td>
						<td>Home Phone</td>
						<td>Mobile No</td>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $PersonalTrainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $PersonalTrainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($PersonalTrainer->Code); ?></td>
						<td><?php echo e($PersonalTrainer->Name); ?></td>
						<td><?php echo e($PersonalTrainer->Address); ?></td>
						<td><?php echo e($PersonalTrainer->Age); ?></td>
						<td><?php echo e($PersonalTrainer->DOB); ?></td>
						<td><?php echo e($PersonalTrainer->Sex); ?></td>
						<td><?php echo e($PersonalTrainer->HomePhone); ?></td>
						<td><?php echo e($PersonalTrainer->MobileNo); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
    </section>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection("content"); ?>
<section id="main-content">
    <section class="wrapper">
		<div class="row">
			<div class="col-md-12">
				<?php echo e(Form::open(array('url' =>'/StudentPaymentHistory',"class"=>"row", "method" => "GET"))); ?>

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
					<div class="col-md-3">
						<div class="form-group">
							<select name="StudentID" class="form-control" id="StudentID" onchange="this.form.submit();">
								<?php $__currentLoopData = $Students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($Student->ID); ?>"
								<?php if($Student->ID==$StudentID): ?>
									selected
								<?php endif; ?>
								><?php echo e($Student->Name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
				<?php echo e(Form::close()); ?>

			</div>
			<div class="col-md-12" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Payment Date</th>
						<th>Code</th>
						<th>Name</th>
						<th>Age</th>
						<th>DOB</th>
						<th>Sex</th>
						<th>Mobile No</th>
						<th>Work Place</th>
						<th>Designation</th>
						<th>Start Date</th>
						<th>Expiry Date</th>
						<th>Marital Status</th>
						<th>Package Name</th>
						<th>Duration</th>
						<th>Personal Trainer</th>
						<th>Program Fees</th>
						<th>PaidAmount</th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $Receipts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Receipt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Receipt->PaymentDate); ?></td>
						<td><?php echo e($Receipt->Code); ?></td>
						<td><?php echo e($Receipt->Name); ?></td>
						<td><?php echo e($Receipt->Age); ?></td>
						<td><?php echo e($Receipt->DOB); ?></td>
						<td><?php echo e($Receipt->Sex); ?></td>
						<td><?php echo e($Receipt->MobileNo); ?></td>
						<td><?php echo e($Receipt->WorkPlace); ?></td>
						<td><?php echo e($Receipt->Designation); ?></td>
						<td><?php echo e($Receipt->StartDate); ?></td>
						<td><?php echo e($Receipt->ExpiryDate); ?></td>
						<td><?php echo e($Receipt->MaritalStatus); ?></td>
						<td><?php echo e($Receipt->PackageName); ?></td>
						<td><?php echo e($Receipt->Duration); ?></td>
						<td><?php echo e($Receipt->PersonalTrainer); ?></td>
						<td><?php echo e($Receipt->ProgramFees); ?></td>
						<td><?php echo e($Receipt->PaidAmount); ?></td>
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
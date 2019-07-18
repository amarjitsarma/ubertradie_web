
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
              <?php echo e(Form::open(array('url' => '/UpdatePackage?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php else: ?>
				<?php echo e(Form::open(array('url' => '/SavePackage',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php endif; ?>
				<div class="col-md-3">
					<div class="form-group">
						<label>Package Name: </label>
						<input type="text" name="PackageName" class="form-control" value="<?php echo e($PackageName); ?>">
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label>Package Price: </label>
						<input type="text" name="Price" class="form-control" value="<?php echo e($Price); ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Personal Trainer Fees Per Month: </label>
						<input type="text" name="PersonalTrainer" class="form-control" value="<?php echo e($PersonalTrainer); ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Duration: </label>
						<select name="Duration" class="form-control">
							<?php for($i=1;$i<=12;$i++): ?>
							<option value="<?php echo e($i); ?>"
							<?php if($i==$Duration): ?>
								selected
							<?php endif; ?>
							><?php echo e($i); ?> Month</option>
							<?php endfor; ?>
						</select>
					</div>
				</div>	
				<div class="clearfix"></div>
				<div class="col-md-12">
					<?php echo e(Form::submit('Submit',array('class'=>'btn btn-info'))); ?>

				</div>
              <?php echo e(Form::close()); ?><!--/row -->
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>	
						<th>PackageName</th>
						<th>Package Price</th>
						<th>Personal Trainer Fees(P/M)</th>
						<th>Duration</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $Packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Package->PackageName); ?></td>
						<td><?php echo e($Package->Price); ?></td>
						<td><?php echo e($Package->PersonalTrainer); ?></td>
						<td><?php echo e($Package->Duration); ?></td>
						<td><a onclick="confirm('Are you sure?');" href="/DeletePackage?ID=<?php echo e($Package->ID); ?>">Delete</a></td>
						<td><a href="/Packages?ID=<?php echo e($Package->ID); ?>">Edit</a></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			  </div>
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
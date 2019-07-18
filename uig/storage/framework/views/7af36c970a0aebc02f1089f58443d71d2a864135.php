
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
              <?php echo e(Form::open(array('url' => '/UpdateLocation?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php else: ?>
				<?php echo e(Form::open(array('url' => '/SaveLocation',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php endif; ?>
				<div class="col-md-4">
					<div class="form-group">
						<label>Location Name: </label>
						<input type="text" onfocus="this.select();" name="LocationName" class="form-control" value="<?php echo e($LocationName); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Full Address: </label>
						<textarea class="form-control" onfocus="this.select();" name="FullAddress"><?php echo e($FullAddress); ?></textarea>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Contact No: </label>
						<input type="text" name="ContactNo" onfocus="this.select();" class="form-control" value="<?php echo e($ContactNo); ?>">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Email ID: </label>
						<input type="text" name="EmailID" onfocus="this.select();" class="form-control" value="<?php echo e($EmailID); ?>">
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
						<th>Location Name</th>
						<th>Full Address</th>
						<th>Contact No</th>
						<th>Email ID</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $Locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Location->LocationName); ?></td>
						<td><?php echo e($Location->FullAddress); ?></td>
						<td><?php echo e($Location->ContactNo); ?></td>
						<td><?php echo e($Location->EmailID); ?></td>
						<td><a onclick="confirm('Are you sure?');" href="/DeleteLocation?ID=<?php echo e($Location->ID); ?>">Delete</a></td>
						<td><a href="/Places?ID=<?php echo e($Location->ID); ?>">Edit</a></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			  </div>
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
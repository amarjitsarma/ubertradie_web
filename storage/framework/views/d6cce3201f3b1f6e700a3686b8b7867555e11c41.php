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
              <?php echo e(Form::open(array('url' => '/UpdateKeyword?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php else: ?>
				<?php echo e(Form::open(array('url' => '/SaveKeyword',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php endif; ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Keyword: </label>
						<input type="text" name="keyword" class="form-control" value="<?php echo e($keyword); ?>" required>
					</div>
				</div>	
				<div class="col-md-6">
					<br/>
					<?php echo e(Form::submit('Submit',array('class'=>'btn btn-info'))); ?>

				</div>
              <?php echo e(Form::close()); ?><!--/row -->
			 
			  <table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Keyword</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $Keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Keyword->keyword); ?></td>
						<td><a onclick="return confirm('Are you sure?');" href="/DeleteKeyword?ID=<?php echo e($Keyword->id); ?>">Delete</a></td>
						<td><a href="/Keywords?ID=<?php echo e($Keyword->id); ?>">Edit</a></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer"); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
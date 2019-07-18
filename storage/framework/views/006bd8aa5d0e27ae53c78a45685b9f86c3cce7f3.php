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
              <?php echo e(Form::open(array('url' => '/UpdateCategory?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php else: ?>
				<?php echo e(Form::open(array('url' => '/SaveCategory',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php endif; ?>
				<div class="col-md-4">
					<div class="form-group">
						<label>Category Name: </label>
						<input type="text" name="CategoryName" class="form-control" value="<?php echo e($CategoryName); ?>" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Thumbnail: </label>
						<input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Cover Photo: </label>
						<input type="file" name="cover_photo" class="form-control" accept=".jpg,.jpeg,.png">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Detail: </label>
						<textarea name="description" class="form-control" required><?php echo e($description); ?></textarea>
					</div>
				</div>
				
				<div class="clearfix"></div>
				<div class="col-md-12">
					<?php echo e(Form::submit('Submit',array('class'=>'btn btn-info'))); ?>

				</div>
              <?php echo e(Form::close()); ?><!--/row -->
			 
			  <table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>CategoryName</th>
						<th>Description</th>
						<th>Thumbnail</th>
						<th>Cover Photo</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $Categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Category->CategoryName); ?></td>
						<td><?php echo e($Category->description); ?></td>
						<td><img src="uploads/<?php echo e($Category->thumbnail); ?>" width="200px"></td>
						<td><img src="uploads/<?php echo e($Category->cover_photo); ?>" width="200px"></td>
						<td><a onclick="return confirm('Are you sure?');" href="/DeleteCategory?ID=<?php echo e($Category->ID); ?>">Delete</a></td>
						<td><a href="/Categories?ID=<?php echo e($Category->ID); ?>">Edit</a></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer"); ?>
<script>
function CheckAll()
{
	var x=document.getElementsByClassName("chk");
	for(var i=0;i<x.length;i++)
	{
		x[i].checked=true;
	}
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
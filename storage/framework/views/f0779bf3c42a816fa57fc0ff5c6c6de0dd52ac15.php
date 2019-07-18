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
              <?php echo e(Form::open(array('url' => '/UpdateSubCategory?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php else: ?>
				<?php echo e(Form::open(array('url' => '/SaveSubCategory',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php endif; ?>
				<div class="col-md-4">
					<div class="form-group">
						<label>Category: </label>
						<select name="CategoryID" class="form-control">
						<?php $__currentLoopData = $Categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($Category->ID); ?>"
							<?php if($CategoryID==$Category->ID): ?>
								selected
							<?php endif; ?>
							><?php echo e($Category->CategoryName); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Sub Category Name: </label>
						<input type="text" name="CategoryName" class="form-control" value="<?php echo e($SubCategoryName); ?>" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Icon: </label>
						<input type="file" name="Icon" class="form-control" accept=".jpg,.jpeg,.png">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Cover Photo: </label>
						<input type="file" name="cover_photo" class="form-control" accept=".jpg,.jpeg,.png">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Short Description: </label>
						<textarea name="short_desc" class="form-control" required><?php echo e($short_desc); ?></textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Description: </label>
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
						<th>Sub Category Name</th>
						<th>Icon</th>
						<th>Cover Photo</th>
						<th>Short Desc</th>
						<th>Description</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $SubCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $SubCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($SubCategory->SubCategoryName); ?></td>
						<td><img src="uploads/<?php echo e($SubCategory->Icon); ?>" width="200px"></td>
						<td><img src="uploads/<?php echo e($SubCategory->cover_photo); ?>" width="200px"></td>
						<td><?php echo e($SubCategory->short_desc); ?></td>
						<td><?php echo e($SubCategory->description); ?></td>
						<td><a onclick="return confirm('Are you sure?');" href="/DeleteCategory?ID=<?php echo e($SubCategory->ID); ?>">Delete</a></td>
						<td><a href="/Categories?ID=<?php echo e($SubCategory->ID); ?>">Edit</a></td>
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
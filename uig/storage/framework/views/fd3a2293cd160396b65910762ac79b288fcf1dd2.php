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
              <?php echo e(Form::open(array('url' => '/UpdateContact?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php else: ?>
				<?php echo e(Form::open(array('url' => '/SaveContact',"class"=>"row","enctype"=>"multipart/form-data"))); ?>

			<?php endif; ?>
				<div class="col-md-3">
					<div class="form-group">
						<label>Full Name: </label>
						<input type="text" name="FullName" class="form-control" value="<?php echo e($FullName); ?>">
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label>Contact No: </label>
						<input type="text" name="ContactNo" class="form-control" value="<?php echo e($ContactNo); ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Email ID: </label>
						<input type="text" name="EmailID" class="form-control" value="<?php echo e($EmailID); ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Detail: </label>
						<textarea name="Detail" class="form-control"><?php echo e($Detail); ?></textarea>
					</div>
				</div>
				
				<div class="clearfix"></div>
				<div class="col-md-12">
					<?php echo e(Form::submit('Submit',array('class'=>'btn btn-info'))); ?>

				</div>
              <?php echo e(Form::close()); ?><!--/row -->
			  <?php echo e(Form::open(array('url' => '/SendMessageToContact',"class"=>"row", "style"=>"overflow:scroll;"))); ?>

			  <div class="col-md-6">
				<div class="form-group">
					<label>Message</label>
					<textarea name="Message" class="form-control"></textarea>
				</div>
				</div>
			<div class="col-md-6">
				<br/>
				<a class="btn btn-danger" onclick="CheckAll();">Check All</a><br/><br/>
				<button type="submit" class="btn btn-info">Send Message To Selected</button>
			  </div>
			  <table class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Check</th>
						<th>Full Name</th>
						<th>Contact No</th>
						<th>Email ID</th>
						<th>Detail</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $Contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><input type="checkbox" class="chk" name="chkContact[]" id="chkContact[]" value="<?php echo e($Contact->ContactNo); ?>"></td>
						<td><?php echo e($Contact->FullName); ?></td>
						<td><?php echo e($Contact->ContactNo); ?></td>
						<td><?php echo e($Contact->EmailID); ?></td>
						<td><?php echo e($Contact->Detail); ?></td>
						<td><a onclick="return confirm('Are you sure?');" href="/DeleteContact?ID=<?php echo e($Contact->ID); ?>">Delete</a></td>
						<td><a href="/Contacts?ID=<?php echo e($Contact->ID); ?>">Edit</a></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			  <?php echo e(Form::close()); ?><!--/row -->
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
		alert("test1");
		x[i].checked=true;
		alert("test2");
	}
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
			<?php echo e(Form::open(array('url' => '/add/user','class'=>'row'))); ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('email','Email ID',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('email','',array('id'=>'email','class'=>'form-control','placeholder'=>'Email ID'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('first_name','First Name',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('first_name','',array('id'=>'first_name','class'=>'form-control','placeholder'=>'First Name'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('last_name','Last Name',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('last_name','',array('id'=>'last_name','class'=>'form-control','placeholder'=>'Last Name'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('dob','Date Of Birth',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('dob','',array('id'=>'dob','class'=>'form-control datepicker','placeholder'=>'YYYY-MM-DD'))); ?>

                        </div>
                    </div>
					<div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('phone','Phone No',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('phone','',array('id'=>'phone','class'=>'form-control','placeholder'=>'Phone No'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('username','User Name',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('username','',array('id'=>'username','class'=>'form-control','placeholder'=>'User Name'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('password','Password',array('id'=>'','class'=>''))); ?>

                            <input type="password" name="password" id="Password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('ConPassword','ConPassword',array('id'=>'','class'=>''))); ?>

                            <input type="password" name="password_confirmation" id="_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 15px;">
					<br>
                    <?php echo e(Form::submit('Submit',array('class'=>'btn btn-info'))); ?>

					<br>
                    </div>
                    <?php echo e(Form::close()); ?><!--/row -->
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
								<th>Email</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>DOB</th>
								<th>Phone</th>
								<th>User Name</th>
								<th>Status</th>
								<th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $Users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $User): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($User->email); ?></td>
								<td><?php echo e($User->first_name); ?></td>
								<td><?php echo e($User->last_name); ?></td>
								<td><?php echo e($User->dob); ?></td>
								<td><?php echo e($User->phone); ?></td>
								<td><?php echo e($User->username); ?></td>
								<td><?php if($User->status==1): ?>
									Active
									<?php else: ?>
									Inactive
									<?php endif; ?>
								</td>
                                <td><a onclick="return confirm('Are you sure');" href="/User/DeleteUser?ID=<?php echo e($User->id); ?>">Delete</a></td>
								<td><a onclick="return confirm('Are you sure');" href="/User/ChangeStatus?ID=<?php echo e($User->id); ?>">Change Status</a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
			  </div>
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
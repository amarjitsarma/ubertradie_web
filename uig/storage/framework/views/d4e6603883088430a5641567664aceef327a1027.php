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
                            <?php echo e(Form::label('FullName','Full Name',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('fullname','',array('id'=>'FullName','class'=>'form-control','placeholder'=>'Full Name'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('DOB','Date Of Birth',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('dob','',array('id'=>'DOB','class'=>'form-control datepicker','placeholder'=>'DOB'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('MobileNo','Mobile Number',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('phone','',array('id'=>'phone','class'=>'form-control','placeholder'=>'Mobile Number'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('EmailID','Email ID',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('email','',array('id'=>'EmailID','class'=>'form-control','placeholder'=>'Email ID'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('UserID','User ID',array('id'=>'','class'=>''))); ?> <?php echo e(Form::text('username','',array('id'=>'UserID','class'=>'form-control','placeholder'=>'User ID'))); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('Password','Password',array('id'=>'','class'=>''))); ?>

                            <input type="password" name="password" id="Password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('ConPassword','ConPassword',array('id'=>'','class'=>''))); ?>

                            <input type="password" name="password_confirmation" id="_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
					<div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('Location','Location',array('id'=>'','class'=>''))); ?>

                            <select name="location" class="form-control">
						<?php $__currentLoopData = $Locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($Location->ID); ?>" 
							
							><?php echo e($Location->LocationName); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
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
                                <th>Full Name</th>
                                <th>DOB</th>
                                <th>Mobile No</th>
                                <th>Email ID</th>
                                <th>User ID</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $Users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $User): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($User->fullname); ?></td>
                                <td><?php echo e($User->dob); ?></td>
                                <td><?php echo e($User->phone); ?></td>
                                <td><?php echo e($User->email); ?></td>
                                <td><?php echo e($User->username); ?></td>
                                <td><a onclick="return confirm('Are you sure');" href="/User/DeleteUser?ID=<?php echo e($User->id); ?>">Delete</a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
			  </div>
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
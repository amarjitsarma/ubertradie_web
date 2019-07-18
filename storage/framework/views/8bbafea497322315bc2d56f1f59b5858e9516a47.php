<?php $__env->startSection("content"); ?>
<section id="main-content">
          <section class="wrapper">
			<?php if(@UserType!="admin"): ?>
			  <div class="row">
				<a href="/StudentRegistration" class="btn btn-success">Add New Student</a>
			  </div>
			<?php endif; ?>
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Location</th>
						<th>Code</th>
						<th>Name</th>
						<th>Address</th>
						<th>Age</th>
						<th>DOB</th>
						<th>Sex</th>
						<th>Home Phone</th>
						<th>Mobile No</th>
						<th>Work Place</th>
						<th>Designation</th>
						<th>Emergency Person</th>
						<th>Emergency Contact No</th>	
						<th>How You Know</th>
						<th>Program</th>
						<th>StartDate</th>	
						<th>Expiry Date</th>
						<th>Marital Status</th>
						<th>Blood Group</th>
						<th>Any Medical History</th>
						<th>Personal Trainer</th>
						<th>Program Fees</th>
						<th>Personal Trainer Fees</th>
						<?php if($UserType=="admin"): ?>
						<th>Delete</th>
						<th>Edit</th>
						<?php endif; ?>
						<th>Upgrade</th>
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $Students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Student->LocationName); ?></td>
						<td><?php echo e($Student->Code); ?></td>
						<td><?php echo e($Student->Name); ?></td>
						<td><?php echo e($Student->Address); ?></td>
						<td><?php echo e($Student->Age); ?></td>
						<td><?php echo e($Student->DOB); ?></td>
						<td><?php echo e($Student->Sex); ?></td>
						<td><?php echo e($Student->HomePhone); ?></td>
						<td><?php echo e($Student->MobileNo); ?></td>
						<td><?php echo e($Student->WorkPlace); ?></td>
						<td><?php echo e($Student->Designation); ?></td>
						<td><?php echo e($Student->EmergencyPerson); ?></td>
						<td><?php echo e($Student->EmergencyContactNo); ?></td>
						<td><?php echo e($Student->HowYouKnow); ?></td>
						<td><?php echo e($Student->PackageName); ?></td>
						<td><?php echo e($Student->StartDate); ?></td>
						<td><?php echo e($Student->ExpiryDate); ?></td>
						<td><?php echo e($Student->MaritalStatus); ?></td>
						<td><?php echo e($Student->BloodGroup); ?></td>
						<td><?php echo e($Student->AnyMedicalHistory); ?></td>
						<td><?php echo e($Student->PersonalTrainer); ?></td>
						<td><?php echo e($Student->ProgramFees); ?></td>
						<td><?php echo e($Student->PersonalTrainerFees); ?></td>
						<?php if($UserType=="admin"): ?>
						<td><a onclick="confirm('Are you sure?');" href="/DeleteStudent?ID=<?php echo e($Student->ID); ?>">Delete</a></td>
						<td><a href="/StudentRegistration?ID=<?php echo e($Student->ID); ?>">Edit</a></td>
						<?php endif; ?>
						<td><a href="/StudentUpgrade?ID=<?php echo e($Student->ID); ?>&PlaceID=<?php echo e($Student->PlaceID); ?>">Upgrade</a></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			  </div>
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
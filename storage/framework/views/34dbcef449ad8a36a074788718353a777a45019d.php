<?php $__env->startSection("content"); ?>
<section id="main-content">
          <section class="wrapper">
			  <div class="row">
				<a href="/StaffRegistration" class="btn btn-success">Add New Staff</a>
			  </div>
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
						<th>Mobile No</th>
						<th>Designation</th>
						<th>Emergency Person</th>
						<th>Emergency Contact No</th>	
						<th>Joining Date</th>	
						<th>Marital Status</th>
						<th>Blood Group</th>
						<th>Any Medical History</th>
						<th>Salary</th>
						<th>Absent Penalty</th>
						<th>Total Duty Days</th>
						<?php if($UserType=="admin"): ?>
						<th>Delete</th>
						<th>Edit</th>
						<?php endif; ?>
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					<?php $__currentLoopData = $Staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Staff->LocationName); ?></td>
						<td><?php echo e($Staff->Code); ?></td>
						<td><?php echo e($Staff->Name); ?></td>
						<td><?php echo e($Staff->Address); ?></td>
						<td><?php echo e($Staff->Age); ?></td>
						<td><?php echo e($Staff->DOB); ?></td>
						<td><?php echo e($Staff->Sex); ?></td>
						<td><?php echo e($Staff->MobileNo); ?></td>
						<td><?php echo e($Staff->Designation); ?></td>
						<td><?php echo e($Staff->EmergencyPerson); ?></td>
						<td><?php echo e($Staff->EmergencyContactNo); ?></td>
						<td><?php echo e($Staff->JoiningDate); ?></td>
						<td><?php echo e($Staff->MaritalStatus); ?></td>
						<td><?php echo e($Staff->BloodGroup); ?></td>
						<td><?php echo e($Staff->AnyMedicalHistory); ?></td>
						<td><?php echo e($Staff->Salary); ?></td>
						<td><?php echo e($Staff->AbsentPenalty); ?></td>
						<td><?php echo e($Staff->WorkDays); ?></td>
						<?php if($UserType=="admin"): ?>
						<td><a onclick="confirm('Are you sure?');" href="/DeleteStaff?ID=<?php echo e($Staff->ID); ?>">Delete</a></td>
						<td><a href="/StaffRegistration?ID=<?php echo e($Staff->ID); ?>">Edit</a></td>
						<?php endif; ?>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			  </div>
          </section>
      </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
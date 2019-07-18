<?php $__env->startSection("content"); ?>
<section id="main-content">
    <section class="wrapper">
		<div class="row">
			<h2>About to expire</h2>
			<div class="col-md-12" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Location Name</th>
						<th>Code</th>
						<th>Name</th>
						<th>Address</th>
						<th>Age</th>
						<th>DOB</th>
						<th>Sex</th>
						<th>Mobile No</th>
						<th>Start Date</th>
						<th>Expiry Date</th>
						<th>Marital Status</th>
						<th>Blood Group</th>
						<th>Personal Trainer</th>
						<th>Program Fees</th>
						<th>Personal Trainer Fees</th>
						<th>Package Name</th>			
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					<?php $__currentLoopData = $Expiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Expiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($Expiry->LocationName); ?></td>
						<td><?php echo e($Expiry->Code); ?></td>
						<td><?php echo e($Expiry->Name); ?></td>
						<td><?php echo e($Expiry->Address); ?></td>
						<td><?php echo e($Expiry->Age); ?></td>
						<td><?php echo e($Expiry->DOB); ?></td>
						<td><?php echo e($Expiry->Sex); ?></td>
						<td><?php echo e($Expiry->MobileNo); ?></td>
						<td><?php echo e($Expiry->StartDate); ?></td>
						<td><?php echo e($Expiry->ExpiryDate); ?></td>
						<td><?php echo e($Expiry->MaritalStatus); ?></td>
						<td><?php echo e($Expiry->BloodGroup); ?></td>
						<td><?php echo e($Expiry->PersonalTrainer); ?></td>
						<td><?php echo e($Expiry->ProgramFees); ?></td>
						<td><?php echo e($Expiry->PersonalTrainerFees); ?></td>
						<td><?php echo e($Expiry->PackageName); ?></td>		
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo e(Form::open(array('url' =>'/GetStaffSalary',"class"=>"row", "method" => "GET"))); ?>

					Staff Salary:<hr/>
					<div class="col-md-3">
						<div class="form-group">
							<select name="Year" class="form-control">
								<?php $__currentLoopData = $Years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($Year); ?>"><?php echo e($Year); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="Month" class="form-control">
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="PlaceID" class="form-control" id="PlaceID" onchange="GetStaffs();">
							<?php if($UserType=="admin"): ?>
								<?php $__currentLoopData = $Locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($Location->ID); ?>"><?php echo e($Location->LocationName); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<?php $__currentLoopData = $Locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($Location->ID==$LocationID): ?>
									<option value="<?php echo e($Location->ID); ?>"><?php echo e($Location->LocationName); ?></option>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="StaffID" class="form-control" id="StaffID">
							
							</select>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12">
						<?php echo e(Form::submit('Download Salary Slip',array('class'=>'btn btn-info'))); ?>

					</div>
				<?php echo e(Form::close()); ?>

			</div>
			<div class="col-md-12">
				<?php echo e(Form::open(array('url' =>'/GetStudentReceipt',"class"=>"row", "method" => "GET"))); ?>

					Student Payment:<hr/>
					<div class="col-md-3">
						<div class="form-group">
							<select name="StudentID" class="form-control" id="StudentID">
							
							</select>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12">
						<?php echo e(Form::submit('Download Admission Receipt',array('class'=>'btn btn-info'))); ?>

					</div>
				<?php echo e(Form::close()); ?>

			</div>
		</div>
    </section>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer"); ?>
<script>
$(document).ready(function(){
	GetStudents();
	GetStaffs();
});
function GetStudents()
{
	$.ajax({
		url:"/GetStudentsByPlaceJSON",
		data:{"PlaceID":document.getElementById("PlaceID").value},
		dataType:"JSON",
		success:function(data)
		{
			var ddl=document.getElementById("StudentID");
			ddl.options.length = 0;
			for(var i=0;i<data.length;i++)
			{
				var val=data[i].ID;
				var title=data[i].Name;
				ddl.options[ddl.options.length] = new Option(title, val);
			}
		},
		error:function()
		{
			
		}
	});
}
function GetStaffs()
{
	$.ajax({
		url:"/GetStaffByPlaceJSON",
		data:{"PlaceID":document.getElementById("PlaceID").value},
		dataType:"JSON",
		success:function(data)
		{
			var ddl=document.getElementById("StaffID");
			ddl.options.length = 0;
			for(var i=0;i<data.length;i++)
			{
				var val=data[i].ID;
				var title=data[i].Name;
				ddl.options[ddl.options.length] = new Option(title, val);
			}
		},
		error:function()
		{
			
		}
	});
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
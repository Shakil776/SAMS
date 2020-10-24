<?php 
	include 'inc/header.php'; 
	include 'lib/Student.php'; 
	$stu = new Student();
?>
  				
<div class="card">
	<div class="card-header">
		<div class="row">
			
			<div class="col-sm-4">
				<div class="text-left">
					<a href="add-student.php" class="btn btn-info btn-sm">Add Student</a>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="text-center">
					<h3><strong>Date:&nbsp;</strong><?php echo date("F j, Y"); ?></h3>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="text-right">
					<a href="index.php" class="btn btn-primary btn-sm">Take Attendance</a>
				</div>
			</div>
			
		</div>
	</div>

	<div class="card-body">

		<form action="" method="post">

			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white text-center">
						<th width="15%">#</th>
						<th width="60%%">Attendance Date</th>
						<th width="25%">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php 
						$getDates = $stu->getDates();
						if (!empty($getDates)) {
							$i = 1;
							while ($data = $getDates->fetch_assoc()) {
					?>
						<tr class="text-center">
							<td><?php echo $i++; ?></td>
							<td><?php echo $data['attend_time']; ?></td>
							<td>
								<a href="view-attendance-details.php?date=<?php echo $data['attend_time']; ?>" class="btn btn-success">View</a>
							</td>
						</tr>
					<?php } } ?>

				</tbody>

			</table>
		</form>
	</div>

<?php include 'inc/footer.php'; ?>

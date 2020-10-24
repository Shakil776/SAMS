<?php 
	include 'inc/header.php'; 
	include 'lib/Student.php'; 
	$stu = new Student();
?>

<?php 
	if (isset($_GET['date']) && !empty($_GET['date'])) {
		$date = $_GET['date'];
	}
 ?>

<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['update'])) {
		$attend = $_POST['attend'];
		$updatedAttend = $stu->updateAttend($attend, $date);
	}
?>

<?php 
 	if (isset($updatedAttend)) {
 		echo "<div id='remove_message'>$updatedAttend</div>";
 	}
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
					<h3><strong>Date:&nbsp;</strong><?php echo $date; ?></h3>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="text-right">
					<a href="view-attendance.php" class="btn btn-primary btn-sm">Back</a>
				</div>
			</div>
			
		</div>
	</div>

	<div class="card-body">

		<form action="" method="post">

			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white text-center">
						<th width="10%">#</th>
						<th width="25%">Name</th>
						<th width="25%">Mobile</th>
						<th width="15%">Roll</th>
						<th width="25%">Attendance</th>
					</tr>
				</thead>

				<tbody>
					<?php 
						$allData = $stu->getAllData($date);
						if (!empty($allData)) {
							$i = 1;
							while ($data = $allData->fetch_assoc()) {
					?>
						<tr class="text-center">
							<td><?php echo $i++; ?></td>
							<td><?php echo $data['name']; ?></td>
							<td><?php echo $data['mobile']; ?></td>
							<td><?php echo $data['roll']; ?></td>
							<td>
								<input type="radio" required name="attend[<?php echo $data['roll']; ?>]" value="present" <?php echo ($data['attend'] == 'present') ? 'checked' : ''; ?>>&nbsp;P
								<input type="radio" required name="attend[<?php echo $data['roll']; ?>]" value="absent" <?php echo ($data['attend'] == 'absent') ? 'checked' : ''; ?>>&nbsp;A
							</td>
						</tr>
					<?php } } ?>

				</tbody>

			</table>

			    <div class="col-12">
			        <input type="submit" class="btn btn-success mx-auto d-block" name="update" value="Update">
			    </div>
			
		</form>
	</div>


<?php include 'inc/footer.php'; ?>

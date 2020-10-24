<?php 
	include 'inc/header.php'; 
	include 'lib/Student.php'; 
	$stu = new Student();
?>

<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['add-student'])) {
		$insertedData = $stu->insertStudentInfo($_POST);
	}
?>

<?php 
 	if (isset($insertedData)) {
 		echo "<div id='remove_message'>$insertedData</div>";
 	}
?>
   				
<div class="card">
	<div class="card-header">
		<div class="row">
			
			<div class="col-sm-4">
				<div class="text-left">
					<a href="index.php" class="btn btn-info btn-sm">Back</a>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="text-center">
					<h3><strong>Date:&nbsp;</strong><?php echo date("F j, Y"); ?></h3> 
				</div>
			</div>

			<div class="col-sm-4">
				<div class="text-right">
					
				</div>
			</div>
			
		</div>
	</div>

	<div class="card-body">

		<div class="col-sm-6 middle">

			<form method="post">

				<div class="form-group">
					<label>Name <span class="text-danger">*</span></label>
					<input type="text" name="name" id="name" class="form-control" placeholder="Enter Student Name" autocomplete="off" required>
				</div>

				<div class="form-group">
					<label>Mobile <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Student Mobile" autocomplete="off" required>
				</div>


				<div class="form-group">
					<label>Roll <span class="text-danger">*</span></label>
					<input type="text" name="roll" id="roll" class="form-control" placeholder="Enter Student Roll" autocomplete="off" required>
				</div>

				<div class="form-group">
					<input type="submit" name="add-student" id="add-student" class="btn btn-primary" value="Add Student">
				</div>

			</form>

		</div>

	</div>

<?php include 'inc/footer.php'; ?>

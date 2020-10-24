<?php 
	include 'Database.php';
	error_reporting(0);

	class Student {
		private $db;
		
		public function __construct(){
			$this->db = new Database();
		}

		// get all students
		public function getStudents(){
			$query = "SELECT * FROM tbl_student ORDER BY roll ASC";
			$result = $this->db->select($query);
			return $result;
		}

		// insert student info
		public function insertStudentInfo($data){
			$name = trim($data['name']);
			$mobile = trim($data['mobile']);
			$roll = trim($data['roll']);

			if (empty($name) || empty($mobile) || empty($roll)) {
				$msg = '<div class="alert alert-danger text-center"><strong>Error: </strong>Field Must Not be Empty.</div>';
				return $msg;
			} else {
				$stu_query = "INSERT INTO tbl_student(name, mobile, roll) VALUES('$name', '$mobile', '$roll')";
				$stu_insert = $this->db->insert($stu_query);

				$attend_query = "INSERT INTO tbl_attendance(roll) VALUES('$roll')";
				$stu_insert = $this->db->insert($attend_query);

				if ($stu_insert) {
					$msg = '<div class="alert alert-success text-center"><strong>Success: </strong>Student Data Inserted Successfully.</div>';
					return $msg;
				} else {
					$msg = '<div class="alert alert-danger text-center"><strong>Error: </strong>Student Data Not Inserted.</div>';
					return $msg;
				}
			}
		}

		// insert student attendance
		public function insertAttend($attend = array()){
			$currDate = date('Y-m-d');
			$query = "SELECT DISTINCT attend_time FROM tbl_attendance";
			$getDate = $this->db->select($query);
			
			while ($result = $getDate->fetch_assoc()) {
				$dbDate = $result['attend_time'];

				if ($currDate == $dbDate) {
					$msg = '<div class="alert alert-danger text-center"><strong>Error: </strong>Attendance already taken today.</div>';
					return $msg;
				}
			}
			
			foreach ($attend as $atn_key => $atn_value) {

				if ($atn_value == 'present') {
					$query = "INSERT INTO tbl_attendance(roll, attend, attend_time) VALUES('$atn_key', 'present', now())";
					$attendInsert = $this->db->insert($query);
				} else if($atn_value == 'absent') {
					$query = "INSERT INTO tbl_attendance(roll, attend, attend_time) VALUES('$atn_key', 'absent', now())";
					$attendInsert = $this->db->insert($query);
				}
			}

			if ($attendInsert) {
				$msg = '<div class="alert alert-success text-center"><strong>Success: </strong>Attendance Taken Successfully.</div>';
				return $msg;
			} else {
				$msg = '<div class="alert alert-danger text-center"><strong>Error: </strong>Attendance Not Taken Today.</div>';
				return $msg;
			}

		}

		// get dates
		public function getDates(){
			$query = "SELECT DISTINCT attend_time FROM tbl_attendance ORDER BY attend_time ASC";
			$result = $this->db->select($query);
			return $result;
		}

		// view student attendance details by date
		public function getAllData($date){
			$query = "SELECT tbl_student.name, tbl_student.mobile, tbl_attendance.* FROM tbl_student INNER JOIN tbl_attendance ON tbl_student.roll = tbl_attendance.roll WHERE attend_time = '$date' ORDER By roll ASC";
			$result = $this->db->select($query);
			return $result;
		}

		// update attendance
		public function updateAttend($attend = array(), $date){

			foreach ($attend as $atn_key => $atn_value) {

				if ($atn_value == 'present') {
					$query = "UPDATE tbl_attendance SET attend = 'present' WHERE roll = '$atn_key' AND attend_time = '$date'";
					$attendUpdate = $this->db->update($query);
				} else if($atn_value == 'absent') {
					$query = "UPDATE tbl_attendance SET attend = 'absent' WHERE roll = '$atn_key' AND attend_time = '$date'";
					$attendUpdate = $this->db->update($query);
				}
			}

			if ($attendUpdate) {
				$msg = '<div class="alert alert-success text-center"><strong>Success: </strong>Attendance Data Updated Successfully.</div>';
				return $msg;
			} else {
				$msg = '<div class="alert alert-danger text-center"><strong>Error: </strong>Attendance Data Not Updated.</div>';
				return $msg;
			}
		}




	}
 ?>
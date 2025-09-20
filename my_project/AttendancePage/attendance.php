<?php
// header("Refresh:5");

class Database
{
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $dbname = "my_project";
	private $conn;
	public function connect()
	{
		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

		if ($this->conn->connect_error) {
			die("DB Connection failed: " . $this->conn->connect_error);
		}
		return $this->conn;
	}
}
class Attendance
{
	private $conn;
	public function __construct($db)
	{
		$this->conn = $db;
	}
	public function getAll($search = null)
	{
		$sql = "SELECT
                    a.id AS attendance_id,
                    r.id AS registration_id,
                    r.name,
                    r.department,
                    d.department_name,
                    a.date,
                    a.in_date,
                    a.in_time,
                    a.out_date,
                    a.out_time
                FROM attendance a
                JOIN registration r
                ON a.registration_id = r.id
                LEFT JOIN department d ON r.department = d.id";
		if (!empty($search)) {
			$sql .= " WHERE r.name LIKE ?";
		}
		$sql .= " ORDER BY a.date ASC";
		$stmt = $this->conn->prepare($sql);
		if (!empty($search)) {
			$like = "%$search%";
			$stmt->bind_param("s", $like);
		}
		$stmt->execute();
		return $stmt->get_result();
	}
}


$database = new Database();
$db = $database->connect();
$attendance = new Attendance($db);
$search = isset($_GET['search']) ? $_GET['search'] : '';
$result = $attendance->getAll($search);
date_default_timezone_set('Asia/Karachi');
$message = "";

// OUT Attendance (roll_no)
if (isset($_POST['btn']) && isset($_POST['roll_no']) && !empty($_POST['roll_no'])) {
	$roll_no = trim($_POST['roll_no']);
	date_default_timezone_set('Asia/Karachi');

	$check_sql = "SELECT COUNT(*) FROM registration WHERE id = ?";
	$check_stmt = $db->prepare($check_sql);
	$check_stmt->bind_param("i", $roll_no);
	$check_stmt->execute();
	$check_stmt->bind_result($count);
	$check_stmt->fetch();
	$check_stmt->close();

	if ($count == 0) {
		$message = "<p style='color:red;'> Roll No $roll_no does not exist in registration!</p>";
	} else {
		$check_att_sql = "SELECT COUNT(*) FROM attendance WHERE registration_id = ?";
		$check_att_stmt = $db->prepare($check_att_sql);
		$check_att_stmt->bind_param("i", $roll_no);
		$check_att_stmt->execute();
		$check_att_stmt->bind_result($att_count);
		$check_att_stmt->fetch();
		$check_att_stmt->close();

		if ($att_count == 0) {
			$date = date('Y-m-d');
			$in_date = null;
			$in_time = null;
			$out_date = date('Y-m-d');
			$out_time = date('H:i:s');
			$out_time_display = date('g:i:s A');

			$sql = "INSERT INTO attendance (registration_id, date, in_date, in_time, out_date, out_time) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($sql);
			$stmt->bind_param("isssss", $roll_no, $date, $in_date, $in_time, $out_date, $out_time);
			if ($stmt->execute()) {
				// Insert also into full_attendance
				$sql2 = "INSERT INTO full_attendance (registration_id, date, in_date, in_time, out_date, out_time) 
                         VALUES (?, ?, ?, ?, ?, ?)";
				$stmt2 = $db->prepare($sql2);
				$stmt2->bind_param("isssss", $roll_no, $date, $in_date, $in_time, $out_date, $out_time);
				$stmt2->execute();

				$message = "<p style='color:green;'> New attendance record created for Roll No $roll_no OUT → $out_date $out_time_display</p>";
			}
		} else {
			$out_date = date('Y-m-d');
			$out_time_db = date('H:i:s');
			$out_time_display = date('g:i:s A');

			$sql = "UPDATE attendance SET out_date = ?, out_time = ? WHERE registration_id = ?";
			$stmt = $db->prepare($sql);
			$stmt->bind_param("ssi", $out_date, $out_time_db, $roll_no);
			if ($stmt->execute()) {
				if ($stmt->affected_rows > 0) {
					// Insert also into full_attendance
					$sql2 = "INSERT INTO full_attendance (registration_id, date, in_date, in_time, out_date, out_time)
                             VALUES (?, ?, ?, ?, ?, ?)";
					$stmt2 = $db->prepare($sql2);
					$out_date_var = $out_date;
					$null_var1 = null;
					$null_var2 = null;
					$out_time_db_var = $out_time_db;
					$stmt2->bind_param("isssss", $roll_no, $out_date_var, $null_var1, $null_var2, $out_date_var, $out_time_db_var);
					$stmt2->execute();

					$message = "<p style='color:;'> Roll No $roll_no OUT marked → $out_date $out_time_display</p>";
				} else {
					$message = "<p style='color:orange;'> Roll No $roll_no not found in attendance!</p>";
				}
			} else {
				$message = "<p style='color:red;'> Failed to update record</p>";
			}
		}
	}
}

// IN Attendance (rollno)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rollno']) && !empty($_POST['rollno'])) {
	$rollno = trim($_POST['rollno']);

	$check_sql = "SELECT COUNT(*) FROM registration WHERE id = ?";
	$check_stmt = $db->prepare($check_sql);
	$check_stmt->bind_param("i", $rollno);
	$check_stmt->execute();
	$check_stmt->bind_result($count);
	$check_stmt->fetch();
	$check_stmt->close();

	if ($count == 0) {
		$message = "<p style='color:red;'> Roll No $rollno does not exist in registration!</p>";
	} else {
		$check_att_sql = "SELECT COUNT(*) FROM attendance WHERE registration_id = ?";
		$check_att_stmt = $db->prepare($check_att_sql);
		$check_att_stmt->bind_param("i", $rollno);
		$check_att_stmt->execute();
		$check_att_stmt->bind_result($att_count);
		$check_att_stmt->fetch();
		$check_att_stmt->close();

		if ($att_count == 0) {
			$date = date('Y-m-d');
			$in_date = date('Y-m-d');
			$in_time = date('H:i:s');
			$in_time_display = date('g:i:s A');
			$out_date = null;
			$out_time = null;

			$sql = "INSERT INTO attendance (registration_id, date, in_date, in_time, out_date, out_time) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($sql);
			$stmt->bind_param("isssss", $rollno, $date, $in_date, $in_time, $out_date, $out_time);
			if ($stmt->execute()) {
				// Insert also into full_attendance
				$sql2 = "INSERT INTO full_attendance (registration_id, date, in_date, in_time, out_date, out_time) 
                         VALUES (?, ?, ?, ?, ?, ?)";
				$stmt2 = $db->prepare($sql2);
				$stmt2->bind_param("isssss", $rollno, $date, $in_date, $in_time, $out_date, $out_time);
				$stmt2->execute();

				$message = "<p style='color:green;'> New attendance record created for Roll No $rollno IN → $in_date $in_time_display</p>";
			}
		} else {
			$in_date = date("Y-m-d");
			$in_time_db = date("H:i:s");
			$in_time_display = date('g:i:s A');

			$sql = "UPDATE attendance SET in_date = ?, in_time = ? WHERE registration_id = ?";

			$stmt = $db->prepare($sql);
			$stmt->bind_param("ssi", $in_date, $in_time_db, $rollno);
			if ($stmt->execute() && $stmt->affected_rows > 0) {
				// Insert also into full_attendance
				$sql2 = "INSERT INTO full_attendance (registration_id, date, in_date, in_time, out_date, out_time) 
                         VALUES (?, ?, ?, ?, ?, ?)";
				$stmt2 = $db->prepare($sql2);
				$in_date_var = $in_date;
				$in_time_db_var = $in_time_db;
				$null_var1 = null;
				$null_var2 = null;
				$stmt2->bind_param("isssss", $rollno, $in_date_var, $in_date_var, $in_time_db_var, $null_var1, $null_var2);
				$stmt2->execute();

				$message = "<p style='color:weight;'> Roll No $rollno IN marked → $in_date $in_time_display</p>";
			} else {
				$message = "<p style='color:red;'> Roll No not found in attendance!</p>";
			}
		}
	}
}

// IN Attendance (registration_id)
if (isset($_POST['btn']) && isset($_POST['registration_id']) && !empty($_POST['registration_id'])) {
	$registration_id = trim($_POST['registration_id']);

	$check_sql = "SELECT COUNT(*) FROM registration WHERE id = ?";
	$check_stmt = $db->prepare($check_sql);
	$check_stmt->bind_param("i", $registration_id);
	$check_stmt->execute();
	$check_stmt->bind_result($count);
	$check_stmt->fetch();
	$check_stmt->close();

	if ($count == 0) {
		$message = "<p style='color:red;'> Registration ID $registration_id does not exist!</p>";
	} else {
		$check_att_sql = "SELECT COUNT(*) FROM attendance WHERE registration_id = ?";
		$check_att_stmt = $db->prepare($check_att_sql);
		$check_att_stmt->bind_param("i", $registration_id);
		$check_att_stmt->execute();
		$check_att_stmt->bind_result($att_count);
		$check_att_stmt->fetch();
		$check_att_stmt->close();
	}
	if ($att_count == 0) {
		$date      = date('Y-m-d');
		$in_date   = date('Y-m-d');
		$in_time   = date('H:i:s');
		$out_date  = null;
		$out_time  = null;

		$sql = "INSERT INTO attendance (registration_id, date, in_date, in_time, out_date, out_time)
                    VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param("isssss", $registration_id, $date, $in_date, $in_time, $out_date, $out_time);
		if ($stmt->execute()) {
			// Insert also into full_attendance
			$sql2 = "INSERT INTO full_attendance (registration_id, date, in_date, in_time, out_date, out_time) 
                         VALUES (?, ?, ?, ?, ?, ?)";
			$stmt2 = $db->prepare($sql2);
			$stmt2->bind_param("isssss", $registration_id, $date, $in_date, $in_time, $out_date, $out_time);
			$stmt2->execute();

			$message = "<p style='color:weight;'> Attendance inserted for Registration ID $registration_id → $date $in_time</p>";
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Attendance Regularization</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
	<link rel="stylesheet" href="attend.css" />
</head>
<style>
</style>

<body>
	<header class="mt-4 header">
		<div class="topbar d-flex justify-content-between align-items-center ">

			<div class="intro-image">
				<img src="Agricultural_University_Peshawar_logo.png" alt="Mian umar" />
			</div>
			<div class="search_div">
				<form action="" method="get">
					<input type="search" placeholder="search" name="search" id="search" class="search_sr" value="<?php echo htmlspecialchars($search); ?>">
					<button type="submit" class="btn search_btn">search</button>
				</form>
			</div>
		</div>

		<div class="message text-end p-end-2">
			<?php echo $message; ?>
		</div>
	</header>
	<div class="row offrow ">
		<button
			class="btn  btn-offcanvas"
			data-bs-toggle="offcanvas"
			data-bs-target="#two"
			type="button">
			<i class="fas fa-bars">menu</i>
		</button>
		<div class="offcanvas offcanvas-start offcanvas-custom" id="two">
			<div class="offcanvas-header">
				<div class="profile_minu">
					<h5 class="offcanvas-title  one">profile</h5>
				</div>
				<button
					type="button"
					class="btn-close text-reset"
					data-bs-dismiss="offcanvas"></button>
			</div>
			<div class="offcanvas-body">

				<div>
					<form action="../sess_destroy.php" method="post">
						<button type="submit" class="btn_destory ">Log out</button>
					</form>
				</div>

			</div>
		</div>
	</div>
	<div class="container">
		<div class="main-content flex-grow-1">
			<div class="card card_bar">
				<div class="attendance_div">
					<h4 class="attendace">Attendance Regularization</h4>
				</div>
				<div class="a">
					<div>
						<form action="" method="post">
							<input type="number" placeholder="In Date & In Time" name="rollno" class="rollno" />
							<button type="submit" class="btn">submit</button>
						</form>
					</div>

					<div>
						<form action="" method="post">
							<input type="text" placeholder="Out Date & Out Time" name="roll_no" id="search" class="search">
							<button type="submit" name="btn" class="btn">submit</button>
						</form>
					</div>
					<div>
						<form action="" method="post">
							<input type="number" name="registration_id" placeholder="Enter Registration ID" class="search">
							<button type="submit" name="btn" class="btn">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<form action="attend.php" method="get">
				<table class="table table-bordered table-hover align-middle">
					<thead class="table-light">
						<tr class="">
							<th>Roll no</th>
							<th>Name</th>
							<th>Department</th>
							<th>Date</th>
							<th>In Date</th>
							<th>In Time</th>
							<th>Out Date</th>
							<th>Out Time</th>
							<th>view</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($result) {
							while ($row = $result->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $row['attendance_id'] ?></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['department_name']; ?></td>
									<td><?php echo $row['date']; ?></td>
									<td><?php echo $row['in_date']; ?></td>
									<td title="<?php echo !empty($row['in_time']) ? $row['in_time'] : ''; ?>"><?php echo !empty($row['in_time']) ? date('g:i A', strtotime($row['in_time'])) : ''; ?></td>
									<td><?php echo !empty($row['out_date']) ? $row['out_date'] : ''; ?></td>
									<td title="<?php echo !empty($row['out_time']) ? $row['out_time'] : ''; ?>"><?php echo !empty($row['out_time']) ? date('g:i A', strtotime($row['out_time'])) : ''; ?></td>
									<td><a href="view.php?id=<?php echo $row['attendance_id']; ?>" class="btn btn-view">View</a></td>
								</tr>
						<?php }
						} ?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
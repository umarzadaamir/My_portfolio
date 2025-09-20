<?php
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

$database = new Database();
$db = $database->connect();


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT
                a.id AS attendance_id,
                a.registration_id AS registration_id,
                r.name,
                r.fathername,
                c.country_name AS country,
                p.province_name AS province,
                r.department,
                d.department_name AS department_name,
                dist.district_name AS district_name,
                t.tehsil_name AS tehsil_name,
                a.in_date,
                a.in_time,
                a.out_date,
                a.out_time
            FROM attendance a
            JOIN registration r ON a.registration_id = r.id
            LEFT JOIN country c ON r.country = c.country_id
            LEFT JOIN province p ON r.province = p.province_id
            LEFT JOIN department d ON r.department = d.id
                LEFT JOIN district dist ON r.district = dist.district_id
                LEFT JOIN tehsil t ON r.tehsil = t.tehsil_id
                WHERE a.id = $id";

    $result = $db->query($sql);
} else {
    die("No user selected.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Person Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="attend.css" />
    <link rel="stylesheet" href="view.css" />
</head>
<style>
   
</style>

<body class="p-4">
    <div class="text-center">
        <h2>Picture</h2>
    </div>
    <div class="profile">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="text-center mb-3">
                <?php
                $profilePic = "default_avatar.png";
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
                    $targetDir = "pic/";
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    $fileName = time() . "_" . basename($_FILES["profile_pic"]["name"]);
                    $targetFile = $targetDir . $fileName;

                    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFile)) {
                        $profilePic = $targetFile;
                    } else {
                        echo "<span style='color:red;'>Error uploading file.</span>";
                    }
                }
                ?>
                <img id="preview" src="<?php echo $profilePic; ?>" class="img-fluid rounded-circle" style="width:150px; height:150px; object-fit:cover;" alt="Profile" />
            </div>
            <div class="profile_full_div justify-content-center">
                <input type="file" accept="image/*" class="form-control mb-3 pic_select" name="profile_pic" required />
                <button type="submit" class="btn btn_uplode pic_btn">Upload</button>
            </div>
        </form>
    </div>
    <div class="container">
        <h3 class="mb-3 attendance">User Attendance Record</h3>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Roll no</th>
                    <th>Name</th>
                    <th>father name</th>
                    <th>country</th>
                    <th>province</th>
                    <th>District</th>
                    <th>Tehsil</th>
                    <th>Department</th>
                    <th>In Date</th>
                    <th>In Time</th>
                    <th>Out Date</th>
                    <th>Out Time</th>
                    <th>view all attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>

                            <td><?php echo $row['attendance_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['fathername']; ?></td>
                            <td><?php echo $row['country']; ?></td>
                            <td><?php echo $row['province']; ?></td>
                            <td><?php echo $row['district_name']; ?></td>
                            <td><?php echo $row['tehsil_name']; ?></td>
                            <td><?php echo $row['department_name']; ?></td>

                            <td><?php echo $row['in_date']; ?></td>
                            <td title="<?php echo $row['in_time']; ?>"><?php echo date('g:i A', strtotime($row['in_time'])); ?></td>
                            <td><?php echo $row['out_date']; ?></td>
                            <td title="<?php echo $row['out_time']; ?>"><?php echo date('g:i A', strtotime($row['out_time'])); ?></td>
                            <td><a href="../viewa_all_usre_data/all_data.php?id=<?php echo $row['registration_id']; ?>" class="btn btn-view">View</a></td>

                        </tr>
                <?php }
                } else {
                    echo "<tr><td colspan='13' class='text-center text-danger'>No data found</td></tr>";
                } ?>
            </tbody>
        </table>
        <div class="div">
            <div class="btn_destory_div">
                <a href="../AttendancePage\attendance.php" class="btn">Back</a>

                <form action="../sess_destroy.php" method="post">
                    <button type="submit" class="btn_destory ">Log out</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
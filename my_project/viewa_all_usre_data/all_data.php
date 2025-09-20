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
                f.id AS id,
                r.name,
                r.fathername,
                c.country_name AS country,
                p.province_name AS province,
                r.department,
                d.department_name AS department_name,
                dist.district_name AS district_name,
                t.tehsil_name AS tehsil_name,
                f.in_date,
                f.in_time,
                f.out_date,
                f.out_time
            FROM full_attendance f
            JOIN registration r ON f.registration_id = r.id
            LEFT JOIN country c ON r.country = c.country_id
            LEFT JOIN province p ON r.province = p.province_id
            LEFT JOIN department d ON r.department = d.id
            LEFT JOIN district dist ON r.district = dist.district_id
            LEFT JOIN tehsil t ON r.tehsil = t.tehsil_id
            WHERE f.registration_id = $id";

    $result = $db->query($sql);
} else {
    // Fetch all attendance records if no id is provided
    $sql = "SELECT
                f.id AS id,
                r.name,
                r.fathername,
                r.department,
                d.department_name AS department_name,
                f.in_date,
                f.in_time,
                f.out_date,
                f.out_time
            FROM full_attendance f
            JOIN registration r ON f.registration_id = r.id
            LEFT JOIN department d ON r.department = d.id";

    $result = $db->query($sql);
}
?>
<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Person Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="all_data.css" />

</head>


<body class="p-4">
    <!-- klskflksdlfksldfksf -->
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
                <input type="file" accept="image/*" class="form-control pic_select" name="profile_pic" required />
                <button type="submit" class="btn btn_uplode pic_btn">Upload</button>
            </div>
        </form>
    </div>
    <div class="container mt-5">
        <h3 class="mb-3 attendance h2">User Attendance All Record</h3>
        <div class="div">
            <div class="btn_destory_div">
                <a href="../AttendancePage\attendance.php" class="btn btn_back">Back</a>
                <form action="../sess_destroy.php" method="post">
                    <button type="submit" class="btn_destory">Log out</button>
                </form>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>father name</th>
                    <th>Department</th>
                    <th>In Date</th>
                    <th>In Time</th>
                    <th>Out Date</th>
                    <th>Out Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>

                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['fathername']; ?></td>

                            <td><?php echo $row['department_name']; ?></td>
                            <td><?php echo $row['in_date']; ?></td>
                            <td title="<?php echo !empty($row['in_time']) ? $row['in_time'] : ''; ?>"><?php echo !empty($row['in_time']) ? date('g:i A', strtotime($row['in_time'])) : ''; ?></td>

                            <td><?php echo !empty($row['out_date']) ? $row['out_date'] : ''; ?></td>
                            <td title="<?php echo !empty($row['out_time']) ? $row['out_time'] : ''; ?>"><?php echo !empty($row['out_time']) ? date('g:i A', strtotime($row['out_time'])) : ''; ?></td>

                        </tr>
                <?php }
                } else {
                    echo "<tr><td colspan='12' class='text-center text-danger'>No data found</td></tr>";
                } ?>
            </tbody>
        </table>

    </div>
</body>

</html>
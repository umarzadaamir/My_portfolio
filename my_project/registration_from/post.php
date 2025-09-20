 <?php
    include_once "db_connection.php";
    if (isset($_POST["post"])) {
        $name = $_POST["name"];
        $fathername = $_POST["Father"];
        $address = $_POST["useraddress"];
        $country = $_POST["country"];
        $province = $_POST["province"];
        $phone = $_POST["phone"];
        $date_of_birth = $_POST["date"];
        $department = $_POST["department"];
        $cnic = $_POST["cnic"];
        $email = $_POST["Email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["Confirm_password"];
        $district = $_POST["district"];
        $tehsil = $_POST["tehsil"];
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $cnic = preg_replace("/[^0-9]/", "", $cnic);
        if (strlen($cnic) == 13) {
            $cnic = substr($cnic, 0, 5) . '-' . substr($cnic, 5, 7) . '-' . substr($cnic, 12, 1);
        }
    }
    if (isset($_POST["post"])) {
        $password = $_POST["password"];
        $confirm_password = $_POST["Confirm_password"];
        if ($password !== $confirm_password) {
            echo "<h1 style='color:red;'>Error: Password and Confirm Password do not match.</h1>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            try {
                $database = new Database();
                $db = $database->connect();
                $sql = "INSERT INTO registration(name, fathername, address, country, province, district, tehsil, phone, date_of_birth, department, cnic, email, password_hash, created_at, updated_at) VALUES (:name, :fathername, :address, :country, :province, :district, :tehsil, :phone, :date_of_birth, :department, :cnic, :email, :password_hash, :created_at, :updated_at)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":name", $_POST["name"]);
                $stmt->bindParam(":fathername", $_POST["Father"]);
                $stmt->bindParam(":address", $_POST["useraddress"]);
                $stmt->bindParam(":country", $_POST["country"]);
                $stmt->bindParam(":province", $_POST["province"]);
                $stmt->bindParam(":district", $district);
                $stmt->bindParam(":tehsil", $tehsil);
                $stmt->bindParam(":phone", $_POST["phone"]);
                $stmt->bindParam(":date_of_birth", $_POST["date"]);
                $stmt->bindParam(":department", $_POST["department"]);
                $stmt->bindParam(":cnic", $cnic);
                $stmt->bindParam(":email", $_POST["Email"]);
                $stmt->bindParam(":password_hash", $hashedPassword);
                $stmt->bindParam(":created_at", $created_at);
                $stmt->bindParam(":updated_at", $updated_at);
                if ($stmt->execute()) {
                    // session_start();
                    // header("Location: login.php");
                    //   $_SESSION['user_id'] = $_POST["Email"];
                    // exit;
                    header("Location: ../login/log.php");
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . implode(", ", $db->errorInfo());
                }
            } catch (PDOException $error) {
                echo "<h2 style='color:red;'>Error: " . $error->getMessage() . "</h2>";
            }
        }
    }
    ?>


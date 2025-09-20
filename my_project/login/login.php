<?php
session_start();
print_r($_POST);

if (isset($_SESSION['user_id'])) {
    // If already logged in, redirect to attendance page
    header("Location: ../AttendancePage/attendance.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo '111111111111';
    $email = $_POST['email'];
    $password = $_POST['password'];
    include "../registration_from/db_connection.php";
    $database = new Database();
    $db = $database->connect();
    $sql = "SELECT * FROM registration WHERE email = :email"; // use a placeholder
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: ../AttendancePage/attendance.php");
        exit;
    } else {
        $error = urlencode("Invalid login: Please register first or check your email and password.");
        header("Location: log.php?error=$error");
        exit;
    }
}


function checkLogin()
{
    // die();
    if (!isset($_SESSION['user_id'])) {

        // header("Location: ../AttendancePage/attendance.php");
        echo '<h2 style="color:red;text-align:center;margin-top:40px;">Access Denied: you are not registor first.</h2>';
        exit;
    }
}

// session_start();
// session_unset();   
// session_destroy(); 
// header("Location: login.php");
// exit;

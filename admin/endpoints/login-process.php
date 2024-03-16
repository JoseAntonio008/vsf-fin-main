<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    include('../../db/db.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_sql = "SELECT `ADMIN_ID`, `PASSWORD`, `STATUS` FROM admin WHERE `USERNAME` = '$username'";
    $login_result = $conn->query($login_sql);
    if ($login_result->num_rows > 0) {
        $admin = $login_result->fetch_assoc();
        $admin_password = $admin['PASSWORD'];
        $status = $admin['STATUS'];
        $admin_id = $admin['ADMIN_ID'];
        if (password_verify($password, $admin_password)) {
            if ($status === 'active') {
                session_start();
                $_SESSION['id'] = $admin_id;
                echo 'Login Success';
            } else {
                echo 'Your account is deactivated.';
            }
        } else {
            echo 'Wrong email or password.';
        }
    } else {
        echo 'Wrong email or password.';
    }
} else {
    echo 'Username and Password is not Posted';
}

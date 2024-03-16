<?php
if (
    isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['address']) &&
    isset($_POST['email']) &&
    isset($_POST['number'])
) {
    include('../../db/db.php');

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $admin_id = 'ADMIN_' . rand(100000, 999999);
    $admin_result = $conn->query("SELECT * FROM admin WHERE `ADMIN_ID` = '$admin_id'");
    while ($admin_result->num_rows > 0) {
        $admin_id = 'ADMIN_' . rand(100000, 999999);
        $admin_result = $conn->query("SELECT * FROM admin WHERE `ADMIN_ID` = '$admin_id'");
    }


    $sql = "INSERT INTO `admin`(`ADMIN_ID`, `USERNAME`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `CONTACT_NO`, `ADDRESS`, `STATUS`) 
                        VALUES ('$admin_id','$username','$hashedPassword','$fname','$lname','$email','$number','$address','active')";
    if ($conn->query($sql) === true) {
        echo 'Account Created';
    } else {
        echo 'Creating Failed';
    }
}

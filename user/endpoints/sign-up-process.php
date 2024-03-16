<?php
if (
    isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['address']) &&
    isset($_POST['email']) &&
    isset($_POST['number']) &&
    isset($_POST['username']) &&
    isset($_POST['password'])
) {
    include('../../db/db.php');

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $faveNumber = $_POST['favNumber'];
    $faveLetter = $_POST['favLetter'];
    $favePerson = $_POST['favPerson'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user_id = rand(100000, 999999);
    $check_uid = $conn->query("SELECT * FROM user WHERE `USER_ID` = '$user_id'");
    while ($check_uid->num_rows > 0) {
        $user_id = rand(100000, 999999);
        $check_uid = $conn->query("SELECT * FROM user WHERE `USER_ID` = '$user_id'");
    }
    $final_userID = 'USER_' . $user_id;

    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d');

    $insert_user_sql = "INSERT INTO `user`(`USER_ID`, `USERNAME`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `CONTACT_NO`, `ADDRESS`,`FAVORITE_NUMBER`, `FAVORITE_LETTER`,`FAVORITE_PERSON`, `DATE_CREATED`, `STATUS`) 
                                  VALUES ('$final_userID','$username','$hashed_password','$fname','$lname','$email','$number','$address','$faveNumber','$faveLetter','$favePerson', '$date', 'active')";

    if ($conn->query($insert_user_sql)) {
        echo 'Account successfully created';
    } else {
        echo 'Failed to create account';
    }
} else {
    echo 'Failed to create account';
}

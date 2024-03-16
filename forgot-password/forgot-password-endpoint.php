<?php
include('../db/db.php');
if (isset($_POST['username'], $_POST['favNumber'], $_POST['favLetter'], $_POST['favPerson'])) {
    $username = $_POST['username'];
    $favNumber = $_POST['favNumber'];
    $favLetter = $_POST['favLetter'];
    $favPerson = $_POST['favPerson'];

    $sql = "SELECT * FROM `user` WHERE `USERNAME` = '$username' AND `FAVORITE_NUMBER` = '$favNumber' AND `FAVORITE_LETTER` = '$favLetter' AND `FAVORITE_PERSON` = '$favPerson'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo $user['USER_ID'];
    } else {
        echo '404';
    }
} elseif (isset($_POST['newPassword'], $_POST['userId'])) {
    $newPassword = $_POST['newPassword'];
    $userId = $_POST['userId'];
    $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE `user` SET `PASSWORD`='$newPasswordHashed' WHERE `USER_ID` = '$userId'";
    if ($conn->query($sql)) {
        echo 'Password Changed';
    } else {
        echo '404';
    }
} else {
    echo '404';
}

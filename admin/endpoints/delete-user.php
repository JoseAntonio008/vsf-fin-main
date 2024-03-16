<?php
if (isset($_POST['userType']) && isset($_POST['id'])) {
    include('../../db/db.php');

    $userType = $_POST['userType'];
    $id = $_POST['id'];

    if ($userType === 'admin') {
        $user_del = "UPDATE `admin` SET `STATUS`='deleted' WHERE ADMIN_ID = '$id'";
    } else {
        $user_del = "UPDATE `user` SET `STATUS`='deleted' WHERE USER_ID = '$id'";
    }

    if ($conn->query($user_del) === TRUE) {
        echo 'Deleted Successfully';
    } else {
        echo 'Deletion Unsuccessful';
    }
}

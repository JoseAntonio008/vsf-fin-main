<?php
if (isset($_POST['id'])) {
    include('../../db/db.php');

    $id = $_POST['id'];
    $sql = "UPDATE `tourist_spot` SET `STATUS`='deleted' WHERE `SPOT_ID` = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo 'Deleted Successfully';
    } else {
        echo 'Deletion Unsuccessful';
    }
}

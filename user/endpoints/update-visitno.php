<?php
parse_str(file_get_contents("php://input"), $_PUT);

if (isset($_PUT['spotID'])) {
    include('../../db/db.php');
    $spot_id = $_PUT['spotID'];
    $sql = "UPDATE `tourist_spot` SET `VISITS`= `VISITS` + 1 WHERE `SPOT_ID` = '$spot_id'";
    if ($conn->query($sql) === true) {
        echo 'Success';
    } else {
        echo 'Server Problem';
    }
} else {
    echo 'not';
}

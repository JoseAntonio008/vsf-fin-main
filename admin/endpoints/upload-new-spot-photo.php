<?php
if (isset($_POST['new_photo_spot_id'], $_FILES['new_photo']) && $_FILES['new_photo']['size'] > 0) {
    include('../../db/db.php');
    $spotId = $_POST['new_photo_spot_id'];
    $spot_photo_name = $_FILES['new_photo'];
    if ($_FILES['new_photo']['error'] == UPLOAD_ERR_OK) {
        $spotNameRandomId = mt_rand(100000000, 999999999);
        $spot_file_name = trim($spotNameRandomId) . '.' . pathinfo(trim($_FILES['new_photo']['name']), PATHINFO_EXTENSION);
        $checkImgName = $conn->query("SELECT * FROM `spot_image` WHERE `IMG` = '$spot_file_name'");
        while ($checkImgName->num_rows > 0) {
            $spotNameRandomId = mt_rand(100000000, 999999999);
            $spot_file_name = trim($spotNameRandomId) . '.' . pathinfo(trim($_FILES['new_photo']['name']), PATHINFO_EXTENSION);
            $checkImgName = $conn->query("SELECT * FROM `spot_image` WHERE `IMG` = '$spot_file_name'");
        }

        $tmp_name = $_FILES['new_photo']['tmp_name'];
        $file_destination = '../assets/spots-photo/' . $spot_file_name;

        if ($_FILES['new_photo']['error'] !== UPLOAD_ERR_OK) {
            echo 'Invalid Upload (Spot)';
            exit();
        }

        if ($_FILES['new_photo']['size'] > 5000000) {
            echo 'Invalid spot photo size';
            exit();
        }

        if ($spot_file_name !== 'spot_default.php' && file_exists($file_destination)) {
            if (!unlink($file_destination)) {
                echo 'Error deleting the existing file';
                exit();
            }
        }

        if (!move_uploaded_file($tmp_name, $file_destination)) {
            echo 'Invalid Upload (Spot)';
            exit();
        }

        $sql = "INSERT INTO `spot_image`(`SPOT_ID`, `IMG`) VALUES ('$spotId','$spot_file_name')";
        if ($conn->query($sql) === TRUE) {
            echo 200;
        } else {
            echo 400;
        }
    }
}

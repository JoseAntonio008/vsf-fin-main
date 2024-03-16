<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST['spot_name']) &&
        isset($_POST['location']) &&
        isset($_POST['description']) &&
        isset($_POST['amenities']) &&
        isset($_POST['map']) &&
        isset($_POST['spot_type']) &&
        isset($_FILES['spot_photo']) &&
        isset($_FILES['business_permit'])
    ) {
        include('../../db/db.php');

        $spot_name = $_POST['spot_name'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $amenities = $_POST['amenities'];
        $map = $_POST['map'];
        $budget = $_POST['budget'];
        $entrance_fee = $_POST['entrance_fee'];
        $spot_type = $_POST['spot_type'];
        $spot_photo_name = $_FILES['spot_photo'];
        $business_permit_name = $_FILES['business_permit'];

        $spot_id = 'SPOT' . mt_rand(100000, 999999);
        $spot_id_result = $conn->query("SELECT * FROM tourist_spot WHERE SPOT_ID = '$spot_id'");
        while ($spot_id_result->num_rows > 0) {
            $spot_id = 'SPOT' . mt_rand(100000, 999999);
            $spot_id_result = $conn->query("SELECT * FROM tourist_spot WHERE SPOT_ID = '$spot_id'");
        }

        if ($_FILES['spot_photo']['error'] == UPLOAD_ERR_OK) {

            $spotNameRandomId = mt_rand(100000000, 999999999);
            $spot_file_name = trim($spotNameRandomId) . '.' . pathinfo(trim($_FILES['spot_photo']['name']), PATHINFO_EXTENSION);
            $checkImgName = $conn->query("SELECT * FROM `spot_image` WHERE `IMG` = '$spot_file_name'");
            while ($checkImgName->num_rows > 0) {
                $spotNameRandomId = mt_rand(100000000, 999999999);
                $spot_file_name = trim($spotNameRandomId) . '.' . pathinfo(trim($_FILES['spot_photo']['name']), PATHINFO_EXTENSION);
                $checkImgName = $conn->query("SELECT * FROM `spot_image` WHERE `IMG` = '$spot_file_name'");
            }


            $tmp_name = $_FILES['spot_photo']['tmp_name'];
            $file_destination = '../assets/spots-photo/' . $spot_file_name;

            if ($_FILES['spot_photo']['error'] !== UPLOAD_ERR_OK) {
                echo 'Invalid Upload (Spot)';
                exit();
            }

            if ($_FILES['spot_photo']['size'] > 5000000) {
                echo 'Invalid spot photo size';
                exit();
            }

            if (!move_uploaded_file($tmp_name, $file_destination)) {
                echo 'Invalid Upload (Spot)';
                exit();
            }
        } else {
            $spot_file_name = 'spot_default.png';
        }

        if ($_FILES['business_permit']['error'] == UPLOAD_ERR_OK) {
            $bus_file_name = trim($spot_id) . '.' . pathinfo(trim($_FILES['business_permit']['name']), PATHINFO_EXTENSION);
            $tmp_name = $_FILES['business_permit']['tmp_name'];
            $file_destination = '../assets/business-permit/' . $bus_file_name;

            if ($_FILES['business_permit']['error'] !== UPLOAD_ERR_OK) {
                echo 'Invalid Upload (Business Permit)';
                exit();
            }

            if ($_FILES['business_permit']['size'] > 5000000) {
                echo 'Invalid Business Permit size';
                exit();
            }

            if (!move_uploaded_file($tmp_name, $file_destination)) {
                echo 'Invalid Upload (Business Permit)';
                exit();
            }
        } else {
            $bus_file_name = 'bus_default.png';
        }

        $spot_sql = "INSERT INTO `tourist_spot`(`SPOT_ID`, `SPOT_NAME`, `LOCATION`, `DESCRIPTION`, `BUDGET`, `ENTRANCE_FEE`, `AMENITIES`, `BUSINESS_PERMIT`, `SPOT_TYPE`, `VISITS`, `MAP`, `STATUS`) VALUES ('$spot_id','$spot_name','$location','$description', $budget, $entrance_fee, '$amenities','$bus_file_name','$spot_type','0', '$map','active')";
        $insertSpotImage = "INSERT INTO `spot_image`(`SPOT_ID`, `IMG`) VALUES ('$spot_id','$spot_file_name')";
        if ($conn->query($spot_sql) === TRUE && $conn->query($insertSpotImage) === TRUE) {
            echo 'New spot created';
        } else {
            echo 'Failed to insert new spot';
        }
    } else {
        echo 'kulang';
    }
}

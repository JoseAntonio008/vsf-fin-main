<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST['spot_id']) &&
        isset($_POST['spot_name']) &&
        isset($_POST['location']) &&
        isset($_POST['description']) &&
        isset($_POST['amenities'])
    ) {
        include('../../db/db.php');

        $spot_id = $_POST['spot_id'];
        $spot_name = $_POST['spot_name'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $amenities = $_POST['amenities'];
        $map = $_POST['map'];
        $budget = $_POST['budget'];
        $entrance_fee = $_POST['entrance_fee'];
        $spot_type = $_POST['spot_type'];
        // $category = $_POST['category'];
        // $toa = $_POST['toa'];
        // $withSpotPhoto = false;
        $withBusPer = false;

        // if (isset($_FILES['spot_photo']) && $_FILES['spot_photo']['size'] > 0) {
        //     $withSpotPhoto = true;
        //     $spot_photo_name = $_FILES['spot_photo'];
        //     if ($_FILES['spot_photo']['error'] == UPLOAD_ERR_OK) {
        //         $spot_file_name = trim($spot_id) . '.' . pathinfo(trim($_FILES['spot_photo']['name']), PATHINFO_EXTENSION);
        //         $tmp_name = $_FILES['spot_photo']['tmp_name'];
        //         $file_destination = '../assets/spots-photo/' . $spot_file_name;

        //         if ($_FILES['spot_photo']['error'] !== UPLOAD_ERR_OK) {
        //             echo 'Invalid Upload (Spot)';
        //             exit();
        //         }

        //         if ($_FILES['spot_photo']['size'] > 5000000) {
        //             echo 'Invalid spot photo size';
        //             exit();
        //         }

        //         if ($spot_file_name !== 'spot_default.php' && file_exists($file_destination)) {
        //             if (!unlink($file_destination)) {
        //                 echo 'Error deleting the existing file';
        //                 exit();
        //             }
        //         }

        //         if (!move_uploaded_file($tmp_name, $file_destination)) {
        //             echo 'Invalid Upload (Spot)';
        //             exit();
        //         }
        //     } else {
        //         $spot_file_name = 'spot_default.png';
        //     }
        // }

        if (isset($_FILES['business_permit']) && $_FILES['business_permit']['size'] > 0) {
            $withBusPer = true;
            $business_permit_name = $_FILES['business_permit'];
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

                if ($bus_file_name !== 'bus_default.php' && file_exists($file_destination)) {
                    if (!unlink($file_destination)) {
                        echo 'Error deleting the existing file';
                        exit();
                    }
                }

                if (!move_uploaded_file($tmp_name, $file_destination)) {
                    echo 'Invalid Upload (Business Permit)';
                    exit();
                }
            } else {
                $bus_file_name = 'bus_default.png';
            }
        }

        // if ($withSpotPhoto === true && $withBusPer === true) {
        //     $sql = "UPDATE `tourist_spot` SET `SPOT_NAME`='$spot_name',`LOCATION`='$location',`DESCRIPTION`='$description',`AMENITIES`='$amenities',`PHOTO`='$spot_file_name',`BUSINESS_PERMIT`='$bus_file_name', `SPOT_TYPE`= '$spot_type', `CATEGORY` = '$category', `TOA` = '$toa', `MAP` = '$map' WHERE `SPOT_ID` = '$spot_id'";
        // } elseif ($withSpotPhoto === true) {
        //     $sql = "UPDATE `tourist_spot` SET `SPOT_NAME`='$spot_name',`LOCATION`='$location',`DESCRIPTION`='$description',`AMENITIES`='$amenities',`PHOTO`='$spot_file_name', `SPOT_TYPE`= '$spot_type', `CATEGORY` = '$category', `TOA` = '$toa', `MAP` = '$map' WHERE `SPOT_ID` = '$spot_id'";
        // } 
        if ($withBusPer === true) {
            $sql = "UPDATE `tourist_spot` SET `ENTRANCE_FEE` = $entrance_fee, `BUDGET` = $budget, `SPOT_NAME`='$spot_name',`LOCATION`='$location',`DESCRIPTION`='$description',`AMENITIES`='$amenities',`BUSINESS_PERMIT`='$bus_file_name', `SPOT_TYPE`= '$spot_type', `MAP` = '$map' WHERE `SPOT_ID` = '$spot_id'";
        } else {
            $sql = "UPDATE `tourist_spot` SET `ENTRANCE_FEE` = $entrance_fee, `BUDGET` = $budget, `SPOT_NAME`='$spot_name',`LOCATION`='$location',`DESCRIPTION`='$description',`AMENITIES`='$amenities', `SPOT_TYPE`= '$spot_type', `MAP` = '$map' WHERE `SPOT_ID` = '$spot_id'";
        }

        if ($conn->query($sql) === TRUE) {
            echo 'Spot Updated';
        } else {
            echo 'Failed to update spot';
        }
    } else {
        echo 'kulang';
    }
}

<?php
if (isset($_GET['id'])) {
    include('../../db/db.php');

    $id = $_GET['id'];

    $sql = "SELECT * FROM tourist_spot WHERE SPOT_ID = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $spot = $result->fetch_assoc();

        $rateSum = 0;
        $rateCount = 0;
        $rate_sql = "SELECT `RATE` FROM reviews WHERE `SPOT_ID` = '$id'";
        $rate_result = $conn->query($rate_sql);
        if ($rate_result->num_rows > 0) {
            while ($rate = $rate_result->fetch_assoc()) {
                $rateSum += $rate['RATE'];
                $rateCount++;
            }
        }

        if ($rateCount > 0) {
            $average_rating = $rateSum / $rateCount;
            $scaled_rating = ($average_rating / 5) * 5;
            $rounded_rating = round($scaled_rating);

            $solid_stars = $rounded_rating;
            $regular_stars = 5 - $rounded_rating;
        } else {
            $solid_stars = 0;
            $regular_stars = 5;
        }

        $getSpotImages = "SELECT * FROM `spot_image` WHERE `SPOT_ID` = '$id'";
        $getSpotImagesResult = $conn->query($getSpotImages);
        $spotImgArray = [];
        while ($imageRow = $getSpotImagesResult->fetch_assoc()) {
            $spotImgArray[] = $imageRow['IMG'];
        }

        $data = [
            'spot_id' => $spot['SPOT_ID'],
            'spot_name' => $spot['SPOT_NAME'],
            'location' => $spot['LOCATION'],
            'description' => $spot['DESCRIPTION'],
            'amenities' => $spot['AMENITIES'],
            'spot_type' => $spot['SPOT_TYPE'],
            'budget' => $spot['BUDGET'],
            'entrance_fee' => $spot['ENTRANCE_FEE'],
            'business_permit' => $spot['BUSINESS_PERMIT'],
            'solid_stars' => $solid_stars,
            'regular_stars' => $regular_stars,
            'map' => $spot['MAP'],
            'spot_photo' => $spotImgArray
        ];

        echo json_encode($data);
    } else {
        echo 'not found';
    }
}

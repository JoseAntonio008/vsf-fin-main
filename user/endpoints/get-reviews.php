<?php
if (isset($_GET['id'])) {
    include('../../db/db.php');
    $id = $_GET['id'];

    $sql = "SELECT * FROM reviews WHERE `SPOT_ID` = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $spot_sql = "SELECT `SPOT_NAME` FROM tourist_spot WHERE `SPOT_ID` = '$id'";
        $spot_result = $conn->query($spot_sql);
        if ($spot_result->num_rows > 0) {
            $spot = $spot_result->fetch_assoc();
            $spot_name = $spot['SPOT_NAME'];
        } else {
            $spot_name = 'Unavailable';
        }

        $reviews_result = [];
        while ($row = $result->fetch_assoc()) {
            $user_id = $row['USER_ID'];
            $user_sql = "SELECT * FROM user WHERE `USER_ID` = '$user_id'";
            $user_result = $conn->query($user_sql);
            if ($user_result->num_rows > 0) {
                $user = $user_result->fetch_assoc();
                $username = $user['USERNAME'];
            } else {
                $username = 'Anonymous';
            }

            $review = [
                'username' => $username,
                'spot_name' => $spot_name,
                'review' => $row['REVIEW'],
                'rate' => $row['RATE']
            ];

            $reviews_result[] = $review;
        }

        echo json_encode($reviews_result);
    } else {
        echo 'No review/s';
    }
}

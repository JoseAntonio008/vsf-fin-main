<?php
session_start();
if (isset($_SESSION['id'])) {
    include('../../db/db.php');
    $session_id = $_SESSION['id'];

    $admin_sql = "SELECT * FROM admin WHERE ADMIN_ID = '$session_id' AND STATUS = 'active'";
    $admin_result = $conn->query($admin_sql);
    if ($admin_result->num_rows > 0) {

        $visits_sql = "SELECT * FROM tourist_spot";
        $visits_result = $conn->query($visits_sql);
        $spots = [];
        if ($visits_result->num_rows > 0) {
            while ($visits = $visits_result->fetch_assoc()) {
                $rate = 0;
                $spot_id = $visits['SPOT_ID'];
                $review_sql = "SELECT SUM(RATE) AS total_rate FROM reviews WHERE SPOT_ID = '$spot_id'";
                $review_result = $conn->query($review_sql);
                if ($review_result->num_rows > 0) {
                    $review = $review_result->fetch_assoc();
                    $rate += $review['total_rate'];
                }

                $spot = [
                    'SPOT_NAME' => $visits['SPOT_NAME'],
                    'VISITS' => intval($visits['VISITS']),
                    'TOTAL_RATE' => intval($rate),
                ];
                $spots[] = $spot;

                if (count($spots) === 10) {
                    break;
                }
            }
        }

        usort($spots, function ($a, $b) {
            return $b['TOTAL_RATE'] - $a['TOTAL_RATE'];
        });

        echo json_encode($spots);
    }
}

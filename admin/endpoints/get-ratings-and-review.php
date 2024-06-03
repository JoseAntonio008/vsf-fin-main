<?php
if (isset($_GET['sort'], $_GET['spotType'])) {
    include('../../db/db.php');

    $sort = $_GET['sort'];
    $spotType = $_GET['spotType'];
    $start_date = $_GET['start'] ?? null;
    $limit_date = $_GET['end'] ?? null;

    if ($spotType == 'All') {
        $spot_sql = "SELECT * FROM tourist_spot WHERE `STATUS` = 'active'";
    } else {
        $spot_sql = "SELECT * FROM tourist_spot WHERE `SPOT_TYPE` = '$spotType' AND `STATUS` = 'active'";
    }

    $spot_result = $conn->query($spot_sql);
    $spot_details = array();
    if ($spot_result->num_rows > 0) {
        while ($spot = $spot_result->fetch_assoc()) {
            $review = 0;
            $rating = 0;
            $spot_id = $spot['SPOT_ID'];
            
            $reviews_sql = "SELECT * FROM reviews WHERE `SPOT_ID` = '$spot_id'";

            if (strlen($start_date) > 0 && strlen($limit_date) > 0) {
                if ($start_date == $limit_date) {
                    $reviews_sql .= " AND `DATE` LIKE '$start_date%'";
                } else {
                    $reviews_sql .= " AND `DATE` BETWEEN '$start_date' AND '$limit_date'";
                }
            }

            $reviews_result = $conn->query($reviews_sql);
            $averageRating = 0;

            if ($reviews_result->num_rows > 0) {
                while ($reviews = $reviews_result->fetch_assoc()) {
                    $review++;
                    $rating += $reviews['RATE'];
                }

                if ($review > 0) {
                    $averageRating = $rating / $review;
                }
            }

            $spot_details[] = array(
                'spot_name' => $spot['SPOT_NAME'],
                'location' => $spot['LOCATION'],
                'review' => $review,
                'rating' => number_format($averageRating, 1)
            );
        }

        if ($sort === 'htl') {
            usort($spot_details, function ($a, $b) {
                return $b['rating'] - $a['rating'];
            });
        } else {
            usort($spot_details, function ($a, $b) {
                return $a['rating'] - $b['rating'];
            });
        }

        foreach ($spot_details as $spot) {
?>
            <tr>
                <td><?php echo $spot['spot_name'] ?></td>
                <td><?php echo $spot['location'] ?></td>
                <td class="text-center"><?php echo $spot['review'] ?></td>
                <td class="text-center"><?php echo $spot['rating'] ?></td>
            </tr>
        <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="4">
                <center>No Reviews Found</center>
            </td>
        </tr>
<?php
    }
}

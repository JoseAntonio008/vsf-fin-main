<?php
if (isset($_GET['search']) && isset($_GET['search_type']) && isset($_GET['type'])) {
    include('../../db/db.php');

    $search = $_GET['search'];
    $search_type = $_GET['search_type'];
    $type = $_GET['type'];
    $budget = $_GET['budget'];
    $entranceFee =  $_GET['entranceFee'];

    if ($type == 'reviews') {

        if ($search_type === 'search bar') {
            $sql = "SELECT r.*, ts.*
            FROM reviews r
            JOIN tourist_spot ts ON r.SPOT_ID = ts.SPOT_ID
            WHERE (ts.SPOT_NAME LIKE '%$search%' OR ts.DESCRIPTION LIKE '%$search%'
            OR ts.LOCATION LIKE '%$search%' OR ts.AMENITIES LIKE '%$search%'
            OR ts.SPOT_TYPE LIKE '%$search%' AND ts.STATUS = 'active'
            ORDER BY r.DATE DESC";
        } elseif ($search_type === 'category') {
            $sql = "SELECT r.*, ts.*
            FROM reviews r
            JOIN tourist_spot ts ON r.SPOT_ID = ts.SPOT_ID
            WHERE ts.SPOT_TYPE = '$search' AND ts.STATUS = 'active' ORDER BY r.DATE DESC";
        } else {
            $sql = "SELECT r.* FROM reviews r 
                    JOIN tourist_spot ts ON r.SPOT_ID = ts.SPOT_ID
                    WHERE ts.STATUS = 'active'
                    ORDER BY r.DATE DESC";
        }

        if ($budget != null) {
            if ($budget != "0-0") {
                $budRange = explode("-", $budget);
                $sql .= " AND `BUDGET` BETWEEN $budRange[0] AND $budRange[1]";
            }
        }

        if ($entranceFee != null) {
            if ($entranceFee != "0-0") {
                $budRange = explode("-", $entranceFee);
                $sql .= " AND `ENTRANCE_FEE` BETWEEN $budRange[0] AND $budRange[1]";
            }
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            session_start();

            while ($review_row = $result->fetch_assoc()) {
                $spot_id = $review_row['SPOT_ID'];
                $user_id = $review_row['USER_ID'];

                $spot_sql = "SELECT `SPOT_NAME` FROM tourist_spot WHERE `SPOT_ID` = '$spot_id'";
                $spot_result = $conn->query($spot_sql);
                if ($spot_result->num_rows > 0) {
                    $spot = $spot_result->fetch_assoc();
                    $spot_name = $spot['SPOT_NAME'];
                } else {
                    $spot_name = 'Unavailable';
                }

                $user_sql = "SELECT * FROM user WHERE `USER_ID` = '$user_id'";
                $user_result = $conn->query($user_sql);
                if ($user_result->num_rows > 0) {
                    $user = $user_result->fetch_assoc();
                    $username = $user['USERNAME'];
                    $fullname = $user['FIRST_NAME'] . ' ' . $user['LAST_NAME'];
                    $img = $user['PROFILE_IMG'];

                    if ($img != null && strpos($img, 'http') === false) {
                        $img = "assets/profile/$img";
                    }
                } else {
                    $username = 'Anonymous';
                }

                $solid_stars = $review_row['RATE'];
                $regular_stars = 5 - $solid_stars;

?>
                <div class="review-container remove-when-changing-the-state">
                    <div class="review-row">
                        <div class="profile">
                            <?php
                            if ($img == null) {
                                echo '<div class="image-default"><i class="fa-solid fa-user"></i></div>';
                            } else {
                            ?>
                                <img src="<?= $img ?>" alt="Profile" referrerpolicy="no-referrer" />
                            <?php
                            }
                            ?>
                        </div>
                        <div class="user-name-rating-container">
                            <h5 class="username"><?php
                                                    echo strpos($username, '@') !== false ? $fullname : $username;

                                                    if (isset($_SESSION['id']) && strpos($user_id, $_SESSION['id']) !== false) {
                                                        echo ' (Me)';
                                                    }
                                                    ?></h5>
                            <div class="rating-container">
                                <?php
                                if ($solid_stars > 0) {
                                    for ($i = 1; $i <= $solid_stars; $i++) {
                                        echo '<i class="fa-solid fa-star"></i>';
                                    }
                                    for ($i = 1; $i <= $regular_stars; $i++) {
                                        echo '<i class="fa-regular fa-star"></i>';
                                    }
                                } else {
                                ?>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="spot-name">
                                <p><?php echo $spot_name ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="review-text">
                        <p><?php echo $review_row['REVIEW'] ?></p>

                        <?php
                        if ($review_row['PICTURE'] != null) {
                            echo '<img src="assets/reviews/' . $review_row['PICTURE'] . '" alt="Review Image" referrerpolicy="no-referrer" width="50%" />';
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        <?php
        } else {
        ?>
            <center class="no-spot-fount remove-when-changing-the-state">No review found</center>
        <?php
        }
    }

    if ($type == 'dn') {
        if ($search_type === 'search bar') {
            $sql = "SELECT * FROM tourist_spot WHERE (`SPOT_NAME` LIKE '%$search%' OR `LOCATION` LIKE '%$search%' OR `DESCRIPTION` LIKE '%$search%' OR `AMENITIES` LIKE '%$search%' OR `SPOT_TYPE` LIKE '%$search%') AND `STATUS` = 'active'";
        } elseif ($search_type === 'category') {
            $sql = "SELECT * FROM tourist_spot WHERE (`SPOT_TYPE` = '$search') AND `STATUS` = 'active'";
        } elseif ($search_type === 'LetterPicker') {
            $sql = "SELECT * FROM tourist_spot WHERE LEFT(`SPOT_NAME`, 1) = '$search'";
        } else {
            $sql = "SELECT * FROM tourist_spot WHERE `STATUS` = 'active'";
        }

        if ($budget != null) {
            if ($budget != "0-0") {
                $budRange = explode("-", $budget);
                $sql .= " AND `BUDGET` BETWEEN $budRange[0] AND $budRange[1]";
            }
        }

        if ($entranceFee != null) {
            if ($entranceFee != "0-0") {
                $budRange = explode("-", $entranceFee);
                $sql .= " AND `ENTRANCE_FEE` BETWEEN $budRange[0] AND $budRange[1]";
            }
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        ?>
            <div class="spot-discover-container remove-when-changing-the-state">

                <?php
                $i = 1;

                while ($spot_row = $result->fetch_assoc()) {
                    $spot_id = $spot_row['SPOT_ID'];
                    $title = $spot_row['SPOT_NAME'];
                    $description = $spot_row['DESCRIPTION'];

                    $getPhotoSQL = $conn->query("SELECT * FROM `spot_image` WHERE `SPOT_ID` = '$spot_id'");
                    $photo = $getPhotoSQL->fetch_assoc();
                    $photoName = $photo['IMG'];

                    echo "<h4>" . ($i++) . ". &nbsp; $title</h4>";
                    echo "<p class=\"vsf-blue font-medium fs-7\">₱ " . number_format($spot_row["BUDGET"], 2, '.', ',') . "</p>";
                    echo '<div class="btn btn-rate-spot" style="color:white;background-color:blue;" data-spot-id="' . $spot_id . '">Rate</div>';

                    echo "<p>$description</p>";
                    echo "<img src='admin/assets/spots-photo/$photoName' alt='$title'>";
                }
                ?>

            </div>
        <?php
        }
    } else if ($type == 'ttd') {
        if ($search_type === 'search bar') {
            $sql = "SELECT * FROM tourist_spot WHERE (`SPOT_NAME` LIKE '%$search%' OR `LOCATION` LIKE '%$search%' OR `DESCRIPTION` LIKE '%$search%' OR `AMENITIES` LIKE '%$search%' OR `SPOT_TYPE` LIKE '%$search%') AND `STATUS` = 'active'";
        } elseif ($search_type === 'category') {
            $sql = "SELECT * FROM tourist_spot WHERE (`SPOT_TYPE` = '$search') AND `STATUS` = 'active'";
        } elseif ($search_type === 'LetterPicker') {
            $sql = "SELECT * FROM tourist_spot WHERE LEFT(`SPOT_NAME`, 1) = '$search'";
        } else {
            $sql = "SELECT * FROM tourist_spot WHERE `STATUS` = 'active'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        ?>
            <div class="spot-main-container remove-when-changing-the-state">
                <?php
                while ($spot_row = $result->fetch_assoc()) {
                    $spot_id = $spot_row['SPOT_ID'];
                    $getPhotoSQL = $conn->query("SELECT * FROM `spot_image` WHERE `SPOT_ID` = '$spot_id'");
                    $photo = $getPhotoSQL->fetch_assoc();
                    $photoName = $photo['IMG'];
                    $review_sql = "SELECT `RATE` FROM reviews WHERE `SPOT_ID` = '$spot_id'";
                    $review_result = $conn->query($review_sql);
                    $rateSum = 0;
                    $rateCount = 0;
                    if ($review_result->num_rows > 0) {
                        while ($review = $review_result->fetch_assoc()) {
                            $rateSum += $review['RATE'];
                            $rateCount++;
                        }
                    }

                    if ($rateCount > 0) {
                        $average_rating = $rateSum / $rateCount;
                        $scaled_rating = ($average_rating / 5) * 5;
                        $rounded_rating = round($scaled_rating);

                        $solid_stars = $rounded_rating;
                        $regular_stars = 5 - $rounded_rating;
                    }
                ?>
                    <div class="spot-container" data-id="<?= $spot_row['SPOT_ID'] ?>">
                        <div class="left" style="background-image: url('admin/assets/spots-photo/<?= $photoName ?>');">
                        </div>
                        <div class="right">
                            <h6 class="text-center"><?php echo $spot_row['SPOT_NAME'] ?></h6>
                            <div class="stars">
                                <?php
                                if ($rateCount > 0) {
                                    for ($i = 1; $i <= $solid_stars; $i++) {
                                        echo '<i class="fa-solid fa-star"></i>';
                                    }
                                    for ($i = 1; $i <= $regular_stars; $i++) {
                                        echo '<i class="fa-regular fa-star"></i>';
                                    }
                                } else {
                                ?>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                <?php
                                }
                                ?>
                                <!-- <span class="rate-count"> | Rate: <?php echo $rateCount ?></span> -->
                            </div>
                            <!-- <div class="spot-details">
                            <div class="spot-location">
                                <h5>Location</h5>
                                <p><?php echo $spot_row['LOCATION'] ?></p>
                            </div>
                            <div class="spot-description">
                                <h5>Description</h5>
                                <p><?php echo $spot_row['DESCRIPTION'] ?></p>
                            </div>
                            <div class="visit-rate-btn">
                                <a href="#" id="visit" data-id="<?php echo $spot_row['SPOT_ID'] ?>">Visit</a>
                                <a href="#" id="rate" data-id="<?php echo $spot_row['SPOT_ID'] ?>">Rate</a>
                            </div>
                        </div> -->
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <center class="no-spot-fount remove-when-changing-the-state">No spot found</center>
    <?php
            }
        }
    } else {
        echo 'no';
    }
   
    ?>





 
 
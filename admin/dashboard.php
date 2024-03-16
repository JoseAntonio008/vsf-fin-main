<?php
session_start();
if (isset($_SESSION['id'])) {
    include('../db/db.php');
    $session_id = $_SESSION['id'];

    $admin_sql = "SELECT * FROM admin WHERE ADMIN_ID = '$session_id' AND STATUS = 'active'";
    $admin_result = $conn->query($admin_sql);
    if ($admin_result->num_rows > 0) {
        $admin = $admin_result->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,200;1,500&family=Roboto+Condensed:wght@300;400&display=swap');
            </style>
            <link rel="stylesheet" href="css/navigation.css">
            <link rel="stylesheet" href="css/dashboard.css">
            <title>Dashboard</title>
        </head>

        <body>
            <div class="side-nav-container">
                <div class="logo-container">
                    <img src="../assets//vsf-final-logo.png" alt="VSF">
                </div>
                <div class="navigations-container navigations-container-active">
                    <a href="dashboard.php"><i class="fa-solid fa-table-list"></i> Dashboard</a>
                </div>
                <div class="navigations-container">
                    <a href="accounts.php"><i class="fa-solid fa-users"></i> Account Signed in</a>
                </div>
                <div class="navigations-container">
                    <a href="ratings-and-reviews.php"><i class="fa-solid fa-star-half-stroke"></i> Ratings & Reviews</a>
                </div>
                <div class="navigations-container">
                    <a href="spots.php"><i class="fa-solid fa-gear"></i> Manage Spots</a>
                </div>
                <center class="logout">
                    <a href="process/logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i>Logout</a>
                </center>
            </div>
            <div class="main-contents-container">
                <div class="top-contents-container">
                    <h1 class="welcome-admin">Welcome Admin!</h1>

                    <!-- <div class="search-container">
                        <input type="text" id="search" name="search" placeholder="Search Something">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div> -->
                </div>
                <div class="db-f-row">
                    <div>
                        <?php
                        date_default_timezone_set('Asia/Manila');
                        $currentDate = date('Y-m-d');
                        $review_sql = "SELECT * FROM reviews WHERE DATE(`DATE`) = '$currentDate'";
                        $review_result = $conn->query($review_sql);
                        $numReview = 0;
                        if ($review_result->num_rows > 0) {
                            $numReview = $review_result->num_rows;
                        }
                        ?>
                        <p><span><?php echo $numReview ?></span> New Reviews</p>
                    </div>
                    <div>
                        <?php
                        $rate_sql = "SELECT * FROM reviews WHERE `RATE` > '0' AND DATE(`DATE`) = '$currentDate'";
                        $rate_result = $conn->query($rate_sql);
                        $numRate = 0;
                        if ($rate_result->num_rows > 0) {
                            $numRate = $rate_result->num_rows;
                        }
                        ?>
                        <p><span><?php echo $numRate ?></span> New Rates</p>
                    </div>
                    <div>
                        <?php
                        $user_sql = "SELECT * FROM user WHERE `DATE_CREATED` = '$currentDate'";
                        $user_result = $conn->query($user_sql);
                        $newAccs = 0;
                        if ($user_result->num_rows > 0) {
                            $newAccs = $user_result->num_rows;
                        }
                        ?>
                        <p><span><?php echo $newAccs ?></span> New Accounts</p>
                    </div>
                </div>
                <?php
                $getMostVisitedSpot = $conn->query("SELECT * FROM `tourist_spot` ORDER BY `VISITS` DESC LIMIT 1");
                if ($getMostVisitedSpot->num_rows > 0) {
                    $mostVisitedSpot = $getMostVisitedSpot->fetch_assoc();
                    $mostVisitedSpotName = $mostVisitedSpot['SPOT_NAME'];
                } else {
                    $mostVisitedSpotName = '';
                }

                $getHighestRatedSpot = $conn->query("SELECT ts.*, SUM(r.RATE) AS total_rating
                                                     FROM `reviews` AS r
                                                     JOIN `tourist_spot` AS ts ON r.SPOT_ID = ts.SPOT_ID
                                                     GROUP BY ts.SPOT_ID
                                                     ORDER BY total_rating DESC
                                                     LIMIT 1");

                if ($getHighestRatedSpot->num_rows > 0) {
                    $highestRatedSpot = $getHighestRatedSpot->fetch_assoc();
                    $highestRatedSpotName = $highestRatedSpot['SPOT_NAME'];
                } else {
                    $highestRatedSpotName = '';
                }
                ?>
                <div class="db-f-row">
                    <div>
                        <label>Most Visited Spot</label>
                        <h2>
                            <center><?= $mostVisitedSpotName ?></center>
                        </h2>
                    </div>
                    <div>
                        <label>highest Rated Spot</label>
                        <h2>
                            <center><?= $highestRatedSpotName ?></center>
                        </h2>
                    </div>
                </div>
                <div class="db-s-row">
                    <div id="chartContainer" style="height: 70vh; width: 100%;"></div>
                </div>

                <center class="spot-type-title">
                    <i>
                        <h1>Spot Types</h1>
                    </i>
                </center>

                <?php
                function getNumberOfSpots($spotType)
                {
                    global $conn;
                    $getSpotSql = $conn->query("SELECT COUNT(*) AS total_spots FROM `tourist_spot` WHERE `SPOT_TYPE` = '$spotType'");
                    $spotCount = $getSpotSql->fetch_assoc();
                    return $spotCount['total_spots'];
                }
                ?>

                <div class="dashboard-spot-type-container">
                    <div class="spot-type-card">
                        <center>
                            <h4>
                                Hotel
                            </h4>
                            <p>
                                <i><?= getNumberOfSpots('Hotel') ?></i> Spots
                            </p>
                        </center>
                    </div>
                    <div class="spot-type-card">
                        <center>
                            <h4>
                                Resort
                            </h4>
                            <p>
                                <i><?= getNumberOfSpots('Resort') ?></i> Spots
                            </p>
                        </center>
                    </div>
                    <div class="spot-type-card">
                        <center>
                            <h4>
                                Lake
                            </h4>
                            <p>
                                <i><?= getNumberOfSpots('Lake') ?></i> Spots
                            </p>
                        </center>
                    </div>
                    <div class="spot-type-card">
                        <center>
                            <h4>
                                Mall
                            </h4>
                            <p>
                                <i><?= getNumberOfSpots('Mall') ?></i> Spots
                            </p>
                        </center>
                    </div>
                    <div class="spot-type-card">
                        <center>
                            <h4>
                                Farm
                            </h4>
                            <p>
                                <i><?= getNumberOfSpots('Farm') ?></i> Spots
                            </p>
                        </center>
                    </div>
                    <div class="spot-type-card">
                        <center>
                            <h4>
                                Restaurant
                            </h4>
                            <p>
                                <i><?= getNumberOfSpots('Restaurant') ?></i> Spots
                            </p>
                        </center>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
            <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
            <script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
            <script src="js/dashboard.js"></script>
        </body>

        </html>
    <?php
    } else {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,200;1,500&family=Roboto+Condensed:wght@300;400&display=swap');
            </style>
            <title>Access Denied</title>
        </head>

        <body>
            <div class="access-denied-container">
                <h1>Access Denied</h1>
                <p>You are not authorize to access this page.</p>
            </div>
        </body>

        </html>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: 'poppins', sans-serif;
            }

            .access-denied-container {
                display: flex;
                flex-direction: column;
                align-items: center;

                position: absolute;
                top: 40%;
            }

            .access-denied-container h1 {
                font-weight: 500;
                font-size: 43px;
                margin: 0;
                color: red;
            }

            .access-denied-container p {
                font-size: 15px;
                margin: 0;
            }
        </style>
<?php
    }
} else {
    header("Location: login.php");
    exit;
}

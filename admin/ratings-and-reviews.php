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
            <link rel="stylesheet" href="../assets/bootstrap.min.css" />
            <link rel="stylesheet" href="lib/daterange/daterangepicker.css" />
            <link rel="stylesheet" href="css/navigation.css">
            <link rel="stylesheet" href="css/ratings-and-reviews.css">
            <title>Ratings & Reviews</title>
        </head>

        <div class="alert alert-success bg-success text-light">

        </div>
        <div class="alert alert-danger bg-danger text-light">

        </div>

        <body>
            <div class="side-nav-container hide-when-print">
                <div class="logo-container">
                    <img src="../assets//vsf-final-logo.png" alt="VSF">
                </div>
                <div class="navigations-container">
                    <a href="dashboard.php"><i class="fa-solid fa-table-list"></i> Dashboard</a>
                </div>
                <div class="navigations-container">
                    <a href="accounts.php"><i class="fa-solid fa-users"></i> Account Signed in</a>
                </div>
                <div class="navigations-container navigations-container-active">
                    <a href="ratings-and-reviews.php"><i class="fa-solid fa-star-half-stroke"></i> Ratings & Reviews</a>
                </div>
                <div class="navigations-container">
                    <a href="spots.php"><i class="fa-solid fa-gear"></i> Manage Spots</a>
                </div>
                <center class="logout">
                    <a href="process/logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i>Logout</a>
                </center>
            </div>
            
            <div class="modal fade hide-when-print" id="dialog-tf" tabindex="-1" aria-labelledby="dialogLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="dialogLabel">Select time frame</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="daterange" class="form-control" placeholder="Timeframe" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="selectTimeFrame">Select & print</button>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="main-contents-container">
                <center class="only-print">
                    <h3><i>VSF</i> Rating and Reviews</h3>
                </center>

                <div class="top-contents-container hide-when-print">
                    <h1 class="welcome-admin">Welcome Admin!</h1>

                    <div class="select-container">
                        <select class="sort" id="sort">
                            <option value="htl">Highest to Lowest Rate</option>
                            <option value="lth">Lowest to Highest Rate</option>
                        </select>
                        <i class="fa-solid fa-sort-down"></i>
                    </div>

                    <div class="select-container spot-type-select-container" style="margin-left: 10px;">
                        <select class="sort" id="SpotType">
                            <option value="All">All</option>
                            <option value="Hotel">Hotel</option>
                            <option value="Resort">Resort</option>
                            <option value="Lake">Lake</option>
                            <option value="Mall">Mall</option>
                            <option value="Farm">Farm</option>
                            <option value="Restaurant">Restaurant</option>
                        </select>
                        <i class="fa-solid fa-sort-down"></i>
                    </div>
                </div>

                <div class="tf-selected">
                    <span class="only-print" id="tf-message"></span>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Spot</th>
                                <th>Address</th>
                                <th>Total Reviews</th>
                                <th>Total Rates</th>
                            </tr>
                        </thead>
                        <tbody id="response-container">

                        </tbody>
                    </table>
                    <div class="tf-selected">
                        <button class="btn hide-when-print btn-outline-secondary ms-2" onclick="location.reload()">Clear</button>
                    </div>
                </div>


                <button data-bs-toggle="modal" data-bs-target="#dialog-tf" class="btn-print-tf hide-when-print">Print w/ timeframe</button>
                <button id="btnPrint" onclick="window.print()" class="btn-print hide-when-print">Print</button>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="../assets/moment.min.js"></script>
            <script src="../assets/bootstrap.bundle.min.js"></script>
            <script src="lib/daterange/daterangepicker.min.js"></script>
            <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
            <script src="js/ratings-and-reviews.js"></script>
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

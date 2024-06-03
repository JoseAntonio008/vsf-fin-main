<?php
session_start();
include('db/db.php');
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $img = "";

    $rated_places = 0;
    $rated_comments = 0;
    $rated_pictures = 0;

    $user_sql = "SELECT * FROM user WHERE `USER_ID` = '$id'";
    $user_result = $conn->query($user_sql);
    if ($user_result->num_rows > 0) {
        $isLoggedIn = true;
        $user = $user_result->fetch_assoc();
        $name = $user['FIRST_NAME'] . ' ' . $user['LAST_NAME'];
        $img = $user["PROFILE_IMG"];

        if ($img != null && strpos($img, 'http') === false) {
            $img = "assets/profile/$img";
        }

        $rated_places_sql = "SELECT COUNT(*) AS count FROM `reviews` r JOIN tourist_spot ts ON r.SPOT_ID = ts.SPOT_ID WHERE r.USER_ID = '$id'";
        $rated_places_result = $conn->query($rated_places_sql);

        if ($rated_places_result->num_rows > 0) {
            $rated_places_row = $rated_places_result->fetch_assoc();
            $rated_places = $rated_places_row['count'];
        }

        $rated_comments_sql = "SELECT COUNT(*) AS count FROM `reviews` r JOIN tourist_spot ts ON r.SPOT_ID = ts.SPOT_ID WHERE r.USER_ID = '$id' AND r.REVIEW != ''";
        $rated_comments_result = $conn->query($rated_comments_sql);

        if ($rated_comments_result->num_rows > 0) {
            $rated_comments_row = $rated_comments_result->fetch_assoc();
            $rated_comments = $rated_comments_row['count'];
        }

        $rated_pictures_sql = "SELECT COUNT(*) AS count FROM `reviews` r JOIN tourist_spot ts ON r.SPOT_ID = ts.SPOT_ID WHERE r.USER_ID = '$id' AND r.PICTURE IS NOT NULL";
        $rated_pictures_result = $conn->query($rated_pictures_sql);

        if ($rated_pictures_result->num_rows > 0) {
            $rated_pictures_row = $rated_pictures_result->fetch_assoc();
            $rated_pictures = $rated_pictures_row['count'];
        }
    } else {
        $isLoggedIn = false;
    }
} else {
    $isLoggedIn = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user/css/index.css">
    <link href="./assets/bootstrap-5.3.2.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,200;1,500&family=Roboto+Condensed:wght@300;400&display=swap');
    </style>
    <title>Vacation Spot Finder</title>
</head>

<body>
    <div class="alert alert-success bg-success text-light">
    </div>
    <div class="alert alert-danger bg-danger text-light">
    </div>

    <div class="appbar">
        <div class="left">
            <img src="assets/vsf-final-logo.png" width="100">
        </div>
        <div class="right">
            <div class="show-only-when-sm">
                <button class="btn-show-nav" data-bs-toggle="offcanvas" data-bs-target="#mainSidenav" aria-controls="mainSidenav"><i class="fa-solid fa-bars"></i></button>
            </div>
            <div class="hide-when-sm">
                <a href="#" id="btdTtd" class="appbar-btn btnTtd">Things to do</a>
                <a href="#" id="btnReviews" class="appbar-btn btnReviews">Reviews</a>

                <?php
                if ($isLoggedIn) {
                    echo '<a href="./user/process/logout.php" class="appbar-btn-filled">Logout | ' . $name . '</a>';
                } else {
                    echo '<a href="./user/signup.php" id="btnSignup" class="appbar-btn">Sign up</a>';
                    echo '<a href="./user/login.php" id="btnSignin" class="appbar-btn-filled">Sign in</a>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="mainSidenav" aria-labelledby="mainSidenavLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mainSidenavLabel">Main Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mobile">
            <h5 class="vsf-blue">Spot Types</h5>
            <ul class="list-group spot-type mt-3">
                <li class="list-group-item">Hotel</li>
                <li class="list-group-item">Resort</li>
                <li class="list-group-item">Lake</li>
                <li class="list-group-item">Mall</li>
                <li class="list-group-item">Farm</li>
                <li class="list-group-item">Restaurant</li>
            </ul>

            <!-- <h5 class="vsf-blue mt-3">Budget Plan</h5>
            <input type="range" class="mt-3 w-100" value="7500" min="100" max="10000" id="budget-sec-main" oninput="rangevalue1.value=currency.format(value)" />
            <div class="d-flex justify-content-between align-items-center mt-3">
                <output id="rangevalue1">₱7,500.00</output>
                <button class="btn btn-secondary" id="budget-sec-btn">Apply</button>
            </div> -->
            <div class="row mt-1">
                <h5 class="col-12 vsf-blue">Entrance Fee</h5>
                <div class="row ">
                    <div class="col"><label for="">min</label></div>
                    <div class="col-2"></div>
                    <div class="col"><label for="">max</label></div>



                </div>

                <div class="col"><input type="number" name="minEntrance" id="minEntrance-mobile" placeholder="P 0.00" style="width:100%"></div>
                <div class="col-1">-</div>
                <div class="col"><input type="number" name="maxEntrance" id="maxEntrance-mobile" placeholder="P 0.00" style="width:100%"></div>
                <div class="row  d-flex justify-content-center ">
                    <div class="col my-2">
                        <button class="btn btn-secondary " style="width:100%" id="entrance-main-btn-mobile">Apply</button>
                    </div>

                </div>

            </div>
            <div class="row mt-1">
                <h5 class="col-12 vsf-blue">Food prices</h5>
                <div class="row ">
                    <div class="col"><label for="">min</label></div>
                    <div class="col-2"></div>
                    <div class="col"><label for="">max</label></div>


                </div>

                <div class="col"><input type="number" name="minFood" id="minFood-mobile" placeholder="P 0.00" style="width:100%"></div>
                <div class="col-1">-</div>
                <div class="col"><input type="number" name="maxFood" id="maxFood-mobile" placeholder="P 0.00" style="width:100%"></div>
                <div class="row  d-flex justify-content-center ">
                    <div class="col my-2">
                        <button class="btn btn-secondary" style="width:100%" id="budget-main-btn-mobile">Apply</button>
                    </div>

                </div>
            </div>


        </div>
    </div>

    <?php

    if (!$isLoggedIn) {
    ?>
        <div class="top-logo-image-container text-white">
            <div class="overlay"></div>
            <div class="flex items-center justify-center flex-column h-full relative home-menu">
                <img src="assets/new/home/image 11.png" alt="" width="75" />
                <h3 class="mt-3">Find out</h3>
                <h1>where you could go.</h1>
                <p class="text-center mt-1 home-text">The City of San Pablo, a first-class city in the Province of Laguna, is one of the Philippines ' oldest cities.</p>
                <a href="#discover" class="btn btnDn btn-light rounded-full px-4 py-2 flex items-center">Discover Now</a>
            </div>
        </div>
    <?php
    }
    ?>
    <input type="hidden" id="display-type" value="dn">
    <div class="main-contents" id="discover">
        <div class="side-nav <?= $isLoggedIn ? 'logged' : "" ?>">
            <h5 class="vsf-blue">Spot Types</h5>
            <ul class="list-group spot-type mt-3">
                <li class="list-group-item">Hotel</li>
                <li class="list-group-item">Resort</li>
                <li class="list-group-item">Lake</li>
                <li class="list-group-item">Mall</li>
                <li class="list-group-item">Farm</li>
                <li class="list-group-item">Restaurant</li>
            </ul>

            <!-- <h5 class="vsf-blue mt-3">Budget Plan</h5>
            <input type="range" class="mt-3 w-100" value="7500" min="100" max="10000" id="budget-main" oninput="rangevalue2.value=currency.format(value)" />
            <div class="d-flex justify-content-between align-items-center mt-3">
                <output id="rangevalue2">₱7,500.00</output>
                <button class="btn btn-secondary" id="budget-main-btn">Apply</button>
            </div> -->

            <div class="row mt-1">
                <h5 class="col-12 vsf-blue">Entrance Fee</h5>
                <div class="row ">
                    <div class="col"><label for="">min</label></div>
                    <div class="col-2"></div>
                    <div class="col"><label for="">max</label></div>
                </div>

                <div class="col"><input type="number" name="minEntrance" id="minEntrance" min="0" placeholder="P 0.00" style="width:100%"></div>
                <div class="col-1">-</div>
                <div class="col"><input type="number" name="maxEntrance" id="maxEntrance" min="0" placeholder="P 0.00" style="width:100%"></div>
                <div class="row  d-flex justify-content-center ">
                    <div class="col my-2">
                        <button class="btn btn-secondary " style="width:100%" id="entrance-main-btn">Apply</button>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <h5 class="col-12 vsf-blue">Food prices</h5>
                <div class="row ">
                    <div class="col"><label for="">min</label></div>
                    <div class="col-2"></div>
                    <div class="col"><label for="">max</label></div>
                </div>
                <div class="col"><input type="number" name="minFood" id="minFood" min="0" placeholder="P 0.00" style="width:100%"></div>
                <div class="col-1">-</div>
                <div class="col"><input type="number" name="maxFood" id="maxFood" min="0" placeholder="P 0.00" style="width:100%"></div>
                <div class="row d-flex justify-content-center ">
                    <div class="col my-2">
                        <button class="btn btn-secondary " style="width:100%" id="budget-main-btn">Apply</button>
                    </div>

                </div>
            </div>
        </div>


        <div class="main <?= $isLoggedIn ? 'logged' : "" ?>" id="spots-container">
            <div class="alert alert-success bg-success text-light">

            </div>
            <div class="alert alert-danger bg-danger text-light">

            </div>
            <?php
            if ($isLoggedIn) {
            ?>

                <div class="profile-container">
                    <div class="profile main-profile">
                        <?php
                        if ($img == null) {
                            echo '<div class="image-default"><i class="fa-solid fa-user"></i></div>';
                        } else {
                        ?>
                            <img src="<?= $img ?>" alt="Profile" referrerpolicy="no-referrer" />
                        <?php
                        }
                        ?>
                        <h5><?= $name ?></h5>
                    </div>

                    <div class="stats-container">
                        <div class="stats">
                            <div class="stat">
                                <p id="spots-visited"><?= $rated_places ?></p>
                                <h5>Rated Places</h5>
                            </div>
                            <div class="stat">
                                <p id="spots-rated"><?= $rated_comments ?></p>
                                <h5>Rated with comments</h5>
                            </div>
                            <div class="stat">
                                <p id="spots-reviewed"><?= $rated_pictures ?></p>
                                <h5>Rated with pictures</h5>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
            <div class="search-container">
                <input type="text" class="form-control txtSearch" placeholder="Start searching" />
                <button class="btn btn-primary">Search</button>
            </div>
            <h1 class="main-title <?= $isLoggedIn ? 'hidden' : '' ?>">
                <span class="light-blue">LOVE</span> <span class="dark-blue">PHILIPPINES</span>, <br class="hide-when-sm">
                <span class="red">LOVE</span> <span class="green">SAN PABLO!</span>
            </h1>
            <div class="container-fluid custom-tags d-flex justify-content-start ">
                <div class="row ">
                    <h5 class="vsf-blue">Tags</h5>
                    <div class="row">
                        <!-- <button >min - max <button>x</button></button> -->

                        <!-- button tags min max entrance fee -->
                        <button type="button" onclick="closingButtonTags(this, 'entrance_fee')" id="tags-entrance-fee" class="tags col-4 ms-1" style="width: 159px; display: none;">
                            <div class="row">
                                <div class="col-12 d-flex p-0">
                                    <span style="font-size: 15px;">Entrance Fee</span>
                                </div>
                                <div class="col-12 d-flex  ps-0">
                                    <span class="button__text" id="tags-entrance-fee-text" style="color:#4477ce">P 100 -P 1000</span>
                                </div>
                            </div>
                            <span class="button__icon" style="font-size:30px;color:white;border-radius:0px 5px 5px 0px;">&times;</span>
                        </button>

                        <!-- button tags min max food prices fee -->
                        <button type="button" class="tags col-4 ms-1" onclick="closingButtonTags(this, 'food')" style="width: 159px;  display: none;" id="tags-food-fee">
                            <div class="row">
                                <div class="col-12 d-flex p-0">
                                    <span style="font-size: 15px;">Food Prices</span>
                                </div>
                                <div class="col-12 d-flex  ps-0">
                                    <span class="button__text" style="color:#4477ce" id="tags-food-fee-text">P 100 -P 1000</span>
                                </div>
                            </div>
                            <span class="button__icon" style="font-size:30px;color:white;border-radius:0px 5px 5px 0px;">&times;</span>
                        </button>

                        <!-- button tags for spot types -->
                        <button type="button" onclick="closingButtonTags(this, 'spot_type')" class="tags col-4 ms-1" style="width: 159px;  display: none;" id="tags-spot-type">
                            <div class="row">
                                <div class="col-12 d-flex p-0">
                                    <span style="font-size: 15px;">Spot Type</span>
                                </div>
                                <div class="col-12 d-flex  ps-0">
                                    <span class="button__text" style="color:#4477ce" id="tags-spot-type-text">Hotel</span>
                                </div>
                            </div>
                            <span class="button__icon" style="font-size:30px;color:white;border-radius:0px 5px 5px 0px;">&times;</span>
                        </button>


                    </div>

                </div>
            </div>
            <div class="letters-container">
                <span class="btnLetter" style="font-weight: 700;" data-id="A">A</span>
                <span class="btnLetter" data-id="B">B</span>
                <span class="btnLetter" data-id="C">C</span>
                <span class="btnLetter" data-id="D">D</span>
                <span class="btnLetter" data-id="E">E</span>
                <span class="btnLetter" data-id="F">F</span>
                <span class="btnLetter" data-id="G">G</span>
                <span class="btnLetter" data-id="H">H</span>
                <span class="btnLetter" data-id="I">I</span>
                <span class="btnLetter" data-id="J">J</span>
                <span class="btnLetter" data-id="K">K</span>
                <span class="btnLetter" data-id="L">L</span>
                <span class="btnLetter" data-id="M">M</span>
                <span class="btnLetter" data-id="N">N</span>
                <span class="btnLetter" data-id="O">O</span>
                <span class="btnLetter" data-id="P">P</span>
                <span class="btnLetter" data-id="Q">Q</span>
                <span class="btnLetter" data-id="R">R</span>
                <span class="btnLetter" data-id="S">S</span>
                <span class="btnLetter" data-id="T">T</span>
                <span class="btnLetter" data-id="U">U</span>
                <span class="btnLetter" data-id="V">V</span>
                <span class="btnLetter" data-id="W">W</span>
                <span class="btnLetter" data-id="X">X</span>
                <span class="btnLetter" data-id="Y">Y</span>
                <span class="btnLetter" data-id="Z">Z</span>
            </div>
        </div>
    </div>

    <div class="visit-spot-container">
        <a href="#" id="close-visit-spot-container"><i class="fa-solid fa-xmark"></i></a>
        <div class="sss d-flex">
            <div class="visit-right-container">
                <h3 id="spot_name"></h3>
                <div class="rate-btns-container">
                    <div class="visit-stars-container">

                    </div>
                    <div class="button-container">
                        <a href="#" id="visitRate" data-id="">Rate</a>
                        <a href="#" id="readReviews" data-id="">Read Reviews</a>
                    </div>
                </div>
                <div class="photo-container mt-4">
                    <img class="big-img current-image" src="">
                    <div class="image-picker">
                    </div>
                </div>
                <div class="contents-map-container">
                    <div class="mt-4" id="mapContainer">
                    </div>

                    <div class="contents">
                        <div class="visit-location-container">
                            <h5>Location</h5>
                            <p id="visit-location-text"></p>
                        </div>
                        <div class="visit-description-container">
                            <h5>Description</h5>
                            <p id="visit-description-text"></p>
                        </div>
                        <div class="visit-amenities-container">
                            <h5>Amenities</h5>
                            <p id="visit-amenities-text"></p>
                        </div>
                        <div class="visit-nearby-container">
                            <h5>Nearby Spot</h5>
                            <p>Sample</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form class="rate-spot-container" id="rate-spot-container">
        <a href="#" id="close-rate-spot-container"><i class="fa-solid fa-xmark"></i></a>
        <div class="photo-container-rate">
            <img class="big-img current-image-rate" src="">
            <div class="image-picker-rate">
            </div>
        </div>
        <div class="rate-right-container">
            <h3 id="rate_spot_name"></h3>
            <div class="rate-btns-container">
                <div class="rate-stars-container">
                    <i class="fa-regular fa-star" data-value="1"></i>
                    <i class="fa-regular fa-star" data-value="2"></i>
                    <i class="fa-regular fa-star" data-value="3"></i>
                    <i class="fa-regular fa-star" data-value="4"></i>
                    <i class="fa-regular fa-star" data-value="5"></i>
                </div>
            </div>
            <textarea id="review" name="review" class="form-control"></textarea>
            <input class="form-control mt-3" accept="image/*" type="file" id="review-image" name="review-image" />
            <div class="button-container">
                <input type="submit" id="submit-rate" data-id="">
            </div>
        </div>
    </form>

    <div class="view-reviews-container">
        <a href="#" id="close-view-revies-container"><i class="fa-solid fa-xmark"></i></a>
        <center>
            <h1 class="review-title">Reviews</h1>
        </center>
        <div class="reviews-container">

        </div>
    </div>

    <button id="scroll-up" class="btn btn-secondary"><i class="fa-solid fa-arrow-up"></i></button>

    <script src="./assets/bootstrap-5.3.2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
    <script src="user/js/index.js"></script>
</body>

</html>
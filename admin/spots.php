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
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
            <link rel="stylesheet" href="css/navigation.css">
            <link rel="stylesheet" href="css/spots.css">
            <title>Manage Spots</title>
        </head>

        <div class="alert alert-success bg-success text-light">

        </div>
        <div class="alert alert-danger bg-danger text-light">

        </div>

        <body>
            <div class="side-nav-container">
                <div class="logo-container">
                    <img src="../assets//vsf-final-logo.png" alt="VSF">
                </div>
                <div class="navigations-container">
                    <a href="dashboard.php"><i class="fa-solid fa-table-list"></i> Dashboard</a>
                </div>
                <div class="navigations-container">
                    <a href="accounts.php"><i class="fa-solid fa-users"></i> Account Signed in</a>
                </div>
                <div class="navigations-container">
                    <a href="ratings-and-reviews.php"><i class="fa-solid fa-star-half-stroke"></i> Ratings & Reviews</a>
                </div>
                <div class="navigations-container navigations-container-active">
                    <a href="spots.php"><i class="fa-solid fa-gear"></i> Manage Spots</a>
                </div>
                <center class="logout">
                    <a href="process/logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i>Logout</a>
                </center>
            </div>
            <div class="main-contents-container">
                <div class="top-contents-container">
                    <h1 class="welcome-admin">Welcome Admin!</h1>

                    <div class="select-container">
                        <select class="spot-select-action" id="spot-select-action">
                            <option value="view">Listed Spots</option>
                            <option value="add">Add Another Spot</option>
                        </select>
                        <i class="fa-solid fa-sort-down"></i>
                    </div>
                </div>

                <div class="spot-container" id="spot-container">

                </div>

                <form class="spot-edit-container" id="spot-edit-container">
                    <center id="edit-title"></center>
                    <a href="#" id="close-edit-spot-container"><i class="fa-solid fa-xmark"></i></a>
                    <div class="edit-contents-container">
                        <input type="hidden" name="spot_id" id="spot-id">
                        <div class="input-container">
                            <input type="text" name="spot_name" id="spot-name" class="form-control">
                            <label for="spot-name">Name of tourist spot</label>
                        </div>
                        <div class="input-container">
                            <input type="text" name="location" id="location" class="form-control">
                            <label for="location">Location</label>
                        </div>
                        <div class="input-container">
                            <textarea name="description" id="description" class="form-control"></textarea>
                            <label for="description">Description</label>
                        </div>
                        <div class="input-container">
                            <textarea name="amenities" id="amenities" class="form-control"></textarea>
                            <label for="amenities">Amenities</label>
                        </div>
                        <div class="input-container">
                            <textarea name="map" id="map" class="form-control"></textarea>
                            <label for="map">Map</label>
                        </div>
                        <div class="input-container">
                            <textarea name="budget" id="budget" class="form-control"></textarea>
                            <label for="budget">Budget</label>
                        </div>
                        <div class="input-container">
                            <textarea name="entrance_fee" id="entrance_fee" class="form-control"></textarea>
                            <label for="entrance_fee">Entrance Fee</label>
                        </div>
                        
                        <div class="categories-container">
                            <div class="select-container">
                                <select id="spot-type" name="spot_type" class="form-control">
                                    <option value=""></option>
                                    <option value="Hotel">Hotel</option>
                                    <option value="Resort">Resort</option>
                                    <option value="Lake">Lake</option>
                                    <option value="Mall">Mall</option>
                                    <option value="Farm">Farm</option>
                                    <option value="Restaurant">Restaurant</option>
                                </select>
                                <label for="spot-type">Spot Type</label>
                            </div>
                            <!-- <div class="select-container">
                                <select id="category" name="category" class="form-control">
                                    <option value=""></option>
                                    <option value="Attractions">Attractions</option>
                                    <option value="Tours">Tours</option>
                                    <option value="Day Trips">Day Trips</option>
                                    <option value="Outdoor Activities">Outdoor Activities</option>
                                </select>
                                <label for="category">Category</label>
                            </div>
                            <div class="select-container">
                                <select id="toa" name="toa" class="form-control">
                                    <option value=""></option>
                                    <option value="Nature & Parks">Nature & Parks</option>
                                    <option value="Sights & Landmarks">Sights & Landmarks</option>
                                    <option value="Spas & Wellness">Spas & Wellness</option>
                                    <option value="Water & Amusement">Water & Amusement</option>
                                    <option value="Parks">Parks</option>
                                    <option value="Boat Tours & Water">Boat Tours & Water</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Fun & Games">Fun & Games</option>
                                </select>
                                <label for="toa">Types of Attractions</label>
                            </div> -->
                        </div>
                        <div class="photo-container">
                            <div id="spot-photo-container">

                            </div>
                            <!-- <img src="" id="photo" alt="photo"> -->
                            <embed src="" id="business_permit" type="application/pdf">
                        </div>
                        <div class="uploads-container-edit">
                            <!-- <div class="upload-container-input-container"> -->
                            <!-- <input type="file" id="spot-photo" name="spot_photo" accept="image/jpeg, image/png">
                                <label for="spot-photo">Upload new photo (JPG, PNG)</label> -->
                            <!-- </div> -->
                            <div class="upload-container-input-container">
                                <input type="file" id="business-permit" name="business_permit" accept="application/pdf">
                                <label for="business-permit">Upload new Business permit (PDF)</label>
                            </div>
                        </div>
                    </div>
                    <div class="edit-buttons-container">
                        <button type="button" id="openAddNewPhoto" class="btn btn-success" data-id="">New Photo</button>
                        <button type="button" id="cancel-edit-spot" class="btn btn-dark">Cancel</button>
                        <input type="submit" name="sumit_edit_spot" id="btn-submit-edit-spot" class="btn" value="Save">
                    </div>
                </form>

                <form class="container card frm-upload-new-photo">
                    <center>
                        <h6>Upload new photo of spot <span id="addNewPhotoSpotId"></span></h6>
                    </center>
                    <div class="mt-3">
                        <input type="hidden" id="new_photo_spot_id" name="new_photo_spot_id">
                        <input type="file" name="new_photo" id="newPhoto" class="form-control" required>
                    </div>
                    <div class="mt-4 d-flex justify-content-center">
                        <button type="button" class="btn btn-dark m-1" id="cancelUploadNewPhoto">Cancel</button>
                        <button type="submit" class="btn btn-primary m-1">Upload</button>
                    </div>
                </form>

                <div class="modal" id="delete-spot-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Spot</h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this spot?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel-delete">Cancel</button>
                                <button type="button" class="btn btn-primary btn-delete-user" id="delete-spot" data-id="">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
            <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
            <script src="js/spots.js"></script>
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

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
            <link rel="stylesheet" href="css/accounts.css">
            <title>Accounts</title>
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
                <div class="navigations-container navigations-container-active">
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

                    <div class="select-container">
                        <select class="select-user-type" id="user-type">
                            <option value="user">User Accounts</option>
                            <option value="admin">Admin</option>
                        </select>
                        <i class="fa-solid fa-sort-down"></i>
                    </div>

                    <div class="add-new-account-container">
                        <a href="#" id="btn-add-new-account"><i class="fa-solid fa-plus"></i> Add Account</a>
                    </div>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email Address</th>
                                <th>Contact Number</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="users-response-container">

                        </tbody>
                    </table>
                </div>

                <div class="edit-user-container" id="edit-user-container">
                    <center class="edit-user-title">Edit User</center>
                    <a href="#" id="close-edit-user-container"><i class="fa-solid fa-xmark"></i></a>
                    <div class="f-row-container">
                        <div class="input-container">
                            <input type="text" id="edit-first-name" class="form-control">
                            <label for="edit-first-name">First Name</label>
                        </div>
                        <div class="input-container">
                            <input type="text" id="edit-last-name" class="form-control">
                            <label for="edit-last-name">Last Name</label>
                        </div>
                    </div>
                    <div class="s-row-container">
                        <div class="input-container">
                            <input type="text" id="edit-username" class="form-control">
                            <label for="edit-username">Username</label>
                        </div>
                        <div class="input-container">
                            <input type="text" id="edit-email" class="form-control">
                            <label for="edit-email">Email</label>
                        </div>
                    </div>
                    <div class="t-row-container">
                        <div class="input-container">
                            <input type="text" id="edit-contact-no" class="form-control">
                            <label for="edit-contact-no">Contact No</label>
                        </div>
                        <div class="input-container">
                            <input type="text" id="edit-address" class="form-control">
                            <label for="edit-address">Address</label>
                        </div>
                    </div>
                    <center class="btn-edit-save-container">
                        <input type="submit" id="edit-save-user" value="Save" class="btn-edit-save btn" data-id="">
                    </center>
                </div>

                <div class="modal" id="delete-user-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete User</h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this user?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel-delete">Cancel</button>
                                <button type="button" class="btn btn-primary btn-delete-user" id="delete-user" data-id="">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="add-account-container" id="frm-add-account">
                <center>Add New Account</center>
                <div class="first-row">
                    <div class="input-container">
                        <input type="text" name="fname" required class="form-control" id="fname" placeholder="Placeholder">
                        <label for="fname">First Name</label>
                    </div>
                    <div class="input-container">
                        <input type="text" name="lname" required class="form-control" id="lname" placeholder="Placeholder">
                        <label for="lname">Last Name</label>
                    </div>
                </div>
                <div class="second-row">
                    <div class="input-container">
                        <input type="text" name="address" required class="form-control" id="address" placeholder="Placeholder">
                        <label for="address">Address</label>
                    </div>
                </div>
                <div class="third-row">
                    <div class="input-container">
                        <input type="email" name="email" required class="form-control" id="email" placeholder="Placeholder">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-container">
                        <input type="number" name="number" required class="form-control" id="number" placeholder="Placeholder">
                        <label for="number">Contact no.</label>
                    </div>
                </div>
                <div class="fourth-row">
                    <div class="input-container">
                        <input type="text" name="username" required class="form-control" id="username" placeholder="Placeholder">
                        <label for="username">Username</label>
                    </div>
                    <div class="input-container">
                        <input type="password" name="password" required class="form-control" id="password" placeholder="Placeholder">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="btn-container">
                    <input type="reset" id="reset-add-form" class="btn btn-dark" value="Cancel">
                    <input type="submit" id="submit" class="btn btn-primary">
                </div>
            </form>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
            <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
            <script src="js/accounts.js"></script>
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

<?php
if (
    isset($_POST['userType']) &&
    isset($_POST['id']) &&
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['username']) &&
    isset($_POST['email']) &&
    isset($_POST['contact_no']) &&
    isset($_POST['address'])
) {
    include('../../db/db.php');

    $userType = $_POST['userType'];
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $address = $_POST['address'];

    if ($userType === 'admin') {
        $sql = "UPDATE `admin` SET `USERNAME`='$username',`FIRST_NAME`='$first_name',`LAST_NAME`='$last_name',`EMAIL`='$email',`CONTACT_NO`='$contact_no',`ADDRESS`='$address' WHERE `ADMIN_ID` = '$id'";
    } else {
        $sql = "UPDATE `user` SET `USERNAME`='$username',`FIRST_NAME`='$first_name',`LAST_NAME`='$last_name',`EMAIL`='$email',`CONTACT_NO`='$contact_no',`ADDRESS`='$address' WHERE `USER_ID` = '$id'";
    }
    if ($conn->query($sql) === TRUE) {
        echo 'Editing Successful';
    } else {
        echo 'Editing Unsuccessful';
    }
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

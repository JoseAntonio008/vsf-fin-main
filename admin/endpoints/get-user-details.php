<?php
if (isset($_GET['userType']) && isset($_GET['id'])) {
    include('../../db/db.php');

    $userType = $_GET['userType'];
    $id = $_GET['id'];

    if ($userType === 'admin') {
        $sql = "SELECT * FROM admin WHERE ADMIN_ID = '$id'";
    } else {
        $sql = "SELECT * FROM user WHERE USER_ID = '$id'";
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $id = ($userType === 'admin') ? $user['ADMIN_ID'] : $user['USER_ID'];
        $first_name = $user['FIRST_NAME'];
        $last_name = $user['LAST_NAME'];
        $username = $user['USERNAME'];
        $email = $user['EMAIL'];
        $contact_no = $user['CONTACT_NO'];
        $address = $user['ADDRESS'];

        $response = [
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => $username,
            'email' => $email,
            'contact_no' => $contact_no,
            'address' => $address
        ];

        echo json_encode($response);
    } else {
        echo 'No User Found';
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

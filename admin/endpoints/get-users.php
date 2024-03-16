<?php
if (isset($_GET['userType'])) {
    include('../../db/db.php');

    $userType = $_GET['userType'];

    if ($userType === 'admin') {
        $admin_sql = "SELECT * FROM admin WHERE STATUS = 'active'";
        $admin_result = $conn->query($admin_sql);
        if ($admin_result->num_rows > 0) {
            while ($admin = $admin_result->fetch_assoc()) {
?>
                <tr>
                    <td><?php echo $admin['ADMIN_ID'] ?></td>
                    <td><?php echo $admin['FIRST_NAME'] . ' ' . $admin['LAST_NAME'] ?></td>
                    <td><?php echo $admin['USERNAME'] ?></td>
                    <td><?php echo $admin['EMAIL'] ?></td>
                    <td><?php echo $admin['CONTACT_NO'] ?></td>
                    <td><?php echo $admin['ADDRESS'] ?></td>
                    <td class="actions-td">
                        <a href="#" id="edit" class="btn btn-dark" data-admin_id="<?php echo $admin['ADMIN_ID'] ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="#" id="delete" class="btn btn-danger" data-admin_id="<?php echo $admin['ADMIN_ID'] ?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">
                    <center>No user found.</center>
                </td>
            </tr>
            <?php
        }
    } else {
        $user_sql = "SELECT * FROM user WHERE STATUS = 'active'";
        $user_result = $conn->query($user_sql);
        if ($user_result->num_rows > 0) {
            while ($user = $user_result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $user['USER_ID'] ?></td>
                    <td><?php echo $user['FIRST_NAME'] . ' ' . $user['LAST_NAME'] ?></td>
                    <td><?php echo $user['USERNAME'] ?></td>
                    <td><?php echo $user['EMAIL'] ?></td>
                    <td><?php echo $user['CONTACT_NO'] ?></td>
                    <td><?php echo $user['ADDRESS'] ?></td>
                    <td class="actions-td">
                        <a href="#" id="edit" class="btn btn-dark" data-admin_id="<?php echo $user['USER_ID'] ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="#" id="delete" class="btn btn-danger" data-admin_id="<?php echo $user['USER_ID'] ?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7">
                    <center>No user found.</center>
                </td>
            </tr>
    <?php
        }
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

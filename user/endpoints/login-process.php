<?php

require_once __DIR__ . '/../../lib/php-jwt/JWT.php';
require_once __DIR__ . '/../../lib/php-jwt/Key.php';
require_once __DIR__ . '/../../lib/php-jwt/SignatureInvalidException.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (isset($_POST['username']) && isset($_POST['password'])) {
    include('../../db/db.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_sql = "SELECT `USER_ID`, `PASSWORD`, `STATUS` FROM user WHERE `USERNAME` = '$username'";
    $login_result = $conn->query($login_sql);
    if ($login_result->num_rows > 0) {
        $user = $login_result->fetch_assoc();
        $user_password = $user['PASSWORD'];
        $status = $user['STATUS'];
        $user_id = $user['USER_ID'];
        if (password_verify($password, $user_password)) {
            if ($status === 'active') {
                session_start();
                $_SESSION['id'] = $user_id;
                echo 'Login Success';
            } else {
                echo 'Your account is deactivated.';
            }
        } else {
            echo 'Wrong email or password.';
        }
    } else {
        echo 'Wrong email or password.';
    }
}

else if (!isset($_POST['credential'])) {
    echo 'Username and Password is not Posted';
}

// If using Google Sign In
else if (isset($_POST["credential"])) {
    $keys = file_get_contents("https://www.googleapis.com/oauth2/v1/certs");

    if (strlen($keys) > 0) {
        $keys = json_decode($keys, true);
    } else {
        echo 'Error: Cannot get Google Public Keys';
        exit;
    }

    $jwt_header = json_decode(base64_decode(explode('.', $_POST["credential"])[0]), true);

    try {
        // Decode the credential
        $credential = JWT::decode($_POST["credential"], new Key($keys[$jwt_header["kid"]], $jwt_header["alg"]));

        $iss = $credential->iss;
        $azp = $credential->azp;
        $aud = $credential->aud;
        $sub = $credential->sub;
        $email = $credential->email;
        $email_verified = $credential->email_verified;
        $nbf = $credential->nbf;
        $name = $credential->name;
        $picture = $credential->picture;
        $given_name = $credential->given_name;
        $family_name = $credential->family_name;
        $locale = $credential->locale;
        $iat = $credential->iat;
        $exp = $credential->exp;
        $jti = $credential->jti;

        include('../../db/db.php');

        $login_sql = "SELECT `USER_ID`, `PASSWORD`, `STATUS` FROM user WHERE `EMAIL` = '$email'";
        $login_result = $conn->query($login_sql);

        // If user exists
        if ($login_result->num_rows > 0) {
            $user = $login_result->fetch_assoc();
            $user_password = $user['PASSWORD'];
            $status = $user['STATUS'];
            $user_id = $user['USER_ID'];

            if (!password_verify($sub, $user_password)) {
                echo 'Your Google Account is not connected to your account.';
                exit;
            }

            if ($status === 'active') {
                session_start();
                $_SESSION['id'] = $user_id;
                echo 'Login Success';
                header('Location: ../../index.php');
            } else {
                echo 'Your account is deactivated.';
            }
        }
        
        // If user does not exist, create new user
        else {
            $password = password_hash($sub, PASSWORD_DEFAULT);
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d');

            do {
                $user_id = rand(100000, 999999);
                $check_uid = $conn->query("SELECT * FROM user WHERE `USER_ID` = '$user_id'");
            } while ($check_uid->num_rows > 0);

            $final_userID = 'USER_' . $user_id;
            $sql = "INSERT INTO `user`(
                `USER_ID`, `PROFILE_IMG`, `USERNAME`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `CONTACT_NO`,
                `ADDRESS`, `FAVORITE_NUMBER`, `FAVORITE_LETTER`, `FAVORITE_PERSON`, `DATE_CREATED`, `STATUS`
            ) VALUES (
                '$final_userID', '$picture', '$email', '$password', '$given_name', '$family_name', '$email', '',
                '', -1, '', '', '$date', 'active'
            )";

            if ($conn->query($sql)) {
                $user_id = $conn->insert_id;
                session_start();
                $_SESSION['id'] = $user_id;
                echo 'Account successfully created with Google Account.';
                header('Location: ../../index.php');
            } else {
                echo 'Failed to create account with Google.';
            }
        }
    } catch (Exception $e) {
        // Invalid credential
        echo $e->getMessage();
        exit;
    }
}
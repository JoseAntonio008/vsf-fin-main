<?php
session_start();
if (isset($_SESSION['id'])) {
    include('../../db/db.php');
    $id = $_SESSION['id'];
    $user_sql = "SELECT * FROM user WHERE `USER_ID` = '$id'";
    $user_result = $conn->query($user_sql);

    if ($user_result->num_rows > 0) {
        $has_img = isset($_FILES["review_image"]);

        if ($has_img) {
            $img = $_FILES["review_image"];
            $arr = explode('.', $img['name']);
            $extension = strtolower(end($arr));
            $review_image_name = "review_".time().".".$extension;
            $path = "../../assets/reviews/".$review_image_name;

            if (!move_uploaded_file($img["tmp_name"], $path)) {
                echo "Error uploading image.";
                exit;
            }
        }

        if (isset($_POST['ratingValue']) && isset($_POST['review']) && isset($_POST['spot_id'])) {
            $rating = $_POST['ratingValue'];
            $review = $_POST['review'];
            $spot_id = $_POST['spot_id'];
            $currentDatetime = date('y-m-d H:i:s');
            $insert_review_sql = "INSERT INTO `reviews`(`SPOT_ID`, `USER_ID`, `REVIEW`, `PICTURE`, `RATE`, `DATE`) 
                                  VALUES ('$spot_id','$id','$review', ". ($has_img ? "'$review_image_name'" : 'NULL') .", '$rating','$currentDatetime')";

                
            if ($conn->query($insert_review_sql) === TRUE) {
                echo 'Your review is successfully recorded!';
            } else {
                echo 'Connection Error';
            }
        } else {
            echo 'invalid';
        }
    } else {
        echo "Please log in your account before creating a review!";
    }
} else {
    echo "Please log in your account before creating a review!";
}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,200;1,500&family=Roboto+Condensed:wght@300;400&display=swap');
    </style>
    <title>Login</title>
</head>

<body>
    <div class="left-container">
        <div class="VSF">
            <div class="bg-img-container">
                <!-- <img src="../assets/San_Pablo_City_Cathedral.jpg"> -->
            </div>
            <img src="../assets//vsf-final-logo.png" class="logo" alt="VSF">
        </div>
    </div>
    <div class="right-container">
        <form class="login-contents-container" id="login-form">
            <div class="user-icon-container">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="login-txt-field-container">
                <div class="username-container">
                    <input type="text" class="username" id="username" name="username" placeholder="username">
                    <label for="username">Username</label>
                </div>
                <div class="password-container">
                    <input type="password" class="password" id="password" name="password" placeholder="password">
                    <div class="show-password-container" id="show-password" data-current-status="hidden">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <label for="password">Password</label>
                </div>
            </div>
            <input type="submit" class="btn-login" id="btn-login" value="Login">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
</body>

</html>
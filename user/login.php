<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,200;1,500&family=Roboto+Condensed:wght@300;400&display=swap');
    </style>
    <script src="https://accounts.google.com/gsi/client" async></script>
    <title>Login</title>
</head>

<body>

    <div class="login-contents-container">
        <img src="../assets/vsf-final-logo.png" class="logo" alt="logo">
        <form class="login-form" id="login-form">
            <center>Sign in</center>
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
                <a href="../forgot-password/forgot-password-one.php" class="a-forgot-password">Forgot password?</a>
            </div>
            <div class="buttons-container">
                <input type="submit" class="btn-login" id="btn-login" value="Login">
                <p>or</p>
                <div id="g_id_onload"
                    data-client_id="748856928373-773hrm15fhdfbub2qcrvl76v3actd0dt.apps.googleusercontent.com"
                    data-login_uri="http://localhost/vsf/user/endpoints/login-process.php"
                    data-auto_prompt="false">
                </div>
                <div class="g_id_signin"
                    data-type="standard"
                    data-size="large"
                    data-theme="outline"
                    data-text="sign_in_with"
                    data-shape="rectangular"
                    data-logo_alignment="left">
                </div>
                <a href="signup.php" class="create-account">Create an Account</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
</body>

</html>
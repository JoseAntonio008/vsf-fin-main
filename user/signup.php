<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,200;1,500&family=Roboto+Condensed:wght@300;400&display=swap');
    </style>
    <title>Sign up</title>
</head>

<body>
    <div class="alert alert-success bg-success text-light">
    </div>
    <div class="alert alert-danger bg-danger text-light">
    </div>
    <img src="../assets/login-bg.png" class="bg-img">
    <img src="../assets/vsf-final-logo.png" class="logo">

    <form id="sign-up-form" class="sign-up-form">
        <center class="signup-title">Sign in</center>
        <div class="f-row">
            <div class="input-container">
                <input type="text" id="fname" required name="fname" class="form-control" placeholder="placeholder">
                <label for="fname">First Name</label>
            </div>
            <div class="input-container">
                <input type="text" id="lname" required name="lname" class="form-control" placeholder="placeholder">
                <label for="lname">Last Name</label>
            </div>
        </div>
        <div class="s-row">
            <div class="input-container">
                <input type="text" required id="address" name="address" class="form-control" placeholder="placeholder">
                <label for="address">Address</label>
            </div>
        </div>
        <div class="t-row">
            <div class="input-container">
                <input type="email" required id="email" name="email" class="form-control" placeholder="placeholder">
                <label for="email">Email</label>
            </div>
            <div class="input-container">
                <input type="number" required id="number" name="number" class="form-control" placeholder="placeholder">
                <label for="number">Contact no.</label>
            </div>
        </div>
        <div class="frth-row">
            <div class="input-container">
                <input type="text" required id="username" name="username" class="form-control" placeholder="placeholder">
                <label for="username">Username</label>
            </div>
            <div class="input-container">
                <input type="password" required id="password" name="password" class="form-control" placeholder="placeholder">
                <label for="password">Password</label>
            </div>
        </div>

        <hr class="line">

        <div class="recover-password-container">
            <div class="rpc-ic-container">
                <div class="input-container">
                    <input type="number" required id="favNumber" name="favNumber" class="form-control" placeholder="placeholder">
                    <label for="favNumber">Favorite Number</label>
                </div>
                <div class="input-container">
                    <input type="text" required id="favLetter" name="favLetter" class="form-control" placeholder="placeholder">
                    <label for="favLetter">Favorite Letter</label>
                </div>
                <div class="input-container">
                    <input type="text" required id="favPerson" name="favPerson" class="form-control" placeholder="placeholder">
                    <label for="favPerson">Favorite Person</label>
                </div>
            </div>
        </div>

        <div class="fifth-row">
            <a href="login.php" class="btn btn-secondary">Back to Login</a>
            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Signup">
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
    <script src="js/signup.js"></script>
</body>

</html>
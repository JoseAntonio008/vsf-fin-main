<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgot-password.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,200;1,500&family=Roboto+Condensed:wght@300;400&display=swap');
    </style>
</head>

<body>
    <div class="alert alert-success bg-success text-light">asd
    </div>
    <div class="alert alert-danger bg-danger text-light">
        asd
    </div>

    <form class="frm-forgot-password container bg-light mt-5 p-5 card" id="frm-forgot-password">
        <h5>
            <center>Forgot Password</center>
        </h5>
        <div class="input-container">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="input-container">
            <label for="favNumber">Favorite Number</label>
            <input type="number" required id="favNumber" name="favNumber" class="form-control">
        </div>
        <div class="input-container">
            <label for="favLetter">Favorite Letter</label>
            <input type="text" required id="favLetter" name="favLetter" class="form-control">
        </div>
        <div class="input-container">
            <label for="favPerson">Favorite Person</label>
            <input type="text" required id="favPerson" name="favPerson" class="form-control">
        </div>
        <div class="button-container mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="../user/login.php" class="btn btn-dark">Back To Login</a>
        </div>
    </form>

    <form class="frm-change-password container card bg-light mt-5 p-5 bg-light" id="frmChangePassword">
        <center>
            <h5>
                Change Password
            </h5>
            <p>Hello<span id="nameOfUser"></span>, Please enter your new password.</p>
        </center>
        <div class="input-container">
            <label>New Password</label>
            <input type="password" class="form-control" name="newPassword" id="newPassword" data-id="">
        </div>
        <div class="mt-3">
            <a href="../user/login.php" class="btn btn-dark">Cancel</a>
            <button type="submit" class="btn btn-primary">Change</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
    <script src="forgot-password.js"></script>
</body>

</html>
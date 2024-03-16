$(document).ready(function () {
  $("#show-password").click(function (e) {
    e.preventDefault();
    var current_status = $(this).attr("data-current-status");
    var passwordInput = $("#password");
    const cursorPosition = passwordInput[0].selectionStart;

    if (current_status === "hidden") {
      $("#password").attr("type", "text");
      $(this).attr("data-current-status", "show");
      $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
    } else {
      $("#password").attr("type", "password");
      $(this).attr("data-current-status", "hidden");
      $(this).find("i").removeClass("fa-eye-slash").addClass("fa-eye");
    }

    passwordInput[0].setSelectionRange(cursorPosition, cursorPosition);
  });

  $("#login-form").submit(function (e) {
    e.preventDefault();

    var password = $("#password").val();
    var username = $("#username").val();

    if (password != "" && username != "") {
      $.ajax({
        type: "POST",
        url: "endpoints/login-process.php",
        data: {
          password: password,
          username: username,
        },
        success: function (response) {
          if (response === "Login Success") {
            window.location.href = '../index.php';
          } else {
            alert(response);
          }
        },
      });
    } else {
      alert("Please input username and password!");
    }
  });
});

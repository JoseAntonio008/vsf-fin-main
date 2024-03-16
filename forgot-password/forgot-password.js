$(document).ready(function () {
  $("#frm-forgot-password").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "forgot-password-endpoint.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response === "404") {
          console.log("User not found!");
        } else {
          $("#newPassword").data("data-id", response);
          $(".frm-forgot-password").css("display", "none");
          $(".frm-change-password").css({
            opacity: "1",
            "pointer-events": "auto",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });

  $("#frmChangePassword").submit(function (e) {
    e.preventDefault();
    var newPassword = $("#newPassword").val();
    var userId = $("#newPassword").data("data-id");

    $.ajax({
      type: "POST",
      url: "forgot-password-endpoint.php",
      data: {
        newPassword: newPassword,
        userId: userId,
      },
      success: function (response) {
        console.log(response);
        if (response == "Password Changed") {
          $(".alert-success")
            .css("opacity", "1")
            .html("<p>Password Changed!</p>");
          setTimeout(function () {
            $(".alert-success").css("opacity", 0);
            $(".alert-success").html("");
            window.location.href = "../user/login.php";
          }, 2000);
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });
});

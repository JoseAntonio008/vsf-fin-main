$(document).ready(function () {
  $("#sign-up-form").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: "endpoints/sign-up-process.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log(response);
        var notif = "<p>" + response + "</p>";
        if (response === "Account successfully created") {
          $("#submit").prop("disabled", true);
          $(".alert-success").html(notif);
          $(".alert-success").css("opacity", 1);

          setTimeout(function () {
            $(".alert-success").css("opacity", 0);
            $(".alert-success").html("");
            window.location.href = "login.php";
          }, 2000);
        } else {
          $(".alert-danger").html(notif);
          $(".alert-danger").css("opacity", 1);

          setTimeout(function () {
            $(".alert-danger").css("opacity", 0);
            $(".alert-danger").html("");
          }, 2000);
        }
      },
    });
  });
});

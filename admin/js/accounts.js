$(document).ready(function () {
  const getUsers = () => {
    var userType = $("#user-type").val();
    $.ajax({
      type: "GET",
      url: "endpoints/get-users.php",
      data: {
        userType: userType,
      },
      success: function (response) {
        $("#users-response-container").html(response);
      },
    });
  };

  const closeDeleteModal = () => {
    $("#delete-user").attr("data-id", "");
    $("#delete-user-modal").modal("hide");
  };

  const editContainerClose = () => {
    $(".edit-user-title").text("");
    $("#edit-first-name").val("");
    $("#edit-last-name").val("");
    $("#edit-username").val("");
    $("#edit-email").val("");
    $("#edit-contact-no").val("");
    $("#edit-address").val("");
    $("#edit-save-user").attr("data_id", "");

    $(".edit-user-container").css("display", "none");
  };

  $("#user-type").change(function (e) {
    e.preventDefault();
    var userType = $("#user-type").val();
    if (userType === "user") {
      $(".add-new-account-container").css("display", "none");
    } else {
      $(".add-new-account-container").css("display", "flex");
    }
    getUsers();
  });

  $(document).on("click", "#delete", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-admin_id");
    $("#delete-user").attr("data-id", id);

    $("#delete-user-modal").modal("show");
  });

  $("#cancel-delete").click(function (e) {
    e.preventDefault();
    closeDeleteModal();
  });

  $("#delete-user").click(function (e) {
    e.preventDefault();
    var userType = $("#user-type").val();
    var id = $(this).attr("data-id");

    $.ajax({
      type: "POST",
      url: "endpoints/delete-user.php",
      data: {
        userType: userType,
        id: id,
      },
      success: function (response) {
        getUsers();
        closeDeleteModal();

        var notif = "<p>" + response + "</p>";

        if (response === "Deleted Successfully") {
          $(".alert-success").html(notif);
          $(".alert-success").css("opacity", 1);

          setTimeout(function () {
            $(".alert-success").css("opacity", 0);
            $(".alert-success").html("");
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

  $(document).on("click", "#edit", function (e) {
    e.preventDefault();
    var userType = $("#user-type").val();
    var id = $(this).attr("data-admin_id");

    $.ajax({
      type: "GET",
      url: "endpoints/get-user-details.php",
      data: {
        userType: userType,
        id: id,
      },
      success: function (response) {
        var data = JSON.parse(response);

        $(".edit-user-title").text("Edit " + data.id);
        $("#edit-first-name").val(data.first_name);
        $("#edit-last-name").val(data.last_name);
        $("#edit-username").val(data.username);
        $("#edit-email").val(data.email);
        $("#edit-contact-no").val(data.contact_no);
        $("#edit-address").val(data.address);
        $("#edit-save-user").attr("data_id", data.id);

        $(".edit-user-container").css("display", "block");
      },
    });
  });

  $("#close-edit-user-container").click(function (e) {
    e.preventDefault();
    editContainerClose();
  });

  $("#edit-save-user").click(function (e) {
    e.preventDefault();
    var userType = $("#user-type").val();
    var id = $(this).attr("data_id");
    var first_name = $("#edit-first-name").val();
    var last_name = $("#edit-last-name").val();
    var username = $("#edit-username").val();
    var email = $("#edit-email").val();
    var contact_no = $("#edit-contact-no").val();
    var address = $("#edit-address").val();

    $.ajax({
      type: "POST",
      url: "endpoints/edit-user-process.php",
      data: {
        userType: userType,
        id: id,
        first_name: first_name,
        last_name: last_name,
        username: username,
        email: email,
        contact_no: contact_no,
        address: address,
      },
      success: function (response) {
        var notif = "<p>" + response + "</p>";
        if (response === "Editing Successful") {
          $(".alert-success").html(notif);
          $(".alert-success").css("opacity", 1);

          setTimeout(function () {
            $(".alert-success").css("opacity", 0);
            $(".alert-success").html("");
          }, 2000);
        } else {
          $(".alert-danger").html(notif);
          $(".alert-danger").css("opacity", 1);

          setTimeout(function () {
            $(".alert-danger").css("opacity", 0);
            $(".alert-danger").html("");
          }, 2000);
        }

        editContainerClose();
        getUsers();
      },
    });
  });

  $("#btn-add-new-account").click(function (e) {
    e.preventDefault();
    $("#frm-add-account").css("display", "flex");
  });

  $("#reset-add-form").click(function (e) {
    $("#frm-add-account").css("display", "none");
  });

  $("#frm-add-account").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "endpoints/new-admin.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log(response);
        $("#frm-add-account")[0].reset();
        $("#frm-add-account").css("display", "none");
        var notif = "<p>" + response + "</p>";
        if (response === "Account Created") {
          $(".alert-success").css("opacity", 1);
          $(".alert-success").html(notif);
          setTimeout(function () {
            $(".alert-success").css("opacity", 0);
            $(".alert-success").html("");
          }, 2000);
        } else {
          $(".alert-danger").css("opacity", 1);
          $(".alert-danger").html(notif);
          setTimeout(function () {
            $(".alert-danger").css("opacity", 0);
            $(".alert-danger").html("");
          }, 2000);
        }
        getUsers();
      },
    });
  });

  getUsers();
});

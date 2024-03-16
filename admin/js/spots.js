$(document).ready(function () {
  const displaySpots = () => {
    var action = $("#spot-select-action").val();
    $.ajax({
      type: "GET",
      url: "endpoints/get-spots.php",
      data: {
        action: action,
      },
      success: function (response) {
        $("#spot-container").html(response);
      },
    });
  };

  const closeDeleteModal = () => {
    $("#delete-spot").attr("data-id", "");
    $("#delete-spot-modal").modal("hide");
  };

  const closeEditForm = () => {
    $("#spot-name").val("");
    $("#location").val("");
    $("#description").val("");
    $("#amenities").val("");
    $("#cancel-edit-spot").attr("src", "");
    $("#business_permit").attr("src", "");
    $("#map").val("");
    $("#spot-photo-container").empty();
    $(".spot-edit-container").css("display", "none");
  };

  const closeAddNewPhoto = () => {
    $("#addNewPhotoSpotId").text("");
    $("#new_photo_spot_id").val("");
    $(".frm-upload-new-photo").css("display", "none");
    $("#newPhoto").val("");
  };

  // -------------

  $("#spot-select-action").change(function (e) {
    e.preventDefault();
    displaySpots();
  });

  $(document).on("submit", "#add-spot-form", function (e) {
    e.preventDefault();

    var spotPhoto = $("#spot-photo").prop("files")[0];
    var businessPermit = $("#business-permit").prop("files")[0];
    if (!spotPhoto || !businessPermit) {
      var notif =
        "<p>Please upload both a spot photo and a business permit.</p>";

      $(".alert-danger").css("opacity", 1);
      $(".alert-danger").html(notif);
      setTimeout(function () {
        $(".alert-danger").css("opacity", 0);
        $(".alert-danger").html("");
      }, 2000);
      return;
    }

    var formData = new FormData(this);

    $.ajax({
      url: "endpoints/upload-spot.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        var notif = "<p>" + response + "</p>";

        if (response === "New spot created") {
          $("#spot-name").val("");
          $("#location").val("");
          $("#description").val("");
          $("#amenities").val("");
          $("#map").val("");
          $("#spot-type").val("");
          // $("#category").val("");
          // $("#toa").val("");
          $("#spot-photo").val(null);
          $("#business-permit").val(null);

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
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  $(document).on("click", "#delete", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-spot_id");
    $(".modal-title").text("Delete " + id);
    $("#delete-spot").attr("data-id", id);
    $("#delete-spot-modal").modal("show");
  });

  $("#cancel-delete").click(function (e) {
    e.preventDefault();
    closeDeleteModal();
  });

  $("#delete-spot").click(function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");

    $.ajax({
      type: "POST",
      url: "endpoints/delete-spot.php",
      data: {
        id: id,
      },
      success: function (response) {
        var notif = "<p>" + response + "</p>";
        if (response === "Deleted Successfully") {
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
        closeDeleteModal();
        displaySpots();
      },
    });
  });

  $(document).on("click", "#edit", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-spot_id");

    $.ajax({
      type: "GET",
      url: "endpoints/get-spot-details.php",
      data: {
        id: id,
      },
      success: function (response) {
        try {
          var data = JSON.parse(response);
          $("#edit-title").text("Edit " + data.spot_id);
          $("#openAddNewPhoto").data("id", data.spot_id);
          $("#spot-id").val(data.spot_id);
          $("#spot-name").val(data.spot_name);
          $("#location").val(data.location);
          $("#description").val(data.description);
          $("#budget").val(data.budget);
          $("#entrance_fee").val(data.entrance_fee);
          $("#amenities").val(data.amenities);
          $("#spot-type").val(data.spot_type);

          for (i = 0; i < data.spot_photo.length; i++) {
            // $("#photo").attr("src", "assets/spots-photo/" + data.spot_photo[0]);
            var newPhoto = $("<img>");
            $(newPhoto).attr("src", "assets/spots-photo/" + data.spot_photo[i]);
            $("#spot-photo-container").append(newPhoto);
          }

          $("#business_permit").attr(
            "src",
            "assets/business-permit/" + data.business_permit
          );

          $("#map").val(data.map);

          $(".spot-edit-container").css("display", "block");
        } catch {
          console.log("Edit Invalid");
        }
      },
    });
  });

  $("#close-edit-spot-container").click(function (e) {
    e.preventDefault();
    closeEditForm();
  });

  $("#cancel-edit-spot").click(function (e) {
    e.preventDefault();
    closeEditForm();
  });

  $("#spot-edit-container").submit(function (e) {
    e.preventDefault();
    // var spotPhoto = $("#spot-photo").prop("files")[0];
    // var businessPermit = $("#business-permit").prop("files")[0];

    var formData = new FormData(this);

    $.ajax({
      url: "endpoints/update-spot.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        var notif = "<p>" + response + "</p>";

        if (response === "Spot Updated") {
          closeEditForm();
          // $("#edit-title").text("");
          // $("#spot-id").val("");
          // $("#spot-name").val("");
          // $("#location").val("");
          // $("#description").val("");
          // $("#amenities").val("");
          // $("#photo").attr("src", "");
          // $("#business_permit").attr("src", "");

          $(".alert-success").css("opacity", 1);
          $(".alert-success").html(notif);
          setTimeout(function () {
            $(".alert-success").css("opacity", 0);
            $(".alert-success").html("");
          }, 2000);

          $(".spot-edit-container").css("display", "none");
          displaySpots();
        } else {
          $(".alert-danger").css("opacity", 1);
          $(".alert-danger").html(notif);
          setTimeout(function () {
            $(".alert-danger").css("opacity", 0);
            $(".alert-danger").html("");
          }, 2000);
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  $("#openAddNewPhoto").click(function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    closeEditForm();
    console.log(id);
    $("#addNewPhotoSpotId").text(id);
    $("#new_photo_spot_id").val(id);
    $(".frm-upload-new-photo").css("display", "block");
  });

  $("#cancelUploadNewPhoto").click(function (e) {
    e.preventDefault();
    closeAddNewPhoto();
  });

  $(".frm-upload-new-photo").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "endpoints/upload-new-spot-photo.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        var notif = "<p>" + response + "</p>";
        if (response === "200") {
          closeEditForm();
          $(".alert-success").css("opacity", 1);
          $(".alert-success").html("Photo Added!");
          setTimeout(function () {
            $(".alert-success").css("opacity", 0);
            $(".alert-success").html("");
          }, 2000);

          $(".spot-edit-container").css("display", "none");
          displaySpots();
        } else {
          $(".alert-danger").css("opacity", 1);
          $(".alert-danger").html(notif);
          setTimeout(function () {
            $(".alert-danger").css("opacity", 0);
            $(".alert-danger").html("");
          }, 2000);
        }
        closeAddNewPhoto();
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  displaySpots();
});

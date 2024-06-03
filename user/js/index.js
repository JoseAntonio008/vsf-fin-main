var spotTypeGlobal = "";

function closingButtonTags(e, purpose) {
  console.log(e)
  if (purpose === "entrance_fee") {
    getSpot(spotTypeGlobal ? spotTypeGlobal : "", spotTypeGlobal ? "category" : "", "dn", getFoodPrice(), getEntranceFee(true));
  }

  if (purpose === "food") {
    getSpot(spotTypeGlobal ? spotTypeGlobal : "", spotTypeGlobal ? "category" : "", "dn", getFoodPrice(true), getEntranceFee());
  }

  if (purpose === "spot_type") {
    document.querySelector("#tags-spot-type-text").innerHTML = "";
    spotTypeGlobal = "";
    getSpot("", "", "dn", getFoodPrice(), getEntranceFee());
  }
  e.style.display = "none";
}

const getSpot = (search, search_type, type, budget, entranceFee) => {
  console.trace("asdf")
  if (type === "ttd") {
    $(".letters-container").css("display", "flex");
  } else {
    $(".letters-container").css("display", "none");
  }

  $.ajax({
    type: "GET",
    url: "user/endpoints/get-spot.php",
    data: {
      search: search,
      search_type: search_type,
      type: type,
      budget: budget ?? "",
      entranceFee: entranceFee ?? ""
    },
    success: function (response) {
      $("#spots-container .remove-when-changing-the-state").remove();
      $("#spots-container").append(response);
    },
  });
};

$(document).ready(function () {
  // Initial Loaded Title
  getSpot("A", "LetterPicker", "ttd", getFoodPrice(), getEntranceFee());

  // For Range action button
  // * FOOD 
  $("#budget-main-btn-mobile").click(function (e) {
    e.preventDefault();
    getSpot(spotTypeGlobal ? spotTypeGlobal : "", spotTypeGlobal ? "category" : "", "dn", getFoodPrice(), getEntranceFee());
  });
  $("#budget-main-btn").click(function (e) {
    e.preventDefault();
    console.log("asdf")
    getSpot(spotTypeGlobal ? spotTypeGlobal : "", spotTypeGlobal ? "category" : "", "dn", getFoodPrice(), getEntranceFee());
  });

  // * ENTRANCE FEE 
  $("#entrance-main-btn-mobile").click(function (e) {
    e.preventDefault();
    getSpot(spotTypeGlobal ? spotTypeGlobal : "", spotTypeGlobal ? "category" : "", "dn", getFoodPrice(), getEntranceFee());
  });
  $("#entrance-main-btn").click(function (e) {
    e.preventDefault();
    console.log("was clekced", getFoodPrice(), getEntranceFee())
    getSpot(spotTypeGlobal ? spotTypeGlobal : "", spotTypeGlobal ? "category" : "", "dn", getFoodPrice(), getEntranceFee());
  });
  // * END OF For Range action button

  const closeVisitSpotContainer = () => {
    $("#spot_name").text("");
    $("#visitRate").attr("");
    $("#readReviews").attr("");
    $("#visit-location-text").text("");
    $("#visit-description-text").text("");
    $("#visit-amenities-text").text("");
    $("#mapContainer").empty();
    $(".visit-spot-container").css("display", "none");
    $(".image-picker").empty();
  };

  const closeRateSpotContainer = () => {
    $(".rate-spot-container").css("display", "none");
    $("#rate_spot_name").text("");
    $("#review").val("");
    $("#submit-rate").attr("");
    $(".rate-stars-container i").removeClass("fa-solid").addClass("fa-regular");
    $(".image-picker-rate").empty();
  };

  const updateStars = (ratingValue) => {
    $(".rate-stars-container i.fa-solid.fa-star").removeClass("fa-solid");
    $(".rate-stars-container i.fa-regular.fa-star")
      .slice(0, ratingValue)
      .addClass("fa-solid");
  };

  $(".btnDn").click(function (e) {
    e.preventDefault();
    $(".top-logo-image-container").css("background-image", "url('./assets/new/home/home bg.png')");
    $("#display-type").val("dn");
    getSpot("", "", "dn", getFoodPrice(), getEntranceFee());
  });

  $(".btnTtd").click(function (e) {
    e.preventDefault();
    $(this).css("font-weight", 600);
    $(".top-logo-image-container").css("background-image", "url('./assets/new/things to do/things to do bg.png')");
    $(".btnReviews").css("font-weight", 500);
    $(".letters-container span").css("font-weight", 500);
    $("#display-type").val("ttd");
    getSpot("", "", "ttd", getFoodPrice(), getEntranceFee());
  });

  $(".btnReviews").click(function (e) {
    e.preventDefault();
    $(this).css("font-weight", 600);
    $(".top-logo-image-container").css("background-image", "url('./assets/new/reviews/image 13.png')");
    $(".btnTtd").css("font-weight", 500);
    $("#display-type").val("reviews");
    getSpot("", "", "reviews", getFoodPrice(), getEntranceFee());
  });

  $(".side-nav ul li, .mobile ul li").click(function (e) {
    e.preventDefault();
    var search = $(this).text();
    spotTypeGlobal = search;
    document.querySelector("#tags-spot-type").style.display = "flex";
    document.querySelector("#tags-spot-type-text").innerHTML = search;
    var displayType = $("#display-type").val();
    $(".side-nav ul li").css("color", "black");
    $(this).css("color", "#51807c");

    getSpot(search, "category", displayType, getFoodPrice(), getEntranceFee());
  });

  $(".txtSearch").keyup(function (e) {
    e.preventDefault();
    $(".letters-container span").css("font-weight", 500);
    var search = $(this).val();
    var displayType = $("#display-type").val();
    console.log(search, "search")
    if (search == "") {
      getSpot("", "", displayType, getFoodPrice(), getEntranceFee());
    } else {
      getSpot(search, "search bar", displayType, getFoodPrice(), getEntranceFee());
    }
  });

  


  
  $(document).on("click", ".spot-container", function (e) {
    e.preventDefault();
    var spotID = $(this).attr("data-id");

    $.ajax({
      type: "PUT",
      url: "user/endpoints/update-visitno.php",
      data: {
        spotID: spotID,
      },
      success: function (response) { },
    });

    $.ajax({
      type: "GET",
      url: "admin/endpoints/get-spot-details.php",
      data: {
        id: spotID,
      },
      success: function (response) {
        try {
          var data = JSON.parse(response);
          console.log(data);
          $("#spot_name").text(data.spot_name);
          $("#visitRate").attr("data-id", data.spot_id);
          $("#readReviews").attr("data-id", data.spot_id);
          $("#visit-location-text").text(data.location);
          $("#visit-description-text").text(data.description);
          $("#visit-amenities-text").text(data.amenities);
          $(".current-image").attr(
            "src",
            "admin/assets/spots-photo/" + data.spot_photo[0]
          );
          $("#mapContainer").append(data.map);

          for (var i = 0; i < data.spot_photo.length; i++) {
            var imageButton = $("<button>");
            var imageInButton = $("<img>");

            $(imageInButton).attr(
              "src",
              "admin/assets/spots-photo/" + data.spot_photo[i]
            );

            $(imageButton).data(
              "id",
              "admin/assets/spots-photo/" + data.spot_photo[i]
            );
            $(imageButton).addClass("btnChangePhoto");

            $(imageButton).append(imageInButton);
            $(".image-picker").append(imageButton);
            console.log(data.spot_photo.length);
          }

          var numRegularStars = data.regular_stars;
          var regularStars = "";
          for (var i = 0; i < numRegularStars; i++) {
            regularStars += '<i class="fa-regular fa-star"></i>';
          }

          var numSolidStars = data.solid_stars;
          var solidStars = "";
          for (var i = 0; i < numSolidStars; i++) {
            solidStars += '<i class="fa-solid fa-star"></i>';
          }
          var totalStars = solidStars + regularStars;
          $(".visit-stars-container").html(totalStars);
        } catch {
          alert("Something wrong with the server!");
        }
      },
    });
    $(".visit-spot-container").css("display", "flex");
  });

  $("#close-visit-spot-container").click(function (e) {
    e.preventDefault();
    closeVisitSpotContainer();
  });

  $("#visitRate").on("click", function (e) {
    e.preventDefault();
    var spotID = $(this).attr("data-id");

    $.ajax({
      type: "GET",
      url: "admin/endpoints/get-spot-details.php",
      data: {
        id: spotID,
      },
      success: function (response) {
        try {
          var data = JSON.parse(response);
          $("#rate_spot_name").text(data.spot_name);
          $("#submit-rate").attr("data-id", data.spot_id);

          $(".current-image-rate").attr(
            "src",
            "admin/assets/spots-photo/" + data.spot_photo[0]
          );

          for (var i = 0; i < data.spot_photo.length; i++) {
            var imageButton = $("<button>");
            var imageInButton = $("<img>");

            $(imageInButton).attr(
              "src",
              "admin/assets/spots-photo/" + data.spot_photo[i]
            );

            $(imageButton).data(
              "id",
              "admin/assets/spots-photo/" + data.spot_photo[i]
            );
            $(imageButton).addClass("btnChangePhotoRate");

            $(imageButton).append(imageInButton);
            $(".image-picker-rate").append(imageButton);
            console.log(data.spot_photo.length);
          }
        } catch {
          alert("Something wrong with the server!");
        }
      },
    });
    $(".rate-spot-container").css("display", "flex");
    closeVisitSpotContainer();
  });

  $("#close-rate-spot-container").click(function (e) {
    e.preventDefault();
    closeRateSpotContainer();
  });

  // rating

  var ratingValue = 0;

  $(".rate-stars-container").on("click", "i", function () {
    ratingValue = $(this).data("value");

    if ($(this).hasClass("fa-solid")) {
      ratingValue--;
    }

    updateStars(ratingValue);
  });

  const filterBadWords = (review) => {
    var badWords = ["Gago", "gago", "Putangina", "putangina"];
    for (var i = 0; i < badWords.length; i++) {
      if (review.includes(badWords[i])) {
        return true;
      }
    }

    return false;
  };

  $("#rate-spot-container").submit(function (e) {
    e.preventDefault();
    var review = $("#review").val();
    var spot_id = $("#submit-rate").attr("data-id");
    const rateImg = $("#rate-spot-container #review-image").prop("files")[0];

    // If not valid image file
    if (rateImg && !rateImg.type.match("image.*")) {
      $(".alert-danger").html("<p>Only image files are allowed!</p>");
      $(".alert-danger").css("opacity", 1);

      setTimeout(function () {
        $(".alert-danger").css("opacity", 0);
        $(".alert-danger").html("");
      }, 2000);

      return;
    }

    if (filterBadWords(review)) {
      $(".alert-danger").html("<p>Bad words in reviews are not allowed!</p>");
      $(".alert-danger").css("opacity", 1);

      setTimeout(function () {
        $(".alert-danger").css("opacity", 0);
        $(".alert-danger").html("");
      }, 2000);
    } else {
      const form = new FormData();
      form.append("ratingValue", ratingValue);
      form.append("spot_id", spot_id);
      form.append("review", review);
      form.append("review_image", rateImg);

      $.ajax({
        type: "POST",
        url: "user/endpoints/insert-review.php",
        processData: false,
        contentType: false,
        data: form,
        success: function (response) {
          var notif = "<p>" + response + "</p>";
          if (response === "Your review is successfully recorded!") {
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
          closeRateSpotContainer();
        },
      });
    }
  });

  // view reviews

  $("#readReviews").click(function (e) {
    e.preventDefault();

    var id = $(this).attr("data-id");
    closeVisitSpotContainer();

    $.ajax({
      type: "GET",
      url: "user/endpoints/get-reviews.php",
      data: {
        id: id,
      },
      success: function (response) {
        var htmlElement = "";
        try {
          var data = JSON.parse(response);
          if (data.length > 0) {
            data.forEach((element) => {
              var username = element.username;
              var spotName = element.spot_name;
              var review = element.review;
              var rate = element.rate;

              var solidStars = rate;
              var regularStars = 5 - solidStars;

              var starHtml = "";
              for (var i = 1; i <= solidStars; i++) {
                starHtml += '<i class="fa-solid fa-star"></i>';
              }
              for (var i = 1; i <= regularStars; i++) {
                starHtml += '<i class="fa-regular fa-star"></i>';
              }

              var perReviewHtml =
                '<div class="per-review-container">' +
                '<div class="reviews-top-container">' +
                '<div class="review-user">' +
                '<i class="fa-solid fa-user"></i>' +
                "</div>" +
                '<div class="review-left-container">' +
                '<p class="review-by">' +
                username +
                "</p>" +
                '<div class="review-stars-container">' +
                starHtml +
                "</div>" +
                '<p class="review-to">' +
                spotName +
                "</p>" +
                "</div>" +
                "</div>" +
                '<div class="review-bot-container">' +
                "<p>" +
                review +
                "</p>" +
                "</div>" +
                "</div>";

              htmlElement += perReviewHtml;
            });
          } else {
            htmlElement = "<center><h1>No Reviews</h1></center>";
          }
          $(".reviews-container").html(htmlElement);
        } catch {
          $(".reviews-container").html(
            '<center class="no-reviews"><h1>No Reviews</h1></center>'
          );
        }
      },
    });

    $(".view-reviews-container").css("display", "flex");
  });

  $("#close-view-revies-container").click(function (e) {
    e.preventDefault();
    $(".view-reviews-container").css("display", "none");
  });

  $(document).on("click", ".btnChangePhoto", function (e) {
    e.preventDefault();
    var newPhoto = $(this).find("img").attr("src");
    $(".current-image").attr("src", newPhoto);
  });

  $(document).on("click", ".btnChangePhotoRate", function (e) {
    e.preventDefault();
    var newPhoto = $(this).find("img").attr("src");
    $(".current-image-rate").attr("src", newPhoto);
  });

  $(document).on("click", ".btnLetter", function (e) {
    e.preventDefault();
    $(".txtSearch").val("");
    var letter = $(this).data("id");
    $(".letters-container span").css("font-weight", 500);
    $(this).css("font-weight", 700);
    console.log(letter);
    getSpot(letter, "LetterPicker", "ttd", getFoodPrice(), getEntranceFee());
  });

  $("#toggle-top-nav").click(function (e) {
    e.preventDefault();
    $(".top-nav").css("transform", "translateX(0)");
  });

  $("#close-top-nav").click(function (e) {
    e.preventDefault();
    $(".top-nav").css("transform", "translateX(-100%)");
  });

  var scrollButton = $("#scroll-up");

  $(window).scroll(function () {
    // Show or hide the scroll button based on scroll position
    if ($(this).scrollTop() > 20) {
      scrollButton.fadeIn();
    } else {
      scrollButton.fadeOut();
    }
  });

  // Scroll to the top when the button is clicked
  scrollButton.click(function () {
    $("html, body").animate({ scrollTop: 0 }, "slow");
  });

  $("#selectSpotType").change(function (e) {
    e.preventDefault();
    var search = $(this).val();
    var displayType = $("#display-type").val();
    // $(".side-nav ul li").css("color", "black");
    // $(this).css("color", "#51807c");

    getSpot(search, "category", displayType, getFoodPrice(), getEntranceFee());
  });

  const rangeInputs = document.querySelectorAll('input[type="range"]')
  let isRTL = document.documentElement.dir === 'rtl'


  function handleInputChange(e) {
    let target = e.target
    if (e.target.type !== 'range') {
      target = document.getElementById('range')
    }
    const min = target.min
    const max = target.max
    const val = target.value
    let percentage = (val - min) * 100 / (max - min)

    if (isRTL) {
      percentage = (max - val)
    }

    target.style.backgroundSize = percentage + '% 100%'
  }

  rangeInputs.forEach(input => {
    input.addEventListener('input', handleInputChange)
  })

  // Handle element change, check for dir attribute value change
  function callback(mutationList, observer) {
    mutationList.forEach(function (mutation) {
      if (mutation.type === 'attributes' && mutation.attributeName === 'dir') {
        isRTL = mutation.target.dir === 'rtl'
      }
    })
  }



  // Listen for body element change
  const observer = new MutationObserver(callback)
  observer.observe(document.documentElement, { attributes: true })

  // $("#budget-main-btn").click(function (e) {
  //   e.preventDefault();
  //   var budget = $("#budget-main").val();
  //   var displayType = $("#display-type").val();
  //   getSpot("", "", displayType, budget);
  // });

  // $("#budget-sec-btn").click(function (e) {
  //   e.preventDefault();
  //   var budget = $("#budget-sec").val();
  //   var displayType = $("#display-type").val();
  //   getSpot("", "", displayType, budget);
  // });

  // getSpot("", "", "dn", 7500);
  //   $("#budget-apply-btn").click(function (e) {
  //     e.preventDefault();
  //     var minBudget = $("#min-budget").val();
  //     var budget = $("#max-budget").val();
  //     var displayType = $("#display-type").val();
  //     getSpot("", "", displayType, minBudget + ',' + budget); // Concatenate minBudget and budget
  // });

});

function getEntranceFee(isReset) {
  var windowScreen = window.screen.width;
  var minEntrance = document.querySelector(windowScreen <= 425 ? "#minEntrance-mobile" : "#minEntrance");
  var maxEntrance = document.querySelector(windowScreen <= 425 ? "#maxEntrance-mobile" : "#maxEntrance");

  if (isReset) {
    minEntrance.value = 0;
    maxEntrance.value = 0;
    return "0-0"
  }

  if (![""].includes(minEntrance.value) && !["0", ""].includes(maxEntrance.value)) {
    document.querySelector("#tags-entrance-fee").style.display = "flex";
    document.querySelector("#tags-entrance-fee-text").innerHTML = `P ${minEntrance ? minEntrance.value : 0} - P ${maxEntrance ? maxEntrance.value : 0}`
  }
  console.log(minEntrance, windowScreen)

  return `${minEntrance.value ? minEntrance.value : 0}-${maxEntrance.value ? maxEntrance.value : 0}`;
}

function getFoodPrice(isReset) {
  var windowScreen = window.screen.width;
  var minFood = document.querySelector(windowScreen <= 425 ? "#minFood-mobile" : "#minFood");
  var maxFood = document.querySelector(windowScreen <= 425 ? "#maxFood-mobile" : "#maxFood");

  if (isReset) {
    minFood.value = 0;
    maxFood.value = 0;
    return "0-0"
  }

  if (![""].includes(minFood.value) && !["0", ""].includes(maxFood.value)) {
    document.querySelector("#tags-food-fee").style.display = "flex";
    document.querySelector("#tags-food-fee-text").innerHTML = `P ${minFood ? minFood.value : 0} - P ${maxFood ? maxFood.value : 0}`
  }
  console.log(minFood, windowScreen)

  return `${minFood.value ? minFood.value : 0}-${maxFood.value ? maxFood.value : 0}`;
}

const currency = new Intl.NumberFormat('en-PH', {
  style: 'currency',
  currency: 'PHP',
});
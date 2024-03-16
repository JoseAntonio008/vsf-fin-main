$(document).ready(function () {
  var sort = $("#sort").val();
  var spotType = $("#SpotType").val();
  
  const getRatingsAndReviews = (sort, spotType) => {
    $.ajax({
      type: "GET",
      url: "endpoints/get-ratings-and-review.php",
      data: {
        sort: sort,
        spotType: spotType,
      },
      success: function (response) {
        $("#response-container").html(response);
      },
    });
  };

  let start = moment().format("YYYY-MM-DD");
  let end = moment().format("YYYY-MM-DD");

  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(s, e, label) {
    start = s.format("YYYY-MM-DD");
    end = e.format("YYYY-MM-DD");
  });

  $("#sort").change(function (e) {
    e.preventDefault();
    sort = $(this).val();
    getRatingsAndReviews(sort, spotType);
  });

  $("#SpotType").change(function (e) {
    e.preventDefault();
    spotType = $(this).val();
    getRatingsAndReviews(sort, spotType);
  });

  $("#selectTimeFrame").click(() => {
    $.ajax({
      type: "GET",
      url: "endpoints/get-ratings-and-review.php",
      data: {
        sort: sort,
        spotType: spotType,
        start: start,
        end: end
      },
      success: function (response) {
        $("#dialog-tf").modal("toggle");
        $(".tf-selected").css("display", "flex");
        $("#tf-message").html("Showing results from " + start + " to " + end);
        $("#response-container").html(response);

        setTimeout(() => {
          window.print();
        }, 500);
      },
    });
  });

  getRatingsAndReviews(sort, spotType);
});

$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "endpoints/dashboard-contents.php",
    success: function (response) {
      console.log(response);
      try {
        var data = JSON.parse(response);

        // var mappedDataPoints = $.map(data, function (item) {
        //   return { y: item.VISITS, label: item.SPOT_NAME };
        // });

        var mappedDataPoints2 = $.map(data, function (item) {
          return { y: item.TOTAL_RATE, label: item.SPOT_NAME };
        });

        // Replace the existing dataPoints array with the mapped data
        // chart.data.dataPoints = mappedDataPoints;
        options.data[0].dataPoints = mappedDataPoints2;
        // options.data[1].dataPoints = mappedDataPoints2;

        // Create the chart wi0th updated data
        $("#chartContainer").CanvasJSChart(options);
      } catch (error) {
        console.error("Error processing response:", error);
      }
    },
  });

  var options = {
    animationEnabled: true,
    theme: "light1",
    title: {
      text: "Vacation Spot Finder",
    },
    axisY2: {
      prefix: "",
      lineThickness: 1,
    },
    toolTip: {
      shared: true,
    },
    legend: {
      verticalAlign: "top",
      horizontalAlign: "center",
    },
    data: [
      // {
      //   type: "column",
      //   showInLegend: false,
      //   name: "Visits",
      //   axisYType: "secondary",
      //   color: "#4477CE",
      //   dataPoints: [],
      // },
      {
        type: "column",
        showInLegend: true,
        name: "Rate",
        axisYType: "secondary",
        color: "#4443AD",
        dataPoints: [],
      },
    ],
  };

  // var chart = new CanvasJS.Chart("chartContainer", {
  //   animationEnabled: true,
  //   theme: "light2",
  //   title: {
  //     text: "Gold Reserves",
  //   },
  //   axisY: {
  //     title: "Gold Reserves (in tonnes)",
  //   },
  //   data: [
  //     {
  //       type: "column",
  //       yValueFormatString: "#,##0.## tonnes",
  //       dataPoints: [],
  //     },
  //   ],
  // });

  // chart.render();
  $("#chartContainer").CanvasJSChart(options);
});

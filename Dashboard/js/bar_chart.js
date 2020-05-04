
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Sales & Marketing', 3],
      ['Warehouse', 2],
      ['Transport', 2],
      ['Operations', 2],
      ['Accounting', 2]
    ]);

      // Optional; add a title and set the width and height of the chart
      var options = {'title':'Employees Present by Department', 'width':550, 'height':400};

      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }
    

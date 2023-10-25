<?php
$conn=mysqli_connect("localhost","root","","expense_tracker");
if($conn){
}
else{
    echo "connection failed";
}
?>



<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['created_at', 'Expense', 'Income'],
          <?php
              $query = "select * from compare";
              $res = mysqli_query($conn,$query);
              while($data=mysqli_fetch_array($res)){
                  $time = $data['income_date'];
                  $expense = $data['amount_spent'];
                  $income = $data['amount_earned'];
          ?>
          ['<?php echo $time;?>',<?php echo $expense;?>,<?php echo $income;?>],
          <?php
              }

              

          ?>
        ]);

        var options = {
          title: 'Your Daily Expense Income Summary over the Days ',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body style="background-color: #d9edf7 ;">
    <div id="curve_chart" style="width: 1400px; height: 500px; color: #d9edf7 ;"></div>
  </body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href=" " type="image/x-icon">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <title>Pie Chart</title>
    <style> .center-block { display: block;margin-left: auto;margin-right: auto; }</style>
</head>
<body style="background-color: #d9edf7 ;">
<div class="container">
    <center>
        <div id="container"></div>
    </center>
    <img class="assets//img//helge.jpg" width="50">
 </div>
<?php
include "db_config.php"; // connection file with database
/*$query = "SELECT expense_category_id FROM expense_tbl"; // get the records on which pie chart is to be drawn
$getData = $con->query($query);
while($row = mysqli_fetch_assoc($getData)){
$expense_category_id= $row =['expense_category_id'];}

    $getAl = mysqli_query($con, "SELECT expense_category_name, amount FROM expense_category_tbl WHERE expense_category_id ='".$expense_category_id."' ");
    while($row = mysqli_fetch_assoc($getAl))
    {
    $_amount = $row['amount']; //SET AMOUNT
    $_expense_category_name = $row['expense_category_name']; 
    // exit;
    }
    $getBal = mysqli_query($con, "SELECT expense_category_id, SUM(amount_spent) AS amount_spent FROM expense_tbl WHERE expense_category_id ='".$expense_category_id." ' GROUP BY  expense_category_id ");
    $sum=0;
  while ($row = mysqli_fetch_assoc($getBal)){
    $_amount_spent = $row['amount_spent'];
    $sum += $_amount_spent;
}

$sum; */

$_sql = mysqli_query($con, "SELECT i.expense_category_id,  s.amount as amount, s.expense_category_name, SUM(i.amount_spent) as amount_spent
           FROM expense_tbl i, expense_category_tbl s  WHERE (i.expense_category_id = s.expense_category_id) group by i.expense_category_id");

$_sqlyy = mysqli_query($con, "SELECT i.expense_category_id,  s.amount as amount, s.expense_category_name, SUM(i.amount_spent) as amount_spent
           FROM expense_tbl i, expense_category_tbl s  WHERE (i.expense_category_id = s.expense_category_id) group by i.expense_category_id");



?>
<script>
    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: '#d9edf7',
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Your Expense Journey Till Now'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} &'
                },
                showInLegend: true
            }
        },
        series: [{
            size: 250,
            center: [300,120],

            name: 'Amount Spent',
            colorByPoint: true,
            data: [
                <?php
                $data = '';
                if ($_sql->num_rows>0){
                    while ($row = $_sql->fetch_object()){
                        $data.='{ name:"'.$row->expense_category_name.'",y:'.$row->amount_spent.'},';
                    }
                }
                echo $data
                ?>
            ]
        },{
            size: 250,
            center: [900,120],

            name: 'Budget',
            colorByPoint: true,
            data: [
                <?php
                $data = '';
                if ($_sqlyy->num_rows>0){
                    while ($row = $_sqlyy->fetch_object()){
                        $data.='{ name:"'.$row->expense_category_name.'",y:'.$row->amount.'},';
                    }
                }
                echo $data
                ?>
            ]
        }
        ]
    });
</script>
</body>
</html>
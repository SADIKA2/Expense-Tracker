<?php
$con  = mysqli_connect("localhost","root","","expense_tracker");
 if (!$con) {
     # code...
    echo "Problem in database connection! Contact administrator!" . mysqli_error();
 }else{
         //$sql ="SELECT * FROM expense_category_tbl";
        // $result = mysqli_query($con,$sql);
        $result = mysqli_query($con, "SELECT i.expense_category_id,  s.amount as amount, s.expense_category_name, SUM(i.amount_spent) as amount_spent
           FROM expense_tbl i, expense_category_tbl s  WHERE (i.expense_category_id = s.expense_category_id) group by i.expense_category_id");

         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $productname[]  = $row['expense_category_name']  ;
            $sales[] = $row['amount_spent'];
        }
 
 
 }
 
 
?>
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BarChart</title> 
    </head>
    <body style="background-color: #ADDFFF ;">
        <div style="width:70%;hieght:20%;text-align:center">
            <h2 class="page-header" >Expense Report </h2>
            <div>Category Based Expense</div>
            <canvas  id="chartjs_bar"></canvas> 
        </div>    
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                                "#583759",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#7E3517",
                                "#000080",
                                "#00CED1",
                                "#E2F516",
                                "#B041EF",

                                "#2ec551"
                                
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        
                        position: 'bottom',
 
                        labels: {
                        
                            fontColor: '#ADDFFF',
                            fontFamily: 'Circular Std Book',
                            fontSize: 16,

                        }
                    },
 
 
                }
                });
    </script>
</html>
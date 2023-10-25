<?php 
session_start();
ob_start();
require_once('db_config.php');
// $con = register('localhost', 'root', 'admin', 'expense_tracker');

//A function to get difference between to numbers
function diff($a=0, $b=0){
  $c = ($a - $b);
  return $c;
}
// echo diff(3,5);


	
if(isset($_POST['submit']) && !empty($_POST['amount_earned']) && !empty($_POST['income_category_id']) && !empty($_POST['income_date'])
&& !empty($_POST['income_description'])){  
    // echo print_r($_POST);
  // exit;
    $amount_earned = mysqli_real_escape_string($con,$_POST['amount_earned']);
    @$income_date = mysqli_real_escape_string($con,$_POST['income_date']);
    $income_description = mysqli_real_escape_string($con,$_POST['income_description']);
    $income_category_id = mysqli_real_escape_string($con,$_POST['income_category_id']);
    $income_created_at = date('Y-m-d');
    $zero ='0';

     //get a particular row amount and expense_name
    $getAll = mysqli_query($con, "SELECT income_category_name, income_amount FROM income_category_tbl WHERE income_category_id ='".$income_category_id." ' ");
    while($row = mysqli_fetch_assoc($getAll))
    {
    $_income_amount = $row['income_amount']; //SET AMOUNT
    $_income_category_name = $row['income_category_name']; 
    // exit;
    }
        
    $getBal = mysqli_query($con, "SELECT income_category_id, SUM(amount_earned) AS amount_earned FROM income_tbl WHERE income_category_id ='".$income_category_id." ' GROUP BY  income_category_id ");
    $sum=0;
  while ($row = mysqli_fetch_assoc($getBal)){
    $_amount_earned = $row['amount_earned'];
    $sum += $_amount_earned;
}

$sum;
//exit;

     $balance =  $_income_amount - $sum;
    // exit;

    if($balance < 0)
    {
    echo '
    <script type="text/javascript">
    confirm("You have acquired the expected earning in '.ucfirst($_income_category_name).' ");
    </script>'; 
    // exit;
    }

		$data = mysqli_query($con, "INSERT INTO income_tbl(income_category_id,income_description,income_date,income_created_at,in_deleted,amount_earned)
      VALUES('".$income_category_id."','".$income_description."','".$income_date."','".$income_created_at."','".$zero."','".$amount_earned."')");
		}	


    //if data inserted successfully
    if(@$data === TRUE)
    {
      echo '
         <script type="text/javascript">
          alert("Record entry successful!");
         </script>';
    
    }

else{
		$message = "All fields are required";
	}
?>





<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Record Income</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    
      <!--ASWESOME ICON-->
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
    
   <!--  <script language="javascript" type="text/javascript">
function removeSpaces(string) {
 return string.split(' ').join('');
}
</script> -->



<script language="JavaScript"><!--
function trim(strText) {
    // this will get rid of leading spaces
    while (strText.substring(0,1) == ' ')
        strText = strText.substring(1, strText.length);

    // this will get rid of trailing spaces
    while (strText.substring(strText.length-1,strText.length) == ' ')
        strText = strText.substring(0, strText.length-1);

   return strText;
}
//--></script>




</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0; color:#FF0">
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Expense Tracker</a> 
            </div>
           <!--  dddddddddd -->
 <div style="color: white;padding: 10px 20px 5px 20px;float: right;font-size: 16px;">Expense Tracker &nbsp; <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> </span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li></li>
                    <li>
			  <a href="logout.php"><span class="glyphicon glyphicon-log-out"> Logout</span></a></li>
            
            <li class="divider"></li>
            
               <li> <a href="changep.php"><i class="glyphicon glyphicon-edit"> Change Password</i></a></li>
                </ul>
            </div>
          </div>
        </nav>         
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/helge.jpg" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a   href=" "><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                   
                      
                    <li  >
                        <?php
                      echo" <li><a   href='index.php'><i class='fa fa-keyboard-o fa-2x'></i>Expense</a></li>";
                      ?>
                       
                    </li>


                    <!-- <li  >
                       
                  <?php

	
		echo' <li><a  href="expense_category.php"><i class="fa fa-cog fa-2x" aria-hidden="true"></i>Create Expense</a></li>';
			

 ?>          
                     </li> -->


                     <li  >
                        <?php
                      echo" <li><a class='active-menu' href='income_index.php'><i class='fa fa-money fa-2x'></i>Income</a></li>";
                      ?>
                       
                    </li>

                     <!-- <li  >
                       
                  <?php

	
		echo' <li><a  href="income_category.php"><i class="fa fa-dollar fa-2x" aria-hidden="true"></i>Create Income</a></li>';
			

 ?>          
                     </li>					 -->
					
                    <?php  

                    



                            
                    echo'   <li>
                        <a href="#"><i class="fa fa-list  fa-2x"></i>Expense Summery<span class="fa arrow"></span></a>
                        
                        
                        
                          <ul class="nav nav-second-level">
             <li>
                                <a href="expense_report.php "><i class="fa fa-file"></i>Expense Report</a>
                            </li>
                            <li>
                                <a href="income_report.php "><i class="fa fa-file-code-o"></i>Income Report </a>
                          
                            
                                    </li>
										  <li>
                                <a href="graphcharts.php "><i class="fa fa-bar-chart"></i>Graphs And Charts </a>
                          
                            
                                    </li>
                                </ul>
                               
                            </li>';
                            
                            
                   ?>         
                            
                            
                            
                            
       
                                </ul>
                               
                            </li>
                                                
                           </ul>
                               
                            </li>
                  <!--   </ul>-->
                      </li>  
                
      </li>				
		</ul>                             
  </li>       
                                  
               
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
               
                           <!--  Modals-->
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                            Modals Example
                        </div> -->
                        <div class="panel-body">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                           <i class="fa fa-plus-circle fa-2x"></i> Enter Income
                            </button>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle fa-1x"></i> Enter Income</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="header"  >
    	<!--<h3 >Add New Department</h3>-->
    </div>
    <div class="content">
        <div>
            <form action="income_index.php" method="POST" enctype="multipart/form-data">
                <!-- <div style=" margin-left:100px;"> -->

        <div class="row" >
        <div class="form-group col-md-6">
          <label for="income_category_id">Income Name:</label>
            <select class="form-control" name="income_category_id" id="income_category_id"  required="">
              <option value="" selected="">Choose Income Category</option>
              <?php 
                $getAll = mysqli_query($con, "SELECT * FROM income_category_tbl order by income_category_name ASC");
                  while($row = mysqli_fetch_array($getAll)):
                ?>
             <option value="<?php echo $row['income_category_id']; ?>">
                <?php echo  $row['income_category_name'];?>  
             </option>
           <?php endwhile; ?>   
         </select>
        </div>
       
                    
                  
            <div class="form-group col-md-6" >
               <label> Amount Earned: </label>
                 <input type="text" name="amount_earned" id="amount_earned"  class="form-control"placeholder="Please Enter Income Amount :"   onBlur="this.value=trim(this.value);" required>
             </div> 
              </div>        
            
         
              <div class="row" >
               <div class="form-group col-md-6">
                 <label> Income Description: </label>
                <input type="text" name="income_description" id="income_description"  class="form-control"placeholder="Please Enter Income Description :"   onBlur="this.value=trim(this.value);" required>
        </div> 
        

        <div class="form-group col-md-6">
            <label> Date: </label>
                <input type="date" name="income_date" id="income_date"  class="form-control"placeholder="Please Enter Income Date :"   onBlur="this.value=trim(this.value);" required>
      
         </div>
        </div>

        
            <?php  if(isset($message)){echo "<font color='FF0000'><h5>$message</font></h5>";} ?>
        
			
    <!-- </div> -->
                                        <!-- </div> -->
              <div class="row" >
               <div class="form-group">                      
                <div class="modal-footer">                   
                    <input type="submit" id="submit" name="submit"  value="Add" class="btn btn-primary" style=""/>
                    <input type="reset" id="rest" value="Cancel / Reset" class="btn btn-danger" style=""/> 
                 </div>
                </div>
             </div>
            </div>
           </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- End Modals-->
               
               
                    
               
               
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Category List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
        <th>Income Name</th>
        <th>Expected Amount </th>
        <th>Amount Earned </th>
        <th>Remaining Amount </th>
       
    </tr>
    </thead>
    <tbody>
  
                        
    <?php		
				$_sql = mysqli_query($con, "SELECT i.income_category_id,  s.income_amount as income_amount, s.income_category_name, SUM(i.amount_earned) as amount_earned
           FROM income_tbl i, income_category_tbl s  WHERE (i.income_category_id = s.income_category_id) group by i.income_category_id");
	// $sql = mysqli_query($con, "SELECT *FROM income_category_tbl i LEFT JOIN income_tbl s ON i.income_category_id= s.income_category_id
 //  WHERE (s.income_category_id>0 )");
//   if (!$_sql) {
//     printf("Error: %s\n", mysqli_error($con));
//     exit();
// } 
							while($row = mysqli_fetch_array($_sql))
			                   	{
							echo '<tr>';
							echo '<td>'. $row['income_category_name'] . '</td>';
              echo '<td>'. $row['income_amount'] . '</td>';
							echo '<td>'. number_format((float)$row['amount_earned'], 2, '.', ''). '</td>';
                $diff = diff($row['income_amount'], $row['amount_earned']);
                 echo '<td>';
              if($diff < 0 ){
               echo'<div class="btn btn-danger btn-xs" title="Congratulations You have earned more in '.$row['income_category_name'].'  category">'. number_format((float)($diff), 2, '.', '') . '</div>';
              }

              if($diff == 0 ){
               echo'<div class="btn btn-warning btn-xs" title="You are earning fine in '.$row['income_category_name'].'  category">'. number_format((float)($diff), 2, '.', '') . '</div>';
              }

              if($diff > 0 ){
                echo '<div class="btn btn-primary btn-xs" title="You have less earning in '.$row['income_category_name'].'  category"">'.number_format((float)($diff), 2, '.', '') . '</div>';
              }
             echo' </td>';
						}
						
						
						 ob_flush();
					?>
                        
      
                        
                        
                        </tbody>
                    </table>



                    
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>





                <!-- /. ROW  -->
            <div class="row"><!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- SWEETALERT SCRIPTS -->
   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->


        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();

            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
                
</body>
</html>
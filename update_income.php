<?php
session_start();
require_once('db_config.php');

	if(isset($_POST['submit']) && !empty($_POST['income_amount']) && !empty($_POST['income_name'])){ 
   
     $income_amount = mysqli_real_escape_string($con,$_POST['income_amount']);
     $income_name = mysqli_real_escape_string($con,$_POST['income_name']);
     $income_category_id = mysqli_real_escape_string($con,$_POST['getID']);
     // exit;
    $update = mysqli_query($con, "UPDATE income_category_tbl SET income_amount = '".$income_amount."', income_category_name= '".$income_name."' 
      WHERE income_category_id = '".$income_category_id."' ");
// exit;
    if($update === TRUE)
    {
      echo '
         <script type="text/javascript">
          alert("Category Edit Successful!");
          window.location.replace("income_category.php");
         </script>';
    
    }

else{
		echo '
         <script type="text/javascript">
          alert("Error!");
          window.location.replace("update.php ");
         </script>';
	}

}
// unset($_SESSION['income_category_id']);
mysqli_close($con);

		?>
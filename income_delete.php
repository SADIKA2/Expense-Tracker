<?php
	require_once('db_config.php');
	
	if(ISSET($_REQUEST['income_id'])){
		$income_id=$_REQUEST['income_id'];
		
		
		// $delete = mysqli_query($con, "DELETE FROM `income_tbl` WHERE `income_id`='$income_id'") or die("Failed to delete a row!");
		$sql = "DELETE FROM `income_tbl` WHERE `income_id`='$income_id'";
		$result = mysqli_query($con, $sql);
		// }	
    //if data deleted successfully
	if(@$result === TRUE)
		  { ?>
		<script type='text/javascript'>
		alert("Item deleted successfully!");
		window.location.replace("income_report.php");
		</script>
<?php 
	}
}
 mysqli_close($con);
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
// 	$(function(){
// Swal
// 	'text': 'This is from sweetalert2',
// 	'type': 'success'
// })
// 	});
</script>

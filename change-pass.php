<?php 
session_start();

//if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

    include "db_config.php";

if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if(empty($op)){
      header("Location: changep.php?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location: changep.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: changep.php?error=The confirmation password  does not match");
	  exit();
    }else {
    	// hashing the password
    	$op = md5($op);
    	$np = md5($np);
        //$id = $_SESSION['id'];

        $sql = "SELECT password
                FROM user WHERE 
                password='$op'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE user
        	          SET password='$np'";
        	mysqli_query($con, $sql_2);
        	header("Location: changep.php?success=Your password has been changed successfully");
	        exit();

        }else {
        	header("Location: changep.php?error=Incorrect password");
	        exit();
        }

    }

    
}else{
	header("Location: changep.php");
	exit();
}

/*}else{
     header("Location: index.php");
     exit();
}*/
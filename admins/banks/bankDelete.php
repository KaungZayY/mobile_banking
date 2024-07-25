<?php 
    session_start(); 
	include("../../connection.php");
    include("../authCheck.php");

	if (isset($_REQUEST['bid'])) {
		$bank_id=$_REQUEST['bid'];
		$Select="DELETE FROM banks WHERE bank_id='$bank_id'";
		$query=mysqli_query($connect, $Select);
		if(!$query){
			echo "<script>alert(' Cannot Remove Current Branch')
			window.location='bankList.php'
			</script>";
		}
		else{
			echo "<script>alert('Bank Branch was removed')
			window.location='bankList.php'
			</script>";
		}
	}

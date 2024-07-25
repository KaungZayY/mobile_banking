<?php 
    session_start(); 
	include("../../connection.php");
    include("../authCheck.php");

	if (isset($_REQUEST['tid'])) {
		$transaction_type_id=$_REQUEST['tid'];
		$Select="DELETE FROM transaction_type WHERE transaction_type_id='$transaction_type_id'";
		$query=mysqli_query($connect, $Select);
		if(!$query){
			echo "<script>alert(' Cannot Remove Current Transaction Type')
			window.location='transactionTypeList.php'
			</script>";
		}
		else{
			echo "<script>alert('Transaction Type was removed')
			window.location='transactionTypeList.php'
			</script>";
		}
	}

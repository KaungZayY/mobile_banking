<?php 
    session_start(); 
	include("../../connection.php");
    include("../authCheck.php");

	if (isset($_REQUEST['tid'])) {
		$type_of_loan_id=$_REQUEST['tid'];
		$Select="DELETE FROM type_of_loan WHERE type_of_loan_id='$type_of_loan_id'";
		$query=mysqli_query($connect, $Select);
		if(!$query){
			echo "<script>alert(' Cannot Remove Current Loan Type')
			window.location='typeOfLoanList.php'
			</script>";
		}
		else{
			echo "<script>alert('Loan Type was removed')
			window.location='typeOfLoanList.php'
			</script>";
		}
	}

<?php 
    session_start(); 
	include("../../connection.php");
    include("../authCheck.php");

	if (isset($_REQUEST['wid'])) {
        $wallet_status = 'Disabled';
		$wallet_id=$_REQUEST['wid'];

        $select="SELECT customer_id FROM wallets WHERE wallet_id=?";
		$stmt = mysqli_prepare($connect, $select);
		mysqli_stmt_bind_param($stmt, "i", $wallet_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($result);
		$customer_id=$data['customer_id'];

		$update="UPDATE wallets SET wallet_status=? WHERE wallet_id=?";
		$stmt = mysqli_prepare($connect, $update);
		mysqli_stmt_bind_param($stmt, "si", $wallet_status, $wallet_id);
		$query1=mysqli_stmt_execute($stmt);
		if ($query1) {
			echo "<script>alert('Wallet Disabled')
			window.location='../customerDetail.php?cid=$customer_id'
			</script>";
		}
        else{
            echo "<script>alert('Cannot Disable Wallet')
			window.location='../customerDetail.php?cid=$customer_id'
			</script>";
        }
	}

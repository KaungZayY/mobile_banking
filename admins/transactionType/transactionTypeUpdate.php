<?php 
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if(isset($_REQUEST['tid'])){
		$transaction_type_id=$_REQUEST['tid'];
		$select="SELECT * FROM transaction_type WHERE transaction_type_id=?";
		$stmt = mysqli_prepare($connect, $select);
		mysqli_stmt_bind_param($stmt, "i", $transaction_type_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($result);
		$transaction_type_id=$data['transaction_type_id'];
		$transaction_type=$data['transaction_type'];
	}

    if (isset($_POST['btnUpdate'])) {
		$transaction_type_id=$_POST['txtId'];
		$transaction_type=$_POST['txtType'];
		$update="UPDATE transaction_type SET transaction_type=? WHERE transaction_type_id=?";
		$stmt = mysqli_prepare($connect, $update);
		mysqli_stmt_bind_param($stmt, "si", $transaction_type, $transaction_type_id);
		$query1=mysqli_stmt_execute($stmt);
		if ($query1) {
			echo "<script>alert('Update Successful')
			window.location='transactionTypeList.php'
			</script>";
		}
        else{
            echo "<script>alert('Update Failed')
			window.location='transactionTypeList.php'
			</script>";
        }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="transactionTypeUpdate.php" method = "POST">
		<fieldset>
		<legend>Udpate Transaction Type</legend>
		<table>
			<tr>
				<td>Transaction Type</td>
				<td>
					<input type="hidden" name="txtId" required value="<?php echo $transaction_type_id; ?>">
					<input type="text" name="txtType" required placeholder="Own Account Transfer" value="<?php echo $transaction_type; ?>">
				</td>
			</tr>

			<tr><td></td>
				<td>
					<input type="submit" name="btnUpdate" value="Update" />
					<input type="reset" value="Cancel" />
				</td>
			</tr>
		</table>
		</fieldset>
	</form>
</body>
</html>
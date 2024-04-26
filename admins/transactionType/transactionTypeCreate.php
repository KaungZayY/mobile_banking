<?php 
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

	if(isset($_POST['btnSave'])){
		$transaction_type = $_POST['txtTransactionType'];

		//------check transaction type already exists
		$checkType = "SELECT * FROM transaction_type WHERE transaction_type=?";
		$stmt = mysqli_prepare($connect, $checkType);
		mysqli_stmt_bind_param($stmt, 's', $transaction_type);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if($res === false){
			echo"Error: ".mysqli_error($connect);
		}
		elseif (mysqli_num_rows($res) > 0){
			echo"<script>window.alert('Transaction Type Already Exist')</script>";
			echo"<script>window.location='transactionTypeCreate.php'</script>";
		}
		else{
			$insertQuery = "INSERT INTO transaction_type (transaction_type)
			VALUES (?)";
			$insertStmt = mysqli_prepare($connect, $insertQuery);
			mysqli_stmt_bind_param($insertStmt, 's', $transaction_type);
			$res1 = mysqli_stmt_execute($insertStmt);
			if(!$res1){
				echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
			}
			else{
				echo"<script>window.alert('New Transaction Type Added')</script>";
				echo"<script>window.location='transactionTypeList.php'</script>";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="transactionTypeCreate.php" method = "POST">
		<fieldset>
		<legend>Add New Transaction Type</legend>
		<table>
			<tr>
				<td>Transaction Type</td>
				<td>
					<input type="text" name="txtTransactionType" required placeholder="Own Wallet Transfer">
				</td>
			</tr>

			<tr><td></td>
				<td>
					<input type="submit" name="btnSave" value="Save" />
					<input type="reset" value="Cancel" />
				</td>
			</tr>
		</table>
		</fieldset>
	</form>
</body>
</html>
<?php 
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

	if(isset($_POST['btnSave'])){
		$type_of_loan = $_POST['txtTypeOfLoan'];
		$rate = $_POST['txtRate'];

		//------check loan already exists
		$checkLoan = "SELECT * FROM type_of_loan WHERE type_of_loan=?";
		$stmt = mysqli_prepare($connect, $checkLoan);
		mysqli_stmt_bind_param($stmt, 's', $type_of_loan);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if($res === false){
			echo"Error: ".mysqli_error($connect);
		}
		elseif (mysqli_num_rows($res) > 0){
			echo"<script>window.alert('Loan Type Already Exist')</script>";
			echo"<script>window.location='typeOfLoanList.php'</script>";
		}
		else{
			$insertQuery = "INSERT INTO type_of_loan (type_of_loan, rate)
			VALUES (?, ?)";
			$insertStmt = mysqli_prepare($connect, $insertQuery);
			mysqli_stmt_bind_param($insertStmt, 'ss', $type_of_loan, $rate);
			$res1 = mysqli_stmt_execute($insertStmt);
			if(!$res1){
				echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
			}
			else{
				echo"<script>window.alert('New Loan Type Added')</script>";
				echo"<script>window.location='typeOfLoanList.php'</script>";
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
	<form action="typeOfLoanCreate.php" method = "POST">
		<fieldset>
		<legend>Add New Loan Type</legend>
		<table>
			<tr>
				<td>Loan Type</td>
				<td>
					<input type="text" name="txtTypeOfLoan" required placeholder="6 months">
				</td>
			</tr>
            <tr>
			    <td>Interest Rate</td>
				<td>
					<input type="number" name="txtRate" required placeholder="5%">
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
<?php 
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if(isset($_REQUEST['tid'])){
		$type_of_loan_id=$_REQUEST['tid'];
		$select="SELECT * FROM type_of_loan WHERE type_of_loan_id=?";
		$stmt = mysqli_prepare($connect, $select);
		mysqli_stmt_bind_param($stmt, "i", $type_of_loan_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($result);
		$type_of_loan_id=$data['type_of_loan_id'];
		$type_of_loan=$data['type_of_loan'];
		$rate=$data['rate'];
	}

    if (isset($_POST['btnUpdate'])) {
		$type_of_loan_id=$_POST['txtId'];
		$type_of_loan=$_POST['txtTypeOfLoan'];
		$rate=$_POST['txtRate'];
		$update="UPDATE type_of_loan SET type_of_loan=?, rate=? WHERE type_of_loan_id=?";
		$stmt = mysqli_prepare($connect, $update);
		mysqli_stmt_bind_param($stmt, "sii", $type_of_loan, $rate, $type_of_loan_id);
		$query1=mysqli_stmt_execute($stmt);
		if ($query1) {
			echo "<script>alert('Update Successful')
			window.location='typeOfLoanList.php'
			</script>";
		}
        else{
            echo "<script>alert('Update Failed')
			window.location='typeOfLoanList.php'
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
	<form action="typeOfLoanUpdate.php" method = "POST">
		<fieldset>
		<legend>Update Loan Type</legend>
		<table>
			<tr>
				<td>Loan Type</td>
				<td>
					<input type="hidden" name="txtId" required value="<?php echo $type_of_loan_id; ?>">
					<input type="text" name="txtTypeOfLoan" required placeholder="6 months" value="<?php echo $type_of_loan; ?>">
				</td>
			</tr>
            <tr>
			    <td>Interest Rate</td>
				<td>
					<input type="number" name="txtRate" required placeholder="5 %" value="<?php echo $rate; ?>">
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
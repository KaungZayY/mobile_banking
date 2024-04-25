<?php 
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

	if(isset($_POST['btnSave'])){
		$txtPrefixCode = $_POST['txtPrefixCode'];
		$txtAddress = $_POST['txtAddress'];

		//------check branch already exists
		$checkBranch = "SELECT * FROM banks WHERE prefix_code=? AND bank_address=?";
		$stmt = mysqli_prepare($connect, $checkBranch);
		mysqli_stmt_bind_param($stmt, 'ss', $txtPrefixCode, $txtAddress);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if($res === false){
			echo"Error: ".mysqli_error($connect);
		}
		elseif (mysqli_num_rows($res) > 0){
			echo"<script>window.alert('Branch with Prefix Code Already Exist')</script>";
			echo"<script>window.location='bankCreate.php'</script>";
		}
		else{
			$insertQuery = "INSERT INTO banks (prefix_code, bank_address)
			VALUES (?, ?)";
			$insertStmt = mysqli_prepare($connect, $insertQuery);
			mysqli_stmt_bind_param($insertStmt, 'ss', $txtPrefixCode, $txtAddress);
			$res1 = mysqli_stmt_execute($insertStmt);
			if(!$res1){
				echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
			}
			else{
				echo"<script>window.alert('New Branch Added')</script>";
				echo"<script>window.location='bankList.php'</script>";
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
	<form action="bankCreate.php" method = "POST">
		<fieldset>
		<legend>Add New Branch</legend>
		<table>
			<tr>
				<td>Prefix Code</td>
				<td>
					<input type="text" name="txtPrefixCode" required placeholder="110011">
				</td>
			</tr>
            <tr>
			    <td>Address</td>
				<td>
					<input type="text" name="txtAddress" required placeholder="No-2 Baho Street Yangon">
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
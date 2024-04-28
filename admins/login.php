<?php
	include('loginHeader.php');
	session_start(); 
	include('../connection.php');
	if (isset($_POST['btnLogin'])) {
		$email = $_POST['txtEmail'];
		$password = $_POST['txtPassword'];
		
		// Create a prepared statement
		$select = "SELECT * FROM staffs WHERE staff_email=?";
		$stmt = mysqli_prepare($connect, $select);
		
		// Bind parameters to the prepared statement
		mysqli_stmt_bind_param($stmt, "s", $email);
		
		// Execute the prepared statement
		mysqli_stmt_execute($stmt);
		
		// Store the result
		$res = mysqli_stmt_get_result($stmt);
		
		// Fetch the data row
		$data_row = mysqli_fetch_array($res);
		
		if ($data_row != null && password_verify($password, $data_row['staff_password'])) {
			$_SESSION['staff_id']=$data_row['staff_id'];
			$_SESSION['staff_name']=$data_row['staff_name'];
			$_SESSION['staff_type_id']=$data_row['staff_type_id'];
			echo "<script>window.alert('Staff Login Successful')</script>";
			echo "<script>window.location='home.php'</script>";
		} else {
            echo "<script>window.alert('Cannot Login, check email and password again')</script>";
            echo "<script>window.location='login.php'</script>";
        }

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		form {
			width: 50%;
			margin: auto;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		fieldset {
			border: none;
			margin: 0;
			padding: 0;
		}
		legend {
			font-size: 20px;
			font-weight: bold;
			margin-bottom: 20px;
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		td {
			padding: 10px 0;
		}
		input[type="date"],
		input[type="number"],
		select,
		textarea {
			width: 100%;
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 5px;
			box-sizing: border-box;
			margin-bottom: 10px;
		}
		input[type="submit"],
		input[type="reset"] {
			padding: 10px 20px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		input[type="submit"]:hover,
		input[type="reset"]:hover {
			background-color: #45a049;
		}
	</style>
</head>
<body>
<form action="login.php" method="POST">
		<legend>Admin Login</legend>
		<table>
			<tr>
				<td>Email</td>
				<td><input type="text" name="txtEmail" required placeholder="youremail@example.com"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="txtPassword" required placeholder="123"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="btnLogin" value="Login">
					<input type="reset" name="btnCancel" value="Cancel">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>

<?php 
include('loginFooter.php');
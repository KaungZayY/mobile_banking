<?php
	session_start(); 
	include('../connection.php');
	if (isset($_POST['btnLogin'])) {
		$email = $_POST['txtEmail'];
		$password = $_POST['txtPassword'];
		
		// Create a prepared statement
		$select = "SELECT * FROM customers WHERE customer_email=?";
		$stmt = mysqli_prepare($connect, $select);
		
		// Bind parameters to the prepared statement
		mysqli_stmt_bind_param($stmt, "s", $email);
		
		// Execute the prepared statement
		mysqli_stmt_execute($stmt);
		
		// Store the result
		$res = mysqli_stmt_get_result($stmt);
		
		// Fetch the data row
		$data_row = mysqli_fetch_array($res);
		
		if ($data_row != null && password_verify($password, $data_row['customer_password'])) {
			$_SESSION['customer_id']=$data_row['customer_id'];
			$_SESSION['customer_name']=$data_row['customer_name'];
			echo "<script>window.alert('User Login Successful')</script>";
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
</head>
<body>
<form action="login.php" method="POST">
		<legend>Login</legend>
		<table>
			<tr>
				<td>Email</td>
				<td><input type="text" name="txtEmail" required placeholder="youremail@example.com"></td>
			</tr>
			<div>
				<!-- <a href="forgotPassword.php">Forgot password?</a>
				<span> | </span> -->
				<a href="register.php">Register as new Customer</a>
			</div>
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
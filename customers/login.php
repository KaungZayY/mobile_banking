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
				<a href="forgotPassword.php">Forgot password?</a>
				<span> | </span>
				<a href="register.php">Register as a member</a>
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
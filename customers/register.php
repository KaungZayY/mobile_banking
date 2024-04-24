<?php 
	include("connection.php");

	if(isset($_POST['btnSave'])){
		$txtName = $_POST['txtName'];
		$txtEmail = $_POST['txtEmail'];
		$txtPassword = $_POST['txtPassword'];
		$txtPhoneNumber = $_POST['txtPhoneNumber'];
		$txtAddress = $_POST['txtAddress'];
		$txtNrcNo = $_POST['txtNrcNo'];

		//---Upload Img---
		$fileProfile=$_FILES['fileProfile']['name'];//Assign var to ui element
		$Destination="images/profiles/";//file destination to copy
		$fileProfileName=$Destination . $txtName ."_". $fileProfile;//set file name before copy/dot is plus operator
        $copied = copy($_FILES['fileProfile']['tmp_name'], $fileProfileName);//copy(from,to)/so a(temp name) copy to (b)
        if(!$copied){
			echo"<p>Error Uploading Profile Image</p>";
			exit();
		}
		//----------------

        //---Upload Img---
		$fileNrc=$_FILES['fileNrc']['name'];//Assign var to ui element
		$Destination="images/nrcs";//file destination to copy
		$fileNrcName=$Destination . $txtName ."_". $fileNrc;//set file name before copy/dot is plus operator
		$copied = copy($_FILES['fileNrc']['tmp_name'], $fileNrcName);//copy(from,to)/so a(temp name) copy to (b)
		if(!$copied){
			echo"<p>Error Uploading NRC Image</p>";
			exit();
		}
		//----------------

		//------check email already exists
		$checkEmail = "SELECT * FROM customers WHERE customer_email=?";
		$stmt = mysqli_prepare($connect, $checkEmail);
		mysqli_stmt_bind_param($stmt, 's', $txtEmail);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if($res === false){
			echo"Error: ".mysqli_error($connect);
		}
		elseif (mysqli_num_rows($res) > 0){
			echo"<script>window.alert('Email Already Exist')</script>";
			echo"<script>window.location='register.php'</script>";
		}
		else{
            echo"<script>window.alert('Customer Account Created')</script>";
            echo"<script>window.location='login.php'</script>";
        }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="register.php" method = "POST" enctype="multipart/form-data">
		<fieldset>
		<legend>Create New Account</legend>
		<table>
			<tr>
				<td>Name</td>
				<td>
					<input type="text" name="txtName" required placeholder="Your Name">
				</td>
			</tr>
			<tr>
				<td>Email Address</td>
				<td>
					<input type="text" name="txtEmail" required placeholder="youremail@yahoo.com">
				</td>
			</tr>
			<tr>
				<td>New Password</td>
				<td>
					<input type="password" name="txtPassword" required placeholder="123">
				</td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td>
					<input type="text" name="txtPhoneNumber" required placeholder="01-220-330-440">
				</td>
			</tr>
			<tr>
				<td>Address</td>
				<td>
					<input type="text" name="txtAddress" required placeholder="No-2 Baho Street Yangon">
				</td>
			</tr>
			<tr>
				<td>Upload Profile Image</td>
				<td>
					<input type="file" name="fileProfile" required>
				</td>
			</tr>
            <tr>
				<td>NRC No</td>
				<td>
					<input type="text" name="txtNrcNo" required placeholder="7/NATALA(N)123456">
				</td>
			</tr>
            <tr>
				<td>NRC Image</td>
				<td>
					<input type="file" name="fileNrc" required>
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
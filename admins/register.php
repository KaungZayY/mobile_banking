<?php 
    session_start(); 
    include('header.php');
    include("../connection.php");
    include("authCheck.php");

	if(isset($_POST['btnSave'])){
		$txtName = $_POST['txtName'];
		$txtEmail = $_POST['txtEmail'];
		$txtPassword = $_POST['txtPassword'];
		$txtPhoneNumber = $_POST['txtPhoneNumber'];
		$txtAddress = $_POST['txtAddress'];
        $staffTypeId = $_POST['staffTypeId'];
        
        if($staffTypeId==""){
            $staffTypeId = 3;
        }
		//------check email already exists
		$checkEmail = "SELECT * FROM staffs WHERE staff_email=?";
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
			$hashedPassword = password_hash($txtPassword, PASSWORD_DEFAULT);//hash password
			$insertQuery = "INSERT INTO staffs (staff_name, staff_email, staff_password, staff_address, staff_phone_number, staff_type_id)
			VALUES (?, ?, ?, ?, ?, ?)";
			$insertStmt = mysqli_prepare($connect, $insertQuery);
			mysqli_stmt_bind_param($insertStmt, 'ssssss', $txtName, $txtEmail, $hashedPassword, $txtAddress, $txtPhoneNumber, $staffTypeId);
			$res1 = mysqli_stmt_execute($insertStmt);
			if(!$res1){
				echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
			}
			else{
				echo"<script>window.alert('Staff Account Created')</script>";
				echo"<script>window.location='home.php'</script>";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        form {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        fieldset {
            border: none;
            margin: 0;
            padding: 0;
        }
        legend {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 20px;
        }
        table {
            width: 100%;
        }
        table tr {
            margin-bottom: 15px;
        }
        table td:first-child {
            width: 30%;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
	<form action="register.php" method = "POST" enctype="multipart/form-data">
		<fieldset>
		<legend>Create New Staff Account</legend>
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
					<input type="email" name="txtEmail" required placeholder="youremail@yahoo.com">
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
            <?php
                if (isset($_SESSION['staff_type_id']) && $_SESSION['staff_type_id']== 1) {
                    $query = "SELECT * FROM staff_type";
                    $result = mysqli_query($connect, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<tr>
                                <td>Role</td>
                                <td>';
                                echo '<select name="staffTypeId">';
                                echo '<option value="">Select Staff Type</option>';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['staff_type_id'] . '">' . $row['staff_type'] . '</option>';
                                }
                                echo '</select>
                                </td>
                                </tr>';
                    } else {
                        echo 'No staff types found.';
                    }
                }
            ?>

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

<?php
    include('../footer.php');
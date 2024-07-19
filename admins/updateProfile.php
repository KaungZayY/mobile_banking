<?php 
	session_start();
    include('header.php');
	include('../connection.php');
	include("authCheck.php");
    if(isset($_SESSION['staff_id'])){
        $staff_id = $_SESSION['staff_id'];

        $select = "SELECT * FROM staffs WHERE staff_id = '$staff_id'";
        $query = mysqli_query($connect,$select);
        $data = mysqli_fetch_array($query);
        
        $staff_id = $data['staff_id'];
        $staff_name = $data['staff_name'];
        $staff_email = $data['staff_email'];
        $staff_address = $data['staff_address'];
        $staff_phone_number = $data['staff_phone_number'];


        if(isset($_POST['btnUpdate'])){
            $staff_id = $_POST['txtId'];
            $staff_name = $_POST['txtName'];
            $staff_email = $_POST['txtEmail'];
            $staff_address = $_POST['txtAddress'];
            $staff_phone_number = $_POST['txtPhoneNumber'];

            $update="UPDATE staffs SET staff_name='$staff_name',
            staff_email='$staff_email', staff_address='$staff_address',staff_phone_number='$staff_phone_number'
            WHERE staff_id='$staff_id'";
            $query1=mysqli_query($connect, $update);
            if (!$query1) {
                echo "<script>alert(' Update UnSuccessful, Try Again')
                window.location='updateProfile.php'
                </script>";
            }
            else{
                echo "<script>alert(' Update Successful')
                window.location='home.php'
                </script>";
            }

        }

    }

    else{
        echo "<script>window.alert('Login with Your Account First')</script>";
        echo "<script>window.location='login.php'</script>";
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
	<form action="updateProfile.php" method = "POST">
		<fieldset>
		<legend>Update Account Info</legend>
		<table>
			<tr>
				<td>Name</td>
				<td>
					<input type="hidden" name="txtId" value="<?php echo $data['staff_id'];?>" required>
					<input type="text" name="txtName" value="<?php echo $data['staff_name'];?>" required placeholder="Your Name">
				</td>
			</tr>
			<tr>
				<td>Email Address</td>
				<td>
					<input type="email" name="txtEmail" value="<?php echo $data['staff_email'];?>" required placeholder="youremail@yahoo.com">
				</td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td>
					<input type="text" name="txtPhoneNumber" value="<?php echo $data['staff_phone_number'];?>" required placeholder="01-220-330-440">
				</td>
			</tr>
			<tr>
				<td>Address</td>
				<td>
					<input type="text" name="txtAddress" required value="<?php echo $data['staff_address'];?>" placeholder="No-2 Baho Street Yangon">
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

<?php
    include('../footer.php');
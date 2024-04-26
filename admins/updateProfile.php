<?php 
include('../connection.php');
session_start();
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
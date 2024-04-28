<?php 
include("header.php");
include('../connection.php');
session_start();
    if(isset($_SESSION['customer_id'])){
        $customer_id = $_SESSION['customer_id'];
        $customer_name = $_SESSION['customer_name'];

        $select = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
        $query = mysqli_query($connect,$select);
        $data = mysqli_fetch_array($query);
        
        $customer_id = $data['customer_id'];
        $customer_name = $data['customer_name'];
        $customer_email = $data['customer_email'];
        $customer_address = $data['customer_address'];
        $customer_phone_number = $data['customer_phone_number'];


        if(isset($_POST['btnUpdate'])){
            $customer_id = $_POST['txtId'];
            $customer_name = $_POST['txtName'];
            $customer_email = $_POST['txtEmail'];
            $customer_address = $_POST['txtAddress'];
            $customer_phone_number = $_POST['txtPhoneNumber'];

            $update="UPDATE customers SET customer_name='$customer_name',
            customer_email='$customer_email', customer_address='$customer_address',customer_phone_number='$customer_phone_number'
            WHERE customer_id='$customer_id'";
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
	<form action="updateProfile.php" method = "POST" enctype="multipart/form-data">
		<fieldset>
		<legend>Update Account Information</legend>
		<table>
			<tr>
				<td>Name</td>
				<td>
					<input type="hidden" name="txtId" required value="<?php echo $customer_id ?>">
					<input type="text" name="txtName" required placeholder="Your Name" value="<?php echo $customer_name ?>">
				</td>
			</tr>
			<tr>
				<td>Email Address</td>
				<td>
					<input type="email" name="txtEmail" required placeholder="youremail@yahoo.com" value="<?php echo $customer_email ?>">
				</td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td>
					<input type="text" name="txtPhoneNumber" required placeholder="01-220-330-440" value="<?php echo $customer_phone_number ?>">
				</td>
			</tr>
			<tr>
				<td>Address</td>
				<td>
					<input type="text" name="txtAddress" required placeholder="No-2 Baho Street Yangon" value="<?php echo $customer_address ?>">
				</td>
			</tr>
            <tr><td></td>
				<td>
					<input type="hidden" value ="<?php echo $member_id?>" name="txtMemberID"/>
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
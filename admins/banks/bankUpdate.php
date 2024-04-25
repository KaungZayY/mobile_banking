<?php 
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if(isset($_REQUEST['bid'])){
		$bank_id=$_REQUEST['bid'];
		$select="SELECT * FROM banks WHERE bank_id=?";
		$stmt = mysqli_prepare($connect, $select);
		mysqli_stmt_bind_param($stmt, "i", $bank_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($result);
		$prefix_code=$data['prefix_code'];
		$bank_address=$data['bank_address'];
	}

    if (isset($_POST['btnUpdate'])) {
		$bank_id=$_POST['txtId'];
		$prefix_code=$_POST['txtPrefixCode'];
		$bank_address=$_POST['txtAddress'];
		$update="UPDATE banks SET prefix_code=?, bank_address=? WHERE bank_id=?";
		$stmt = mysqli_prepare($connect, $update);
		mysqli_stmt_bind_param($stmt, "ssi", $prefix_code, $bank_address, $bank_id);
		$query1=mysqli_stmt_execute($stmt);
		if ($query1) {
			echo "<script>alert('Update Successful')
			window.location='bankList.php'
			</script>";
		}
        else{
            echo "<script>alert('Update Failed')
			window.location='bankList.php'
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
	<form action="bankUpdate.php" method = "POST">
		<fieldset>
		<legend>Add New Branch</legend>
		<table>
			<tr>
				<td>Prefix Code</td>
				<td>
					<input type="hidden" name="txtId" required value="<?php echo $bank_id; ?>">
					<input type="text" name="txtPrefixCode" required placeholder="110011" value="<?php echo $prefix_code; ?>">
				</td>
			</tr>
            <tr>
			    <td>Address</td>
				<td>
					<input type="text" name="txtAddress" required placeholder="No-2 Baho Street Yangon" value="<?php echo $bank_address; ?>">
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
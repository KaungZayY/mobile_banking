<?php 
    session_start(); 
    include("../header.php");
    include("../../connection.php");
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
	<form action="bankUpdate.php" method = "POST">
		<fieldset>
		<legend>Update Branch Info</legend>
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
<?php
    include('../../footer.php');
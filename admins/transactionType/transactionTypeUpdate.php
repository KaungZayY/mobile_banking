<?php 
    include("../header.php");
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if(isset($_REQUEST['tid'])){
		$transaction_type_id=$_REQUEST['tid'];
		$select="SELECT * FROM transaction_type WHERE transaction_type_id=?";
		$stmt = mysqli_prepare($connect, $select);
		mysqli_stmt_bind_param($stmt, "i", $transaction_type_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($result);
		$transaction_type_id=$data['transaction_type_id'];
		$transaction_type=$data['transaction_type'];
	}

    if (isset($_POST['btnUpdate'])) {
		$transaction_type_id=$_POST['txtId'];
		$transaction_type=$_POST['txtType'];
		$update="UPDATE transaction_type SET transaction_type=? WHERE transaction_type_id=?";
		$stmt = mysqli_prepare($connect, $update);
		mysqli_stmt_bind_param($stmt, "si", $transaction_type, $transaction_type_id);
		$query1=mysqli_stmt_execute($stmt);
		if ($query1) {
			echo "<script>alert('Update Successful')
			window.location='transactionTypeList.php'
			</script>";
		}
        else{
            echo "<script>alert('Update Failed')
			window.location='transactionTypeList.php'
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
	<form action="transactionTypeUpdate.php" method = "POST">
		<fieldset>
		<legend>Update Transaction Type</legend>
		<table>
			<tr>
				<td>Transaction Type</td>
				<td>
					<input type="hidden" name="txtId" required value="<?php echo $transaction_type_id; ?>">
					<input type="text" name="txtType" required placeholder="Own Account Transfer" value="<?php echo $transaction_type; ?>">
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
<?php 
    include("../header.php");
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

	if(isset($_POST['btnSave'])){
		$transaction_type = $_POST['txtTransactionType'];

		//------check transaction type already exists
		$checkType = "SELECT * FROM transaction_type WHERE transaction_type=?";
		$stmt = mysqli_prepare($connect, $checkType);
		mysqli_stmt_bind_param($stmt, 's', $transaction_type);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if($res === false){
			echo"Error: ".mysqli_error($connect);
		}
		elseif (mysqli_num_rows($res) > 0){
			echo"<script>window.alert('Transaction Type Already Exist')</script>";
			echo"<script>window.location='transactionTypeCreate.php'</script>";
		}
		else{
			$insertQuery = "INSERT INTO transaction_type (transaction_type)
			VALUES (?)";
			$insertStmt = mysqli_prepare($connect, $insertQuery);
			mysqli_stmt_bind_param($insertStmt, 's', $transaction_type);
			$res1 = mysqli_stmt_execute($insertStmt);
			if(!$res1){
				echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
			}
			else{
				echo"<script>window.alert('New Transaction Type Added')</script>";
				echo"<script>window.location='transactionTypeList.php'</script>";
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
	<form action="transactionTypeCreate.php" method = "POST">
		<fieldset>
		<legend>Add New Transaction Type</legend>
		<table>
			<tr>
				<td>Transaction Type</td>
				<td>
					<input type="text" name="txtTransactionType" required placeholder="Own Wallet Transfer">
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

<?php
    include('../../footer.php');
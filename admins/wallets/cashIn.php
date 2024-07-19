<?php
    session_start(); 
    include("../header.php");
    include("../../connection.php");
    include("../authCheck.php");

    if(isset($_POST['btnSave'])){
        $wallet_number = $_POST['txtWalletNo'];
		$note = $_POST['txtNote'];
		$amount = $_POST['txtAmount'];

        $select = "SELECT wallet_id,customer_id,balance FROM wallets WHERE wallet_number='$wallet_number'";
        $result = mysqli_query($connect,$select);
        $wallet_data = mysqli_fetch_array($result);
        $wallet_id = $wallet_data['wallet_id'];
        $customer_id = $wallet_data['customer_id'];
        $balance = $wallet_data['balance'];

        $sel = "SELECT customer_name FROM customers WHERE customer_id='$customer_id'";
        $res = mysqli_query($connect,$sel);
        $c_data = mysqli_fetch_array($res);
        $customer_name = $c_data['customer_name'];

        $staff_id = $_SESSION['staff_id'];

        $insertQuery = "INSERT INTO cash_in (customer_name, wallet_id, staff_id, note, amount, cash_in_date)
			VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
			$insertStmt = mysqli_prepare($connect, $insertQuery);
			mysqli_stmt_bind_param($insertStmt, 'ssisi', $customer_name, $wallet_id, $staff_id, $note, $amount);
			$res1 = mysqli_stmt_execute($insertStmt);
			if(!$res1){
				echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
			}
			else{
                $updated_amount = $balance + $amount;
                $update = "UPDATE wallets SET balance=? WHERE wallet_id=?";
                $stmt = mysqli_prepare($connect, $update);
                mysqli_stmt_bind_param($stmt, "ii", $updated_amount, $wallet_id);
                mysqli_stmt_execute($stmt);
                
				echo"<script>window.alert('Wallet has been debited by $updated_amount')</script>";
				echo"<script>window.location='../home.php'</script>";
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
	<form action="cashIn.php" method = "POST">
		<fieldset>
		<legend>Cash In</legend>
		<table>
			<tr>
				<td>Wallet No</td>
				<td>
					<input type="text" name="txtWalletNo" required placeholder="xxxxxx xxxxxxxx">
				</td>
			</tr>
			<tr>
				<td>Note</td>
				<td>
					<textarea name="txtNote" id="txtNote" cols="40" rows="5"></textarea>
				</td>
			</tr>
			<tr>
				<td>Amount</td>
				<td>
					<input type="number" name="txtAmount" required placeholder="10000.00">
				</td>
			</tr>

			<tr><td></td>
				<td>
					<input type="submit" name="btnSave" value="Add" />
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
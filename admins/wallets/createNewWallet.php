<?php 
    session_start(); 
    include("../header.php");
    include("../../connection.php");
    include("../authCheck.php");

    if (isset($_REQUEST['cid']))
    {
        $customer_id = $_REQUEST['cid'];
        $select = "SELECT customer_id, customer_name FROM customers WHERE customer_id='$customer_id'";
        $result = mysqli_query($connect,$select);
        $c_data = mysqli_fetch_array($result);
    }

    if(isset($_POST['btnSave'])){
        $status = $_POST['selStatus'];
        $balance = $_POST['txtBalance'];
        $bank_id = $_POST['bank_id'];
        $customer_id = $_POST['txtCustomerId'];

        $bankSelect = "SELECT prefix_code FROM banks WHERE bank_id = '$bank_id'";
        $res = mysqli_query($connect,$bankSelect);
        $b_data = mysqli_fetch_array($res);
        $prefix_code = $b_data['prefix_code'];

        $currentDateTimeCode = date("YmdHis");
        $wallet_no = $prefix_code.$currentDateTimeCode;

        $insertQuery = "INSERT INTO wallets (wallet_number, wallet_status, balance, customer_id, bank_id)
			VALUES (?, ?, ?, ?, ?)";
			$insertStmt = mysqli_prepare($connect, $insertQuery);
			mysqli_stmt_bind_param($insertStmt, 'sssss', $wallet_no, $status, $balance, $customer_id, $bank_id);
			$res1 = mysqli_stmt_execute($insertStmt);
			if(!$res1){
				echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
			}
			else{
				echo"<script>window.alert('Wallet Created')</script>";
				echo"<script>window.location='../customerDetail.php?cid=$customer_id'</script>";
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
	<form action="createNewWallet.php" method = "POST">
		<fieldset>
		<legend>Create New Wallet</legend>
		<table>
			<tr>
				<td>Customer Name</td>
				<td>
					<input type="hidden" name="txtCustomerId" readonly value="<?php echo $c_data['customer_id'];?>">
					<input type="text" name="txtCustomerName" readonly value="<?php echo $c_data['customer_name'];?>">
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>
					<select name="selStatus" id="selStatus">
                        <option value="active">Active</option>
                        <option value="disabled">Disabled</option>
                    </select>
				</td>
			</tr>
			<tr>
				<td>Balance</td>
				<td>
					<input type="text" name="txtBalance" required placeholder="10000.00">
				</td>
			</tr>
			<?php
                    $query = "SELECT * FROM banks";
                    $result = mysqli_query($connect, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<tr>
                                <td>Branch</td>
                                <td>';
                                echo '<select name="bank_id">';
                                echo '<option value="">Select Branch</option>';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['bank_id'] . '">' . $row['bank_address'] . '</option>';
                                }
                                echo '</select>
                                </td>
                                </tr>';
                    } else {
                        echo '<tr><td>No Branches found.</td></tr>';
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
    include('../../footer.php');
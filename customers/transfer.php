<?php

include("../connection.php");
    session_start(); 
    include("authCheck.php");

    $customer_id = $_SESSION['customer_id'];
    $query = "SELECT * FROM wallets WHERE customer_id='$customer_id'";
    $result = mysqli_query($connect, $query);

    $qry = "SELECT * FROM transaction_type";
    $t_type = mysqli_query($connect, $qry);

    if(isset($_POST['btnSave'])){
        $wallet_id_1 = $_POST['wallet_id_1'];
        $wallet_number = $_POST['wallet_id_2'];
        $amount = $_POST['amount'];
        $note = $_POST['note'];
        $transaction_type_id = $_POST['transaction_type_id'];

        //Wallet 1
        $sel = "SELECT balance FROM wallets WHERE wallet_id='$wallet_id_1'";
        $res = mysqli_query($connect,$sel);
        $w_data = mysqli_fetch_array($res);
        $w_1_balance = $w_data['balance'];

        if($w_1_balance >= $amount){
            //Wallet 2
            $select = "SELECT wallet_id,balance FROM wallets WHERE wallet_number='$wallet_number'";
            $result = mysqli_query($connect,$select);
            $wallet_data = mysqli_fetch_array($result);
            $wallet_id_2 = $wallet_data['wallet_id'];
            $w_2_balance = $wallet_data['balance'];

            //Substruct balance from W 1
            $minus_balance = $w_1_balance - $amount;
            $minus_update = "UPDATE wallets SET balance=? WHERE wallet_id=?";
            $minus_stmt = mysqli_prepare($connect, $minus_update);
            mysqli_stmt_bind_param($minus_stmt, "ii", $minus_balance, $wallet_id_1);
            $minus = mysqli_stmt_execute($minus_stmt);

            if($minus){
                //Add balance to W 2
                $plus_balance = $w_2_balance + $amount;
                $plus_update = "UPDATE wallets SET balance=? WHERE wallet_id=?";
                $plus_stmt = mysqli_prepare($connect, $plus_update);
                mysqli_stmt_bind_param($plus_stmt, "ii", $plus_balance, $wallet_id_2);
                $plus = mysqli_stmt_execute($plus_stmt);
                if($plus){
                    $insertQuery = "INSERT INTO transactions (amount, wallet_id_1, wallet_id_2, transaction_date, note, transaction_type_id) VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?, ?)";
			        $insertStmt = mysqli_prepare($connect, $insertQuery);
			        mysqli_stmt_bind_param($insertStmt, 'iiisi', $amount, $wallet_id_1, $wallet_id_2, $note, $transaction_type_id);
			        $res1 = mysqli_stmt_execute($insertStmt);
                    if(!$res1){
                        echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
                    }
                    else{
                        echo"<script>window.alert('Transaction Successful')</script>";
                        echo"<script>window.location='home.php'</script>";
                    }
                }
                else{
                    echo"<script>window.alert('Something Went Wrong')</script>";
			        echo"<script>window.location='home.php'</script>";
                }
            }
            else{
                echo"<script>window.alert('Something Went Wrong')</script>";
			    echo"<script>window.location='home.php'</script>";
            }
        }
        else{
            echo"<script>window.alert('Not Enough Balance')</script>";
			echo"<script>window.location='home.php'</script>";
        }


    }
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="transfer.php" method = "POST">
		<fieldset>
		<legend>Transfer Cash</legend>
		<table>
			<tr>
				<td>From Wallet :</td>
				<td>
                    <select name="wallet_id_1" id="" required>
                        <option value="">SELECT WALLET</option>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $wallet_id = $row['wallet_id'];
                                $wallet_number = $row['wallet_number'];
                                echo "<option value=\"$wallet_id\">$wallet_number</option>";
                            }
                        ?>
                    </select>
				</td>
			</tr>
			<tr>
				<td>To Wallet :</td>
				<td>
					<input type="text" name="wallet_id_2" required>
				</td>
			</tr>
			<tr>
				<td>Amount</td>
				<td>
					<input type="number" name="amount" required placeholder="1000.00">
				</td>
			</tr>
			<tr>
				<td>Transaction Type</td>
				<td>
                    <select name="transaction_type_id" id="transaction_type_id">
                        <option value="">SELECT TRANSACTION TYPE</option>
                        <?php
                            while ($type = mysqli_fetch_assoc($t_type)) {
                                $transaction_type_id = $type['transaction_type_id'];
                                $transaction_type = $type['transaction_type'];
                                echo "<option value=\"$transaction_type_id\">$transaction_type</option>";
                            }
                        ?>
                    </select>
				</td>
			</tr>
			<tr>
				<td>Note</td>
				<td>
                    <textarea name="note" id="note" cols="40" rows="5"></textarea>
				</td>
			</tr>
			<tr><td></td>
				<td>
					<input type="submit" name="btnSave" value="Sent" />
					<input type="reset" value="Cancel" />
				</td>
			</tr>
		</table>
		</fieldset>
	</form>
</body>
</html>
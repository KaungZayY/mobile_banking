<?php
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if (isset($_REQUEST['wid']))
    {
        $wallet_id = $_REQUEST['wid'];
        $select = "SELECT balance, customer_id FROM wallets WHERE wallet_id='$wallet_id'";
        $result = mysqli_query($connect,$select);
        $w_data = mysqli_fetch_array($result);
    }

    if(isset($_POST['btnSave'])){
        $amount = $_POST['txtAmount'];
        $wallet_id = $_POST['txtWalletId'];
        $customer_id = $_POST['txtCustomerId'];

        // Retrieve the current balance from the database
        $select_balance = "SELECT balance FROM wallets WHERE wallet_id='$wallet_id'";
        $balance_result = mysqli_query($connect, $select_balance);
        $balance_data = mysqli_fetch_array($balance_result);
        $balance = $balance_data['balance'];

        // Calculate the updated balance
        $updated_amount = $balance + $amount;

        // Update the balance in the database
        $update = "UPDATE wallets SET balance=? WHERE wallet_id=?";
        $stmt = mysqli_prepare($connect, $update);
        mysqli_stmt_bind_param($stmt, "ii", $updated_amount, $wallet_id);
        $query1 = mysqli_stmt_execute($stmt);
        if ($query1) {
            echo "<script>alert('Wallet has been debited by $amount')
            window.location='../customerDetail.php?cid=$customer_id'
            </script>";
        } else {
            echo "<script>alert('Failed to debit from the wallet')
            window.location='../customerDetail.php?cid=$customer_id'
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
    <form action="addBalance.php" method="POST">
        <fieldset>
            <legend>Add Balance</legend>
            <table>
                <tr>
                    <td>Amount</td>
                    <td>
                        <input type="hidden" name="txtWalletId" required value="<?php echo $_REQUEST['wid']; ?>">
                        <input type="hidden" name="txtCustomerId" required value="<?php echo $w_data['customer_id']; ?>">
                        <input type="number" name="txtAmount" required placeholder="1000.00">
                    </td>
                </tr>
                <tr>
                    <td></td>
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

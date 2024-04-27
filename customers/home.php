<?php
    include("../connection.php");
    session_start(); 
    include("authCheck.php");

    $customer_id = $_SESSION['customer_id'];

    $query = "SELECT * FROM wallets WHERE customer_id = '$customer_id'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
</head>
<body>
    <h3>Name : <?php echo $_SESSION['customer_name'];?></h3>

    <table>
        <thead>
            <tr>
                <th>Wallet No</th>
                <th>Balance</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $wallet_id = $row['wallet_id'];
                    echo "<tr>";
                    echo "<td>{$row['wallet_number']}</td>";
                    echo "<td>{$row['balance']}</td>";
                    echo "<td>{$row['wallet_status']}</td>";
                    echo "<td><a href='transactions/cashInHistory.php?wid=$wallet_id'>Cash In</a> |
                    <a href='transactions/transactionHistory.php?wid=$wallet_id'>Transactions</a> |
                    <a href='loans/loanList.php?wid=$wallet_id'>Loans</a>";
                    echo "</td>";
                    echo "</tr>";
                }

                if($count < 1) {
                    echo "<tr><td class='no-data' colspan='2'>No Wallet</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
<a href="transfer.php">Transfer</a>
</html>


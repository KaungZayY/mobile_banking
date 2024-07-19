<?php
    session_start(); 
    include('header.php');
    include("../connection.php");
    include("authCheck.php");

    $select = "SELECT transactions.*, t_type.transaction_type, w1.wallet_number as w_num_1, w2.wallet_number as w_num_2 FROM transactions 
        LEFT JOIN transaction_type as t_type ON transactions.transaction_type_id = t_type.transaction_type_id 
        LEFT JOIN wallets as w1 ON transactions.wallet_id_1 = w1.wallet_id 
        LEFT JOIN wallets as w2 ON transactions.wallet_id_2 = w2.wallet_id  
        ORDER BY transaction_date DESC";
        $result = mysqli_query($connect,$select);
        $count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>From Wallet</th>
                <th>To Wallet</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Transaction Type</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['w_num_1']}</td>";
                    echo "<td>{$row['w_num_2']}</td>";
                    echo "<td>{$row['amount']}</td>";
                    echo "<td>{$row['transaction_date']}</td>";
                    echo "<td>{$row['transaction_type']}</td>";
                    echo "<td>{$row['note']}</td>";
                    echo "</tr>";
                }

                if($count < 1) {
                    echo "<tr><td class='no-data' colspan='6'>No Recent History</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="../home.php"><button type="button" style="background-color:#4CAF50;color:white;margin:4px;">Back</button></a>
</body>
</html>

<?php
    include('../footer.php');
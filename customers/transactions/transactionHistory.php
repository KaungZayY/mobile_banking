<?php
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if(isset($_REQUEST['wid'])){
        $wallet_id = $_REQUEST['wid'];

        $sel = "SELECT wallet_number FROM wallets WHERE wallet_id='$wallet_id'";
        $res = mysqli_query($connect,$sel);
        $w_data = mysqli_fetch_array($res);
        $wallet_number = $w_data['wallet_number'];

        $select = "SELECT transactions.*, t_type.transaction_type, w1.wallet_number as w_num_1, w2.wallet_number as w_num_2 FROM transactions 
        LEFT JOIN transaction_type as t_type ON transactions.transaction_type_id = t_type.transaction_type_id 
        LEFT JOIN wallets as w1 ON transactions.wallet_id_1 = w1.wallet_id 
        LEFT JOIN wallets as w2 ON transactions.wallet_id_2 = w2.wallet_id 
        WHERE wallet_id_1='$wallet_id' OR wallet_id_2='$wallet_id' 
        ORDER BY transaction_date DESC";
        $result = mysqli_query($connect,$select);
        $count = mysqli_num_rows($result);

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Histories</title>
</head>
<body>
    <h4>Wallet Number : <?php echo $wallet_number;?></h4>

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
                    if($wallet_id == $row['wallet_id_1']){
                        echo "<td> - {$row['amount']}</td>";
                    }
                    else{
                        echo "<td> + {$row['amount']}</td>";
                    }
                        echo "<td>{$row['transaction_date']}</td>";
                        echo "<td>{$row['transaction_type']}</td>";
                        echo "<td>{$row['note']}</td>";
                        echo "</tr>";
                }

                if($count < 1) {
                    echo "<tr><td class='no-data' colspan='3'>No Recent Cash In History</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="../home.php">Back</a>
</body>
</html>
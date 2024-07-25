<?php
    session_start(); 
	include("../header.php");
    include("../../connection.php");
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
    <style>
        body {
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        h4 {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .no-data {
            text-align: center;
        }
        .actions {
            text-align: center;
        }
        a {
            text-decoration: none;
        }
    </style>
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
                    echo "<tr><td class='no-data' colspan='6'>No Recent History</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="../home.php"><button type="button" style="background-color:#4CAF50;color:white;margin:4px;">Back</button></a>
</body>
</html>

<?php
    include('../../footer.php');
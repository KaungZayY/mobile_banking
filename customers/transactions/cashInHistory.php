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

        $select = "SELECT * FROM cash_in WHERE wallet_id='$wallet_id' ORDER BY cash_in_date DESC";
        $result = mysqli_query($connect,$select);
        $count = mysqli_num_rows($result);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash In Histories</title>
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
    <h3>Wallet Number : <?php echo $wallet_number;?></h3>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Loop through the results and display each row in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['cash_in_date']}</td>";
                    echo "<td>{$row['amount']}</td>";
                    echo "<td>{$row['note']}</td>";
                    echo "</tr>";
                }

                if($count < 1) {
                    echo "<tr><td class='no-data' colspan='3'>No Recent Cash In History</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="../home.php"><button type="button" style="background-color:#4CAF50;color:white;margin:4px;">Back</button></a>
</body>
</html>

<?php
    include('../../footer.php');
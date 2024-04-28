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

        $select = "SELECT loans.*, l.type_of_loan 
        FROM loans 
        LEFT JOIN type_of_loan as l ON loans.type_of_loan_id = l.type_of_loan_id 
        WHERE wallet_id='$wallet_id' 
        ORDER BY loan_Start_date DESC";
        $result = mysqli_query($connect,$select);
        $count = mysqli_num_rows($result);

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Applications</title>
</head>
<body>
    <h4>Wallet Number : <?php echo $wallet_number;?></h4>

    <table>
        <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Amount</th>
                <th>Loan Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $loan_id = $row['loan_id'];
                    echo "<tr>";
                    echo "<td>{$row['loan_start_date']}</td>";
                    echo "<td>{$row['loan_end_date']}</td>";
                    echo "<td>{$row['amount']}</td>";
                    echo "<td>{$row['type_of_loan']}</td>";
                    echo "<td>{$row['loan_status']}</td>";
                    if($row['loan_status']==='approved'){
                        echo "<td><a href='loanRepayment.php?lid=$loan_id'>Repay</a></td>";
                    }
                    echo "</tr>";
                }

                if($count < 1) {
                    echo "<tr><td class='no-data' colspan='6'>No Recent Loan History</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="../home.php">Back</a>
    <a href="loanApply.php">Loan Apply</a>
</body>
</html>
<?php
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    $select = "SELECT loans.*, l.type_of_loan, w.wallet_number 
    FROM loans 
    LEFT JOIN type_of_loan as l ON loans.type_of_loan_id = l.type_of_loan_id 
    LEFT JOIN wallets as w ON loans.wallet_id = w.wallet_id   
    ORDER BY loan_Start_date DESC";
    $result = mysqli_query($connect,$select);
    $count = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Applications</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Wallet Number</td>
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
                    echo "<td>{$row['wallet_number']}</td>";
                    echo "<td>{$row['loan_start_date']}</td>";
                    echo "<td>{$row['loan_end_date']}</td>";
                    echo "<td>{$row['amount']}</td>";
                    echo "<td>{$row['type_of_loan']}</td>";
                    echo "<td>{$row['loan_status']}</td>";
                    if($row['loan_status']==='pending'){
                        echo "<td><a href='loanDecision.php?lid=$loan_id&action=approve'>Approve</a> |
                        <a href='loanDecision.php?lid=$loan_id&action=deny'>Deny</a>";
                        echo "</td>";
                    }
                    echo"</tr>";
                }

                if($count < 1) {
                    echo "<tr><td class='no-data' colspan='6'>No Recent Loan History</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="../home.php">Back</a>
</body>
</html>
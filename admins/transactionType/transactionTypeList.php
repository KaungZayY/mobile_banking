<?php 
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    $query = "SELECT * FROM transaction_type";
    $result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Type List</title>
</head>
<body>
    <a href="transactionTypeCreate.php">Add Transaction Type</a>
    <h2>Transaction Types</h2>
    <table>
        <thead>
            <tr>
                <th>Transaction Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $transaction_type_id = $row['transaction_type_id'];
                    echo "<tr>";
                    echo "<td>{$row['transaction_type']}</td>";
                    echo "<td><a href='transactionTypeUpdate.php?tid=$transaction_type_id'>Update</a>
                    |
                    <a href='transactionTypeDelete.php?tid=$transaction_type_id'>Remove</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
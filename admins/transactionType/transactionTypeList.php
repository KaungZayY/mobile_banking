<?php 
    session_start(); 
    include("../header.php");
    include("../../connection.php");
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
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <a href="transactionTypeCreate.php"><button type="button" style="background-color:#4CAF50;color:white;margin:4px;">Add Transaction Type</button></a>
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

<?php
    include('../../footer.php');
<?php 
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    $query = "SELECT * FROM type_of_loan";
    $result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Type List</title>
</head>
<body>
    <a href="typeOfLoanCreate.php">Add New Loan Type</a>
    <h2>Loan Types</h2>
    <table>
        <thead>
            <tr>
                <th>Loan Type</th>
                <th>Interest Rate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $type_of_loan_id = $row['type_of_loan_id'];
                    echo "<tr>";
                    echo "<td>{$row['type_of_loan']}</td>";
                    echo "<td>{$row['rate']}</td>";
                    echo "<td><a href='typeOfLoanUpdate.php?tid=$type_of_loan_id'>Update</a>
                    |
                    <a href='typeOfLoanDelete.php?tid=$type_of_loan_id'>Remove</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php 
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    $query = "SELECT * FROM banks";
    $result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank List</title>
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
    <a href="bankCreate.php">Add New Branch</a>
    <h2>Banks</h2>
    <table>
        <thead>
            <tr>
                <th>Prefix Code</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $bank_id = $row['bank_id'];
                    echo "<tr>";
                    echo "<td>{$row['prefix_code']}</td>";
                    echo "<td>{$row['bank_address']}</td>";
                    echo "<td><a href='bankUpdate.php?bid=$bank_id'>Update</a>
                    |
                    <a href='bankDelete.php?bid=$bank_id'>Remove</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
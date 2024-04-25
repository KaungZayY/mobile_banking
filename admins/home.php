<?php 
    include("../connection.php");
    session_start(); 
    include("authCheck.php");

    $query = "SELECT customer_id, customer_name, customer_email, customer_address, customer_phone_number, nrc_no FROM customers";
    $result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
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
    <h2>Customers</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>NRC No</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $customer_id = $row['customer_id'];
                    echo "<tr>";
                    echo "<td>$customer_id</td>";
                    echo "<td>{$row['customer_name']}</td>";
                    echo "<td>{$row['customer_email']}</td>";
                    echo "<td>{$row['customer_address']}</td>";
                    echo "<td>{$row['customer_phone_number']}</td>";
                    echo "<td>{$row['nrc_no']}</td>";
                    echo "<td><a href='customerDetail.php?cid=$customer_id'>Detail</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
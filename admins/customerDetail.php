<?php
    include("../connection.php");
    session_start(); 
    include("authCheck.php");

    if (isset($_REQUEST['cid']))
    {
        $customer_id = $_REQUEST['cid'];
        $select = "SELECT customer_name, customer_profile, nrc_photo FROM customers WHERE customer_id='$customer_id'";
        $result = mysqli_query($connect,$select);
        $c_data = mysqli_fetch_array($result);

        $query = "SELECT * FROM wallets WHERE customer_id = '$customer_id'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Accounts</title>
</head>
<body>
    <h3>Customer Name : <?php echo $c_data['customer_name'];?></h3>
    <div class="profile-images">
        <img src="<?php echo $c_data['customer_profile'];?>" alt="Profile Photo">
        <img src="<?php echo $c_data['nrc_photo'];?>" alt="NRC Photo">
    </div>

    <table>
        <thead>
            <tr>
                <th>Wallet No</th>
                <th>Balance</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Loop through the results and display each row in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    $wallet_id = $row['wallet_id'];
                    echo "<tr>";
                    echo "<td>{$row['wallet_number']}</td>";
                    echo "<td>{$row['balance']}</td>";
                    echo "<td>{$row['wallet_status']}</td>";
                    echo "<td><a href='wallets/addBalance.php?wid=$wallet_id'>Add Balance</a>";
                    if($row['wallet_status']=='Active'){
                        echo "|
                        <a href='wallets/walletDisable.php?wid=$wallet_id'>Disable</a>";
                    }
                    else{
                        echo "|
                        <a href='wallets/walletEnable.php?wid=$wallet_id'>Enable</a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }

                if($count < 1) {
                    echo "<tr><td class='no-data' colspan='2'>No Wallet</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <a href="wallets/createNewWallet.php?cid=<?php echo $customer_id; ?>">Add New Wallet</a>
</body>
</html>


<?php
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if (isset($_REQUEST['lid']))
    {
        $loan_id = $_REQUEST['lid'];
        
        $select = "SELECT wallet_id, amount FROM loans WHERE loan_id = '$loan_id'";
        $query = mysqli_query($connect,$select);
        $data = mysqli_fetch_array($query);
        $wallet_id = $data['wallet_id'];
        $amount = $data['amount'];

        $w_select = "SELECT balance FROM wallets WHERE wallet_id='$wallet_id'";
        $w_query = mysqli_query($connect, $w_select);
        $w_data = mysqli_fetch_array($w_query);
        $balance = $w_data['balance'];

        if($balance >= $amount){
            $updated_balance = $balance - $amount;
            $upt = "UPDATE wallets SET balance='$updated_balance' WHERE wallet_id='$wallet_id'";
            $qry = mysqli_query($connect, $upt);

            if(!$qry){
                echo "<script>alert(' Something Went Wrong')
                window.location='loanList.php?wid=$wallet_id'
                </script>";    
            }
            else{
                $update="UPDATE loans SET loan_status='completed'
                WHERE loan_id='$loan_id'";
                $query1=mysqli_query($connect, $update);
                if ($query1) {
                    echo "<script>alert(' Loan Completed')
                    window.location='loanList.php?wid=$wallet_id'
                    </script>";
                }
                else{
                    $f_upt = "UPDATE wallets SET balance='$balance' WHERE wallet_id='$wallet_id'";
                    $f_qry = mysqli_query($connect, $f_upt);
                    echo "<script>alert(' Action Failed')
                    window.location='loanList.php?wid=$wallet_id'
                    </script>"; 
                }
            }
        }
        else{
            echo "<script>alert(' Not Enough Balance in the Account')
            window.location='loanList.php?wid=$wallet_id'
            </script>"; 
        }
    }

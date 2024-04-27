<?php
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if (isset($_REQUEST['lid']) && isset($_GET['action']))
    {
        $loan_id = $_REQUEST['lid'];
        $action = $_GET['action'];

        if($action === 'approve') {
            $update="UPDATE loans SET loan_status='approved'
            WHERE loan_id='$loan_id'";
            $query1=mysqli_query($connect, $update);
            if (!$query1) {
                echo "<script>alert(' Action Failed, Try Again')
                window.location='loanList.php'
                </script>";
            }
            else{
                $w_select = "SELECT wallet_id, amount FROM loans WHERE loan_id = '$loan_id'";
                $w_query = mysqli_query($connect,$w_select);
                $w_data = mysqli_fetch_array($w_query);
                $wallet_id = $w_data['wallet_id'];
                $amount = $w_data['amount'];

                $select = "SELECT balance FROM wallets WHERE wallet_id='$wallet_id'";
                $query = mysqli_query($connect, $select);
                $data = mysqli_fetch_array($query);
                $balance = $data['balance'];

                $updated_balance = $balance + $amount;
                $upt = "UPDATE wallets SET balance='$updated_balance' WHERE wallet_id='$wallet_id'";
                $qry = mysqli_query($connect, $upt);

                if($qry){
                    echo "<script>alert(' Loan Approved')
                    window.location='loanList.php'
                    </script>";    
                }
                else{
                    echo "<script>alert(' Something Went Wrong')
                    window.location='loanList.php'
                    </script>"; 
                }
                
            }
        } 
        elseif($action === 'deny') {
            $update="UPDATE loans SET loan_status='denined'
            WHERE loan_id='$loan_id'";
            $query1=mysqli_query($connect, $update);
            if (!$query1) {
                echo "<script>alert(' Action Failed, Try Again')
                window.location='loanList.php'
                </script>";
            }
            else{
                echo "<script>alert(' Loan has successfully Denined')
                window.location='loanList.php'
                </script>";
            }
        }
        else{
            echo"<script>window.alert('Invalid Action')</script>";
			echo"<script>window.location='loanList.php'</script>";
        }
    }

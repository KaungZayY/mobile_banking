<?php 
    if (!isset($_SESSION['customer_id'])) {
        echo"<script>window.alert('Unauthorized Access')</script>";
        echo"<script>window.location='/mobile_banking/customers/login.php'</script>";
    }
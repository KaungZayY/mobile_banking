<?php 
    if (!isset($_SESSION['customer_id'])) {
        echo"<script>window.alert('Unauthorized Access')</script>";
        echo"<script>window.location='login.php'</script>";
    }
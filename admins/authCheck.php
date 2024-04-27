<?php 
    if (!isset($_SESSION['staff_type_id'])) {
        echo"<script>window.alert('Unauthorized Access')</script>";
        echo"<script>window.location='/mobile_banking/admins/login.php'</script>";
    }
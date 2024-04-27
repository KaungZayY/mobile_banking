<?php
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if (isset($_REQUEST['lid']))
    {
        $loan_id = $_REQUEST['lid'];
        
    }

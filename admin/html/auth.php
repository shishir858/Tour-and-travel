<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if(! $_SESSION['status']){
        header("location:../../admin.php");
    }
?>
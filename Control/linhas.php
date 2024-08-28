<?php 
session_start();
$_SESSION['ice']['linha']=$_GET['linha'];

header('location:../');
?>
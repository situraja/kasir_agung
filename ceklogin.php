<?php

require 'function.php';

if(isset($_SESSION['login'])){
//yaudah
    }else{
//belom login
header('location:login.php');
    }
?>
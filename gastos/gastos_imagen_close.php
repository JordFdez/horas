<?php

session_start();
include("../include/bbddconexion.php");

if (isset($_REQUEST['close'])){
    header("Location:./gastos.php");
} 
else if (isset($_REQUEST['print'])) {
    header("Location:./gastos.php");
}

?>
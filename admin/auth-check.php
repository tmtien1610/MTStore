<?php
session_start();
if(!isset($_SESSION['access'])){
    header('Location: ../sign-in.php');
}else{
    if($_SESSION['role'] != 1){
        header('Location: ../');
    }
} 
?>
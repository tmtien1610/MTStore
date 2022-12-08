<?php
if(!isset($_SESSION['access'])){
    header('Location: sign-in.php');
}
?>
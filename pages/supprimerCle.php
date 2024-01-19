<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['key'])){
        $key = $_POST['key'];
        unset($_SESSION[$key]);
    }
}
?>

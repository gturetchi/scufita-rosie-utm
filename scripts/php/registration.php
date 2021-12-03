<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$errors = array();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["psw"];
    $rpassword = $_POST["rpsw"];
}

if(empty($email)){
    array_push($errors, "Câmpul Email nu poate fi liber!");
} else {

}
if(empty($password)){
    array_push($errors, "Câmpul Password nu poate fi liber!");
}
if(empty($rpassword)){
    array_push($errors, "Câmpul Repeat Password nu poate fi liber!");
}
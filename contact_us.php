<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scufita Rosie</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/6ed27cff65.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
//
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//
//$emailErr = $passErr = $rpassErr = "";
//$email = $pass = $rpass = "";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if (empty($_POST["email"])) {
//        $emailErr = "Email is required";
//    } else {
//        if (empty($_POST["password"])) {
//            $passErr = "Password is required";
//        } else {
//            if (empty($_POST["rpassword"])) {
//                $rpassErr = "Repeat password is required";
//            } else {
//                $email = $_POST["email"];
//                $pass = $_POST["password"];
//                $rpass = $_POST["rpassword"];
//
//                if(mailValidation($email) == true && passwordValidation($pass, $rpass) == true){
//                    header("Location: http://188.237.206.157:8080/main.html");
//                    exit();
//                } else {
//                    $emailErr = mailValidation($email);
//                    $passErr = passwordValidation($pass, $rpass);
//                }
//
//            }
//        }
//    }
//
//}
//
//
//
////if(mailValidation($email) == true && passwordValidation($pass, $rpass) == true){
////    header("Location: http://188.237.206.157:8080/main.html");
////    exit();
////} else {
////    $emailErr = mailValidation($email);
////    $passErr = passwordValidation($pass, $rpass);
////}
//
//function mailValidation($email){
//    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function passwordValidation($pass, $rpass){
//
//    $uppercase = preg_match('@[A-Z]@', $pass);
//    $lowercase = preg_match('@[a-z]@', $pass);
//    $number    = preg_match('@[0-9]@', $pass);
//    $specialChars = preg_match('@[^\w]@', $pass);
//
//    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
//        return 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
//    }else{
//        if($pass != $rpass) {
//            return 'Repeated password must be the same!';
//        } else {
//            return true;
//        }
//    }
//}
//?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nameErr = $surenameErr = $emailErr = $messageErr ="";
$name = $surename = $email = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = input_data($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only alphabets and white space are allowed";
        }
    }

    if (empty($_POST["surename"])) {
        $surenameErr = "Surename is required";
    } else {
        $surename = input_data($_POST["surename"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$surename)) {
            $surenameErr = "Only alphabets and white space are allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = input_data($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = input_data($_POST["message"]);
    }


}
function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<div style="position:fixed; top:0; z-index: -1;">
    <canvas id="fireflies" style="position: absolute;"></canvas>
</div>

<div class="head">
    <h1>Scufița Roșie Blog</h1>
</div>

<div class="login">
    <div class="heading">
        <h2>Sign up</h2>
    </div>
    <form method="post" name="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="validateForm()">
        Name:
        <input type="text" name="name" required>
        <span class="error"><?php echo $nameErr; ?> </span>
        <br><br>
        Surename:
        <input type="text" name="surename" required>
        <span class="error"><?php echo $surenameErr; ?> </span>
        <br><br>
        E-mail:
        <input type="text" name="email" required>
        <span class="error"><?php echo $emailErr; ?> </span>
        <br><br>
        Message:
        <textarea id="message" name="message" placeholder="Say whatever you want." required style="width: 100%; height: 100px;"></textarea>
        <span class="error"><?php echo $messageErr; ?> </span>
        <br><br>
        <div style="text-align: center;">
            <input type="submit" name="submit" value="Send">
            <br><br>
            <a href="index.php" style="color: #cccccc">Go back !</a>
            <br><br>
        </div>
    </form>
</div>
<script>
    function validateForm() {

        let name = document.forms["myForm"]["name"].value;
        let surename = document.forms["myForm"]["surename"].value;
        let email = document.forms["myForm"]["email"].value;
        let message = document.forms["myForm"]["message"].value;

        let namep = /^[a-zA-Z ]*$/;
        let surenamep = /^[a-zA-Z ]*$/;
        let emailp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;


        if(name.trim() == "") {
            alert("Name must be filled out");
            return false;
        }
        if(surename.trim() == "") {
            alert("Surename must be filled out");
            return false;
        }
        if(email.trim() == "") {
            alert("Email must be filled out");
            return false;
        }
        if(message.trim() == "") {
            alert("Message must be filled out");
            return false;
        }

        if(!namep.test(name)){
            alert("Name must contain characters only!");
            return false;
        }
        if(!surenamep.test(surename)){
            alert("Surename must contain characters only!");
            return false;
        }
        if(!emailp.test(email)){
            alert("Email isn't valid!");
            return false;
        }

    }
</script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script type="text/javascript" src="scripts/js/fireflies.js"></script>
</body>
</html>
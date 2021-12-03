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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nameErr = $surenameErr = $emailErr = $mobilenoErr = $genderErr = $websiteErr = $agreeErr = $passwordErr ="";
$name = $surename = $email = $mobileno = $gender = $website = $agree = $password = "";

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

    if (empty($_POST["mobileno"])) {
        $mobilenoErr = "Mobile no is required";
    } else {
        $mobileno = input_data($_POST["mobileno"]);
        if (!preg_match ("/^[0-9]*$/", $mobileno) ) {
            $mobilenoErr = "Only numeric value is allowed.";
        }
        if (strlen ($mobileno) != 9) {
            $mobilenoErr = "Mobile no must contain 10 digits.";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = input_data($_POST["password"]);
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            $passwordErr = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
        }
    }

    if (empty ($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = input_data($_POST["gender"]);
    }

    if (!isset($_POST['agree'])){
        $agreeErr = "Accept terms of services before submit.";
    } else {
        $agree = input_data($_POST["agree"]);
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
    <form method="post" name="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
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
        Mobile No:
        <input type="text" name="mobileno" required>
        <span class="error"><?php echo $mobilenoErr; ?> </span>
        <br><br>
        Password:
        <input type="password" name="password" required>
        <span class="error"><?php echo $passwordErr; ?> </span>
        <br><br>
        <div style="text-align: center;">
            Gender:
            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female
            <input type="radio" name="gender" value="other"> Other
            <span class="error"><?php echo $genderErr; ?> </span>
            <br><br>
            Agree to Terms of Service:
            <input type="checkbox" name="agree">
            <span class="error"><?php echo $agreeErr; ?> </span>
            <br><br>
            <input type="submit" name="submit" value="Submit">
            <br><br>
            <a href="index.php" style="color: #cccccc">Already have an account ?</a>
            <br><br>
            <a href="contact_us.php" style="color: #cccccc">Any problems ? Contact us !</a>
        </div>
    </form>
</div>
<script>
    function validateForm() {

        let name = document.forms["myForm"]["name"].value;
        let surename = document.forms["myForm"]["surename"].value;
        let email = document.forms["myForm"]["email"].value;
        let mobile = document.forms["myForm"]["mobileno"].value;
        let password = document.forms["myForm"]["password"].value;

        let namep = /^[a-zA-Z ]*$/;
        let surenamep = /^[a-zA-Z ]*$/;
        let emailp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let mobilep = /^[0-9]*$/;

        if (name.trim() == "") {
            alert("Name must be filled out");
            return false;
        }
        if (surename.trim() == "") {
            alert("Surename must be filled out");
            return false;
        }
        if (email.trim() == "") {
            alert("Email must be filled out");
            return false;
        }
        if (mobile.trim() == "") {
            alert("Mobile no must be filled out");
            return false;
        }
        if (password.trim() == "") {
            alert("Password must be filled out");
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
        if(!mobilep.test(mobile) || mobile.length != 9){
            alert("Mobile no must contain only numbers! And should be 9 charectes long!");
            return false;
        }

        if(!PasswordValidation(password)){
            alert("Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.");
            return false;
        }

    }

    function PasswordValidation(password){
        let re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return re.test(password);
    }

</script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script type="text/javascript" src="scripts/js/fireflies.js"></script>
</body>
</html>
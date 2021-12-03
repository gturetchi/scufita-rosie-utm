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

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = input_data($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
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
            <h2>Sign in</h2>
        </div>
        <form method="post" name="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
            E-mail:
            <input type="text" name="email" required>
            <span class="error"><?php echo $emailErr; ?> </span>
            <br><br>
            Password:
            <input type="password" name="password" required>
            <span class="error"><?php echo $passwordErr; ?> </span>
            <br><br>
            <div style="text-align: center;">
                <input type="submit" name="submit" value="Log in">
                <br><br>
                <a href="register.php" style="color: #cccccc">Don't have an account ?</a>
                <br><br>
                <a href="contact_us.php" style="color: #cccccc">Any problems ? Contact us !</a>
            </div>
        </form>
    </div>
    <script>
        function validateForm() {

            let email = document.forms["myForm"]["email"].value;
            let password = document.forms["myForm"]["password"].value;

            let emailp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            if (email.trim() == "") {
                alert("Email must be filled out");
                return false;
            }

            if (password.trim() == "") {
                alert("Password must be filled out");
                return false;
            }

            if(!emailp.test(email)){
                alert("Email isn't valid!");
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
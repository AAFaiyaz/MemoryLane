<?php
$conn = mysqli_connect("localhost","root","","memoryLane");
if (mysqli_connect_errno()){
    echo "Failed to connect". mysqli_connect_errno();
}

//Declaring variables to prevent errors
$fname = ""; //First Name
$mname = ""; //Middle Name
$lname = ""; //Last Name
$email = ""; //Email
$email2 = ""; //Email2
$password = ""; //Password
$password2 = ""; //Password2
$date =""; //Sign Up date
$errors_array = array (); //Holds error message

if(isset($_POST['register_button'])){

    //Registration form values

    //First Name
    $fname = strip_tags($_POST['reg_fname']); //replace html tags
    $fname = str_replace(' ','',$fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); //Capitalize First Letter

    //Middle Name
    $mname = strip_tags($_POST['reg_mname']); //replace html tags
    $mname = str_replace(' ','',$mname); //remove spaces
    $mname = ucfirst(strtolower($mname)); //Capitalize First Letter

    //Last Name
    $lname = strip_tags($_POST['reg_lname']); //replace html tags
    $lname = str_replace(' ','',$lname); //remove spaces
    $lname = ucfirst(strtolower($lname)); //Capitalize First Letter

    //Email
    $email = strip_tags($_POST['reg_email']); //replace html tags
    $email = str_replace(' ','',$email); //remove spaces
    $email = ucfirst(strtolower($email)); //Capitalize First Letter

    //Email2
    $email2 = strip_tags($_POST['reg_email2']); //replace html tags
    $email2 = str_replace(' ','',$email2); //remove spaces
    $email2 = ucfirst(strtolower($email2)); //Capitalize First Letter

    //password
    $password = strip_tags($_POST['reg_password']); //replace html tags

    //password2
    $password2 = strip_tags($_POST['reg_password2']); //replace html tags
    
    $date = date("Y-m-d");

    if($email == $email2){
        //Check if email is in valid format
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //Validated version of email
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            //Check if email really exist
            $e_check = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
            
            //Count number of rows returned
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0){
                echo "Email already exist.<br>";
            }
        }else{
            echo "Sorry! Invalid Email Format! <br>";
        }

    } else {
        echo "Emails don't match. <br>";
    }

    if (strlen($fname) > 25 || strlen($fname) < 2){
        echo "Your First Name must be between 2 and 25 chracters <br>";
    }

    if (strlen($mname) > 25 || strlen($mname) < 2){
        echo "Your Middle Name must be between 2 and 25 chracters <br>";
    }

    if (strlen($lname) > 25 || strlen($lname) < 2){
        echo "Your Last Name must be between 2 and 25 chracters <br>";
    }

    if ($password != $password2) {
        echo "Your Password doesn't match <br>";
    } else {
        if(preg_match('/[^A-Za-z0-9]/', $password)){ //Password should be contains these character A-Z,a-z,0-9
            echo "Your password can only contain english chracters or number <br>";
        }
    }

    if(strlen($password > 30 || strlen($password) <5)){
        echo "Your password must be between 5 and 30 characters <br>";
    }
    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MemoryLane</title>
</head>
<body>
    <form action="register.php" method="post">
        <input type="text" name="reg_fname" placeholder="First Name" required>
        <br>
        <input type="text" name="reg_lname" placeholder="Last Name" required>
        <br>
        <input type="text" name="reg_mname" placeholder="Middle Name" required>
        <br>
        <input type="email" name="reg_email" placeholder="Email" required>
        <br>
        <input type="email" name="reg_email2" placeholder="Confirm Email" required>
        <br>
        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <input type="submit" name="register_button" value="Sign-Up">
        <br>
    </form>
</body>
</html>
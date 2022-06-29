<?php
//Start the session
session_start();

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
    $_SESSION['reg_fname'] = $fname; //Stores first name into session variable

    //Middle Name
    $mname = strip_tags($_POST['reg_mname']); //replace html tags
    $mname = str_replace(' ','',$mname); //remove spaces
    $mname = ucfirst(strtolower($mname)); //Capitalize First Letter
    $_SESSION['reg_mname'] = $mname; //Stores middle name into session

    //Last Name
    $lname = strip_tags($_POST['reg_lname']); //replace html tags
    $lname = str_replace(' ','',$lname); //remove spaces
    $lname = ucfirst(strtolower($lname)); //Capitalize First Letter
    $_SESSION['reg_lname'] = $lname; //Stores last name into session variables

    //Email
    $email = strip_tags($_POST['reg_email']); //replace html tags
    $email = str_replace(' ','',$email); //remove spaces
    $email = ucfirst(strtolower($email)); //Capitalize First Letter
    $_SESSION['reg_email'] = $email; //Stores email into session variable

    //Email2
    $email2 = strip_tags($_POST['reg_email2']); //replace html tags
    $email2 = str_replace(' ','',$email2); //remove spaces
    $email2 = ucfirst(strtolower($email2)); //Capitalize First Letter
    $_SESSION['reg_email2'] = $email2; //Stores email2 into session variable

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
                array_push($errors_array,"Email already exist.<br>");
            }
        }else{
            array_push($errors_array,"Sorry! Invalid Email Format! <br>");
        }

    } else {
        array_push($errors_array,"Emails don't match. <br>");
    }

    if (strlen($fname) > 25 || strlen($fname) < 2){
        array_push($errors_array,"Your First Name must be between 2 and 25 chracters <br>");
    }

    if (strlen($mname) > 25 || strlen($mname) < 2){
        array_push($errors_array,"Your Middle Name must be between 2 and 25 chracters <br>");
    }

    if (strlen($lname) > 25 || strlen($lname) < 2){
        array_push($errors_array,"Your Last Name must be between 2 and 25 chracters <br>");
    }

    if ($password != $password2) {
        array_push($errors_array,"Your Password doesn't match <br>");
    } else {
        if(preg_match('/[^A-Za-z0-9]/', $password)){ //Password should be contains these character A-Z,a-z,0-9
            array_push($errors_array,"Your password can only contain english chracters or number <br>");
        }
    }
    if(strlen($password) > 30 || strlen($password) < 5){
        array_push($errors_array,"Your password must be between 5 and 30 characters <br>");
    }
   
    if(empty($errors_array)){
        $password = md5($password); //Encrypting password before sending to database
        //Generate username by concatenating with first middle and last name
        $username = strtolower($fname . "_" .$mname. "_". $lname);
        $check_username_query = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");

        $i = 0;
        while(mysqli_num_rows($check_username_query) !=0){
            $i++;
            $username = $username ."_". $i;
            $check_username_query = mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");
        }
        //We have to use while loop here

        //Profile Picture assignment
        $rand = rand(1,2); //Random number between 1 and 2;
        if ($rand == 1){
            $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        } else{
            $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
        }
        
        $query = mysqli_query($conn, "INSERT INTO users VALUES ('','$fname','$mname','$lname','$username','$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')"); 

        array_push($errors_array,"<span style='color: #14C800;'>You are all set ! Go ahead and login!</span><br>");

        //Clear Session variables
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_mname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";

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
        <input type="text" name="reg_fname" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])) echo $_SESSION['reg_fname']; ?>" required>
        <br>
        <?php if(in_array("Your First Name must be between 2 and 25 chracters <br>",$errors_array)) echo "Your First Name must be between 2 and 25 chracters <br>";?>

        <input type="text" name="reg_mname" placeholder="Middle Name" value="<?php if(isset($_SESSION['reg_mname'])) echo $_SESSION['reg_mname']; ?>" required>
        <br>
        <?php if(in_array("Your Middle Name must be between 2 and 25 chracters <br>",$errors_array)) echo "Your Middle Name must be between 2 and 25 chracters <br>";?>

        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])) echo $_SESSION['reg_lname']; ?>" required>
        <br>
        <?php if(in_array("Your Last Name must be between 2 and 25 chracters <br>",$errors_array)) echo "Your Last Name must be between 2 and 25 chracters <br>";?>

        <input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])) echo $_SESSION['reg_email']; ?>" required>
        <br>
        <?php  ?>

        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if(isset($_SESSION['reg_email2'])) echo $_SESSION['reg_email2']; ?>" required>
        <br>
        <?php 
        if(in_array("Email already exist.<br>",$errors_array)) echo "Email already exist.<br>";
        else if(in_array("Sorry! Invalid Email Format! <br>",$errors_array)) echo "Sorry! Invalid Email Format! <br>";
        else if(in_array("Emails don't match. <br>",$errors_array)) echo "Emails don't match. <br>";?>


        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <?php
        
        if(in_array("Your Password doesn't match <br>",$errors_array)) echo "Your Password doesn't match <br>";
        
        else if(in_array("Your password can only contain english chracters or number <br>",$errors_array)) echo "Your password can only contain english chracters or number <br>";
        else if(in_array("Your password must be between 5 and 30 characters <br>",$errors_array)) echo "Your password must be between 5 and 30 characters <br>";
        ?>

        <input type="submit" name="register_button" value="Sign-Up">
        <br>
        <?php
            if(in_array("<span style='color: #14C800;'>You are all set ! Go ahead and login!</span><br>",$errors_array)) echo "<span style='color: #14C800;'>You are all set ! Go ahead and login!</span><br>";
        ?>
    </form>
</body>
</html>
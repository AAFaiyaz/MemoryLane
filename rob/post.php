<?php

//  print_r($_POST);
$usernames = ['Faiyaz','Prity'];
$isUser = false;
 if ($_POST){
    foreach ($usernames as $user){
        if ($user == $_POST['name']){
            $isUser = true;
        } 
        }
        if ($isUser){
            echo "Hello ". $_POST['name'];
        } else {
            echo "Please give a valid username";
        }
    }

?> 
<!-- <p>Please enter a namer</p> -->
<form method = "post">
    <p>What is your name ?</p>
    <p><input name="name" type="text"></p>
    <p><input type="submit" value="GO!!!!"></p>
</form>


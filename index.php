<?php

$conn = mysqli_connect("localhost","root","","memoryLane");

if(mysqli_connect_errno()){
    echo "Failed to connect".mysqli_connect_errno(); 
}
$query = mysqli_query($conn,"INSERT INTO users VALUES('','FAiyaz')");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello World</h1>
</body>
</html>
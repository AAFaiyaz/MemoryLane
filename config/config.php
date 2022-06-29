<?php
ob_start(); //Turns on output buffering
//Start the session
session_start();

$timezone = date_default_timezone_set("Europe/Berlin");

$conn = mysqli_connect("localhost","root","","memoryLane");
if (mysqli_connect_errno()){
    echo "Failed to connect". mysqli_connect_errno();
}


<?php

class User {

    private $user;
    private $conn;

    public function __construct($conn, $user){
        $this->conn = $conn;
        $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array( $user_details_query);
    }

    public function getFirstMiddleAndLastName(){
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT first_name, middle_name, last_name FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name']. " " . $row['middle_name'] . " " . $row['last_name'];
    }
}


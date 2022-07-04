<?php

// for ($i = 1; $i <10; $i++){
//     if($i%2!=0){
//         echo $i."<br>";
//     }
// }

$family = array ("Rob","Kirsten","Tommy");

// for ($i = 0; $i < sizeof($family); $i++){
//     echo $family[$i]."<br>";
// }

// foreach($family as $member => $name){
//     $family[$member] = $name. " Percibal"; // this way didnot work
//     $name = $name. " Percibal";
//     echo "Family member's name ". $name ."<br>";
//     // $name = $name. " Robot";
//     // echo "Family member's name ". $name ."<br>";
// }

 $i = 0;
 
 while ($i< sizeof($family)){
    echo $family[$i]. "<br>";
    $i++;
 }

?>
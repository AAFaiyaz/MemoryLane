<?php
//    print_r($_GET);
//    echo $_GET['age'];

// echo "Hi there ".$_GET['age']."!!!";
if(is_numeric($_GET['number']) && $_GET['number'] > 0 && $_GET['number'] == round($_GET['number'],0)){
    // $number = $_GET['number'];
    $isPrime = true;
    for ($i=2; $i < $_GET['number']; $i++){
        if ($_GET['number'] % $i == 0){
            $isPrime = false;
        }
    }
    if ($isPrime){
        echo "<p> ".$i." Its a prime </p>";
    } else {
        echo "<p> ".$i." Its not a prime </p>";
    }                
} else if ($_GET) {
    echo "<p>Please give a valid positive number</p>";
}
?>

<p>Is it prime ?</p>
<form>
    <input name="number" type="text">
    <input type="submit" value="GO!!!!">
</form>
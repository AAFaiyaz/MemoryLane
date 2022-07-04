<?php

    $emailTo = 'abdullaalfaiyaz@gmail.com';

    $subject = 'I hope this works';

    $body = 'You are awesome';

    $headers = "From: faiyazbucse@gmail.com";

    if(mail($emailTo, $subject, $body, $headers)){
        echo "Mail has sent successfully";
    } else {
        echo ("Mail could not sent");
    }


?>
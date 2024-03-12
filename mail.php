<?php 
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "strona@az-dom.pl";
    $to = "kontakt@az-dom.pl";
    $subject = "Wiadomosc z formularza wycena";
    $headers = "From:" . $from;
   
    $naszaWiadomosc = var_export($_POST, true);

    mail($to,$subject,$naszaWiadomosc, $headers);
    header('Location: wyslano.html');

?>
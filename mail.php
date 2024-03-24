<?php 
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "strona@az-dom.pl";
    $to = "kontakt@az-dom.pl";
    $subject = "Wiadomość z formularza";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: '.$from.''."\r\n";
    $naszaWiadomosc = print_r($_POST, true);

    mail($to,$subject,$naszaWiadomosc, $headers);
    // header('Location: wyslano.html');

?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$from = "strona@az-dom.pl";
$to = "kontakt@az-dom.pl";
$subject = "Wiadomość z formularza";

// Obsługa załącznika
if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $fileName = $_FILES['file']['name'];
    $mimeType = $_FILES['file']['type'];
    $fileContent = base64_encode(file_get_contents($_FILES['file']['tmp_name']));

    $boundary = md5(uniqid());

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"charset=utf-8\r\n";
    $headers .= "From: $from\r\n";

    $message = "--$boundary\r\n";
    $message .= "Content-Type: text/html; charset=utf-8\r\n";
    $message .= "\r\n";
    $message .= print_r($_POST, true) . PHP_EOL;
    $message .= "\r\n--$boundary\r\n";
    $message .= "Content-Type: $mimeType; name=\"$fileName\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment\r\n";
    $message .= "\r\n";
    $message .= $fileContent;
    $message .= "\r\n--$boundary--";

    if (!mail($to, $subject, $message, $headers)) {
        echo "Błąd wysyłania maila!";
    } else {
        header('Location: wyslano.html');
    }
} else {
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: ' . $from . '' . "\r\n";

    $naszaWiadomosc = print_r($_POST, true);

    if (!mail($to, $subject, $naszaWiadomosc, $headers)) {
        echo "Błąd wysyłania maila!";
    } else {
        header('Location: wyslano.html');
    }
}
?>
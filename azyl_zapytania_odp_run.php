<body oncontextmenu="return false">
<?php
include 'c_baza.php'; 
header('Content-type: text/html; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$imie = $_GET['inputAutor'];
$email = $_GET['nadawca_email'];
$tresc = $_GET['tresc'];
$temat = $_GET['inputTemat'];



date_default_timezone_set('Europe/Warsaw');

$mail = new PHPMailer(true);
try {
 $mail->isSMTP(); // Używamy SMTP
 $mail->Host = 'smtp.gmail.com'; // Adres serwera SMTP
 $mail->SMTPAuth = true; // Autoryzacja (do) SMTP
 $mail->Username = "forum.azyl@gmail.com"; // Nazwa użytkownika
 $mail->Password = "polkmn)("; // Hasło
 $mail->SMTPSecure = 'tls'; // Typ szyfrowania (TLS/SSL)
 $mail->Port = 587; // Port

 $mail->CharSet = "UTF-8";
 $mail->setLanguage('pl', '/phpmailer/language');

 $mail->setFrom('forum.azyl@gmail.com', 'Forum-azyl.pl'); //nadawca
 $mail->addAddress($email, $imie); //odbiorca


 $mail->isHTML(true); // Format: HTML
 $mail->Subject = $temat;
 $mail->Body = $tresc;
 $mail->AltBody = 'By wyświetlić wiadomość należy skorzystać z czytnika obsługującego wiadomości w formie HTML';

 $mail->send();
 // Gdy OK:
 	$id = $_GET['id'];
 	$sql = "UPDATE azyl_zapytania SET odp = '1' WHERE id='$id'";
  	$result=$conn->query($sql);

 	echo "<fieldset>";
	echo "<div id='success'>";
	echo "<h1>Wiadomość została wysłana pomyślnie.</h1>";
	echo "</div>";
	echo "</fieldset>";
 	header("Refresh: 2; URL=gui_admin.php");
 	

} catch (Exception $e) {
 // Gdy błąd:
	echo 'Wystąpił błąd podczas wysyłania wiadomości! Błąd: ' .$mail->ErrorInfo;
	header("Refresh: 7; URL=gui_admin.php");
}

?>
</body>
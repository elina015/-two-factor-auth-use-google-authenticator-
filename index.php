<?
require_once 'GoogleAuthenticator.php';

$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $ga->createSecret();
echo "<p>Код: $secret</p>";

$qrCodeUrl = $ga->getQRCodeGoogleUrl('test123', $secret);
echo '<img src="'.$qrCodeUrl.'">';

?>
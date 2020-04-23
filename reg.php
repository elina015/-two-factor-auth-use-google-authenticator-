<?

if ($_GET['enter']) {
	include 'db.php';
	
	$login = mysqli_real_escape_string($db, $_GET['login']);
	if (mysqli_num_rows(mysqli_query($db, "SELECT `secret` FROM `users` WHERE `login` = '$login'"))) {
		exit('Логин уже зарегистрирован');
	}

	require_once 'GoogleAuthenticator.php';
	$ga = new PHPGangsta_GoogleAuthenticator();
	$secret = $ga->createSecret();
	
	mysqli_query($db, "INSERT INTO `users` VALUES ('$login', '$secret')");
	exit('<p>Секретный ключ: '.$secret.'</p><p><img src="'.$ga->getQRCodeGoogleUrl($login, $secret).'"></p>');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>REG</title>
</head>
<body>
	<h1>Регистрация</h1>
	<form method="get" action="/reg.php">
		<p>Логин</p>
		<p><input type="text" name="login"></p>
		<p><input type="submit" name="enter" value="Создать аккаунт"></p>
	</form>

	<h1>Авторизация</h1>
	<form method="get" action="/log.php">
		<p>Логин</p>
		<p><input type="text" name="login"></p>
		<p><input type="submit" name="enter" value="Авторизация"></p>
	</form>
</body>
</html>
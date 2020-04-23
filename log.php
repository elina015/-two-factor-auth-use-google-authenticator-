<?

if ($_GET['confirm']) {
	
	include 'db.php';
	$login = mysqli_real_escape_string($db, $_GET['login']);
	$row = mysqli_fetch_assoc(mysqli_query($db, "SELECT `secret` FROM `users` WHERE `login` = '$login'"));
	

	if (!$row) {
		exit('Аккаунт не найден');
	}

	require_once 'GoogleAuthenticator.php';
	$ga = new PHPGangsta_GoogleAuthenticator();
	$checkResult = $ga->verifyCode($row['secret'], $_GET['code'], 2);
	if ($checkResult) {
		exit('Код введен верно');
	} else {
		exit('Код введен неверно');
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>LOG</title>
</head>
<body>
	<form method="get" action="/log.php">
		<p>Введите код для аккаунта <b><?=$login?></b></p>
		<p><input type="text" name="code"></p>
		<p><input type="hidden" name="login" value="<?=$login?>"></p>
		<p><input type="submit" name="confirm" value="Авторизация"></p>
	</form>
</body>
</html>
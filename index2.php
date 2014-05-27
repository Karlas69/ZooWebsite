<?php
include("config.php");
// Check form if is submited
if(isSet($_POST['trimite'])) {
// Check if user is equal with username and  password from config.php
    if($_POST['user'] != $user || $_POST['pass'] != $pass) {
        echo "Neteisinga informacija";
        echo '<br/><a href="index2.php">Bandyti dar karta</a><br/>';
    } else {
// Open the session for store user logged
        session_start();
// Setting the session
        $_SESSION['logat'] = "da";
// Redirecting user to admin page if is logged
        Header('Location: admin.php');
    }
} else {
// Form
echo '<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Prisijungimas</title>
<link rel="stylesheet" type="text/css" href="Styles/Style.css" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Prisijungimas</h1>
			<div>
				<input type="text" placeholder="Slapyvardis" required="" name="user" />
			</div>
			<div>
				<input type="password" placeholder="Slaptažodis" required="" name="pass" />
			</div>
			<div>
				<input type="submit" name="trimite" value="Prisijungti" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>';

}
?>
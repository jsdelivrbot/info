<?php
/*
session_start();
//print_r($_SESSION);
if(!isset($_SESSION['USTANOVA']) || $_SESSION['USTANOVA']!="DINFOSALV"){
header("location:index.html");
die();

}
*/
//echo 'Prijava uspela! Dobrodošli '.$_SESSION['USERNAME'];
?>
<html>
    <head>
        <title>DINFO</title>
        <meta charset='utf-8'>
        <link href="reset.css" rel="stylesheet">
        <link href="stylesindex.css" rel="stylesheet">
        <link rel="shortcut icon" href="slike/ikona.ico" />

    </head>
    <body>
        <div class="screen">
            <div class="container">
        	<br><h1>Dobrodošli na straneh DINFO<img src="Dilogo_transparent.png" style="width: 5vw; padding-top:1vw; padding-left:1vw;"> </h1><br><br><br>
        	<?php
            
require_once('baza.php');


if (isset($_POST['submit'])){
	$email1 = $_POST['email1'];
	$email2 = $_POST['email2'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	if($email1 == $email2 && $pass1 == $pass2){
		$uname = mysql_escape_string($_POST['uname']);
		$email1 = mysql_escape_string($_POST['email1']);
		$email2 = mysql_escape_string($_POST['email2']);
		$pass1 = mysql_escape_string($_POST['pass1']);
		$pass2 = mysql_escape_string($_POST['pass2']);
		$ustanova = mysql_escape_string($_POST['ustanova']);
		$pass1 = password_encrypt($pass1);
		//Check if username is taken
		$check = mysql_query("SELECT * FROM members WHERE username = '$uname'")or die(mysql_error());

		if (mysql_num_rows($check)>=1) echo "Username already taken";

		else{
		mysql_query("INSERT INTO `members` (`username`, `email`, `password`, `Ustanova`) VALUES ('$uname', '$email1', '$pass1', '$ustanova')") or die(mysql_error());
		echo "Registration Successful";
		$link="home.php";
		echo "<a href='".$link."'>Domov</a>";
		}
	}
	else{
		echo "Sorry, your email's or your passwords do not match. <br />";
		$link="home.php";
		echo "<a href='".$link."'>Domov</a>";
	}
}
else{
	$form = <<<EOT
	<form action="registracija.php" method="POST">
	Uporabniško ime: <input type="text" name="uname" /><br />
	Ustanova: <input type="text" name="ustanova" /><br />
	Email: <input type="text" name="email1" /><br />
	Confirm Email: <input type="text" name="email2" /><br />
	Password: <input type="password" name="pass1" /><br />
	Confirm Password: <input type="password" name="pass2" /><br />
	<input type="submit" value="Register" name="submit" />
	</form>
EOT;
echo $form;
}

?>
        	
    	</div>
        </div>
    </body>
</html>

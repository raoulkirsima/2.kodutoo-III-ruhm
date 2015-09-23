
<?php

	//errorid
	$email_error_login = "";
	$password_error_login = "";
	$first_name_error = "";
	$last_name_error = "";
	$email_error_create ="";
	$password_error_create= "";
	
	//väärtused
	$email_login = "";
	$password_login = "";
	$first_name = "";
	$last_name = "";
	$email_create ="";
	$password_create= "";
	
	
	//kontrollime, et keegi vajutas input nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST" ) {
		
		//echo "keegi vajutas nuppu";
		//kontrollin, et email ei ole tühi
		if(isset($_POST["login"])){
			echo "vajutas login nuppu!";
		
		
		if ( empty($_POST["email_login"]) ) {
			$email_error_login = "See väli on kohustuslik";
		}else{
			$email_login = test_input($_POST["email_create"]);
		}
		//kontrollin, et parool ei ole tühi
		
		if (empty($_POST["password_login"]) ) {
			$password_error_login = "See väli on kohustuslik";
		}else{
			$password_login = test_input($POST["email"]);
		} 
		
		if($email_error == "" && $password_error == ""){
			echo "Ready to log in! Username is ".$email_login."and password is".$password_login;
			
			$hash = hash("sha512", $password_login);
			
			$stmt = mysqli ->prepare("SELECT id, email FROM user_sample WHERE email=?")
			$stmt->bind_param("ss", $email, $hash);
			
			//muutujad tulemustele
			$stmt->bind_result($id_from_db, $email_from_db);
			$stmt->execute();
			
			//Kontrollin kas tulemusi leiti
			if($stmt->fetch()){
				//ab'is oli midagi
				echo " E-mail and password are correct, user id=".$id_from_db;
			}else{
				//ei olnud midagi
				echo " Wrong credentials!";
			}
			
			$stmt->close();
		}	
			
	//***************************************************************************		
	    }elseif(isset($_POST["create"])){	
			echo" vajutas create user nuppu!";	
	
	
			if (empty($_POST["e-mail"])){
			$email_error2 = "See väli on kohustuslik";
			}
			if (empty($_POST["pass"]) ) {
			$password_error2 = "See väli on kohustuslik";
			} else {
			
				if(strlen($_POST["pass"]) <8) {
				$password_error2 = "Parool on liiga lühike, peab olema vähemalt 8 tähemärki pikk!";
				}
				$sname = test_input($_POST["name"]);
	
			}
			if (empty ($_POST["first_name"])){
			$first_name_error = "See väli on kohustuslik";
			}
			
			}
			if (empty ($_POST["last_name"])){
			$last_name_error = "See väli on kohustuslik";
			}
	}	
	
	
	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
	
	
	
	//TÄIENDA INPUTE - NÄIDISE JÄRGI
	
	
	
?>

<?php	
	$page_title="Sisselogimine";
	$page_file_name="login.php";
?>
<?php require_once("../header.php"); ?>






		
		
	<h2>Log in</h2>
		
		<form action="login.php" method="post" >
			<input name="email" type="email" placeholder="e-mail"> <?php echo $email_error_login; ?> <br><br>
			<input name="password" type="password" placeholder="password"> <?php echo $password_error_login; ?> <br><br>
			<input name="login" type="submit" value="Log in" >
		</form>
		
		
	<h2>Create user</h2>
		
		<form action="login.php" method="post" >
			<input name="e-mail" type="email" placeholder="e-mail" >*<?php echo $email_error_create; ?> <br><br>
			<input name="pass" type="password" placeholder="password" >*<?php echo $password_error_create; ?> <br><br><br><br>
			<input name="first_name" type="text" placeholder="first name" >* <?php echo $first_name_error; ?> <br><br>
			<input name="last_name" type="text" placeholder="last name" >* <?php echo $last_name_error; ?> <br><br>
			<input name="create" type="submit" value="Create user" >
		</form>	
			
			
			
			
 	
<?php require_once("../footer.php"); ?>	
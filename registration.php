<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Onekweb.com</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	
   <div id="content"> 
   	  <?php 
 // Connects to your Database 

 mysql_connect("localhost", "root", "m@rio") or die(mysql_error()); 

 mysql_select_db("members") or die(mysql_error()); 


 //This code runs if the form has been submitted

 if (isset($_POST['submit'])) { 



 //This makes sure they did not leave any fields blank

 if (!$_POST['username'] | !$_POST['pass'] | !$_POST['pass2'] ) {

 		die('You did not complete all of the required fields');

 	}



 // checks if the username is in use

 	if (!get_magic_quotes_gpc()) {

 		$_POST['username'] = addslashes($_POST['username']);

 	}

 $usercheck = $_POST['username'];

 $check = mysql_query("SELECT user FROM members WHERE user = '$usercheck'") 

or die(mysql_error());

 $check2 = mysql_num_rows($check);



 //if the name exists it gives an error

 if ($check2 != 0) {

 		die('Sorry, the username '.$_POST['username'].' is already in use.');

 				}


 // this makes sure both passwords entered match

 	if ($_POST['pass'] != $_POST['pass2']) {

 		die('Your passwords did not match. ');

 	}



 	// here we encrypt the password and add slashes if needed

 	$_POST['pass'] = md5($_POST['pass']);

 	if (!get_magic_quotes_gpc()) {

 		$_POST['pass'] = addslashes($_POST['pass']);

 		$_POST['username'] = addslashes($_POST['username']);

 			}



 // now we insert it into the database

 	$insert = "INSERT INTO members (user, pass)

 			VALUES ('".$_POST['username']."', '".$_POST['pass']."')";

 	$add_member = mysql_query($insert);

 	?>
	   		
	   		 <h1>Registered</h1>

 <p>Thank you, you have registered - <a href="index.php">you may now login</a>.</p>
        
        <?php
        }
        
		else{
        ?>
        <form id ="login" action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post">
            <h1>Registration</h1>
            <fieldset id="inputs">
                <p><input id="userame"type="name" name="username" value="" placeholder="Username"></p>
                <p><input id="password"type="password" name="pass" value="" placeholder="Password"></p>
                <p><input id="password"type="password" name="pass2" value="" placeholder="Confirm password"></p>   
                </fieldset>        
            <fieldset id="actions">
                <input id="submit"type="submit" name="submit" value="Register">
            </fieldset>
        </form>
         <?php

		 }
		 ?> 
   </div>                
</body>
</html>

<?php



/* #Configuration
================================================== */
$to	 		= "info@sushispot2.com"; 				// Your email
$owner	 	= "Sushi Spot"; 					// Your name
$subject	= "Sushi Spot : Message from your Website";	// Email Subject

// Some text in the email's footer
$copy		= "<br><br> ~ This email was sent from your Website <br> ~ Powered by HACHE STUDIO";

/* #Form Values
================================================== */
$name = trim(htmlspecialchars($_POST['name']));
$email = $_POST['email'];
$comments = htmlspecialchars($_POST['comments']) . $copy;

// Success message
$congrats 	= "Congratulations, " . $name . ". We've received your email. We'll be in touch as soon as we possibly can!";

/* #PHP Mailer
================================================== */
require_once 'class.phpmailer.php';

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

try {
  $mail->SetFrom($email, $name);
  $mail->AddReplyTo($email, $name);
  $mail->AddAddress($to, $owner);
  $mail->Subject = $subject;
  //$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($comments);
  
  $mail->Send();
  
  // Congrats message
  echo $congrats;
  
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}


?>
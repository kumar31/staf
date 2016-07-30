<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$body             = file_get_contents('contents.html');
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 465;                    // set the SMTP server port
	$mail->Host       = "smtp.mailgun.org"; // SMTP server
	$mail->Username   = "smaatapp@auto.outfitstaff.com";     // SMTP server username
	$mail->Password   = ")2gNYK3Ed9K*3Z9Q4n{mWJp#Eb/rTCRq";            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("lakshmanan@smaatapps.com","First Last");

	$mail->From       = "lakshmanan@smaatapps.com";
	$mail->FromName   = "First Last";

	$to = "lakshmanan@smaatapps.com";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	echo $mail->SMTPDebug = 0; 
	echo $mail->SMTPDebug = 1;
	echo $mail->SMTPDebug = 2; 
	echo 'Message has been sent.';
} catch (phpmailerException $e) {
	echo $mail->SMTPDebug = 0; 
	echo $mail->SMTPDebug = 1;
	echo $mail->SMTPDebug = 2; 
	
	echo $e->errorMessage();
}
?>

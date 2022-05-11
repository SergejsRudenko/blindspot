<?php
// exit;
	require_once 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;


	/* dev */
	/* Blindsave nevajag definēt SMTP */
	// $mail->isSMTP();                                      	// Set mailer to use SMTP
	// $mail->Host = 'knopkens.com';  						// Specify main and backup SMTP servers
	// $mail->SMTPAuth = true;                               	// Enable SMTP authentication

	// $mail->Username = 'sender@knopkens.com';							          // SMTP username
	// $mail->Password = 'iSend1@33';          					         // SMTP password

	// $mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
	// $mail->Port = 587;                                    	// TCP port to connect to

	$mail->isSMTP();                                      	// Set mailer to use SMTP
	$mail->Host = 'smtp-relay.gmail.com';  						// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               	// Enable SMTP authentication

	$mail->Username = 'info@blindsave.com';							          // SMTP username
	$mail->Password = 'playcool31';          					         // SMTP password
	$mail->SMTPDebug = 1;
	$mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    	// TCP port to connect to


	// $mail->SetFrom('customizer@blindsave.com', 'Blindsave customizer');
	$mail->SetFrom("info@blindsave.com", "testazz");

	/* dev */
	$mail->AddAddress("andris.knopkens@gmail.com", 'Blindsave customizer');




	/* LV versijai nevajadzēšot */

	/* country specific emails */
	// switch ( $country ) {
		// case "Switzerland":
			// $mail->AddAddress("test@gmail.com", 'Blindsave customizer');  			/* dev */
			// break;
		// case "Sweden":
			// break;
	// }





	$mail->IsHTML(true);  
	$mail->CharSet = 'UTF-8';
	$mail->Subject = 'Blindsave uniform order #'."8";
	// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	// $pre_text = "Email from - ".$email;

	$mail->Body = "asdf";

	if(!$mail->Send()) {
		// echo 'Message could not be sent.';
		// echo 'Mailer Error: ' . $mail->ErrorInfo;

	 	/* dev */
	    $messages .= 'Message could not be sent.';
	    $messages .= ' Mailer Error: ' . $mail->ErrorInfo;
	} else {
		// echo 'Message has been sent';

		/* dev */
	    $messages .= 'Message has been sent';;
	}

	echo $messages;
?>
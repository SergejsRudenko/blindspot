<?php



session_start();

// require_once("libs/Medoo.php");
// use Medoo\Medoo;

$root_url = "https://".$_SERVER['SERVER_NAME']."/norway";

// $db_prefix = "bsclv_";

// /* development */
// $database = new Medoo([
//     'database_type' => 'mysql',
//     'database_name' => 'bsc_lv',
//     'server' => 'localhost',
//     'username' => 'bsc_lv',
//     'password' => 'ed714jGzab$39PhwG8',
//     'charset' => 'utf8'
// ]);

function svgPartAPI($file_id){
	// if (!isset($_SESSION['svg_file_id'])){
	// 	$_SESSION['svg_file_id'] = uniqid();
	// }
	// $file_id = $_SESSION['svg_file_id'];

	$myfile = fopen("svg_temp/".$file_id.".base", "a") or die("Unable to open file!");
	$txt = $_POST["data"];
	fwrite($myfile, $txt);
	fclose($myfile);
}
function svgPartCleanupAPI($file_id){
	unlink("svg_temp/" . $file_id . ".base");
	unlink("svg_temp/" . $file_id . ".svg");
}


function createOrderNumber() {
	$reader = fopen("order_counter.txt", "r");
	$base = fread($reader,filesize("order_counter.txt"));
	fclose($reader);
	$order_number = $base;
	if ($order_number<=0 || $order_number=="") $order_number = 0;
	$order_number++;
	$myfile = fopen("order_counter.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $order_number);
	fclose($myfile);

	return $order_number;
}

function createSVG($file_id) {
	$reader = fopen("svg_temp/".$file_id.".base", "r");
	$base = fread($reader,filesize("svg_temp/".$file_id.".base"));
	fclose($reader);

	$myfile = fopen("svg_temp/".$file_id.".svg", "w") or die("Unable to open file!");
	$txt = base64_decode($base);
	fwrite($myfile, $txt);
	fclose($myfile);
}

function createEmailBody($file_id) {

	if (isset($_POST['first-name'])){ $first_name = $_POST['first-name']; }else{ $ok = false; }
	if (isset($_POST['last-name'])){ $last_name = $_POST['last-name']; }else{ $ok = false; }
	if (isset($_POST['phone'])){ $phone = $_POST['phone']; }else{  }
	if (isset($_POST['email'])){ $email = $_POST['email']; }else{ $ok = false; }
	if (isset($_POST['address'])){ $address = $_POST['address']; }else{ $ok = false; }
	if (isset($_POST['city'])){ $city = $_POST['city']; }else{ $ok = false; }
	if (isset($_POST['postal'])){ $postal = $_POST['postal']; }else{ $ok = false; }

	if (isset($_POST['country'])){ $country = $_POST['country']; }else{ $ok = false; }
	if (isset($_POST['size'])){ $size = $_POST['size']; }else{ $ok = false; }
	if (isset($_POST['quantity'])){ $quantity = $_POST['quantity']; }else{ $ok = false; }
	if (isset($_POST['number'])){ $number = $_POST['number']; }else{ $number=""; }
	if (isset($_POST['print'])){ $print = true; }else{ $print = false;  }
	if (isset($_POST['print-name'])){ $print_name = $_POST['print-name']; }else{ $print_name=""; }
	if (isset($_POST['comments'])){ $comments = $_POST['comments']; }else{ $comments=""; }

	
	if (isset($_POST['c_uniform'])){ $c_uniform = $_POST['c_uniform']; }
	if (isset($_POST['c_design'])){ $c_design = $_POST['c_design']; }
	if (isset($_POST['c_shoulder'])){ $c_shoulder = $_POST['c_shoulder']; }
	if (isset($_POST['c_arms'])){ $c_arms = $_POST['c_arms']; }
	if (isset($_POST['c_logo_line'])){ $c_logo_line = $_POST['c_logo_line']; }
	if (isset($_POST['c_logo_1'])){ $c_logo_1 = $_POST['c_logo_1']; }
	if (isset($_POST['c_logo_2'])){ $c_logo_2 = $_POST['c_logo_2']; }
	if (isset($_POST['c_logo_3'])){ $c_logo_3 = $_POST['c_logo_3']; }
	if (isset($_POST['c_logo_4'])){ $c_logo_4 = $_POST['c_logo_4']; }
	if (isset($_POST['c_waist'])){ $c_waist = $_POST['c_waist']; }
	if (isset($_POST['c_lines'])){ $c_lines = $_POST['c_lines']; }
	if (isset($_POST['c_tights'])){ $c_tights = $_POST['c_tights']; }
	if (isset($_POST['c_shins'])){ $c_shins = $_POST['c_shins']; }	
	if (isset($_POST['total_price'])){ $total_price = $_POST['total_price']; }

	if (isset($_POST['c_shins_2'])){ $c_shins_2 = $_POST['c_shins_2']; }
	if (isset($_POST['c_shins_3'])){ $c_shins_3 = $_POST['c_shins_3']; }
	if (isset($_POST['c_jersey'])){ $c_jersey = $_POST['c_jersey']; }
	if (isset($_POST['c_jersey_2'])){ $c_jersey_2 = $_POST['c_jersey_2']; }
	if (isset($_POST['c_elbow_armpit'])){ $c_elbow_armpit = $_POST['c_elbow_armpit']; }


	// Stili jāieliek inline citādi Gmail nepatīk
	$ss = ' style="';
	$title_class_style = 'font-weight: bold;';
	$color_box_style = 'display: inline-block; width:30px; height: 20px; vertical-align: top; margin-left: 10px; margin-right: 10px; margin-top: -4px; border: 1px solid #999;';
	$pss = 'vertical-align: top;';
	$header_style = 'font-weight: bold; font-size: 1.2em;';
	$h1_style = 'font-weight: bold; font-size: 1.4em;';
	$se = '"';

	$body = '<style>';
	$body.= '.title{font-weight: bold;}';
	$body.= '.color-box{display: inline-block; width:30px; height: 20px; vertical-align: top; margin-left: 10px; margin-right: 10px; margin-top: -4px; border: 1px solid #999;}';
	$body.= 'p span{vertical-align: top;}';
	$body.= '.header{font-weight: bold; font-size: 1.2em;}';
	$body.= '.h1{font-weight: bold; font-size: 1.4em;}';
	
	$body.= '</style>';
	$body.= '<p><span class="header"'.$ss.$header_style.$pss.$se.'>Customer</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Navn: </span> <span'.$ss.$pss.$se.'>'.$first_name.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Etternavn: </span> <span'.$ss.$pss.$se.'>'.$last_name.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Telefon: </span> <span'.$ss.$pss.$se.'>'.$phone.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>E-post: </span> <span'.$ss.$pss.$se.'>'.$email.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Adresse: </span> <span'.$ss.$pss.$se.'>'.$address.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>By: </span> <span'.$ss.$pss.$se.'>'.$city.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Postnummer: </span> <span'.$ss.$pss.$se.'>'.$postal.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Land: </span> <span'.$ss.$pss.$se.'>'.$country.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Størrelse: </span> <span'.$ss.$pss.$se.'>'.$size.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Antall: </span> <span'.$ss.$pss.$se.'>'.$quantity.'</span></p><br/>';

	if ($print){
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Trykk: </span> <span'.$ss.$pss.$se.'>Yes</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Nummer: </span> <span'.$ss.$pss.$se.'>'.$number.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Trykk Navn: </span> <span'.$ss.$pss.$se.'>'.$print_name.'</span></p>';
	}
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Kommentarer: </span> <span'.$ss.$pss.$se.'>'.$comments.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Totalt: </span> <span'.$ss.$pss.$se.'>'.$total_price.' NOK</span></p>';


	//DESIGN
	$body.= '<br/><p><span class="header"'.$ss.$header_style.$pss.$se.'>Design</span></p>';

	if($c_uniform == "svg-uniform-1"){
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Uniform: </span> <span'.$ss.$pss.$se.'>Original uniform</span></p>';
		if($c_design==1){
			$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Design: </span> <span'.$ss.$pss.$se.'>Black</span></p>';
		}else{
			$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Design: </span> <span'.$ss.$pss.$se.'>White</span></p>';
		}
	}
	if($c_uniform == "svg-uniform-2"){
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Uniform: </span> <span'.$ss.$pss.$se.'>New uniform</span></p>';
	}


	if($c_uniform == "svg-uniform-1"){

		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Skuldre: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shoulder.'"></span><span'.$ss.$pss.$se.'>#'.$c_shoulder.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Bryst / armer: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_arms.'"></span><span'.$ss.$pss.$se.'>#'.$c_arms.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo line on jeresey: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_line.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_line.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 1: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_1.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_1.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 2: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_2.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_2.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 3: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_3.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_3.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 4: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_4.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_4.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Mageområde: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_waist.'"></span><span'.$ss.$pss.$se.'>#'.$c_waist.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Farbe piping: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_lines.'"></span><span'.$ss.$pss.$se.'>#'.$c_lines.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Lår: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_tights.'"></span><span'.$ss.$pss.$se.'>#'.$c_tights.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Legg: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins.'</span></p>';

	}


	if($c_uniform == "svg-uniform-2"){

		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Trøye kropp/armer: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_jersey.'"></span><span'.$ss.$pss.$se.'>#'.$c_jersey.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Trøye kanter: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_jersey_2.'"></span><span'.$ss.$pss.$se.'>#'.$c_jersey_2.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Albue / armhule: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_elbow_armpit.'"></span><span'.$ss.$pss.$se.'>#'.$c_elbow_armpit.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 1: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_1.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_1.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 2: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_3.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_3.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 3: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_4.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_4.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Sømmer: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_lines.'"></span><span'.$ss.$pss.$se.'>#'.$c_lines.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Lår (øvre del av benet): </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_tights.'"></span><span'.$ss.$pss.$se.'>#'.$c_tights.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Legg 1 (nedre del av benet): </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Legg 2 (nedre del av benet): </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins_2.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins_2.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Bukse design elementer: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins_3.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins_3.'</span></p>';

	}

	$body.= '<br/><p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Uniform: </span><br/><img alt="Uniform" src="cid:my-attach"></p>';

	// $path_i = "svg_temp/".$file_id.".svg";
	// $type_i = pathinfo($path_i, PATHINFO_EXTENSION);
	// $data_i = file_get_contents($path_i);
	// if ($type_i=="svg") $type_i.="+xml";
	// $base64 = 'data:image/' . $type_i . ';base64,' . base64_encode($data_i);
	// // $body.="<img src='".$base64."' />";

	// $body.= '<br/><p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Uniform: </span><br/><img src="'.$base64.'" /></p>';


	return $body;
}

function createOrder($file_id, $order_number, $body) {
	$path_i = "svg_temp/".$file_id.".svg";
	$type_i = pathinfo($path_i, PATHINFO_EXTENSION);
	$data_i = file_get_contents($path_i);
	if ($type_i=="svg") $type_i.="+xml";
	$base64 = 'data:image/' . $type_i . ';base64,' . base64_encode($data_i);

	$myfile = fopen(__DIR__."/orders/".$order_number.".txt", "w") or die("");
	fwrite($myfile, $body."<img src='".$base64."' />");
	fclose($myfile);
}

function createTempEmail($file_id, $body) {
	$myfile = fopen(__DIR__."/emails_temp/".$file_id.".txt", "w") or die("");
	fwrite($myfile, $body);
	fclose($myfile);
}

function createTempEmailFrom($file_id) {

	$first_name = "";
	$last_name = "";

	if (isset($_POST['first-name'])){ $first_name = $_POST['first-name']; }else{ $ok = false; }
	if (isset($_POST['last-name'])){ $last_name = $_POST['last-name']; }else{ $ok = false; }

	$from = $first_name . " " . $last_name;

	$myfile = fopen(__DIR__."/emails_temp/".$file_id."from.txt", "w") or die("");
	fwrite($myfile, $from);
	fclose($myfile);
}

function getEmailBody($file_id) {
	$reader = fopen(__DIR__ . "/emails_temp/" . $file_id . ".txt", "r");
	$body = fread($reader, filesize(__DIR__ . "/emails_temp/" . $file_id . ".txt"));
	fclose($reader);

	return $body;
}

function getEmailFrom($file_id) {
	$reader = fopen(__DIR__ . "/emails_temp/" . $file_id . "from.txt", "r");
	$from = fread($reader, filesize(__DIR__ . "/emails_temp/" . $file_id . "from.txt"));
	fclose($reader);

	return $from;
}

function sendEmail($file_id, $email = null){
	
	$order_number = createOrderNumber();

	$body = getEmailBody($file_id);

	createOrder($file_id, $order_number, $body);

	/* dev */
	// Nepieciešams priekš Gmail
	// + iekš sava Gmail konta settingos jāatļauj "Less secure apps"
	// ( https://stackoverflow.com/a/21282468 )
	date_default_timezone_set('Etc/UTC');

	require_once 'PHPMailer/PHPMailerAutoload.php';

	$messages = "";

	//ADMIN

	$mail = new PHPMailer;

	/* dev */
	/* Blindsave nevajag definēt SMTP */
	// $mail->isSMTP();                                      	// Set mailer to use SMTP
	// $mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
	// $mail->SMTPAuth = true;                               	// Enable SMTP authentication

	// $mail->Username = '';							          // SMTP username
	// $mail->Password = '';          					         // SMTP password

	// $mail->SMTPSecure = 'ssl';                            	// Enable TLS encryption, `ssl` also accepted
	// $mail->Port = 465;                                    	// TCP port to connect to

	$mail->isSMTP();								// Set mailer to use SMTP
	$mail->Host = 'knopkens.com';					// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;							// Enable SMTP authentication
	$mail->Username = 'sender@knopkens.com';		// SMTP username
	$mail->Password = 'iSend1@33';					// SMTP password
	$mail->SMTPSecure = 'tls';						// Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;								// TCP port to connect to


	$from = getEmailFrom($file_id);

	//$mail->SetFrom('customizer@blindsave.com', 'Blindsave customizer');
	$mail->SetFrom("info@blindsave.com", $from);

	/* dev */
	// $mail->AddAddress("andris.knopkens@gmail.com", 'Blindsave customizer');
	$mail->AddAddress("toms@bear.lv", 'Blindsave customizer');
	// $mail->AddAddress("billijs@bear.lv", 'Blindsave customizer');
	// $mail->AddAddress("oskars.bear@gmail.com", 'Blindsave customizer');

	/* live */
	// $mail->AddAddress("info@blindsave.com", 'Blindsave customizer');
	// $mail->AddAddress("au@sportagon.ch", 'Blindsave customizer');





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
	$mail->Subject = 'Blindsave uniform order #'.$order_number;
	// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	// Nez kāpēc neparāda smuki epasta ziņā (Gmail vēl vismaz ieliek attēlu kā pielikumu, bet Yahoo piem. to nedara)
	$mail->AddEmbeddedImage("svg_temp/".$file_id.".svg", "my-attach", "".$file_id.".svg");

	// $pre_text = "Email from - ".$email;

	$mail->Body = $body;

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





	// USER

	if ( !empty($email) ) {
	
		$first_name = explode(' ', $from, 2)[0];

		$body2 = "";
		$body2.= "<p>Hi " . $first_name . ",</p>";
		$body2.= "<p>Thank you for your order #" . $order_number . ". Please find your order details below.</p>";
		$body2.= "<p>You will receive an invoice soon. You can pay via bank transfer or PayPal.</p>";
		$body2.= "<p>Please keep in mind - we will start production when we will receive your payment. Goalie suit delivery time is until 3 weeks.</p>";
		$body2.= "<p>If you have some questions please let us know.</p>";
		$body2.= "<p>Your BLINDSAVE Team</p>";

		// /* Logo jānomaina uz png */
		// /* old: https://customizer.blindsave.com/assets/img/blindsave-logo.svg */
		$body2.= '<p><img alt="Logo" src="https://customizer.blindsave.com/assets/img/blindsave-logo.png"></p>';

		$body2.= "<p>* * *</p><br/><br/>";
		$body2.= "<p class='h1'>Order details:</p><br/>";


		$mail2 = new PHPMailer;


		// /* Blindsave nevajag definēt SMTP */
		// $mail2->isSMTP();                                      		// Set mailer to use SMTP
		// $mail2->Host = 'smtp.gmail.com';  							// Specify main and backup SMTP servers
		// $mail2->SMTPAuth = true;                               		// Enable SMTP authentication

		// $mail2->Username = '';							          	// SMTP username
		// $mail2->Password = '';                   					// SMTP password
		
		// $mail2->SMTPSecure = 'ssl';                            		// Enable TLS encryption, `ssl` also accepted
		// $mail2->Port = 465;                                    		// TCP port to connect to

		$mail2->isSMTP();								// Set mailer to use SMTP
		$mail2->Host = 'knopkens.com';					// Specify main and backup SMTP servers
		$mail2->SMTPAuth = true;						// Enable SMTP authentication
		$mail2->Username = 'sender@knopkens.com';		// SMTP username
		$mail2->Password = 'iSend1@33';					// SMTP password
		$mail2->SMTPSecure = 'tls';						// Enable TLS encryption, `ssl` also accepted
		$mail2->Port = 587;								// TCP port to connect to


		$mail2->SetFrom('info@blindsave.com', 'Blindsave customizer');
		// $mail2->AddAddress($email, $last_name." ".$first_name);     // Add a recipient
		$mail2->AddAddress($email, $from);     // Add a recipient
		$mail2->IsHTML(true);  
		$mail2->CharSet = 'UTF-8';
		$mail2->Subject = 'Deine Bestellung #' . $order_number;
		// // $mail2->AltBody = 'This is the body in plain text for non-HTML mail clients';

		// // Nez kāpēc neparāda smuki epasta ziņā (Gmail vēl vismaz ieliek attēlu kā pielikumu, bet Yahoo piem. to nedara)
		$mail2->AddEmbeddedImage("svg_temp/".$file_id.".svg", "my-attach", "".$file_id.".svg");
		$mail2->Body = $body2.$body;

		if(!$mail2->Send()) {
		//     // echo 'Message could not be sent.';
		//     // echo 'Mailer Error: ' . $mail2->ErrorInfo;

		// 	/* dev */
		//     $messages .= 'Message could not be sent.';
		//     $messages .= ' Mailer Error: ' . $mail->ErrorInfo;
		} else {
		//     // echo 'Message has been sent';
		//
		//	/* dev */
		//     $messages .= 'Message has been sent';;
		}

	}





	unlink(__DIR__ . "/emails_temp/" . $file_id . ".txt");
	unlink(__DIR__ . "/emails_temp/" . $file_id . "from.txt");
	// unlink("svg_temp/" . $file_id . ".svg");
	// unlink("svg_temp/" . $file_id . ".base");

	/* if thankyou.php is used then comment lines below */
	if ( isset($_SESSION['svg_file_id']) ) {
		unset($_SESSION['svg_file_id']);
	}
	/* if thankyou.php is used then comment lines above */

	return $messages;
}


function orderAPI($public_key){
	$return = array();

	$return['POST'] = $_POST;
	$ok = true;

	/*
	 * Only allow specific country orders
	 */
	if ( isset($_POST['country']) ) {
		$country = $_POST['country'];
		if ( !($country === 'Norway') ) {
			$ok = false;
		}
	} else { 
		$ok = false;
	}

	if (isset($_POST['first-name'])){ $first_name = $_POST['first-name']; }else{ $ok = false; }
	if (isset($_POST['last-name'])){ $last_name = $_POST['last-name']; }else{ $ok = false; }
	if (isset($_POST['phone'])){ $phone = $_POST['phone']; }else{  }
	if (isset($_POST['email'])){ $email = $_POST['email']; }else{ $ok = false; }
	if (isset($_POST['address'])){ $address = $_POST['address']; }else{ $ok = false; }
	if (isset($_POST['city'])){ $city = $_POST['city']; }else{ $ok = false; }
	if (isset($_POST['postal'])){ $postal = $_POST['postal']; }else{ $ok = false; }

	// if (isset($_POST['country'])){ $country = $_POST['country']; }else{ $ok = false; }
	if (isset($_POST['size'])){ $size = $_POST['size']; }else{ $ok = false; }
	if (isset($_POST['quantity'])){ $quantity = $_POST['quantity']; }else{ $ok = false; }
	if (isset($_POST['number'])){ $number = $_POST['number']; }else{  }
	if (isset($_POST['print-name'])){ $print_name = $_POST['print-name']; }else{  }
	if (isset($_POST['comments'])){ $comments = $_POST['comments']; }else{  }

	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$ok = false;
	}

	

	if ($ok){

		createSVG($public_key);
		$email_body = createEmailBody($public_key);
		createTempEmail($public_key, $email_body);
		createTempEmailFrom($public_key);

		$return['success'] = true;

		/* if thankyou.php is used then comment line below */
		sendEmail($public_key, $email);

		/* dev */
		// $return['messages'] = sendEmail();

	}

	echo json_encode($return);
}

if (isset($_POST) && !empty($_POST)){
	if (isset($_POST['act'])){

		// if ( isset($_SESSION['svg_file_id']) ) {
		// 	unset($_SESSION['svg_file_id']);
		// }

		if ( !isset($_SESSION['svg_file_id']) ) {
			$key = hash('sha256', uniqid('', true));
			$_SESSION['svg_file_id'] = $key;
		}

		$public_key = $_SESSION['svg_file_id'];

		/* if thankyou.php is used then uncomment lines below */
		// if ( isset($_COOKIE['p_key']) && !empty($_COOKIE['p_key']) ) {
		// 	$public_key = $_COOKIE['p_key'];
		// }

		// if ( !isset($_COOKIE['p_key']) && empty($_COOKIE['p_key']) ) {
		// 	if ( !isset($_COOKIE['pub_k']) && empty($_COOKIE['pub_k']) ) {
		// 		$cookie_name = "pub_k";
		// 		$cookie_value = $public_key;
		// 		setcookie($cookie_name, $cookie_value, time() + (60*60*24*30*6), "/");
		// 	}
		// }
		/* if thankyou.php is used then uncomment lines above */

		if ($_POST['act']=="order"){
			orderAPI($public_key);
		}
		if ($_POST['act']=="svg_part_cleanup"){
			svgPartCleanupAPI($public_key);
			exit;
		}
		if ($_POST['act']=="svg_part"){
			svgPartAPI($public_key);
		}
	}

}

?>
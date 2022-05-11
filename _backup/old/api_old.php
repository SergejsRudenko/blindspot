<?php



session_start();

function svgPartAPI(){
	if (!isset($_SESSION['svg_file_id'])){
		$_SESSION['svg_file_id'] = uniqid();
	}
	$file_id = $_SESSION['svg_file_id'];

	$myfile = fopen("svg_temp/".$file_id.".base", "a") or die("Unable to open file!");
	$txt = $_POST["data"];
	fwrite($myfile, $txt);
	fclose($myfile);
}

function sendEmail(){
	if (!isset($_SESSION['svg_file_id'])){
		$_SESSION['svg_file_id'] = uniqid();
	}
	$file_id = $_SESSION['svg_file_id'];

	$reader = fopen("order_counter.txt", "r");
	$base = fread($reader,filesize("order_counter.txt"));
	fclose($reader);
	$order_number = $base;
	if ($order_number<=0 || $order_number=="") $order_number = 0;
	$order_number++;
	$myfile = fopen("order_counter.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $order_number);
	fclose($myfile);


	$reader = fopen("svg_temp/".$file_id.".base", "r");
	$base = fread($reader,filesize("svg_temp/".$file_id.".base"));
	fclose($reader);


	$myfile = fopen("svg_temp/".$file_id.".svg", "w") or die("Unable to open file!");
	$txt = base64_decode($base);
	fwrite($myfile, $txt);
	fclose($myfile);

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

	


	$body = '<style>';
	$body.= '.title{font-weight: bold;}';
	$body.= '.color-box{display: inline-block; width:30px; height: 20px; vertical-align: top; margin-left: 10px; margin-right: 10px; margin-top: -4px; border: 1px solid #999;}';
	$body.= 'p span{vertical-align: top;}';
	$body.= '.header{font-weight: bold; font-size: 1.2em;}';
	$body.= '.h1{font-weight: bold; font-size: 1.4em;}';
	
	$body.= '</style>';
	$body.= '<p><span class="header">Customer</span></p>';
	$body.= '<p><span class="title">First name: </span> <span>'.$first_name.'</span></p>';
	$body.= '<p><span class="title">Last name: </span> <span>'.$last_name.'</span></p>';
	$body.= '<p><span class="title">Phone: </span> <span>'.$phone.'</span></p>';
	$body.= '<p><span class="title">E-mail: </span> <span>'.$email.'</span></p>';
	$body.= '<p><span class="title">Address: </span> <span>'.$address.'</span></p>';
	$body.= '<p><span class="title">City: </span> <span>'.$city.'</span></p>';
	$body.= '<p><span class="title">Postal: </span> <span>'.$postal.'</span></p>';
	$body.= '<p><span class="title">Country: </span> <span>'.$country.'</span></p>';
	$body.= '<p><span class="title">Size: </span> <span>'.$size.'</span></p>';
	$body.= '<p><span class="title">Quantity: </span> <span>'.$quantity.'</span></p><br/>';

	if ($print){
		$body.= '<p><span class="title">Print: </span> <span>Yes</span></p>';
		$body.= '<p><span class="title">Number: </span> <span>'.$number.'</span></p>';
		$body.= '<p><span class="title">Print name: </span> <span>'.$print_name.'</span></p>';
	}
	$body.= '<p><span class="title">Comments: </span> <span>'.$comments.'</span></p>';
	$body.= '<p><span class="title">Total: </span> <span>'.$total_price.' Eur</span></p>';


	//DESIGN
	$body.= '<br/><p><span class="header">Design</span></p>';
	if($c_design==1){
		$body.= '<p><span class="title">Design: </span> <span>Black</span></p>';
	}else{
		$body.= '<p><span class="title">Design: </span> <span>White</span></p>';
	}
	$body.= '<p><span class="title">Shoulders: </span> <span class="color-box" style="background-color: #'.$c_shoulder.'"></span><span>#'.$c_shoulder.'</span></p>';
	$body.= '<p><span class="title">Chest / arms: </span> <span class="color-box" style="background-color: #'.$c_arms.'"></span><span>#'.$c_arms.'</span></p>';
	$body.= '<p><span class="title">Logo line on jeresey: </span> <span class="color-box" style="background-color: #'.$c_logo_line.'"></span><span>#'.$c_logo_line.'</span></p>';
	$body.= '<p><span class="title">Logo 1: </span> <span class="color-box" style="background-color: #'.$c_logo_1.'"></span><span>#'.$c_logo_1.'</span></p>';
	$body.= '<p><span class="title">Logo 2: </span> <span class="color-box" style="background-color: #'.$c_logo_2.'"></span><span>#'.$c_logo_2.'</span></p>';
	$body.= '<p><span class="title">Logo 3: </span> <span class="color-box" style="background-color: #'.$c_logo_3.'"></span><span>#'.$c_logo_3.'</span></p>';
	$body.= '<p><span class="title">Logo 4: </span> <span class="color-box" style="background-color: #'.$c_logo_4.'"></span><span>#'.$c_logo_4.'</span></p>';
	$body.= '<p><span class="title">Stomach area: </span> <span class="color-box" style="background-color: #'.$c_waist.'"></span><span>#'.$c_waist.'</span></p>';
	$body.= '<p><span class="title">Lines / trim: </span> <span class="color-box" style="background-color: #'.$c_lines.'"></span><span>#'.$c_lines.'</span></p>';
	$body.= '<p><span class="title">Tights: </span> <span class="color-box" style="background-color: #'.$c_tights.'"></span><span>#'.$c_tights.'</span></p>';
	$body.= '<p><span class="title">Shins: </span> <span class="color-box" style="background-color: #'.$c_shins.'"></span><span>#'.$c_shins.'</span></p>';

	
	$body.= '<br/><p><span class="title">Uniform: </span><br/><img alt="Uniform" src="cid:my-attach"></p>';

	require_once 'PHPMailer/PHPMailerAutoload.php';


	//ADMIN

	$mail = new PHPMailer;
	//$mail->SetFrom('customizer@blindsave.com', 'Blindsave customizer');
	$mail->SetFrom($email, $last_name." ".$first_name);
	//$mail->AddAddress("markus@graftik.lv", 'Blindsave customizer');     // Add a recipient
	$mail->AddAddress("info@blindsave.com", 'Blindsave customizer');     // Add a recipient
	$mail->IsHTML(true);  
	$mail->CharSet = 'UTF-8';
	$mail->Subject = 'Blindsave uniform order #'.$order_number;
	// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	$mail->AddEmbeddedImage("svg_temp/".$file_id.".svg", "my-attach", "".$file_id.".svg");
	$mail->Body = $body;

	if(!$mail->Send()) {
	    // echo 'Message could not be sent.';
	    // echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    // echo 'Message has been sent';
	}


	// USER
	
	$body2 = "";
	$body2.= "<p>Hi ".$first_name.",</p>";
	$body2.= "<p>Thank you for your order #".$order_number.". Please find your order details below.</p>";
	$body2.= "<p>You will receive an invoice soon. You can pay via bank transfer or PayPal.</p>";
	$body2.= "<p>Please keep in mind - we will start production when we will receive your payment. Goalie suit delivery time is until 3 weeks.</p>";
	$body2.= "<p>If you have some questions please let us know.</p>";
	$body2.= "<p>Your BLINDSAVE Team</p>";
	$body2.= '<p><img alt="Logo" src="http://customizer.blindsave.com/assets/img/blindsave-logo.svg"></p>';
	$body2.= "<p>* * *</p><br/><br/>";
	$body2.= "<p class='h1'>Order details:</p><br/>";


	$mail2 = new PHPMailer;
	$mail2->SetFrom('info@blindsave.com', 'Blindsave customizer');
	$mail2->AddAddress($email, $last_name." ".$first_name);     // Add a recipient
	$mail2->IsHTML(true);  
	$mail2->CharSet = 'UTF-8';
	$mail2->Subject = 'Your order #'.$order_number;
	// $mail2->AltBody = 'This is the body in plain text for non-HTML mail clients';
	$mail2->AddEmbeddedImage("svg_temp/".$file_id.".svg", "my-attach", "".$file_id.".svg");
	$mail2->Body = $body2.$body;

	if(!$mail2->Send()) {
	    // echo 'Message could not be sent.';
	    // echo 'Mailer Error: ' . $mail2->ErrorInfo;
	} else {
	    // echo 'Message has been sent';
	}

	unlink("svg_temp/".$file_id.".svg");
	unlink("svg_temp/".$file_id.".base");
}


function orderAPI(){
	$return = array();

	$return['POST'] = $_POST;
	$ok = true;

	if (isset($_POST['first-name'])){ $first_name = $_POST['first-name']; }else{ $ok = false; }
	if (isset($_POST['last-name'])){ $first_name = $_POST['last-name']; }else{ $ok = false; }
	if (isset($_POST['phone'])){ $phone = $_POST['phone']; }else{  }
	if (isset($_POST['email'])){ $email = $_POST['email']; }else{ $ok = false; }
	if (isset($_POST['address'])){ $address = $_POST['address']; }else{ $ok = false; }
	if (isset($_POST['city'])){ $city = $_POST['city']; }else{ $ok = false; }
	if (isset($_POST['postal'])){ $postal = $_POST['postal']; }else{ $ok = false; }

	if (isset($_POST['country'])){ $country = $_POST['country']; }else{ $ok = false; }
	if (isset($_POST['size'])){ $size = $_POST['size']; }else{ $ok = false; }
	if (isset($_POST['quantity'])){ $quantity = $_POST['quantity']; }else{ $ok = false; }
	if (isset($_POST['number'])){ $number = $_POST['number']; }else{  }
	if (isset($_POST['print-name'])){ $print_name = $_POST['print-name']; }else{  }
	if (isset($_POST['comments'])){ $comments = $_POST['comments']; }else{  }

	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$ok = false;
	}

	

	if ($ok){
		$return['success'] = true;

		sendEmail();

	}

	echo json_encode($return);
}

if (isset($_POST) && !empty($_POST)){
	if (isset($_POST['act'])){
		if ($_POST['act']=="order"){
			orderAPI();
		}
	}
	if (isset($_POST['act'])){
		if ($_POST['act']=="svg_part"){
			svgPartAPI();
		}
	}
}

?>
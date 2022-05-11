<?php



session_start();

// require_once("libs/Medoo.php");
// use Medoo\Medoo;

$root_url = "https://".$_SERVER['SERVER_NAME']."/customizer";

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

function initCustomSession(){
	$custom_session_id = round(microtime(true) * 1000);
	$custom_session_id = $custom_session_id.md5(rand(100000,999999));
	setCustomSession($custom_session_id, array('id' => $custom_session_id ));
	return $custom_session_id;
}
function clearSessions(){
	$files = scandir(__DIR__."/sessions/");
	$cur_time = time();
	foreach($files as $file) {
		if ($file == "." || $file == ".."){ continue; }
		$file_time = filemtime(__DIR__."/sessions/".$file);
		if ($cur_time - $file_time > 60*60*12){
			unlink(__DIR__."/sessions/".$file);
		}
	}
}
function getCustomSession($session_id){
	$reader = fopen(__DIR__."/sessions/".$session_id.".ses", "r");
	$body = fread($reader, filesize(__DIR__."/sessions/".$session_id.".ses"));
	fclose($reader);
	if ($body){
		return json_decode($body, true);
	}
	return null;
}
function setCustomSession($session_id, $data){
	$myfile = fopen(__DIR__."/sessions/".$session_id.".ses", "w") or die("Unable to open file!");
	
	fwrite($myfile,json_encode($data));
	fclose($myfile);
}
function unsetCustomSession($session_id){
	unlink(__DIR__."/sessions/".$session_id.".ses");
}


if (isset($_GET['demo'])){
	echo "string";
	setCustomSession("aa", "bb");
	echo(getCustomSession("aa"));
	exit;
}


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

function createEmailBody() {

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
	if (isset($_POST['c_inner_tights'])){ $c_inner_tights = $_POST['c_inner_tights']; }
	if (isset($_POST['c_tights'])){ $c_tights = $_POST['c_tights']; }
	if (isset($_POST['c_shins'])){ $c_shins = $_POST['c_shins']; }	
	if (isset($_POST['total_price'])){ $total_price = $_POST['total_price']; }

	if (isset($_POST['c_shins_2'])){ $c_shins_2 = $_POST['c_shins_2']; }
	if (isset($_POST['c_shins_3'])){ $c_shins_3 = $_POST['c_shins_3']; }
	if (isset($_POST['c_jersey'])){ $c_jersey = $_POST['c_jersey']; }
	if (isset($_POST['c_jersey_2'])){ $c_jersey_2 = $_POST['c_jersey_2']; }
	if (isset($_POST['c_elbow_armpit'])){ $c_elbow_armpit = $_POST['c_elbow_armpit']; }
	if (isset($_POST['c_arms_2'])){ $c_arms_2 = $_POST['c_arms_2']; }

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
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>First name: </span> <span'.$ss.$pss.$se.'>'.$first_name.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Last name: </span> <span'.$ss.$pss.$se.'>'.$last_name.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Phone: </span> <span'.$ss.$pss.$se.'>'.$phone.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>E-mail: </span> <span'.$ss.$pss.$se.'>'.$email.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Address: </span> <span'.$ss.$pss.$se.'>'.$address.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>City: </span> <span'.$ss.$pss.$se.'>'.$city.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Postal: </span> <span'.$ss.$pss.$se.'>'.$postal.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Country: </span> <span'.$ss.$pss.$se.'>'.$country.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Size: </span> <span'.$ss.$pss.$se.'>'.$size.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Quantity: </span> <span'.$ss.$pss.$se.'>'.$quantity.'</span></p><br/>';

	if ($print){
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Print: </span> <span'.$ss.$pss.$se.'>Yes</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Number: </span> <span'.$ss.$pss.$se.'>'.$number.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Print name: </span> <span'.$ss.$pss.$se.'>'.$print_name.'</span></p>';
	}
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Comments: </span> <span'.$ss.$pss.$se.'>'.$comments.'</span></p>';
	$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Total: </span> <span'.$ss.$pss.$se.'>'.$total_price.' Eur</span></p>';


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

		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Shoulders: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shoulder.'"></span><span'.$ss.$pss.$se.'>#'.$c_shoulder.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Chest / arms: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_arms.'"></span><span'.$ss.$pss.$se.'>#'.$c_arms.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo line on jeresey: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_line.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_line.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 1: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_1.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_1.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 2: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_2.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_2.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 3: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_3.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_3.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 4: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_4.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_4.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Stomach area: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_waist.'"></span><span'.$ss.$pss.$se.'>#'.$c_waist.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Lines / trim: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_lines.'"></span><span'.$ss.$pss.$se.'>#'.$c_lines.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Tights: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_tights.'"></span><span'.$ss.$pss.$se.'>#'.$c_tights.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Shins: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins.'</span></p>';

	}


	if($c_uniform == "svg-uniform-2"){

		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Jersey body/arms: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_jersey.'"></span><span'.$ss.$pss.$se.'>#'.$c_jersey.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Jersey edges: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_jersey_2.'"></span><span'.$ss.$pss.$se.'>#'.$c_jersey_2.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Elbow / armpit: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_elbow_armpit.'"></span><span'.$ss.$pss.$se.'>#'.$c_elbow_armpit.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 1: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_1.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_1.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 2: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_3.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_3.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 3: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_4.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_4.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Lines / trim: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_lines.'"></span><span'.$ss.$pss.$se.'>#'.$c_lines.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Thighs (upper leg part): </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_tights.'"></span><span'.$ss.$pss.$se.'>#'.$c_tights.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Shins 1 (lower leg part): </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Shins 2 (lower leg part): </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins_2.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins_2.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Pants design elements: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins_3.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins_3.'</span></p>';

	}

	if($c_uniform == "svg-uniform-3"){

		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Jersey body: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_jersey.'"></span><span'.$ss.$pss.$se.'>#'.$c_jersey.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Jersey edges: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_jersey_2.'"></span><span'.$ss.$pss.$se.'>#'.$c_jersey_2.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Jersey arms: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_arms_2.'"></span><span'.$ss.$pss.$se.'>#'.$c_arms_2.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Mesh: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_elbow_armpit.'"></span><span'.$ss.$pss.$se.'>#'.$c_elbow_armpit.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 1: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_1.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_1.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 2: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_3.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_3.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Logo 3: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_logo_4.'"></span><span'.$ss.$pss.$se.'>#'.$c_logo_4.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Lines / trim: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_lines.'"></span><span'.$ss.$pss.$se.'>#'.$c_lines.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Thighs: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_tights.'"></span><span'.$ss.$pss.$se.'>#'.$c_tights.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Inner thighs: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_tights.'"></span><span'.$ss.$pss.$se.'>#'.$c_tights.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Shins 1: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins.'</span></p>';
		$body.= '<p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Shins 2: </span> <span class="color-box" style="'.$color_box_style.'background-color: #'.$c_shins_2.'"></span><span'.$ss.$pss.$se.'>#'.$c_shins_2.'</span></p>';

	}

	$body.= '<br/><p><span class="title"'.$ss.$title_class_style.$pss.$se.'>Uniform: </span><br/><img alt="Uniform" src="cid:my-attach"></p>';

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

function sendEmail($file_id){
	
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

	$mail->isSMTP();                                      	// Set mailer to use SMTP
	$mail->Host = 'knopkens.com';  						// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               	// Enable SMTP authentication

	$mail->Username = 'sender@knopkens.com';							          // SMTP username
	$mail->Password = 'iSend1@33';          					         // SMTP password

	$mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    	// TCP port to connect to
	


	$from = getEmailFrom($file_id);

	//$mail->SetFrom('customizer@blindsave.com', 'Blindsave customizer');
	$mail->SetFrom("info@blindsave.com", $from);

	/* dev */
	$mail->AddAddress("andris.knopkens@gmail.com", 'Blindsave customizer');
	$mail->AddAddress("toms@bear.lv", 'Blindsave customizer');
	$mail->AddAddress("toms@mediapark.com", 'Blindsave customizer');
	// $mail->AddAddress("billijs@bear.lv", 'Blindsave customizer');

	/* live */
	$mail->AddAddress("info@blindsave.com", 'Blindsave customizer');




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





	/* LV versijai klientam e-pasts nav */

	// USER
	
	// $body2 = "";
	// $body2.= "<p>Hi ".$first_name.",</p>";
	// $body2.= "<p>Thank you for your order #".$order_number.". Please find your order details below.</p>";
	// $body2.= "<p>You will receive an invoice soon. You can pay via bank transfer or PayPal.</p>";
	// $body2.= "<p>Please keep in mind - we will start production when we will receive your payment. Goalie suit delivery time is until 3 weeks.</p>";
	// $body2.= "<p>If you have some questions please let us know.</p>";
	// $body2.= "<p>Your BLINDSAVE Team</p>";

	// /* Logo jānomaina uz png */
	// /* old: https://customizer.blindsave.com/assets/img/blindsave-logo.svg */
	// $body2.= '<p><img alt="Logo" src="https://customizer.blindsave.com/assets/img/blindsave-logo.png"></p>';

	// $body2.= "<p>* * *</p><br/><br/>";
	// $body2.= "<p class='h1'>Order details:</p><br/>";


	// $mail2 = new PHPMailer;


	// /* Blindsave nevajag definēt SMTP */
	// $mail2->isSMTP();                                      		// Set mailer to use SMTP
	// $mail2->Host = 'smtp.gmail.com';  							// Specify main and backup SMTP servers
	// $mail2->SMTPAuth = true;                               		// Enable SMTP authentication

	// $mail2->Username = '';							          	// SMTP username
	// $mail2->Password = '';                   					// SMTP password
	
	// $mail2->SMTPSecure = 'ssl';                            		// Enable TLS encryption, `ssl` also accepted
	// $mail2->Port = 465;                                    		// TCP port to connect to


	// $mail2->SetFrom('info@blindsave.com', 'Blindsave customizer');
	// $mail2->AddAddress($email, $last_name." ".$first_name);     // Add a recipient
	// $mail2->IsHTML(true);  
	// $mail2->CharSet = 'UTF-8';
	// $mail2->Subject = 'Your order #'.$order_number;
	// // $mail2->AltBody = 'This is the body in plain text for non-HTML mail clients';

	// // Nez kāpēc neparāda smuki epasta ziņā (Gmail vēl vismaz ieliek attēlu kā pielikumu, bet Yahoo piem. to nedara)
	// $mail2->AddEmbeddedImage("svg_temp/".$file_id.".svg", "my-attach", "".$file_id.".svg");
	// $mail2->Body = $body2.$body;

	// if(!$mail2->Send()) {
	//     // echo 'Message could not be sent.';
	//     // echo 'Mailer Error: ' . $mail2->ErrorInfo;

	// 	/* dev */
	//     $messages .= 'Message could not be sent.';
	//     $messages .= ' Mailer Error: ' . $mail->ErrorInfo;
	// } else {
	//     // echo 'Message has been sent';
	//
	//	/* dev */
	//     $messages .= 'Message has been sent';;
	// }





	// unlink(__DIR__ . "/emails_temp/" . $file_id . ".txt");
	// unlink(__DIR__ . "/emails_temp/" . $file_id . "from.txt");
	// unlink("svg_temp/" . $file_id . ".svg");
	// unlink("svg_temp/" . $file_id . ".base");

	return $messages;
}


function orderAPI($public_key){
	$return = array();

	$return['POST'] = $_POST;
	$ok = true;

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
	if (isset($_POST['number'])){ $number = $_POST['number']; }else{  }
	if (isset($_POST['print-name'])){ $print_name = $_POST['print-name']; }else{  }
	if (isset($_POST['comments'])){ $comments = $_POST['comments']; }else{  }

	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$ok = false;
	}

	

	if ($ok){

		createSVG($public_key);
		$email_body = createEmailBody();
		createTempEmail($public_key, $email_body);
		createTempEmailFrom($public_key);

		$return['success'] = true;

		// sendEmail();

		/* dev */
		// $return['messages'] = sendEmail();

	}

	echo json_encode($return);
}

// function getPrivateKey() {
// 	GLOBAL $db_prefix, $database;

// 	$data = $database->select($db_prefix.'private_key', [
// 		"id",
// 		"private_key"
// 	],[
// 		'AND'=>[
// 	    	'id' => 1
// 	    ]
// 	]);

// 	return $data[0]['private_key'];
// }




// function removeTempOrder($cookie) {
// 	GLOBAL $db_prefix, $database;

// 	$public_key = $cookie;

// 	$data = $database->select($db_prefix . 'temp_orders', [
// 		"id",
// 		"public_key"
// 	],[
// 		'AND'=>[
// 	    	'public_key' => $public_key,
// 	    ]
// 	]);

// 	if ( count($data) > 0 ){
// 		$database->delete($db_prefix . 'temp_orders', [
// 			'AND' => [
// 				'public_key' => $public_key
// 			]
// 		]);
// 	}
// }

// function saveTempOrder() {
// 	GLOBAL $db_prefix, $database;

// 	// $salt = "*a7df34;st18jw*&*&HPjq28i";
// 	// $key = hash('sha256','*a7df34;st18jw*&*&HPjq28i');
//     // 8cc10187eeaac9d3bd4c312c8dcbda97777c1a1dee18605e8af699115b517b43
// 	// $private_key = getPrivateKey();

// 	// $public_key = hash('sha256', uniqid());
// 	$public_key = uniqid()

// 	$cookie_name = "pub_k";
// 	$cookie_value = $public_key;
// 	setcookie($cookie_name, $cookie_value, time() + (60*60*24*30*6), "/");

// 	$order_number = createOrderNumber();
// 	// $svg_file_id = 
// 	createSVG($public_key);

// 	// $database->insert($db_prefix.'temp_orders', [
// 	//     'public_key' 	=> $public_key,
// 	//     'svg_file_id'	=> $svg_file_id,
// 	//     'order_number'	=> $order_number
// 	// ]);

//     $response['success'] = true;

// 	echo json_encode($response);
// }

if (isset($_POST) && !empty($_POST)){
	if (isset($_POST['act'])){

		// if ( isset($_SESSION['svg_file_id']) ) {
		// 	unset($_SESSION['svg_file_id']);
		// }

		// unset($_COOKIE['pub_k']);
  //   	setcookie('pub_k', '', time() - 3600, '/');


		$ses_id = $_POST['custom_session_id'];
		$ses = getCustomSession($ses_id);
		if (isset($ses)){
			$public_key = $ses_id;
		}else{
			exit;
		}


		/*
		if ( !isset($_SESSION['svg_file_id']) ) {
			$key = hash('sha256', uniqid('', true));
			$_SESSION['svg_file_id'] = $key;
		}

		$public_key = $_SESSION['svg_file_id'];

		if ( isset($_COOKIE['p_key']) && !empty($_COOKIE['p_key']) ) {
			$public_key = $_COOKIE['p_key'];
		}

		if ( !isset($_COOKIE['p_key']) && empty($_COOKIE['p_key']) ) {
			if ( !isset($_COOKIE['pub_k']) && empty($_COOKIE['pub_k']) ) {
				$cookie_name = "pub_k";
				$cookie_value = $public_key;
				setcookie($cookie_name, $cookie_value, time() + (60*60*24*30*6), "/");
			}
		}
		*/

		if ($_POST['act']=="order"){
			// if ( isset($_COOKIE['pub_k']) && !empty($_COOKIE['pub_k']) ) {
				// removeTempOrder($_COOKIE['pub_k']);
			// }
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
	// if (isset($_POST['save'])){
	// 	if ($_POST['save']=="checkout"){
	// 		if ( isset($_COOKIE['pub_k']) && !empty($_COOKIE['pub_k']) ) {
	// 			removeTempOrder($_COOKIE['pub_k']);
	// 		}
	// 		saveTempOrder();
	// 	}
	// }
}

?>
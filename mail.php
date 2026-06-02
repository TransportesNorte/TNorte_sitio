<?php

$to = "contactenos_group@transportesnorte.cl"; # <--- Your Email
$subject = "WEB Publica mensaje";

if ($_POST) {
	$name = stripslashes($_POST['name']);
	$email = trim($_POST['email']);
	$phone = stripslashes($_POST['phone']);
	$message = htmlspecialchars($_POST['message']);
  $guests = stripslashes($_POST['guests']);
  $date = stripslashes($_POST['date']);

	$error = '';

	if (!$name) {
		$error .= '<p>Transportes Norte</p>';
	}

	if (!$email) {
		$error .= '<p>contactenos_group@transportesnorte.cl</p>';
	}

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  	$error .= "<p>E-mail no es valido</p>";
  }

	$mess = "Full Name: " . $name . "\r\n";
	$mess .= "Email: " . $email . "\r\n";
	if ($phone) {
    $mess .= "Phone:" . $phone . "\r\n";
  }
  if ($message) {
  	$mess .= "Message: " . $message . "\r\n";
  }
  if ($guests) {
    $mess .= "Guests:" . $guests . "\r\n";
  }
  if ($date) {
    $mess .= "Date:" . $date . "\r\n";
  }

	if (!$error) {
		$mail = mail($to, $subject, $mess,
  	"From: ".$name." <".$email.">\r\n"
  	."Reply-To: ".$name."<".$email.">\r\n"
  	);

  	if ($mail) {
  		echo "Ok";
  	}
  	else{
  		header('HTTP/1.1 500 ' . $error );
      exit();
  	}
	}
	else{
		echo $error;
	}
}

?>

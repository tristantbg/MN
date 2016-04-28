<?php
if(isset($_POST['name'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
	$email_to = "studio@maisonnue.com";
	$email_subject = "Collaboration Maison Nue - ".$_POST['name'];


	function died($error) {
        // your error code can go here
		echo $error."<br /><br />";
		die();
	}

    // validation expected data exists
	if(!isset($_POST['name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['message'])) {
		died('We are sorry, but there appears to be a problem with the form you submitted.');       
}

    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
    $website = $_POST['website']; // not required
    //$pdf = $_POST['pdf']; // not required
    $message = $_POST['message']; // required

    $error_message = "";
    $string_exp = "/^[A-Za-z .'-]+$/";
    if(!preg_match($string_exp,$name)) {
    	$error_message .= 'The name you entered does not appear to be valid.<br />';
    }
  // if(strlen($message) < 50) {
  //   $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  // }
    if(strlen($error_message) > 0) {
    	died($error_message);
    }
    $email_message = "New message from Maison Nue collaboration form:\n\n";

    function clean_string($string) {
    	$bad = array("content-type","bcc:","to:","cc:","href");
    	return str_replace($bad,"",$string);
    }

    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Website: ".clean_string($website)."\n\n";

    // if(isset($pdf) && 
    // 	$pdf == 'yes') 
    // {
    // 	$email_message .= "Portfolio request: Yes\n\n";
    // }
    // else
    // {
    // 	$email_message .= "Portfolio request: No\n\n";
    // }

    $email_message .= "Message: ".clean_string($message)."\n";  


// create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email_to, $email_subject, $email_message, $headers);  

    echo 'Thank you for contacting us.<br>We will be in touch with you very soon.';

}
?>
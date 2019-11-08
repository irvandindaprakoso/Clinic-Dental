<?php
function send_mail($to, $body, $subject)
{	
	require_once "PHPMailer/PHPMailer.php";
	$mail = new PHPMailer;
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'irvanvavan16@gmail.com';                 // SMTP username
	$mail->Password = 'password email';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to
	
	$mail->FromName = 'Nama Anda';
	$mail->addAddress($to);               // Name is optional
	$mail->addReplyTo('Nama Anda', 'Reply');
	
	$mail->Subject = $subject;
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Body    = $body;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		echo 'gagal mengirim.';
	} else {
		?> <script type="text/javascript">alert('Email Berhasil Dikirim!');</script><?php
	}
}
?>
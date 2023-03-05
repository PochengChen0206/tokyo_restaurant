<?php
use PHPMailer\PHPMailer\PHPMailer;

require('../vendor/autoload.php');

$mail = new PHPMailer;
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the encryption system to use - ssl (deprecated) or tls
// $mail->SMTPSecure = 'tls';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
// $mail->Port = 465;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "cpocheng32@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "";

//Set who the message is to be sent from
$mail->setFrom('cpocheng32@gmail.com', 'List Of Tokyo Restaurant');

//Set an alternative reply-to address
$mail->addReplyTo('cpocheng32@gmail.com', 'List Of Tokyo Restaurant');

//Set who the message is to be sent to
// $mail->addAddress('cpocheng32@gmail.com', 'User');
$mail->addAddress($check_email, $user_name);

//設變編碼
$mail->CharSet = "utf-8";

//Set the subject line
$mail->Subject = '新密碼通知';
$mail->IsHTML(true);

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents(''), __DIR__);

//Replace the plain text body with one created manually
// $mail->AltBody = 'This is a plain-text message body';
$mail->Body = '您的新密碼是：'.$password_new_sent.'<br>'.'請用新密碼重新登入帳號設定!';


//Attach an image file
$mail->addAttachment('');

//send the message, check for errors
if (!$mail->send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  // echo "Message sent!";
  //Section 2: IMAP
  //Uncomment these to save your message in the 'Sent Mail' folder.
  #if (save_mail($mail)) {
  #    echo "Message saved!";
  #}
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
// function save_mail($mail)
// {
//   //You can change 'Sent Mail' to any other folder or tag
//   $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

//   //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
//   $imapStream = imap_open($path, $mail->Username, $mail->Password);
//   $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
//   imap_close($imapStream);
//   return $result;
// }
?>
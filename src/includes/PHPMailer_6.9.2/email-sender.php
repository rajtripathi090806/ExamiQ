
<?php

require_once __DIR__ . '/../../../auth/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'src/Exception.php';
require_once 'src/PHPMailer.php';
require_once 'src/SMTP.php';

function sendEmail(array $to, $subject, $body, $altBody, array $attachments=[], array $replyTo=[], array $cc=[], array $bcc=[], array $embedImg=[]) {
    
    $email = new PHPMailer(true);

    try {

        // email server settings

        $email->isSMTP();
        $email->Host       = "smtp.gmail.com";
        $email->SMTPAuth   = true;
        $email->Username   = ADMIN_EMAIL;
        $email->Password   = APP_PASSWORD;
        $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $email->Port       = 587; // 587 is the port no. of TLS / SMTP

        $email->setFrom(ADMIN_EMAIL, ADMIN_NAME);
        


        // email recipients
        // $email->addAddress($toEmail, $toName);
        // similarly for addCC, addBCC, and addReplyTo
        for ($i=0; $i < count($to); $i++)       { $email->addAddress($to[$i][0], $to[$i][1]); }
        for ($i=0; $i < count($cc); $i++)       { $email->addCC($cc[$i][0], $cc[$i][1]); }
        for ($i=0; $i < count($bcc); $i++)      { $email->addBCC($bcc[$i][0], $bcc[$i][1]); }
        for ($i=0; $i < count($replyTo); $i++)  { $email->addReplyTo($replyTo[$i][0], $replyTo[$i][1]); }
        


        // email content

        $email->isHTML(true);

        if (count($embedImg) == 3) {
            // image is embedded with the 3 required parameters
            // $email->addEmbeddedImage($imgLocation, $cid, $fileDisplayName);
            $email->addEmbeddedImage($embedImg[0], $embedImg[1], $embedImg[2]);
        }
        $email->Subject = $subject;
        $email->Body = $body;
        $email->AltBody = $altBody;
        


        // attachments

        for ($i=0; $i < count($attachments); $i++) {
            // $email->addAttachment($fileLocation, $fileDisplayName);
            $email->addAttachment($attachments[0], $attachments[1]);
        }
        

        // sending the email

        $email->send();
        return 1;
    }
    catch (Exception $e) {
        // something went wrong
        return $e->getMessage();
    }
}

?>

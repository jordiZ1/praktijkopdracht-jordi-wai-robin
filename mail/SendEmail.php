<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php';

class SendEmail
{
    private function sendMail($address, $subject, $message)
    {
        $mail = new PHPMailer();

        //SMTP settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "service.coralyachts@gmail.com";
        $mail->Password = "coralyachtsaventus4";
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Mail settings
        $mail->isHTML(true);
        $mail->setFrom("service.mollenhof@gmail.com", "Mollenhof");
        $mail->addAddress($address);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if($mail->send()) {
            return 'success';
        }
        else {
            return 'failed';
        }
    }

    public function createMail($toAddress, $subject, $template, $values)
    {
        if($this->getTemplate($template) == NULL) {
            return 'failed';
        }
        else {
            $template = $this->getTemplate($template);
        }

        $template = $this->setValues($template, $values);

        $status = $this->sendMail($toAddress, $subject, $template);

        return $status;
    }

    private function getTemplate($fileName) {
        $header_path = "mail/templates/header.phtml";
        $footer_path = "mail/templates/footer.phtml";
        $content_path = "mail/templates/" . $fileName . ".phtml";

        if(file_exists($header_path) && file_exists($footer_path) && file_exists($content_path)) {
            $header = file_get_contents($header_path);
            $footer = file_get_contents($footer_path);
            $content = file_get_contents($content_path);

            $template = $header . $content . $footer;

            return $template;
        }
        else {
            return NULL;
        }
    }

    private function setValues($template, $values)
    {
        foreach(array_keys($values) as $key) {
            $template = str_replace($key, $values[$key], $template);
        }

        return $template;
    }
}
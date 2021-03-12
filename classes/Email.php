<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../vendor/PHPMailer-master/src/Exception.php';
require '../vendor/PHPMailer-master/src/PHPMailer.php';
require '../vendor/PHPMailer-master/src/SMTP.php';

/**
 * email sending class
 */
class Email
{

    // PUBLIC PROPS
    public $subject = 'NOREPLY';
    public $message;
    public $recepient;

    public function __construct($recepient)
    {
        $this->recepient = $recepient;
    }


    /**
     * construct an email about the changes made to the project
     * @param array $project original values
     * @param object $updatedProject updated values
     * 
     * return void
     */
    public function registerChanges($project, $updatedProject)
    {
        // check which props have been changed and assign value accordingly
        $title = $project['title'] == $updatedProject->title ? 'Nincs változás' :  $updatedProject->title;
        $description = $project['description'] == $updatedProject->description ? 'Nincs változás' : $updatedProject->description;
        $status = $project['status'] == $updatedProject->status ? 'Nincs változás' : $updatedProject->status;
        $owner_name = $project['owner_name'] == $updatedProject->owner_name ? 'Nincs változás' :  $updatedProject->owner_name;
        $owner_email = $project['owner_email'] == $updatedProject->owner_email ? 'Nincs változás' : $updatedProject->owner_email;
        // construct email message
        $this->message = "Hello {$updatedProject->owner_name} 
        A következő változások történtek az egyik projektedben(id:{$updatedProject->id})
        Cím: {$title}
        Leírás: {$description}
        Státusz:  {$status}
        Kapcsolattartó: {$owner_name}
        kapcsolattartó email címe: {$owner_email} ";
    }

    public function sendEmail()
    {
        try {
            // instantiate PHPMailer object and pass true to be able to catch exceptions
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom(SENDER);
            $mail->addAddress($this->recepient);
            $mail->addReplyTo(SENDER);
            $mail->Subject = $this->subject;
            $mail->Body = $this->message;

            $mail->send();
            // return true to the if statement in edit.php to be able to proceed to redirect 
            return true;
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}

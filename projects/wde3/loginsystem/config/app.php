<?php

//const APP_URL = 'http://aidcascs210.byethost15.com/projects/wde3/loginsystem/public';
//const SENDER_EMAIL_ADDRESS = 'aidencastillo41@gmail.com';

const APP_URL = 'http://localhost/aidcascs210/projects/wde3/loginsystem/public';
const SENDER_EMAIL_ADDRESS = 'aidencastillo41@gmail.com';

function success_email(string $email): void
{
    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
        ->setUsername('aidencastillo41@gmail.com')
        ->setPassword('pbrsizrztfwtgdpl');
    $mailer = new Swift_Mailer($transport);
    // Create a message
    $message = (new Swift_Message('Password Update'))
        ->setFrom(['aidencastillo41@gmail.com' => 'Password Reset Successful'])
        ->setTo([$email])
        ->setBody(
            '<html>' .
            '<head>' .
            '<style>' .
            'h1 { font-family: Arial, sans-serif; font-size: 16px; }' .
            '</style>' .
            '</head>' .
            '<body>' .
            '<h1>Greetings,<br> You have successfully updated your
                password.<br></h1>' .
            '</body>' .
            '</html>',
            'text/html'
        );
    // Send the message
    $result = $mailer->send($message);
}
?>
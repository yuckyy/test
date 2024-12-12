<?php

use EasyMiler\EmailTemplate;

$services = require __DIR__ . '/bootatrap/bootstrap.php';

$db = $services['db'];
$emailSender = $services['emailSender'];
$name = $_POST['name'];
$email = $_POST['email'];
$description = $_POST['description'];

$templatePath = __DIR__ . '/templates/email_template.php';

    if ($email) {
        $db->putEmail($email, $name, $description);

        $data = [
            'name' => $name,
            'email' => $email,
            'description' => $description,
            'bodyContent' => '',
            'subject' => '6weeks - Форма заповнена',
        ];

        $emailTemplate = EmailTemplate::fromFile($templatePath, $data);

        $maxRetries = 3;
        $retryDelay = 60;

        for ($i = 0; $i < $maxRetries; $i++) {
            try {
                $emailSender->send($email, $emailTemplate->getSubject(), $emailTemplate->getBody());
//                echo "Email sent successfully to $email" . PHP_EOL;
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'name' => $name,
                    'email' => $email,
                    'description' => $description
                ]);

                break;
            } catch (Exception $e) {
//                echo "Error sending email to $email: " . $e->getMessage() . PHP_EOL;

                if (strpos($e->getMessage(), '451') !== false && strpos($e->getMessage(), '4.7.1') !== false) {
//                    echo "Rate limit exceeded. Retrying in $retryDelay seconds..." . PHP_EOL;
                    echo json_encode(['success' => false]);
                }

                if ($i < $maxRetries - 1) {
                    sleep($retryDelay);
                } else {
//                    echo "Failed to send email to $email after $maxRetries attempts. Moving to next email." . PHP_EOL;
                    echo json_encode(['success' => false]);
                }
            }
        }
    } else {
        error_log('Invalid email data: ' . print_r($email, true));
    }



//echo "Sending is Finished";

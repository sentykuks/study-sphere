<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // This is for Composer autoload. If not using Composer, include PHPMailer manually

function sendWelcomeEmail($toEmail, $toName) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                              // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                            // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                       // Enable SMTP authentication
        $mail->Username   = 'anandpaswan4812@gmail.com';                      // SMTP username (use your email)
        $mail->Password   = 'dxoq pbag pgtj ijaw';                       // SMTP password (use your email password or app-specific password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;              // Enable TLS encryption
        $mail->Port       = 587;                                        // TCP port to connect to

        //Recipients
        $mail->setFrom('anandpaswan4812@gmail.com', 'studysphere');
        $mail->addAddress($toEmail, $toName);                            // Add a recipient

        // Content
        $mail->isHTML(true);                                            // Set email format to HTML
        $mail->Subject = 'Welcome to Our Website!';
        $mail->Body = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    color: #333;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    max-width: 600px;
                    margin: auto;
                }
                h1 {
                    color: #4CAF50;
                    font-size: 24px;
                    text-align: center;
                }
                p {
                    font-size: 16px;
                    line-height: 1.5;
                    margin: 10px 0;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                    font-size: 14px;
                    color: #777;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Welcome, $toName!</h1>
                <p>Thank you for signing up to our website. We are excited to have you on board.</p>
                <p class='footer'>Best regards,<br>our Website Team</p>
            </div>
        </body>
        </html>
    ";
    $mail->AltBody = "Welcome, $toName! Thank you for signing up to our website. We are excited to have you on board. Best regards, Your Website Team";

        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Example usage: Send the welcome email after user registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];

    // Call the sendWelcomeEmail function
    sendWelcomeEmail($email, $name);

    // Redirect or show success message
    
}
?>

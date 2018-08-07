<?php
/* 
    Advacned PHP contact form script 
    Copyrights BootstrapMade 
*/

/***************** Configuration *****************/

// Enter your email, where you want to receive the messages.
$contact_email_to = "7netic@gmail.com";

// Subject prefix
$contact_subject_prefix = "Contat Form Message: ";

// Name too short error text
$contact_error_name = "姓名太短囉！ Name is too short or empty!";

// Email invalid error text
$contact_error_email = "請輸入正確的mail！ Please enter a valid email!";

// Subject too short error text
$contact_error_subject = "要記得寫主題！ Subject is too short or empty!";

// Message too short error text
$contact_error_message = "要記得寫內容哦！ Too short message! Please enter something.";

/********** Do not edit from the below line ***********/

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    // The Request must be Ajax POST, enter a message for direct access requests.
    die('Invalid Request!'); 
}

if( isset($_POST) ) {

    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    
    if(strlen($name)<4){ 
        die($contact_error_name);
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){  
        die($contact_error_email);
    }
    
    if(strlen($message)<3){ 
        die($contact_error_subject);
    }
    
    if(strlen($message)<3){ 
        die($contact_error_message);
    }

    $sendemail = mail($contact_email_to, $contact_subject_prefix . $subject, $message,
         "From: ".$name." <".$email.">" . PHP_EOL
        ."Reply-To: ".$email . PHP_EOL
        ."X-Mailer: PHP/" . phpversion()
    );
    
    if( $sendemail ) {
        echo 'OK';
    } else {
        echo 'Could not send mail! Please check your PHP mail configuration.';
    }
}
?>
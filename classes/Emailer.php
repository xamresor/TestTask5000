<?php

class Emailer
{
    public static function validateEmail(string $email) :bool {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public static function sendEmail(string $to, string $subject, string $message) :bool {
        $header = "From:admin@" . $_SERVER['HTTP_HOST'] . PHP_EOL;
        $header .= "Cc:" . PHP_EOL;
        $header .= "MIME-Version: 1.0" . PHP_EOL;
        $header .= "Content-type: text/html" . PHP_EOL;

        $return = true; //mail ($to,$subject,$message,$header);
        return (bool) $return;
    }


}

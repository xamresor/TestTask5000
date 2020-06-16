<?php
require('../initialize.php');

switch ($_POST['method']) {
    case 'register':
        $email = validateEmail($_POST['email'] ?? null);
        $amount = validateAmount($_POST['amount'] ?? null);

        if ($src = Application::register($email, $amount)) {
            die(json_encode([
                'success' => 1,
                'src' => $src,
            ]));
        }
        die('error');
    break;
}

function validateEmail($email) : string {
    if (empty($email)) {
        die('empty email');
    } elseif (!Emailer::validateEmail($email)) {
        die('wrong email');
    }
    return $email;
}

function validateAmount($amount) : string {
    if (empty($amount)) {
        die('empty sum');
    } elseif ($amount <= 0) {
        die('sum is not positive');
    }
    return $amount;
}




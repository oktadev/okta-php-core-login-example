<?php
require('../bootstrap.php');

use Src\Services\OktaApiService;
use Src\Controllers\UserController;

$oktaApi = new OktaApiService;
$userController = new UserController($oktaApi);

// view data
$data = null;

// build login URL and redirect the user
if (isset($_REQUEST['login']) && (! isset($_SESSION['username']))) {
    $_SESSION['state'] = bin2hex(random_bytes(5));
    $authorizeUrl = $oktaApi->buildAuthorizeUrl($_SESSION['state']);
    header('Location: ' . $authorizeUrl);
    die();
}

// handle the redirect back
if (isset($_GET['code'])) {
    $result = $oktaApi->authorizeUser();
    if (isset($result['error'])) {
        $data['loginError'] = $result['errorMessage'];
    }
}

if (isset($_REQUEST['logout'])) {
    unset($_SESSION['username']);
    header('Location: /');
    die();
}

if (isset($_REQUEST['register'])) {
    view('register');
    die();
}

if (isset($_REQUEST['command']) && ($_REQUEST['command'] == 'register')) {
    $userController->handleRegistrationPost();
    die();
}

if (isset($_REQUEST['thankyou'])) {
    $data['thank_you'] = 'Thank you for your registration!';
}

if (isset($_REQUEST['forgot'])) {
    view('forgot');
    die();
}

if (isset($_REQUEST['command']) && ($_REQUEST['command'] == 'forgot_password')) {
    $userController->handleForgotPasswordPost();
    die();
}

if (isset($_REQUEST['password_reset'])) {
    $data['thank_you'] = 'You should receive an email with password reset instructions';
}

view('home', $data);

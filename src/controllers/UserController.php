<?php
namespace Src\Controllers;

use Src\Services\OktaApiService;

class UserController
{

    private $errors = null;
    private $errorMessage = null;

    public function __construct(OktaApiService $oktaApi)
    {
        $this->oktaApi = $oktaApi;
    }

    public function handleRegistrationPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $input = [
                'first_name'      => $_POST['first_name'],
                'last_name'       => $_POST['last_name'],
                'email'           => $_POST['email'],
                'password'        => $_POST['password'],
                'repeat_password' => $_POST['repeat_password'],
            ];

            // local form validation
            $this->validateRegistrationForm($input);
            if ($this->errors) {
                $viewData = [
                    'input' => $input,
                    'errors' => $this->errors,
                    'errorMessage' => $this->errorMessage
                ];
                view('register', $viewData);
                return true;
            }

            // if local validation passes, attempt to register the user
            // via the Okta API
            $result = $this->oktaApi->registerUser($input);
            $result = json_decode($result, true);
            if (isset($result['errorCode'])) {
                $viewData = [
                    'input' => $input,
                    'errors' => true,
                    'errorMessage' => '<br>(Okta) ' . $result['errorCauses'][0]['errorSummary']
                ];
                view('register', $viewData);
                return true;
            }

            header('Location: /?thankyou');
            return true;
        }
        
        header('HTTP/1.0 405 Method Not Allowed');
        die();
    }

    public function handleForgotPasswordPost()
    {
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $input = [
                'email' => $_POST['email']
            ];

            // validate the email address
            if (empty($input['email']) ||
                strlen($input['email']) > 100 ||
                (! filter_var($input['email'], FILTER_VALIDATE_EMAIL))) {
                $viewData = [
                    'input' => $input,
                    'errors' => true,
                    'errorMessage' => '<br>Invalid email!'
                ];
                view('forgot', $viewData);
                return true;
            }

            // search for this user via the OktaApi
            $result = $this->oktaApi->findUser($input);
            $result = json_decode($result, true);
            if (! isset($result[0]['id'])) {
                $viewData = [
                    'input' => $input,
                    'errors' => true,
                    'errorMessage' => '<br>User not found!'
                ];
                view('forgot', $viewData);
                return true;
            }

            // attempt to send a reset link to this user
            $userId = $result[0]['id'];
            $result = $this->oktaApi->resetPassword($userId);

            header('Location: /?password_reset');
            return true;
        }

        header('HTTP/1.0 405 Method Not Allowed');
        die();
    }

    private function validateRegistrationForm($input)
    {
        $errorMessage = '';
        $errors = false;

        // validate field lengths
        if (strlen($input['first_name']) > 50) {
            $errorMessage .= "<br>'First Name' is too long (50 characters max)!";
            $errors = true;            
        }
        if (strlen($input['last_name']) > 50) {
            $errorMessage .= "<br>'Last Name' is too long (50 characters max)!";
            $errors = true;            
        }
        if (strlen($input['email']) > 100) {
            $errorMessage .= "<br>'Email' is too long (100 characters max)!";
            $errors = true;            
        }
        if (strlen($input['password']) > 72) {
            $errorMessage .= "<br>'Password' is too long (72 characters max)!";
            $errors = true;            
        }
        if (strlen($input['password']) < 8) {
            $errorMessage .= "<br>'Password' is too short (8 characters min)!";
            $errors = true;            
        }

        // validate field contents
        if (empty($input['first_name'])) {
            $errorMessage .= "<br>'First Name' is required!";
            $errors = true;
        }
        if (empty($input['last_name'])) {
            $errorMessage .= "<br>'Last Name' is required!";
            $errors = true;
        }
        if (empty($input['email'])) {
            $errorMessage .= "<br>'Email' is required!";
            $errors = true;
        } else if (! filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $errorMessage .= "<br>Invalid email!";
            $errors = true;
        }
        if (empty($input['password'])) {
            $errorMessage .= "<br>'Password' is required!";
            $errors = true;
        }
        if (empty($input['repeat_password'])) {
            $errorMessage .= "<br>'Repeat Password' is required!";
            $errors = true;
        }
        if ($input['password'] !== $input['repeat_password']) {
            $errorMessage .= "<br>Passwords do not match!";
            $errors = true;
        }

        $this->errors = $errors;
        $this->errorMessage = $errorMessage;
    }
}
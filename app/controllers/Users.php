<?php
class Users extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data

            // Init data
            $data = [
                'FirstName' => trim($_POST['FirstName']),
                'LastName' => trim($_POST['LastName']),
                'DateOfBirth' => date('Y-m-d'),
                'Email' => trim($_POST['Email']),
                'PasswordHash' => $_POST['PasswordHash'],
                'first_name_err' => '',
                'last_name_err' => '',
                'DateOfBirth_err' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if (empty(trim($data['Email']))) {
                $data['email_err'] = 'Pleae enter email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['Email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate First Name
            if (empty(trim($data['FirstName']))) {
                $data['first_name_err'] = 'Please enter your first name';
            }
            // Validate Last Name
            if (empty(trim($data['LastName']))) {
                $data['last_name_err'] = 'Please enter your last name';
            }
            
            // Validate date of birth
            if (empty(trim($data['DateOfBirth']))) {
                $data['DateOfBirth_err'] = 'Please enter date';
            }
            
            // Validate Password
           
            if (empty(trim($data['PasswordHash']))) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['PasswordHash']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Make sure errors are empty
            if (empty(trim($data['email_err'])) && empty(trim($data['first_name_err'])) && empty(trim($data['last_name_err'])) && empty(trim($data['DateOfBirth_err']))  && empty(trim($data['password_err']))) {
                // Validated

                // Hash Password
                $data['PasswordHash'] = password_hash($_POST['PasswordHash'], PASSWORD_DEFAULT);
                
                // Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Init data
            $data = [
                'FirstName' => '',
                'LastName' => '',
                'DateOfBirth' => '',
                'Email' => '',
                'PasswordHash' => '',
                'first_name_err' => '',
                'last_name_err' => '',
                'DateOfBirth_err' => '',
                'email_err' => '',
                'password_err' => '', ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data

            // Init data
            $data = [
                'Email' => $_POST['Email'],
                'PasswordHash' => $_POST['PasswordHash'],
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if (empty($data['Email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // Validate Password
            if (empty($data['PasswordHash'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            $user = $this->userModel->findUserByEmail($data['Email']);

            if ($user) {
                // echo $_POST['PasswordHash'];
                echo $user['PasswordHash'];

                // User found, check password
                if (password_verify($_POST['PasswordHash'], $user['PasswordHash'])) {
                    // Password is correct, set up the session
                    echo "this is correct :)";
                    $this->createUserSession($user);
                } else {
                    echo "this aint correct";
                    // Password incorrect
                    echo $_SESSION["UserID"];
                    $data['password_err'] = 'Password incorrect';
                }
            } else {
                // User not found
                $data['email_err'] = 'No user found';
            }

            // Check for errors
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated, login successful
                // Redirect or do other actions as needed
                // echo 'Login successful';
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Init data
            $data = [
                'email' => '',
                'PasswordHash' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['UserID'] = $user['UserID'];
        $_SESSION['email'] = $user['Email'];
        $_SESSION['first_name'] = $user['FirstName'];
        $_SESSION['last_name'] = $user['LastName'];
        redirect('binance');
    }

    public function logout()
    {
        unset($_SESSION['UserID']);
        unset($_SESSION['email']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        session_destroy();
        redirect('users/login');
    }
}

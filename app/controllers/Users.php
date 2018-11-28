<?php 

   class Users extends Controller{

      public function __construct(){
         $this -> userModel = $this -> model("User");

      }
////////////////////////////////////////////////////////////////////////////////////////////////////
      // register
      public function register(){
         // Check for POST
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process the form
            // die('submitted');

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
               'name' => trim($_POST['name']),
               'email' => trim($_POST['email']),
               'password' => trim($_POST['password']),
               'confirm_password' => trim($_POST['confirm_password']),
               'name_err' => '',
               'email_err' => '',
               'password_err' => '',
               'confirm_password_err' => ''
            ];

            // Validate email
            if(empty($data['email'])){
               $data['email_err'] = 'Please enter email';
            } else {
               // Check Email
               if($this->userModel->findUserByEmail($data['email'])){
                  $data['email_err'] = "This email is already registered, Wolud you like to <a class='btn btn-outline-primary btn-sm mt-2'  href='login'>Login</a>";
               } 
            }

            // Validate name
            if(empty($data['name'])){
               $data['name_err'] = 'Please enter name';
            }

            // Validate password
            if(empty($data['password'])){
               $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6){
               $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate confirm_password
            if(empty($data['confirm_password'])){
               $data['confirm_password_err'] = 'Please confirm password';
            } else {
               if($data['password'] != $data['confirm_password']){
                  $data['confirm_password_err'] = 'Password do not match';
               }
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
               // Everything Validated

               // Need to hash the password
               $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, array('cost' => 12));
               
               // Everything ready to register the user to database
               if($this->userModel->register($data)){
                  flash('register_success_msg', 'You are registered and can log in...');
                  redirect('users/login');
               } else { 
                  die('Something went wrong');
               }
            }else {
               // Load view with errors
               $this->view('users/register', $data);
            }


         } else {
            // Init data
            $data = [
               'name' => '',
               'email' => '',
               'password' => '',
               'confirm_password' => '',
               'name_err' => '',
               'email_err' => '',
               'password_err' => '',
               'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
            
         }
      } // register()
////////////////////////////////////////////////////////////////////////////////////////////////////

      // Login
      public function login(){
         // Check for POST
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process the form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
               'email' => trim($_POST['email']),
               'password' => trim($_POST['password']),
               'email_err' => '',
               'password_err' => ''
            ];

            // Validate email
            if(empty($data['email'])){
               $data['email_err'] = 'Please enter email';
            }

            // Validate password
            if(empty($data['password'])){
               $data['password_err'] = 'Please enter password';
            }

            

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err']) ) {
               // Validated
               // Check for user / email
               if($this->userModel->findUserByEmail($data['email'])) {
                  // Registered email found on the database

                  $loggedInUser = $this->userModel -> login($data['email'], $data['password']);

                  if($loggedInUser){
                     // LOGIN DETAILS ARE CORRECT - PASSWORD (EMAIL ALREADY CHECKED)
                     // CREATE SESSION VARIABLES TO LET USER LOG IN
                     $this -> createUserSession($loggedInUser);
                  } else {
                     // PASSWORD IS NOT CORRECT
                     flash('login_password_error', 'Your email or password is not correct(PASSWORD)' , 'alert alert-danger');
                     $this->view('users/login');
                  }
               } else {
                  flash('login_email_error', 'Your email or password is not correct(EMAIL)' , 'alert alert-danger');
                  $this->view('users/login');
               }
               
            }else {
               // Load view with errors
               $this->view('users/login', $data);
            }



         } else {
            // Init data
            $data = [
               'email'        => '',
               'password'     => '',
               'email_err'    => '',
               'password_err' => ''
            ];

            // Load view
            $this->view('users/login', $data);
            
         }
      } // login()

////////////////////////////////////////////////////////////////////////////////////////////////////

      // createUserSession()
      public function createUserSession($user){
         $_SESSION['userID']     = $user -> user_id;
         $_SESSION['user_email'] = $user -> user_email;
         $_SESSION['user_name']  = $user -> user_name;
         redirect('posts');
      } // createUserSession()
////////////////////////////////////////////////////////////////////////////////////////////////////

      // logout
      public function logout(){
         unset($_SESSION['userID']);
         unset($_SESSION['user_email']);
         unset($_SESSION['user_password']);
         session_destroy();
         redirect('users/login');
      } // logout

////////////////////////////////////////////////////////////////////////////////////////////////////
      // isLoggedIn
      public function isLoggedIn(){
         if(isset($_SESSION["userID"])){
            return true;
         } else {
            return false;
         }
      }  // isLoggedIn 
////////////////////////////////////////////////////////////////////////////////////////////////////
   
////////////////////////////////////////////////////////////////////////////////////////////////////
      // profile
      public function profile(){
         $data = $_SESSION;

         $this -> view('users/profile', $data);
      }  // isLoggedIn 
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
      // forgot
      public function forgot(){

         $this -> view('users/forgot');
      }  // isLoggedIn 
////////////////////////////////////////////////////////////////////////////////////////////////////
} // Users
?>
<?php 
   class User {
      private $db;

      // __consruct
      public function __construct(){
         $this->db = new Database();

      } // __construct
////////////////////////////////////////////////////////////////////////////////////////////////////

      // Find user by email
      public function findUserByEmail($email){

         $this->db->query('SELECT * FROM users WHERE user_email = :user_email');
         $this->db->bind(':user_email', $email);

         $row = $this->db->single();

         // Check row
         if($this->db->rowCount() > 0){
         return true;
         } else {
         return false;
         }
      } //
////////////////////////////////////////////////////////////////////////////////////////////////////

      // Register user
      public function register($data){
         // Set the query
         $this -> db -> query('INSERT INTO users SET user_name = :user_name, user_email = :user_email, user_password = :user_password');
         // Bind the values
         $this -> db -> bind(':user_name', $data['name']);
         $this -> db -> bind(':user_email', $data['email']);
         $this -> db -> bind(':user_password', $data['password']);

         // Execute
         if($this -> db -> execute()){
            return true;
         } else {
            return false;
         }
      } // Register user
////////////////////////////////////////////////////////////////////////////////////////////////////

      // Login user
      public function login($email, $password){

         $this -> db -> query('SELECT * FROM users WHERE user_email = :user_email');
         $this -> db -> bind(':user_email', $email);

         $row = $this -> db ->single();
         $hashed_password = $row->user_password;

         if(password_verify($password, $hashed_password)){
            return $row;
         } else {
            return false;
         }

      } // Login user
////////////////////////////////////////////////////////////////////////////////////////////////////



   } // User

<?php 

   session_start();
   
   // Flash message helper
   function flash($name = '', $message = '', $class = 'alert alert-success alert-dismissible fade show'){

      if(!empty($name)) {
         if(!empty($message) && empty($_SESSION[$name])){

            if(!empty($_SESSION[$name])) {
               unset($_SESSION[$name]);
            }
            if(!empty($_SESSION[$name.'_class'])) {
               unset($_SESSION[$name.'_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;


         } elseif(empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';

            echo '<div class="'.$class.'" id="msg-flash" role="alert">'.$_SESSION[$name].'
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>';

            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
         }
      }
   } 

////////////////////////////////////////////////////////////////////////////////////////////////////
   // isLoggedIn
   function isLoggedIn(){
      if(isset($_SESSION["userID"])){
         return true;
      } else {
         return false;
      }
   }  // isLoggedIn 
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
   // trace   
   function trace($obj){
      echo "<pre>";
      echo print_r($obj);
      echo "</pre>";
   } // trace
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<?php 
   class Posts extends Controller {

      public function __construct(){
         if(!isLoggedIn()){
            redirect('users/login');
         }

         $this -> postModel = $this -> model('Post');
      } 

      public function index(){
         // Get Posts
         $posts = $this -> postModel -> getPosts();
         $data = [
            'posts' => $posts
         ];

         $this -> view('posts/index', $data);
      }

      // add
      public function add(){

         if($_SERVER['REQUEST_METHOD'] == "POST") {
            // Sanitaze post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
               'title'     => trim($_POST['title']),
               'body'      => trim($_POST['body']),
               'user_id'   => $_SESSION['userID'],
               'title_err' => '',
               'body_err'  => ''
            ];

            // Validate title
            if(empty($data['title'])){
               $data['title_err'] = "Please enter post title";
            }

            // Validate body
            if(empty($data['body'])){
               $data['body_err'] = "Please enter post body text";
            }

            // make sure no errors
            if(empty($data['title_err']) && empty($data['body_err'])){
               // Validated all
               if($this->postModel->addPost($data)){
                  flash('post_add_success', 'Post successfully added');
                  redirect('posts');
               } else {
                  die('Something went wrong');
               }

            } else {
               // Load view with errors
               $this -> view('posts/add', $data);
            }

         }else {
            $data = [
               'title' => '',
               'body'  => '',
               'title_err' => '',
               'body_err'  => ''
            ];
            $this -> view('posts/add');
         }
      } // add

   }

?>
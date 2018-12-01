<?php 

class Post {
   private $db;

   public function __construct(){
      $this -> db = new Database();
   }
   
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////

   // getPosts()
   public function getPosts(){
      
      // EGER IKI TABLEDA AYNI ISIMLI COLUMN VARSA KULLANILIR 
      // BURADA ID VE CREATED_AT ICIN ALIAS OLUSTURULUYOR
      // $this -> db -> query("SELECT *,
      //                      posts.post_id as postId,
      //                      users.user_id as userId,
      //                      posts.created_at as postCreated,
      //                      users.created_at as userCreated
      //                      FROM posts
      //                      INNER JOIN users
      //                      ON posts.post_user_id = users.user_id
      //                      ORDER BY posts.created_at DESC
      //                      ");
      // INNER JOIN IKI KULLANIMI BURADA GOSTERILDI

      $this -> db -> query("SELECT *
                           FROM posts
                           INNER JOIN users
                           ON posts.post_user_id = users.user_id
                           ORDER BY posts.post_created_at DESC
                           ");

      $results = $this -> db -> resultSet();

      return $results;
   } // getPosts

////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////     

   // addPost()
   public function addPost($data){

      $this -> db -> query("INSERT INTO posts SET post_user_id = :post_user_id, post_title = :post_title, post_body = :post_body");
      // BIND THE VALUES
      $this -> db -> bind(":post_user_id", $data['user_id']);
      $this -> db -> bind(":post_title", $data['title']);
      $this -> db -> bind(":post_body", $data['body']);

      if($this -> db -> execute()){
         return true;
      } else {
         return false;
      }
   } // addPost()
////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////  
   
   // getPostById
   public function getPostById ($id){
      $this -> db -> query("SELECT * FROM posts WHERE post_id = :post_id");
      $this -> db -> bind(':post_id', $id);
      $row = $this -> db -> single();
      return $row;
   } // getPostById

////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////// 


   } // Posts
?>
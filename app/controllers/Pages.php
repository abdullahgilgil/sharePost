<?php
  class Pages extends Controller {
    public function __construct(){
      
    }
    
    public function index(){
      
      if(isLoggedIn()) {
        redirect('posts/index');
      }

      $data = [
        'title' => 'SharePosts',
        'description' => 'Simple social network built on PHP MVC Framework'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to share posts with other users'
      ];

      $this->view('pages/about', $data);
    }
  }
<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('post_add_success'); ?>
   <div class="row my-5">
      <div class="col-md-6">
         <h1>POSTS</h1>
      </div>
      <div class="col-md-6">
         <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Add Post
         </a>
      </div>
   </div> <!-- row -->
   <?php foreach($data['posts'] as $post) { ?>
   <div class="row">
      <div class="card card-body mb-3">
         <h4 class="card-title">
            <?php echo $post -> post_title; ?>
         </h4>
         <div class="bg-light p-2 mb-3">
            Written by <?php echo ucwords($post -> user_name); ?> on <?php echo $post -> post_created_at; ?>
         </div>
         <div class="card-text">
            <?php echo $post -> post_body; ?>
         </div>
         <div>
            <a style="width: 100px;" href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->post_id; ?>" class="btn btn-warning mt-5">Read More</a>
            <!-- <span style="color:red; margin-bottom:100px;" class="px-3"><i class="fa fa-heart fa-2x"></i></span> -->
            <a style="width: 100px;" href="" class="btn btn-dark mt-5 pull-right">Comment</a>
         </div>
      </div>
   
      <!-- <?php trace($data['posts']); ?> -->
   </div>
   <?php } ?>

<?php require APPROOT . '/views/inc/header.php'; ?>
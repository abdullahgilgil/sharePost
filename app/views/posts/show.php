<?php require APPROOT . '/views/inc/header.php'; ?>

   <a href="<?php echo URLROOT; ?>/posts/" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
   <br/>

   <h1><?php echo $data['post'] -> post_title; ?></h1>
   <div class="bg-secondary text-white p-2 mb-3">
      Written By <?php echo $data['user'] -> user_name; ?> on <?php echo $data['post'] -> post_created_at; ?>
   </div>
   <p><?php echo $data['post'] -> post_body; ?></p>

   <?php if($data['user'] -> user_id == $_SESSION['userID'])  : ?>
      <hr>
      <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post'] -> post_id; ?>" class="btn btn-dark">Edit</a>

      <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post'] -> post_id; ?>" method="POST">
         <input type="submit" value="Delete" class="btn btn-danger">
      </form>
   <?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
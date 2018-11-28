<?php require APPROOT . '/views/inc/header.php'; ?>
   <a href="<?php echo URLROOT; ?>/posts/" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
   <div class="card card-body bg-light mt-5">
      <h2 class="text-center">Add Post</h2>
      <p class="text-center">Create post with this form</p>
      <form action="<?php echo URLROOT; ?>/posts/add" method="POST">
         <div class="form-group">
            <label for="title">Title: <strong><sup>*</sup></strong></label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php if(isset($data['title'])) { echo $data['title']; } ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
         </div>
         <div class="form-group">
            <label for="body">Body: <strong><sup>*</sup></strong></label>
            <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php if(isset($data['body'])) {echo $data['body'];} ?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
         </div>
         <input type="submit" value="Submit" class="btn btn-success pull-right mt-3 btn-lg"/>
      </form>
   </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
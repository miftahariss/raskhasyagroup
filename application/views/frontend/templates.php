<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('frontend/head'); ?>
  </head>
  <body>
    <?php $this->load->view('frontend/tagline'); ?>
    
    <?php $this->load->view('frontend/navigation'); ?>

    <?php $this->load->view($mainpage); ?>
    
    <?php $this->load->view('frontend/footer'); ?>
  </body>
</html>
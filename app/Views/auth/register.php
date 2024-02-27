<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/login/fonts/icomoon/style.css">
    <link rel="stylesheet" href="/login/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/login/css/bootstrap.min.css">
    <link rel="stylesheet" href="/login/css/style.css">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" rel="stylesheet">
    <style>
      .custom-alert {
        padding: 15px;
        border-radius: 3px;
        margin-bottom: 1rem;
        font-size: 14px
      }
      .custom-alert-success {
        background: #5bc0de;
        color: #edf2f5;
      }
      .custom-alert-danger {
        background: #d9534f;
        color: #edf2f5;
      }
      .custom-btn-register {
          border: none;
          color: #fff;
          border-radius: 4px;
          padding: 10px 20px;
      }
    </style>
    <title>IT Blaster</title>
  </head>
  <body>
  <?php 
    function display_error($validation, $field) {
        if(isset($validation)) {
            if($validation->hasError($field)) {
                return $validation->getError($field);
            } else {
                return false;
            }
        }
    }
  ?>
  <div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="/" class="navbar-brand p-0">
        <img src="/login/images/logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars text-light"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="/#contactus" class="nav-item nav-link">Contact</a>
                <a href="/signin" class="nav-item nav-link">Login</a>
                <a href="/register" class="nav-item nav-link">Register</a>
            </div>
        </div>
    </nav>
  </div>
  <div class="content">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <img src="/login/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
      
        <div class="col-md-6 contents">
          <div class="row d-flex justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign Up</h3>
            </div>
            <div class="d-flex justify-content-center mb-3">
            <button class="custom-btn-register mx-2" id="it" style="outline: none; background: #192F64">IT Professionals</button>
            <button class="custom-btn-register mx-2" id="client" style="outline: none; background: #6c63ff">Client</button>
            </div>
            <?php $validation = \Config\Services::validation();?>
            <form action="<?php echo base_url(); ?>register" method="post" autocomplete="off" id="asIt">
            <p class="text-center">Join as IT Professional</p>
              <input type="hidden" name="registrationtype" value="1">
              <div class="form-group first">
                <label for="name">Name</label>
                <input type="text" name="user_name" value="<?= set_value('user_name') ?>" class="form-control" id="username">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'user_name');?></span>
              

              <div class="form-group first">
                <label for="contact">Contact Number</label>
                <input  type="number" name="user_contact" value="<?= set_value('user_contact');?>" class="form-control" id="username">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'user_contact');?></span>
              

              <div class="form-group first">
                <label for="username">Your Desire Rate/Hr in USD</label>
                <input type="number" name="user_rate" value="<?= set_value('user_rate') ?>" class="form-control" id="username" required>
              </div>
              

              <div class="form-group first">
                <label for="username">Email Address</label>
                <input type="text" name="user_email" value="<?= set_value('user_email') ?>" class="form-control" id="username">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'user_email');?></span>
              

              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" name="user_password" class="form-control" id="password">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'user_password');?></span>
              

              <div class="form-group last mb-4">
                <label for="password">Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" id="password">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'confirmpassword');?></span>
              

              <button style="background: #192F64; border:none" type="submit" class="btn btn-block btn-primary mt-5">Register</button>
            </form>

            <!-- As client -->

            <form action="<?php echo base_url(); ?>register" method="post" autocomplete="off" id="asClient" style="display:none">
            <p class="text-center">Join as Client</p>
              <div class="form-group first">
                <input type="hidden" name="registrationtype" value="2">
                <label for="name">Company</label>
                <input type="text" name="user_companyname" value="<?= set_value('user_companyname') ?>" class="form-control" id="username" required>
              </div>
              

              <div class="form-group first">
                <label for="contact">Name</label>
                <input  type="text" name="user_name" value="<?= set_value('user_name') ?>" class="form-control" id="username">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'user_name');?></span>
              

              <div class="form-group first">
                <label for="username">Position</label>
                <input type="text" name="user_position" value="<?= set_value('user_position') ?>" class="form-control" id="username" required>
              </div>
              

              <div class="form-group first">
                <label for="username">Contact</label>
                <input type="text" name="user_contact" value="<?= set_value('user_contact') ?>" class="form-control" id="username">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'user_contact');?></span>
              

              <div class="form-group first">
                <label for="username">Email Address</label>
                <input type="text" name="user_email" value="<?= set_value('user_email') ?>" class="form-control" id="username">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'user_email');?></span>
              

              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" name="user_password" class="form-control" id="password">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'user_password');?></span>
              

              <div class="form-group last mb-4">
                <label for="password">Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" id="password">
              </div>
              <span class="text-danger mb-2" style="font-size: 13px;"><?= display_error($validation, 'confirmpassword');?></span>
              

              <button style="background: #192F64; border:none" type="submit" class="btn btn-block btn-primary mt-5">Register</button>
            </form>
          
            </div>
          </div>
        
        </div>
        
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/login/js/jquery-3.3.1.min.js"></script>
  <script src="/login/js/popper.min.js"></script>
  <script src="/login/js/bootstrap.min.js"></script>
  <script src="/login/js/main.js"></script>
  <script>
    $(function(){
      $('#client').on('click', function(){
        $('#asIt').hide();
        $('#asClient').show();
      })

      $('#it').on('click', function(){
        $('#asIt').show();
        $('#asClient').hide();
      })
    })
  </script>
  </body>
</html>
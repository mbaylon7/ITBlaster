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
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Forgot Password</h3>
              <p class="text-muted" style="font-size:14px"> Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
            </div>
            <?php if(session()->getFlashdata('success')): ?>
              <div class="custom-alert custom-alert-success w3-animate-right" id="alert-auto">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?>
              <div class="custom-alert custom-alert-danger w3-animate-right" id="alert-auto">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form method="post" autocomplete="off">
              <div class="form-group first">
                <label for="username">Email Address</label>
                <input type="text" name="email" value="<?= set_value('email') ?>" class="form-control" id="username">
              </div>
              <?php $validation = \Config\Services::validation();?>
                <span class="text-danger" style="font-size: 13px;"><?= display_error($validation, 'email');?></span>
              <button style="background: #192F64; border:none" type="submit" class="btn btn-block btn-primary  mt-4">Submit</button>

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
  </body>
</html>
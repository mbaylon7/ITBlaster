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
    :root {
    --primary: #2124B1;
    --secondary: #4777F5;
    --light: #F7FAFF;
    --dark: #1D1D27;
    --theme: #010F30; /*#030B25; */
    }

    .navbar-light {
    background-color: var(--theme);
    }

    .navbar-light h1 {
        color: var(--light) !important;
    }

    .navbar-light .navbar-nav .nav-link {
        position: relative;
        margin-left: 25px;
        padding: 35px 0;
        color: var(--light) !important;
        outline: none;
        transition: .5s;
    }

    .sticky-top.navbar-light .navbar-nav .nav-link {
        padding: 20px 0;
        color: var(--light) !important;
    }

    .navbar-light .navbar-nav .nav-link:hover,
    .navbar-light .navbar-nav .nav-link.active {
        color: var(--secondary) !important;
    }

    .navbar-light .navbar-brand h1 {
        color: #FFFFFF;
    }

    .navbar-light .navbar-brand img {
        max-height: 60px;
        transition: .5s;
    }

    .sticky-top.navbar-light .navbar-brand img {
        max-height: 45px;
    }

    @media (max-width: 991.98px) {
        .sticky-top.navbar-light {
            position: relative;
            background: #FFFFFF;
        }

        .navbar-light .navbar-collapse {
            margin-top: 15px;
            border-top: 1px solid #DDDDDD;
        }

        .navbar-light .navbar-nav .nav-link,
        .sticky-top.navbar-light .navbar-nav .nav-link {
            padding: 10px 0;
            margin-left: 0;
            color: var(--light) !important;
        }

        .navbar-light .navbar-brand h1 {
            color: var(--primary);
        }

        .navbar-light .navbar-brand img {
            max-height: 45px;
        }
    }

    @media (min-width: 992px) {
        .navbar-light {
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            border-bottom: 1px solid rgba(256, 256, 256, .1);
            z-index: 999;
        }
        
        .sticky-top.navbar-light {
            position: fixed;
            background: var(--theme);
        }

        .navbar-light .navbar-nav .nav-link::before {
            position: absolute;
            content: "";
            width: 0;
            height: 2px;
            bottom: -1px;
            left: 50%;
            background: var(--secondary);
            transition: .5s;
        }

        .navbar-light .navbar-nav .nav-link:hover::before,
        .navbar-light .navbar-nav .nav-link.active::before {
            width: 100%;
            left: 0;
        }

        .navbar-light .navbar-nav .nav-link.nav-contact::before {
            display: none;
        }

        .sticky-top.navbar-light .navbar-brand h1 {
            color: var(--primary);
        }
    }
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
              <h3>Reset Password</h3>
              <p class="text-muted" style="font-size:14px">You can now create a new password of your account for better security please choose a strong password.</p>
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

            <?php $validation = \Config\Services::validation();?>
                <?php if(isset($error)): ?>
                    <div class="custom-alert custom-alert-danger w3-animate-right" id="alert-auto">
                        <?= $error; ?>
                    </div>
                <?php else: ?>
            <form method="post" autocomplete="off">
              <div class="form-group ">
                <label for="username">New Password</label>
                <input type="password" type="password" name="password" class="form-control" id="passsword">
              </div>
              <span class="text-danger" style="font-size: 13px;"><?= display_error($validation, 'password');?></span>

              <div class="form-group ">
                <label for="username">Confirm New Password</label>
                <input type="password" type="password" name="confirmpassword" class="form-control" id="passsword">
              </div>
              <span class="text-danger" style="font-size: 13px;"><?= display_error($validation, 'confirmpassword');?></span>
              <button style="background: #192F64; border:none" type="submit" class="btn btn-block btn-primary  mt-4">Change Password</button>
            </form>
            <?php endif; ?>
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
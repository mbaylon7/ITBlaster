<?= $this->extend('/templates/default') ?>

<?= $this->section('content') ?>
<style>
    .card {
        border-radius: 0 5px 5px 0 !important;
        border-left: 4px solid;
        border-left-style: solid;
    }
    .card-close{
        border-left-color: #54BF78;
    }
    .card-inprogress{
        border-left-color: #658FFC;
    }
    .black-image {
     filter: invert(100%);
    }
</style>
<div class="container-fluid bg-white p-0">

    <?= $this->include('/partials/index/spinner') ?>
    <!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
<nav id="myNavbar" class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0" style="background: transparent !important">
    <a href="/" class="navbar-brand p-0">
        <!--<h1 class="m-0">IT Blaster</h1>-->
        <img src="dist/img/IB png.png" alt="Logo" id="logo" class="black-image">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars text-light"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="/#contactus" class="nav-item nav-link" id="link1" style="color: #010f30 !important">Contact</a>
            <a href="/signin" class="nav-item nav-link" id="link2" style="color: #010f30 !important">Login</a>
            <a href="/register" class="nav-item nav-link" id="link3" style="color: #010f30 !important">Register</a>
        </div>
    </div>
</nav>

    <div class="container-fluid py-5  mb-5" style="background-image: url('dist/img/banner.webp'); background-size: cover; background-repeat:no-repeat">
        <div class="container my-5 py-5 px-lg-5">
            <div class="row g-5 py-5">
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="" style="color: #010F30;">MANAGE IT SERVICES</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navbar & Hero End -->

<!-- Service Start -->
<div class="container-fluid" style="min-height: 100vh">
    <div class="row mb-5">
        <div class="col-sm-12">
            <div class="d-flex justify-content-center">
                <input class="search-skill-input"  id="search-input" type="text" placeholder="What are you looking for ?" style="border:4px solid #D5DADA!important">
                <a href="#contactus" class="search-skill-btn d-flex justify-content-center align-items-center" type="button" style="background:#D5DADA!important">
                    <i id="search-icons" class="bi bi-search"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row g-4" id="search-div">  
        <?php if(!empty($projects)): foreach ($projects as $project):?>
        <div class="col-sm-6 col-md-4 mb-5">
            <a href="#" data-bs-toggle="modal" data-bs-target="#services-modal">
            <div class="card text-left card-close">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $project['project_name']?>
                    </h5>
                    <?php if(!empty($project['allot_skills'])):?>
                    <?php $allotSkills = $project['allot_skills'];
                        $skillsArray = explode(',', $allotSkills);
                        if(!empty($skillsArray)): foreach ($skillsArray as $skill):?>
                        <span class="alert-info p-1 text-black" style="margin-top: 20px"><?= $skill?></span>
                    <?php endforeach; endif; endif?>
                </div>
            </div>
            </a>
        </div>
        <?php endforeach; endif?>
    </div>
</div>
<script>
    window.addEventListener('scroll', function() {
        var navbar = document.getElementById('myNavbar');
        var link1 = document.getElementById('link1');
        var link2 = document.getElementById('link2');
        var link3 = document.getElementById('link3');
        var logo = document.getElementById('logo');
        if (window.pageYOffset > 50) {
            navbar.removeAttribute('style');
            link1.removeAttribute('style');
            link2.removeAttribute('style');
            link3.removeAttribute('style');
            logo.classList.remove('black-image');
        } else {
            navbar.setAttribute('style', 'background: transparent !important');
            link1.setAttribute('style', 'color: #010f30 !important');
            link2.setAttribute('style', 'color: #010f30 !important');
            link3.setAttribute('style', 'color: #010f30 !important');
            logo.classList.add('black-image');

        }
    });
</script>
    <!-- Service End -->
<?= $this->endsection() ?>
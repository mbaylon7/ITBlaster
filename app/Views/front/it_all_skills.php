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

    <div class="container-fluid py-5  mb-5" style="background-image: url('/dist/img/banner.webp'); background-size: cover; background-repeat:no-repeat">
        <div class="container my-5 py-5 px-lg-5">
            <div class="row g-5 py-5">
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="" style="color: #010F30;">WE GOT YOU COVERED</h1>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Navbar & Hero End -->

    <!-- Service Start -->
    <div class="container-xxl px-lg-5" style="height: 80vh">
        <div class="row mb-5">
            <div class="col-sm-12">
                <div class="d-flex justify-content-center">
                    <input class="search-skill-input"  id="search-input" type="text" placeholder="What are you looking for ?">
                    <a href="#contactus" class="search-skill-btn d-flex justify-content-center align-items-center" type="button">
                        <i id="search-icons" class="bi bi-search"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
        <?php if(!empty($skills)): foreach ($skills as $skill):?>
            <div class="col-sm-6 col-md-4 mb-5">
                <a href="#" data-bs-toggle="modal" data-bs-target="#services-modal" class="d-flex justify-content-between skill-container" id="generatedColor<?= $skill['skill_setid']?>">
                        <span class="skill-title"><?= $skill['skill_name']?></span>
                        <span class="skill-count" id="generatedBgColor<?= $skill['skill_setid']?>"><?= $skill['count']?></span>
                </a>
            </div>
            <script>
                function generateRandomColor() {
                    var r = Math.floor(Math.random() * 256);
                    var g = Math.floor(Math.random() * 256);
                    var b = Math.floor(Math.random() * 256);
                    var color = "rgb(" + r + "," + g + "," + b + ")";
                    return color;
                    }
                    // Example usage:
                    var myColor = generateRandomColor();
                    style="border: 3px solid #F21A1A"
                    $('#generatedColor<?= $skill['skill_setid']?>').css('border', '3px');
                    $('#generatedColor<?= $skill['skill_setid']?>').css('border', 'solid');
                    $('#generatedColor<?= $skill['skill_setid']?>').css('border-color', myColor);

                    $('#generatedBgColor<?= $skill['skill_setid']?>').css('background-color', myColor);
            </script>
        <?php endforeach; endif?>       
        </div>
    </div>

</div>   

    <div class="modal fade" id="services-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header border-0">
            <h5 class="modal-title" id="exampleModalLabel">HTML Skillset Manage IT Services</h5>
            <a type="button" class="border-0" data-bs-dismiss="modal" aria-label="Close"
                    style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle" style="font-size:22px!important"></i></a>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <a href="#">
                    <div class="card text-left card-close">
                        <div class="card-body">
                            <h5 class="card-title">
                                Allergen Management Software Development
                            </h5>
                            <p><small>Status: <span class="alert-info p-1 text-black">Close</span></small></p>
                            <small class="alert-info p-1 text-black">Html</small>
                            <small class="alert-info p-1 text-black">Css</small>
                            <small class="alert-info p-1 text-black">Bootstrap</small>
                            <small class="alert-info p-1 text-black">Javascript</small>
                            <small class="alert-info p-1 text-black">Ajax</small>
                            <small class="alert-info p-1 text-black">Jquery</small>
                            <small class="alert-info p-1 text-black">Native PHP</small>
                            <small class="alert-info p-1 text-black">MySQL</small>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-md-12 mb-5">
                    <a href="#">
                    <div class="card text-left card-inprogress">
                        <div class="card-body">
                            <h5 class="card-title">
                                Allergen Management Software Development
                            </h5>
                            <p><small>Status: <span class="alert-info p-1 text-black">Close</span></small></p>
                            <small class="alert-info p-1 text-black">Html</small>
                            <small class="alert-info p-1 text-black">Css</small>
                            <small class="alert-info p-1 text-black">Bootstrap</small>
                            <small class="alert-info p-1 text-black">Javascript</small>
                            <small class="alert-info p-1 text-black">Ajax</small>
                            <small class="alert-info p-1 text-black">Jquery</small>
                            <small class="alert-info p-1 text-black">Native PHP</small>
                            <small class="alert-info p-1 text-black">MySQL</small>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        </div>
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
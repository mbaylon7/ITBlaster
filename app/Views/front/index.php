<?= $this->extend('/templates/default') ?>

<?= $this->section('content') ?>
<div class="container-fluid bg-white p-0">

    <?= $this->include('/partials/index/spinner') ?>

    <?= $this->include('/partials/index/navbar_with_banner') ?>

    <!-- Service Start -->
    <div class="container-xxl py-5">
        
        <div class="container px-lg-5">
            <div class="position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h4 class="position-relative d-inline text-primary ps-4">WE GOT YOU COVERED</h6>
                <div class="div"></div>
            </div>
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
            <?php
                if(!empty($skills)): foreach ($skills as $skill):
            ?>
                <div class="col-sm-6 col-md-4 mb-5">
                    <a href="#contactus" class="d-flex justify-content-between skill-container" id="generatedColor<?= $skill['skill_setid']?>">
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
                
            <div class="d-flex justify-content-center"> <a href="/skills" style="color:gray !important">See more &nbsp; <i class="bi bi-arrow-right"></i></a></div>
            </div>
        </div>
    </div>
    <!-- Service End -->
<div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h4 class="position-relative d-inline text-primary ps-4">Managed IT Services</h6>
            </div>
            <div class="row g-4">
                <?php if(!empty($projects)): foreach($projects as $project):?>
                <div class="col-sm-6 col-md-6 mb-5">
                    <a href="#">
                        <div class="card text-left">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php $project_name = (empty($project['project_alias_name'])) ? $project['project_name']: $project['project_alias_name']; ?>
                                    <a href="#contactus"><?= $project_name?></a>
                                </h5>
                                <?php if(!empty($project['allot_skills'])):?>
                                <?php $allotSkills = $project['allot_skills'];
                                    $skillsArray = explode(',', $allotSkills);
                                    if(!empty($skillsArray)): foreach ($skillsArray as $skill):?>
                                    <small class="alert-info p-1 text-black"><?= $skill?></small>
                                <?php endforeach; endif; endif?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; endif?>    
            <div class="d-flex justify-content-center"> <a href="/services" style="color:gray !important">See more &nbsp; <i class="bi bi-arrow-right"></i></a></div>
            </div>
        </div>
    </div>
    <!-- Why Armane Start -->
    <div class="container-xxl py-5 d-none">
        <div class="container px-lg-5">
            <div class="position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h4 class="position-relative d-inline text-primary ps-4">Managed IT Services</h6>
            </div>
            <div class="row g-4">
                <?php if(!empty($projects)): foreach($projects as $project):?>
                <div class="col-sm-6 col-md-6 mb-5">
                    <a href="#">
                        <div class="card text-left">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="#contactus"><?= $project['project_name']?></a>
                                </h5>
                                <?php if(!empty($project['allot_skills'])):?>
                                <?php $allotSkills = $project['allot_skills'];
                                    $skillsArray = explode(',', $allotSkills);
                                    if(!empty($skillsArray)): foreach ($skillsArray as $skill):?>
                                    <small class="alert-info p-1 text-black"><?= $skill?></small>
                                <?php endforeach; endif; endif?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; endif?>    
            <div class="d-flex justify-content-center"> <a href="/services" style="color:gray !important">See more &nbsp; <i class="bi bi-arrow-right"></i></a></div>
            </div>
        </div>
    </div>
    <!-- Why Armane End -->

    <!-- Contact Us Start -->
    <div class="container-fluid wow fadeInUp" id="contactus" data-wow-delay="0.1s">
        <div class="container py-5 mb-5">
            <div class="position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h4 class="position-relative d-inline text-primary ps-4">CONTACT US</h6>
            </div>
            <?= form_open('contact/send', array('id' => 'contact_us_form')); ?>
                <div class="position-relative">
                    <div class="text-center mb-5"><h6>Learn More About IT Blaster’s Managed IT Services</h6></div>
                    <div class="row">
                        <div class="col-lg-7">
                        <?php
                            $session = \Config\Services::session();
                            $message = $session->getFlashdata('success_message');
                            if (!$message) {
                                $errors = isset($errors) && $errors !== null && $errors ? $errors : $session->getFlashdata();
                            }
                            ?>
                            <?php if(!empty($message) && $message !== null): ?>
                                <div class="alert alert-success" role="alert"><?=$message;?></div>
                            <?php endif; ?>
                            <?php if (isset($errors) && $errors !== null && $errors) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php if (is_array($errors)) : ?>
                                        <?php foreach ($errors as $key => $error) : ?>
                                            <?= $error ?><br/>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <?= $errors; ?>
                                    <?php endif ?>
                                </div>
                            <?php endif; ?>
                            <div class="mb-4">
                                <?php echo form_input(array(
                                    'type' => 'text',
                                    'name' => 'name',
                                    'class' => 'form-control w-100',
                                    'required' => true,
                                    'placeholder' => 'Name'
                                )); ?>
                            </div>
                            <div class="mb-4">
                                <?php echo form_input(array(
                                    'type' => 'text',
                                    'name' => 'phone_no',
                                    'class' => 'form-control w-100',
                                    'required' => true,
                                    'placeholder' => 'Phone No.'
                                )); ?>
                            </div>
                            <div class="mb-4">
                                <?php echo form_input(array(
                                    'type' => 'email',
                                    'name' => 'email_address',
                                    'class' => 'form-control w-100',
                                    'required' => true,
                                    'placeholder' => 'Email Address'
                                )); ?>
                            </div>
                            <div class="mb-3">
                                <?php echo form_textarea(array(
                                    'name' => 'message',
                                    'class' => 'form-control',
                                    'rows' => 3,
                                    'maxlength' => '500',
                                    'required' => true,
                                    'placeholder' => 'Message'
                                )); ?>
                            </div>

                            <div class="mb-3">
                               <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LchvBsmAAAAAGY3A-3iK8HkDl3WhzUFgCZPpY0u"></div>
                               </div>
                            </div>

                            <div class="align-content-start">
                                <?php echo form_button(array(
                                    'name' => 'send_message',
                                    'class' => 'btn btn-primary btn_send_message',
                                    'type' => 'submit',
                                    'content' => 'SEND'
                                )); ?>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div><h6>Professionally Managed By:</h6></div>
                                <div>IT Blaster Management Services</div>
                                <div>1-703-906-9719</div>
                                <div>
                                    <a href="mailto:services@consultareinc.com">services@consultareinc.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?= form_close(); ?>
            </script>
        </div>
    </div>

    <div class="container-fluid wow fadeInUp" id="contactus" data-wow-delay="0.1s"  style="background:#010F30!important;">
        <div class="container">
            <div class="position-relative text-centerwow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-center align-items-center my-3 gap-5">
                                <a href="https://consultareinc.com/shop/"><img class="img-fluid img-size" src="img/SOPKing.png" alt=""></a>
                                <a href="https://consultareinc.com/"><img class="img-fluid img-size" src="img/ccc.png" alt=""></a>
                                <a href="https://interlinkiq.com/"><img class="img-fluid img-size" src="img/iiq.png" alt=""></a>
                            </div>
                            <div class="d-flex justify-content-center align-items-center pb-3">
                                <span class="text-light">Copyright 2023 © Consultare Inc. Group. </span>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contact Us End -->
</div>
<?= $this->endsection() ?>
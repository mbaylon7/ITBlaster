<aside class="main-sidebar sidebar-no-expand sidebar-light-primary d-print-none" style="background: #192F64;">
    <div class="d-flex justify-content-center" style="height: 80px;">
      <img src="/dist/img/logo.png" class="brand-image mt-2" height="50" width="50">
    </div>
    <div class="sidebar text-sm" style="height: calc(93% - (12rem))!important">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-flat nav-child-indent nav-legacy nav-collapse-hide-child flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <?php $usertype = (session('usertype') == 1)? 'it' : 'client'; ?>
            <a href="<?= base_url().$usertype?>" class="nav-link" data-toggle="tooltip" title="Profile">
              <i class="nav-icon text-white bi-person-circle"></i>
              <p>
              </p>
            </a>
          </li>
            <!-- Task -->
            <?php if(session('usertype') != 1) :?>
            <li class="nav-item">
              <a href="<?= base_url()?>project" class="nav-link" data-toggle="tooltip" title="Projects">
                <i class="nav-icon text-white bi-lightbulb"></i>
              </a>
            </li>
            <?php else: ?>
              <li class="nav-item">
                <a href="<?= base_url()?>ticket" class="nav-link" data-toggle="tooltip" title="Project Postings">
                  <i class="nav-icon text-white bi-list-task"></i>
                </a>
              </li>
            <?php endif ?>

            <!-- <li class="nav-item">
              <a href="<?= base_url()?>it/ticket/" class="nav-link" data-toggle="tooltip" title="Managed">
              <i class="nav-icon text-white bi-clipboard-pulse"></i>
              </a>
            </li> -->

            <!-- Chart -->
            <li class="nav-item">
              <a href="#" class="nav-link" data-toggle="tooltip" title="Report">
                <i class="nav-icon text-white bi-bar-chart"></i>
              </a>
            </li>
           <!-- Logs -->
           <li class="nav-item">
           <!-- <?= base_url()?>system -->
            <a href="#" class="nav-link" data-toggle="tooltip" title="Logs">
              <i class="nav-icon text-white bi-activity"></i>
            </a>
          </li>
         
          <div class="space"></div>
        </ul>
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <div class="d-flex flex-column bd-highlight mb-3 h-100">
        <div class="d-flex justify-content-center mt-4"><a href="/logout" data-toggle="tooltip" title="Logout"><i class="nav-icon text-white-50 fas fa-power-off h4 text-red"></i></a></div>
        <div class="d-flex justify-content-center mt-2 mb-2"><a href="#" data-toggle="tooltip" title="Settings"><i class="nav-icon text-white text-light bi-sliders h4"></i></a></div>
        <div class="d-flex justify-content-center mt-2 mb-2">
            <div class="rounded d-flex align-items-center bg-light text-light justify-content-center" style="width:40px;height:40px;">
                <?php 
                if(session('usertype') == 2) {
                    if(!empty($avatar)) {
                      echo '<img src="/uploads/files/'.$name.'/'.$avatar.'?>" width="46" heigth="46" class="rounded">';
                    } else {
                      echo '<span style="font-size: 20px; font-weight: bold;">'.substr($name ,0,1).'</span>';
                    }
                } else {
                    if(!empty($avatar)) {
                      echo '<img src="/uploads/files/'.$name.'/'.$avatar.'" width="46" heigth="46" class="rounded">';
                    } else {
                      echo '<span style="font-size: 20px; font-weight: bold;">'.substr($name ,0,1).'</span>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="status-indicator bg-warning" style="width: 15px;height: 15px;padding: 0px 0px;border: 2px solid #192F64;border-radius: 15px;font-size: 12px;line-height: 1.42857;margin-top: -18px;margin-left: 48px;"></div>
    </div>
  </aside>
  <div class="content-wrapper">
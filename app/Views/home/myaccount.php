   <!-- content @s -->
   <?= $this->extend('1layouts/main') ?>

   <?= $this->section('cp') ?>


   <div class="nk-content-body">
       <div class="nk-block">
           <div class="card card-bordered">
               <div class="card-aside-wrap">
                   <div class="card-inner card-inner-lg">
                       <div class="nk-block-head nk-block-head-lg">
                           <div class="nk-block-between">
                               <div class="nk-block-head-content">
                                   <h4 class="nk-block-title">Personal Information</h4>
                                   <div class="nk-block-des">
                                       <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                                   </div>
                               </div>
                               <div class="nk-block-head-content align-self-start d-lg-none">
                                   <a href="" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                               </div>
                           </div>
                       </div><!-- .nk-block-head -->
                       <div class="nk-block">
                           <div class="nk-data data-list">
                               <div class="data-head">
                                   <h6 class="overline-title">Basics</h6>
                               </div>
                               <div class="data-item" data-bs-toggle="modal" data-target="#profile-edit">
                                   <div class="data-col">
                                       <span class="data-label">Full Name</span>
                                       <span class="data-value"><?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['oname']; ?></span>
                                   </div>
                                   <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                               </div><!-- data-item -->
                               <div class="data-item" data-bs-toggle="modal" data-target="#profile-edit">
                                   <div class="data-col">
                                       <span class="data-label">Display Name</span>
                                       <span class="data-value"><?php echo $_SESSION['fname']; ?></span>
                                   </div>
                                   <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                               </div><!-- data-item -->
                               <div class="data-item">
                                   <div class="data-col">
                                       <span class="data-label">Email</span>
                                       <span class="data-value"><?php echo $_SESSION['userEmail']; ?></span>
                                   </div>
                                   <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                               </div><!-- data-item -->
                               <div class="data-item" data-bs-toggle="modal" data-target="#profile-edit">
                                   <div class="data-col">
                                       <span class="data-label">Phone Number</span>
                                       <span class="data-value text-soft"><?php echo $_SESSION['pnumber']; ?></span>
                                   </div>
                                   <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                               </div><!-- data-item -->
                               <div class="data-item" data-bs-toggle="modal" data-target="#profile-edit">
                                   <div class="data-col">
                                       <span class="data-label">Date of Birth</span>
                                       <span class="data-value">00 Jan, 2000</span>
                                   </div>
                                   <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                               </div><!-- data-item -->
                               <div class="data-item" data-bs-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                   <div class="data-col">
                                       <span class="data-label">Address</span>
                                       <span class="data-value">Kangaru,<br>Embu, Kenya</span>
                                   </div>
                                   <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                               </div><!-- data-item -->
                           </div><!-- data-list -->
                           <div class="nk-data data-list">
                               <div class="data-head">
                                   <h6 class="overline-title">Preferences</h6>
                               </div>
                               <div class="data-item">
                                   <div class="data-col">
                                       <span class="data-label">Language</span>
                                       <span class="data-value">English (United State)</span>
                                   </div>
                                   <div class="data-col data-col-end"><a href="#" data-bs-toggle="modal" data-target="#profile-language" class="link link-primary">Change Language</a></div>
                               </div><!-- data-item -->
                               <div class="data-item">
                                   <div class="data-col">
                                       <span class="data-label">Date Format</span>
                                       <span class="data-value">M d, YYYY</span>
                                   </div>
                                   <div class="data-col data-col-end"><a href="#" data-bs-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                               </div><!-- data-item -->
                               <div class="data-item">
                                   <div class="data-col">
                                       <span class="data-label">Timezone</span>
                                       <span class="data-value">Nairobi (GMT +3)</span>
                                   </div>
                                   <div class="data-col data-col-end"><a href="#" data-bs-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                               </div><!-- data-item -->
                           </div><!-- data-list -->
                       </div><!-- .nk-block -->
                   </div>

                   <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                       <div class="card-inner-group" data-simplebar>
                           <div class="card-inner">
                               <div class="user-card">
                                   <div class="user-avatar bg-primary">
                                       <span><?php echo  substr($_SESSION['fname'], 0, 1); ?><?php echo  substr($_SESSION['oname'], 0, 1); ?></span>
                                   </div>
                                   <div class="user-info">
                                       <span class="lead-text"><?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['oname']; ?></span>
                                       <span class="sub-text"><?php echo $_SESSION['userEmail']; ?></span>
                                   </div>
                                   <div class="user-action">
                                       <div class="dropdown">
                                           <a class="btn btn-icon btn-trigger mr-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                                           <div class="dropdown-menu dropdown-menu-right">
                                               <ul class="link-list-opt no-bdr">
                                                   <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                                                   <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                                               </ul>
                                           </div>
                                       </div>
                                   </div>
                               </div><!-- .user-card -->
                           </div><!-- .card-inner -->
                           <div class="card-inner">
                               <div class="user-account-info py-0">
                                   <h6 class="overline-title-alt">Sales Account</h6>
                                   <div class="user-balance"><small class="currency currency-btc">Ksh</small> 12,395,769 </div>
                                   <div class="user-balance-sub">Today <span class="currency currency-btc">Ksh</span> <span>0.344939 </span></div>
                               </div>
                           </div><!-- .card-inner -->
                           <div class="card-inner p-0">
                               <ul class="link-list-menu">
                                   <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                                   <li><a href="html/user-profile-notification.html"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li>
                                   <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                                   <li><a href="html/user-profile-setting.html"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                                   <li><a href="html/user-profile-social.html"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li>
                               </ul>
                           </div><!-- .card-inner -->
                       </div><!-- .card-inner-group -->
                   </div><!-- card-aside -->
               </div><!-- .card-aside-wrap -->
           </div><!-- .card -->
       </div><!-- .nk-block -->
   </div>

   <!-- content @e -->


   <!-- content ends here -->

   <?= $this->endSection('cp') ?>
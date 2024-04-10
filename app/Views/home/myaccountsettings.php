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
                                   <h4 class="nk-block-title">Security Settings</h4>
                                   <div class="nk-block-des">
                                       <p>These settings are helps you keep your account secure.</p>
                                   </div>
                               </div>
                               <div class="nk-block-head-content align-self-start d-lg-none">
                                   <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                               </div>
                           </div>
                       </div><!-- .nk-block-head -->
                       <div class="nk-block">
                           <div class="card card-bordered">
                               <div class="card-inner-group">
                                   <div class="card-inner">
                                       <div class="between-center flex-wrap flex-md-nowrap g-3">
                                           <div class="nk-block-text">
                                               <h6>Save my Activity Logs</h6>
                                               <p>You can save your all activity logs including unusual activity detected.</p>
                                           </div>
                                           <div class="nk-block-actions">
                                               <ul class="align-center gx-3">
                                                   <li class="order-md-last">
                                                       <div class="custom-control custom-switch mr-n2">
                                                           <input type="checkbox" class="custom-control-input" checked="" id="activity-log">
                                                           <label class="custom-control-label" for="activity-log"></label>
                                                       </div>
                                                   </li>
                                               </ul>
                                           </div>
                                       </div>
                                   </div><!-- .card-inner -->
                                   <div class="card-inner">
                                       <div class="between-center flex-wrap g-3">
                                           <div class="nk-block-text">
                                               <h6>Change Password</h6>
                                               <p>Set a unique password to protect your account.</p>
                                           </div>
                                           <div class="nk-block-actions flex-shrink-sm-0">
                                               <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                   <li class="order-md-last">
                                                       <a href="#" class="btn btn-primary">Change Password</a>
                                                   </li>
                                                   <li>
                                                       <em class="text-soft text-date fs-12px">Last changed: <span>Oct 2, 2019</span></em>
                                                   </li>
                                               </ul>
                                           </div>
                                       </div>
                                   </div><!-- .card-inner -->
                                   <div class="card-inner">
                                       <div class="between-center flex-wrap flex-md-nowrap g-3">
                                           <div class="nk-block-text">
                                               <h6>2 Factor Auth &nbsp; <span class="badge badge-success ml-0">Enabled</span></h6>
                                               <p>Secure your account with 2FA security. When it is activated you will need to enter not only your password, but also a special code using app. You can receive this code by in mobile app. </p>
                                           </div>
                                           <div class="nk-block-actions">
                                               <a href="#" class="btn btn-primary">Disable</a>
                                           </div>
                                       </div>
                                   </div><!-- .card-inner -->
                               </div><!-- .card-inner-group -->
                           </div><!-- .card -->
                       </div><!-- .nk-block -->
                   </div><!-- .card-inner -->

                   <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
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
   </div> <!-- content @e -->

   <!-- content ends here -->

   <?= $this->endSection('cp') ?>
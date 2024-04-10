   <!-- content @s -->
   <?= $this->extend('1layouts/main') ?>

   <?= $this->section('cp') ?>


   <div class="nk-content-body">
       <div class="nk-block">
           <div class="card card-bordered">
               <div class="card-aside-wrap">
                   <div class="card-inner card-inner-lg">
                       <div class="nk-block">
                           <div class="nk-block-head">
                               <div class="nk-block-head-content">
                                   <h5 class="nk-block-title">Connected with Social Account</h5>
                                   <div class="nk-block-des">
                                       <p>You can connect with your social account such as facebook, google etc to make easier to login into account.</p>
                                   </div>
                               </div>
                           </div><!-- .nk-block-head -->
                           <h6 class="lead-text">Connect to Facebook</h6>
                           <div class="card card-bordered">
                               <div class="card-inner">
                                   <div class="between-center flex-wrap flex-md-nowrap g-3">
                                       <div class="media media-center gx-3 wide-xs">
                                           <div class="media-object">
                                               <em class="icon icon-circle icon-circle-lg ni ni-facebook-f"></em>
                                           </div>
                                           <div class="media-content">
                                               <p>You have successfully connected with your facebook account, you can easily log in using your account too.</p>
                                           </div>
                                       </div>
                                       <div class="nk-block-actions flex-shrink-0">
                                           <a href="#" class="btn btn-lg btn-danger">Revoke Access</a>
                                       </div>
                                   </div>
                               </div><!-- .nk-card-inner -->
                           </div><!-- .nk-card -->
                           <h6 class="lead-text">Connect to Google</h6>
                           <div class="card card-bordered">
                               <div class="card-inner">
                                   <div class="between-center flex-wrap flex-md-nowrap g-3">
                                       <div class="media media-center gx-3 wide-xs">
                                           <div class="media-object">
                                               <em class="icon icon-circle icon-circle-lg ni ni-google"></em>
                                           </div>
                                           <div class="media-content">
                                               <p>You can connect with your google account. <em class="d-block text-soft">Not connected yet</em></p>
                                           </div>
                                       </div>
                                       <div class="nk-block-actions flex-shrink-0">
                                           <a href="#" class="btn btn-lg btn-dim btn-primary">Connect</a>
                                       </div>
                                   </div>
                               </div><!-- .nk-card-inner -->
                           </div><!-- .nk-card -->
                           <div class="nk-block-head nk-block-head-sm">
                               <div class="nk-block-head-content">
                                   <h6 class="nk-block-title">Import Contacts <a href="#" class="link link-primary ml-auto">Import from Google</a></h6>
                                   <div class="nk-block-des">
                                       <p>You have not imported contacts from your mobile phone.</p>
                                   </div>
                               </div>
                           </div><!-- .nk-block-head -->
                       </div>
                   </div>

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
   </div>

   <!-- content @e -->


   <!-- content ends here -->

   <?= $this->endSection('cp') ?>
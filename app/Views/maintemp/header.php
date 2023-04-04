<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="<?php echo base_url()?>">
    <meta charset="utf-8">
    <meta name="author" content="Camera20 POS">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An online point of sale system designed and developed by Camera20 Production that enables businesses to manage stock, expenses, and generate reports. The system includes M-Pesa integration, allowing for secure and convenient mobile payments in addition to traditional payment methods.">
    <meta name="author" content="Camera20 Production">
    <meta name="version" content="1.0.0">
    <meta name="releaseDate" content="01/04/2023">
    <meta name="keywords" content="point of sale, online, inventory, expenses, reports, M-Pesa, payments, user management, security">
    <meta name="robots" content="index,follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo base_url()?>files/images/favicon.png">
    <!-- Page Title  -->
    <title>Login | Camera20 POS</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?php echo base_url()?>files/assets/css/dashlite.css?ver=2.9.1">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url()?>files/assets/css/theme.css?ver=2.9.1">

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
</head>

<body class="nk-body bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-brand">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img" src="<?php echo base_url()?>/files/images/logo.png" srcset="<?php echo base_url()?>/files/images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="<?php echo base_url()?>/files/images/logo-dark.png" srcset="<?php echo base_url()?>/files/images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div><!-- .nk-header-brand -->
                        <div class="nk-header-menu ml-auto" data-content="headerNav">
                            <div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a href="html/index.html" class="logo-link">
                                        <img class="logo-light logo-img" src="<?php echo base_url()?>/files/images/logo.png" srcset="<?php echo base_url()?>/files/images/logo2x.png 2x" alt="logo">
                                        <img class="logo-dark logo-img" src="<?php echo base_url()?>/files/images/logo-dark.png" srcset="<?php echo base_url()?>/files/images/logo-dark2x.png 2x" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-menu-trigger mr-n2">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                </div>
                            </div>
                            <ul class="nk-menu nk-menu-main ui-s2">
                                <li class="nk-menu-item has-sub">
                                    <a href="html/index.html" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Dashboards</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="html/index.html" class="nk-menu-link">
                                                <span class="nk-menu-text">Default Dashboard</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->
                                        
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Sales</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="html/sales-new.html" class="nk-menu-link"><span class="nk-menu-text">New Sale</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="/html/sales-list.html" class="nk-menu-link"><span class="nk-menu-text">Sales</span></a>
                                        </li>
                                        
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Expenses</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                       
                                       
                                        <li class="nk-menu-item">
                                            <a href="/html/expense-list.html" class="nk-menu-link">
                                                <span class="nk-menu-text">View Expense</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->
                                       
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Stock</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        
                                        
                                        <li class="nk-menu-item">
                                            <a href="/html/product-list.html" class="nk-menu-link"><span class="nk-menu-text">View Stock</span></a>
                                        </li>
                                        
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">User</span>
                                    </a>
                                    <ul class="nk-menu-sub">                                
                                    
                                        <li class="nk-menu-item">
                                            <a href="html/user-list-regular.html" class="nk-menu-link">
                                                <span class="nk-menu-text">View Users</span>
                                            </a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-header-menu -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                
                        
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span><?php  echo  substr($_SESSION['fname'],0,1); ?><?php  echo  substr($_SESSION['oname'],0,1); ?></span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['oname']; ?></span>
                                                    <span class="sub-text"><?php echo $_SESSION['userEmail']; ?></span>
                                                </div>
                                                <div class="user-action">
                                                    <a class="btn btn-icon mr-n2" href="html/user-profile-setting.html"><em class="icon ni ni-setting"></em></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner user-account-info">
                                            <h6 class="overline-title-alt">Your Account</h6>
                                            <div class="user-balance">Sales <small class="currency currency-usd">Ksh 1,000</small></div>
                                            <div class="user-balance-sub">Expenses <span>Ksh 1,000 <span class="currency currency-usd"></span></span></div>
                                            <a href="" class="link"><span>View Total Sales</span> <em class="icon ni ni-wallet-out"></em></a>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                <li><a class="dark-mode-switch" href=""><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="html/user-session-close.html"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .dropdown -->
                            </ul><!-- .nk-quick-nav -->
                        </div><!-- .nk-header-tools -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="<?php echo base_url()?>/files/images/logo.png" srcset="<?php echo base_url()?>/files/images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="<?php echo base_url()?>/files/images/logo-dark.png" srcset="<?php echo base_url()?>/files/images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>
                                        <div class="nk-block-des">
                                            <p>To access use your email and passcode.</p>
                                        </div>
                                    </div>
                                </div>
                                <form id="frmLogin"  name="frmLogin" action="html/user-access-login.html" method="post">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email or National ID</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="txtEmail" name="txtEmail" placeholder="Enter your email address or username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Passcode</label>
                                            <a class="link link-primary link-sm" data-toggle="modal" data-target="#exampleModal">Forgot Code?</a>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="txtPassword" name="txtPassword" placeholder="Enter your passcode">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="">Create an account</a>
                                </div>
                                <div class="text-center pt-4 pb-3">
                                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                                </div>
                                <ul class="nav justify-center gx-4">
                                    <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
 


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Reset password</h5>
                                        <div class="nk-block-des">
                                            <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="/html/pages/auths/auth-request-password-reset-v2.html" action="post" name="requestReset" id="requestReset">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email or ID Number</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" name="txtEmail" id="txtEmail" placeholder="Enter your email address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Send Reset Link</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4">
                                    <a href="html/pages/auths/auth-login-v2.html"><strong>Return to login</strong></a>
                                </div>
                            </div>
                        </div>
    </div>
  </div>
</div>

<script>
    $('#requestReset').validate({
        rules:{
            txtEmail: "required",
            
        },
        messages:{
            txtEmail: "Please enter your Email",
            
        },
        submitHandler: function(form){
            var form_action = $("#requestReset").attr("action");
                    $.ajax({
                        data: $('#requestReset').serialize(),
                        url: form_action,
                        type: 'POST',
                        dataType: 'json',
                        beforeSend:function(){Swal.fire({icon: 'info',title: 'Loading...',showConfirmButton: false,timer: 1500})},
                        success: function (res) {
                            
                            var $status =  + JSON.stringify(res.status);
                            var $sts = 'false';
                            if ($status < 1){
                                Swal.fire({
                                icon:'error',
                                title: 'Ooops...',
                                text: JSON.stringify(res.data.message)
                                })
                            }else{
                                Swal.fire({
                                icon:'success',
                                title: 'Success',
                                text: JSON.stringify(res.data.message)
                                }).then(()=>{
                                    window.location.href = "html/pages/auths/auth-login-v2.html";
                                });
                            }
                            $('#loading').modal('hide');

                        },
                        error: function (data) {
                            
                            Swal.fire({
                                icon:'error',
                                title: 'Ooops...',
                                text: "An error: "+JSON.stringify(data.responseText)+" has occured"
                            })
                        }
            });
        }
    });
</script>


<script>
    $('#frmLogin').validate({
        rules:{
            txtEmail: "required",
            txtPassword: "required",
        },
        messages:{
            txtEmail: "Please enter your Email",
            txtPassword: "Please enter your password",
        },
        submitHandler: function(form){
            var form_action = $("#frmLogin").attr("action");
                    $.ajax({
                        data: $('#frmLogin').serialize(),
                        url: form_action,
                        type: 'POST',
                        dataType: 'json',
                        beforeSend:function(){Swal.fire({icon: 'info',title: 'Loading...',showConfirmButton: false,timer: 2500})},
                        success: function (res) {
                            
                            var $status =  + JSON.stringify(res.status);
                            var $sts = 'false';
                            if ($status < 1){
                                Swal.fire({
                                icon:'error',
                                title: 'Ooops...',
                                text: JSON.stringify(res.data.message)
                                })
                            }else{
                                Swal.fire({
                                icon:'success',
                                title: 'Success',
                                text: JSON.stringify(res.data.message)
                                }).then(()=>{
                                    window.location.href = "html/index.html";
                                });
                            }
                            $('#loading').modal('hide');

                        },
                        error: function (data) {
                            
                            Swal.fire({
                                icon:'error',
                                title: 'Ooops...',
                                text: "An error: "+JSON.stringify(data.responseText)+" has occured"
                            })
                        }
            });
        }
    });
</script>
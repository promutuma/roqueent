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
                                        <h5 class="nk-block-title">Reset password</h5>
                                        <div class="nk-block-des">
                                            <p>Set your new password here.</p>
                                        </div>
                                    </div>
                                </div>
                                <form id="setPass" name="setPass" action="html/pages/auths/user-update-password-v2.html" method="post">
                                <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">User ID</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="txtResetcode" name="txtResetcode" value=<?php echo $userId;?> readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control form-control-lg" id="txtPassword" name="txtPassword" placeholder="Enter your new password here">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Retype Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control form-control-lg" id="txtPassword1" name="txtPassword1" placeholder="Enter your new password here">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Set Password</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4">
                                    <a href="html/pages/auths/auth-login-v2.html"><strong>Return to login</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>

<script>
    $('#setPass').validate({
        rules:{
            txtPassword:{
                required: true,
                minlength: 7,
            },
            txtPassword1:{
                equalTo: '#txtPassword',
            }
        },
        messages:{
            txtPassword:{
                required: "Please Enter new Password",
                minlength:  jQuery.validator.format("Enter at least {0} characters"),
            },
            txtPassword1:{
                equalTo: "Enter the same password as above",
            }
        },
        submitHandler: function(form){
            var form_action = $("#setPass").attr("action");
                    $.ajax({
                        data: $('#setPass').serialize(),
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
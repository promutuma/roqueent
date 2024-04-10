<!-- content @s -->
<?= $this->extend('1layouts/main_auth') ?>

<?= $this->section('cp') ?>




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
                    <label class="form-label" for="txtResetcode">User ID</label>
                </div>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" id="txtResetcode" name="txtResetcode" value=<?php echo $userId; ?> readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="txtPassword">Password</label>
                </div>
                <div class="form-control-wrap">
                    <input type="password" class="form-control form-control-lg" id="txtPassword" name="txtPassword" placeholder="Enter your new password here">
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="txtPassword1">Retype Password</label>
                </div>
                <div class="form-control-wrap">
                    <input type="password" class="form-control form-control-lg" id="txtPassword1" name="txtPassword1" placeholder="Enter your new password here">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block">
                    <span class="submitText">Set Password</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <span class="loadingText d-none">Loading...</span>
                </button>
            </div>
        </form>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var submitButton = $("#setPass button[type='submit']");
                $('#setPass').validate({
                    rules: {
                        txtPassword: {
                            required: true,
                            minlength: 7,
                        },
                        txtPassword1: {
                            equalTo: '#txtPassword',
                        }
                    },
                    messages: {
                        txtPassword: {
                            required: "Please Enter new Password",
                            minlength: jQuery.validator.format("Enter at least {0} characters"),
                        },
                        txtPassword1: {
                            equalTo: "Enter the same password as above",
                        }
                    },
                    submitHandler: function(form) {
                        var form_action = $("#setPass").attr("action");

                        submitButton.find(".spinner-border").removeClass("d-none");
                        submitButton.find(".submitText").addClass("d-none");
                        submitButton.find(".loadingText").removeClass("d-none");
                        submitButton.prop("disabled", true);

                        $.ajax({
                            data: $('#setPass').serialize(),
                            url: form_action,
                            type: 'POST',
                            dataType: 'json',
                            beforeSend: function() {
                                NioApp.Toast("Setting the new password", 'info', {
                                    position: 'top-right',
                                    icon: 'auto',
                                    ui: 'is-dark'
                                });
                            },
                            success: function(res) {

                                var $status = +res.status;
                                var $sts = 'false';
                                if ($status < 1) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ooops...',
                                        text: res.message
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: res.message
                                    }).then(() => {
                                        window.location.href = "html/pages/auths/auth-login-v2.html";
                                    });
                                }
                                $('#loading').modal('hide');

                            },
                            error: function(data) {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ooops...',
                                    text: "An error: " + JSON.stringify(data.responseText) + " has occured"
                                })
                            },
                            complete: function(r) {
                                if (r.responseJSON && r.responseJSON.data && r.responseJSON.tn) {
                                    updateToken(r.responseJSON.data.tn);
                                } else {
                                    console.error('Invalid response format or missing CSRF token');
                                    NioApp.Toast("<h5> Error: Invalid Server Response </h5> PLease reflesh the page and try again", 'error', {
                                        position: 'top-right',
                                        icon: 'auto',
                                        ui: 'is-dark'
                                    });
                                }
                                // Hide loading spinner and enable submit button
                                submitButton.find(".spinner-border").addClass('d-none');
                                submitButton.find(".submitText").removeClass('d-none');
                                submitButton.find(".loadingText").addClass('d-none');
                                submitButton.prop("disabled", false);
                            }
                        });
                    }
                });
            });
        </script>

        <div class="form-note-s2 text-center pt-4">
            <a href="html/pages/auths/auth-login-v2.html"><strong>Return to login</strong></a>
        </div>
    </div>
</div>

<!-- content ends here -->
<?= $this->endSection('cp') ?>
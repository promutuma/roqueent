<!-- content @s -->
<?= $this->extend('1layouts/main_auth') ?>

<?= $this->section('cp') ?>




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
        <form id="frmLogin" name="frmLogin" action="html/user-access-login.html" method="post">
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="txtEmailinput">Email or National ID</label>
                </div>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" id="txtEmailinput" name="txtEmailinput" placeholder="Enter your email address or username" required>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="txtPassword">Passcode</label>
                    <a class="link link-primary link-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Forgot Code?</a>
                </div>
                <div class="form-control-wrap">
                    <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="txtPassword">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg" id="txtPassword" name="txtPassword" placeholder="Enter your passcode" required>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">
                    <span class="submitText">Sign in</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <span class="loadingText d-none">Loading...</span>
                </button>
            </div>
        </form>



        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var submitButton = $("#frmLogin button[type='submit']");
                $('#frmLogin').validate({
                    rules: {
                        txtEmailinput: "required",
                        txtPassword: "required",
                    },
                    messages: {
                        txtEmailinput: "Please enter your Email or ID number",
                        txtPassword: "Please enter your password",
                    },
                    submitHandler: function(form) {
                        var form_action = $("#frmLogin").attr("action");

                        submitButton.find(".spinner-border").removeClass("d-none");
                        submitButton.find(".submitText").addClass("d-none");
                        submitButton.find(".loadingText").removeClass("d-none");
                        submitButton.prop("disabled", true);


                        $.ajax({
                            data: $('#frmLogin').serialize(),
                            url: form_action,
                            type: 'POST',
                            dataType: 'json',
                            beforeSend: function() {
                                NioApp.Toast("Checking your credentials", 'info', {
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
                                        window.location.href = "html/index.html";
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

<!-- Load Modals -->
<?= $this->include('auth/auth_modals') ?>
<!-- End Load Modals -->


<!-- content ends here -->
<?= $this->endSection('cp') ?>
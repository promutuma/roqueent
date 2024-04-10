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
                                <label class="form-label" for="txtEmail">Email or ID Number</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg" name="txtEmail" id="txtEmailinput" placeholder="Enter your email address">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                <span class="submitText">Send Reset Link</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                <span class="loadingText d-none">Loading...</span>
                            </button>
                        </div>
                    </form>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var submitButton = $("#requestReset button[type='submit']");
                            $('#requestReset').validate({
                                rules: {
                                    txtEmail: "required",

                                },
                                messages: {
                                    txtEmail: "Please enter your Email",

                                },
                                submitHandler: function(form) {
                                    var form_action = $("#requestReset").attr("action");

                                    submitButton.find(".spinner-border").removeClass("d-none");
                                    submitButton.find(".submitText").addClass("d-none");
                                    submitButton.find(".loadingText").removeClass("d-none");
                                    submitButton.prop("disabled", true);


                                    $.ajax({
                                        data: $('#requestReset').serialize(),
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
        </div>
    </div>
</div>
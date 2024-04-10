<!-- modal to add users -->
<div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>

    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">New User</h5>
            <div class="nk-block-des">
                <p>Add information and add new User.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <form class="form-validate" id="addUser" name="addUser" method="post" action="/html/user-add-user.html">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="txtFname">First Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtFname" name="txtFname" placeholder="Franklin">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="txtOname">Other Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtOname" name="txtOname" placeholder="Mutuma">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="txtEmail">Email</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="info@camera20production.co.ke">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="txtID">Id Number</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtID" name="txtID" placeholder="12345678">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label" for="txtUT">User Type</label>
                    <div class="form-control-wrap">
                        <select class="form-select js-select2" data-search="on" name="txtUT" id="txtUT" data-placeholder="Select user type..." required>
                            <option label="empty"></option>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="txtPN">Phone Number</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtPN" name="txtPN" placeholder="0796096678">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="upload-zone small bg-lighter my-2">
                        <div class="dz-message">
                            <span class="dz-message-text">Profile Photo </span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            <span class="submitText">
                                <em class="icon ni ni-plus"></em>
                                <span>Add New</span>
                            </span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span class="loadingText d-none">Loading...</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var submitButton = $("#addUser button[type='submit']");
                $('#addUser').validate({
                    rules: {
                        txtFname: "required",
                        txtOname: "required",
                        txtEmail: "required",
                        txtID: "required",
                        txtUT: "required",
                        txtPN: "required",
                    },
                    messages: {
                        txtFname: "First name is required",
                        txtOname: "Other name is required",
                        txtEmail: "Email is required",
                        txtID: "User national ID isrequired",
                        txtPN: "User phone number is required",
                    },
                    submitHandler: function(form) {
                        var form_action = $("#addUser").attr("action");

                        submitButton.find(".spinner-border").removeClass("d-none");
                        submitButton.find(".submitText").addClass("d-none");
                        submitButton.find(".loadingText").removeClass("d-none");
                        submitButton.prop("disabled", true);


                        $.ajax({
                            data: $('#addUser').serialize(),
                            url: form_action,
                            type: 'POST',
                            dataType: 'json',
                            beforeSend: function() {
                                NioApp.Toast("Adding New User", 'info', {
                                    position: 'top-right',
                                    icon: 'auto',
                                    ui: 'is-dark'
                                });
                            },
                            success: function(res) {

                                var $status = +JSON.stringify(res.status);
                                var $sts = 'false';
                                if ($status < 1) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ooops...',
                                        text: JSON.stringify(res.message)
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: JSON.stringify(res.message)
                                    }).then(() => {
                                        window.location.href = "/html/user-list-regular.html";
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
                                if (r.responseJSON && r.responseJSON.data && r.responseJSON.data.tn) {
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

    </div>
</div>
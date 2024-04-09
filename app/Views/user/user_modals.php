<!-- modal to add users -->
<div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
    <form id="addUser" name="addUser" method="post" action="/html/user-add-user.html">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">New User</h5>
                <div class="nk-block-des">
                    <p>Add information and add new User.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">

            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="product-title">First Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtFname" name="txtFname" placeholder="Franklin">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="product-title">Other Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtOname" name="txtOname" placeholder="Mutuma">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="product-title">Email</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="info@camera20production.co.ke">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="sale-price">Id Number</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtID" name="txtID" placeholder="12345678">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="stock">User Type</label>
                        <div class="form-control-wrap">
                            <select class="form-select" data-search="on" name="txtUT" id="txtUT" placeholder="Category">

                                <option value="User">User</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="stock">Phone Number</label>
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
                    <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                </div>
            </div>
        </div>
    </form>

    <script>
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
                txtUT: "User Type is required",
                txtPN: "User phone number is required",
            },
            submitHandler: function(form) {
                var form_action = $("#addUser").attr("action");
                $.ajax({
                    data: $('#addUser').serialize(),
                    url: form_action,
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function() {
                        Swal.fire({
                            icon: 'info',
                            title: 'Loading...',
                            showConfirmButton: false,
                            timer: 3500
                        })
                    },
                    success: function(res) {

                        var $status = +JSON.stringify(res.status);
                        var $sts = 'false';
                        if ($status < 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ooops...',
                                text: JSON.stringify(res.data.message)
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: JSON.stringify(res.data.message)
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
                    }
                });
            }
        });
    </script>

</div>
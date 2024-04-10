<!-- modal to add new expense -->
<div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">New Expense</h5>
            <div class="nk-block-des">
                <p>Add information and add new Expense.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <form id="addExpense" name="addExpense" action="/html/expense-add-item.html" method="post">
        <div class="nk-block">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="product-title">Description</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtDesc" name="txtDesc">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="sale-price">Amount</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtAmount" name="txtAmount">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="stock">Remarks</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="txtRemarks" name="txtRemarks">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="upload-zone small bg-lighter my-2">
                        <div class="dz-message">
                            <span class="dz-message-text">Reciept </span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">
                        <span class="submitText">
                            <em class="icon ni ni-plus"></em>
                            <span>Submit</span>
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
            var submitButton = $("#addExpense button[type='submit']");
            $("#addExpense").validate({
                rules: {
                    txtDesc: "required",
                    txtAmount: "required",
                    txtRemarks: "required",
                },
                messages: {
                    txtDesc: "Please enter expense discription",
                    txtAmount: "Please enter Expense Amount in Kenya Shillings",
                    txtRemarks: "Please enter you remarks and any other infomation",
                },
                submitHandler: function(form) {
                    var form_action = $("#addExpense").attr("action");

                    submitButton.find(".spinner-border").removeClass("d-none");
                    submitButton.find(".submitText").addClass("d-none");
                    submitButton.find(".loadingText").removeClass("d-none");
                    submitButton.prop("disabled", true);


                    $.ajax({
                        data: $('#addExpense').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        beforeSend: function() {
                            NioApp.Toast("Updating...", 'info', {
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
                                    text: res.message
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message
                                }).then(() => {
                                    window.location.href = "/html/expense-list.html";
                                });
                            }

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
                                updateToken(r.responseJSON.tn);
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



<!-- modal to edit expenses -->

<!--modal-->
<div class="modal" tabindex="-1" role="dialog" id="editExpense">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Expense</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form id="ee" name="ee" action="/html/expense-edit-item.html" method="post">

                    <div class="row g-3">

                        <input type="hidden" id="txtExpID" name="txtExpID">

                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="product-title">Description</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="txtDesc" name="txtDesc">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="sale-price">Amount</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="txtAmount" name="txtAmount">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="stock">Remarks</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="txtRemarks" name="txtRemarks" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="upload-zone small bg-lighter my-2">
                                <div class="dz-message">
                                    <span class="dz-message-text">Reciept </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            <span class="submitText">
                                <em class="icon ni ni-plus"></em>
                                <span>Submit</span>
                            </span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span class="loadingText d-none">Loading...</span>
                        </button>
                    </div>
                </form>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var submitButton = $("#ee button[type='submit']");
                        $("#ee").validate({
                            rules: {
                                txtAmount: "required",
                                txtDesc: "required",
                            },
                            messages: {
                                txtAmount: "Amount required",
                                txtDesc: "Description required",
                            },
                            submitHandler: function(form) {

                                var form_action = $("#ee").attr("action");

                                submitButton.find(".spinner-border").removeClass("d-none");
                                submitButton.find(".submitText").addClass("d-none");
                                submitButton.find(".loadingText").removeClass("d-none");
                                submitButton.prop("disabled", true);


                                $.ajax({
                                    data: $('#ee').serialize(),
                                    url: form_action,
                                    type: "POST",
                                    dataType: 'json',
                                    beforeSend: function() {
                                        NioApp.Toast("Updating...", 'info', {
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
                                                text: res.message
                                            })
                                        } else {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: res.message
                                            }).then(() => {
                                                window.location.href = "/html/expense-list.html";
                                            });
                                        }

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
                                            updateToken(r.responseJSON.tn);
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
    </div>
</div>
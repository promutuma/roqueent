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
                    <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                </div>
            </div>
        </div>
    </form>

    <script>
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
                $.ajax({
                    data: $('#addExpense').serialize(),
                    url: form_action,
                    type: "POST",
                    dataType: 'json',
                    success: function(res) {
                        var $status = JSON.stringify(res.status);
                        var $sts = 'false';
                        if ($status < "1") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ooops...',
                                text: JSON.stringify(res.data)
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: JSON.stringify(res.data)
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
                    }
                });
            }
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="ee" name="ee" action="/html/expense-edit-item.html" method="post">

                    <div class="row g-3">

                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="sale-price">Expense ID</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="txtExpID" name="txtExpID" readonly>
                                </div>
                            </div>
                        </div>


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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

                <script>
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
                            $.ajax({
                                data: $('#ee').serialize(),
                                url: form_action,
                                type: "POST",
                                dataType: 'json',
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
                                }
                            });
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
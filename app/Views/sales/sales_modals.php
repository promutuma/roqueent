<!-- modal to add items -->
<div class="modal fade" tabindex="-1" id="addItemModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Select Item</h5>
            </div>
            <div class="modal-body">
                <form id="addItem" name="addItem" action="/html/sales-add-item-cart.html" method="post">
                    <div class="form-group">
                        <label class="form-label" for="default-01">Sale Id</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtSaleId" id="txtSaleId" placeholder="Stock" value="<?php echo $saleId; ?>" readonly>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="default-01">Select Product</label>

                        <div class="form-control-wrap">
                            <select class="form-select js-select2" data-search="on" name="txtItem" id="txtItem" placeholder="Select Item">
                                <?php foreach ($product as $row) : ?>
                                    <option value="<?php echo $row['product_sku'] ?>"><?php echo $row['product_name'] ?> @ <?php echo $row['sale_price'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Quantity</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtQuantity" id="txtQuantity" placeholder="Quantity">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            <span class="submitText">
                                <span>Submit</span>
                            </span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span class="loadingText d-none">Loading...</span>
                        </button>
                    </div>

                </form>
            </div>
            <div class="modal-footer bg-light">

            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var submitButton = $("#addItem button[type='submit']");
                $("#addItem").validate({
                    rules: {
                        txtItem: "required",
                        txtQuantity: "required",
                    },
                    messages: {},
                    submitHandler: function(form) {
                        var form_action = $("#addItem").attr("action");


                        submitButton.find(".spinner-border").removeClass("d-none");
                        submitButton.find(".submitText").addClass("d-none");
                        submitButton.find(".loadingText").removeClass("d-none");
                        submitButton.prop("disabled", true);


                        $.ajax({
                            data: $('#addItem').serialize(),
                            url: form_action,
                            type: "POST",
                            dataType: 'json',
                            beforeSend: function() {
                                NioApp.Toast("Loading...", 'info', {
                                    position: 'top-right',
                                    icon: 'auto',
                                    ui: 'is-dark'
                                });
                            },
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
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#addItem')[0].reset();
                                            location.reload();
                                        } else if (result.isDenied) {
                                            location.reload();
                                        }
                                    })
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


<!-- modal add payment -->
<div class="modal fade" tabindex="-1" id="addPaymentModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add Payment</h5>
            </div>
            <div class="modal-body">

                <form id="addPayment" name="addPayment" action="/html/sales-add-payment.html" method="post">

                    <div class="form-group">
                        <label class="form-label" for="default-01">Sale Id</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtSaleId" id="txtSaleId" placeholder="Sale ID" value="<?php echo $saleId; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Payment To Be Done</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtPrice" id="txtPrice" value="<?php echo $totalPrice - $Payment; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Transaction Type</label>
                        <div class="form-control-wrap">
                            <select class="form-select js-select2" data-search="" name="txtTT" id="txtTT" placeholder="Select Item">
                                <option value="Cash">Cash</option>
                                <option value="Mpesa">Mpesa</option>
                                <option value="Bank-Deposit">Bank Deposit</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Amount</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtAmount" id="txtAmount" placeholder="Amount">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            <span class="submitText">
                                <span>Submit</span>
                            </span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span class="loadingText d-none">Loading...</span>
                        </button>
                    </div>
                </form>

            </div>
            <div class="modal-footer bg-light">
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var submitButton = $("#addPayment button[type='submit']");
                    $("#addPayment").validate({
                        rules: {
                            txtAmount: "required",
                        },
                        messages: {
                            txtAmount: "Please enter the Amount Paid",
                        },
                        submitHandler: function(form) {
                            var form_action = $("#addPayment").attr("action");

                            submitButton.find(".spinner-border").removeClass("d-none");
                            submitButton.find(".submitText").addClass("d-none");
                            submitButton.find(".loadingText").removeClass("d-none");
                            submitButton.prop("disabled", true);


                            $.ajax({
                                data: $('#addPayment').serialize(),
                                url: form_action,
                                type: "POST",
                                dataType: 'json',
                                beforeSend: function() {
                                    NioApp.Toast("Loading...", 'info', {
                                        position: 'top-right',
                                        icon: 'auto',
                                        ui: 'is-dark'
                                    });
                                },
                                success: function(res) {
                                    $('#addPaymentModal').modal('hide');
                                    var $status = +JSON.stringify(res.status);
                                    var $sts = 'false';
                                    if ($status > 1) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Payment not Enough',
                                            text: JSON.stringify(res.data.message),
                                            showCancelButton: true,
                                            confirmButtonText: 'Ask Now',
                                            cancelButtonText: `No, Payment to be done in future`,
                                        }).then((result) => {
                                            /* Read more about isConfirmed, isDenied below */
                                            if (result.isConfirmed) {
                                                $('#addPaymentModal').modal('show');
                                                $('#addPaymentModal #txtPrice').val(res.data.toPay);
                                            } else {
                                                Swal.fire('You Canceled the Transaction, Please not that the sale is not complete, but a transaction was recorded', '', 'info').then((result) => {
                                                    location.reload();
                                                })
                                            }
                                        })
                                    } else {
                                        if ($status === 1) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: JSON.stringify(res.data.message)
                                            }).then((result) => {
                                                location.reload();
                                            })
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Ooops...',
                                                text: JSON.stringify(res.data.message)
                                            })
                                        }

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



<!-- modal quantity change -->
<div class="modal fade" tabindex="-1" id="addQuantityModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add / Deduct Quantity</h5>
            </div>
            <div class="modal-body">
                <form id="QtrChange" name="QtrChange" action="/html/sales-quantity-change.html" method="post">
                    <div class="form-group">
                        <label class="form-label" for="default-01">Item Sale Id</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtItemSaleId" id="txtItemSaleId" placeholder="Stock" value="<?php echo $saleId; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Quantity to Add / Deduct</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtQD" id="txtQD" placeholder="Quantity to Add or Deduct">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            <span class="submitText">
                                <span>Submit</span>
                            </span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span class="loadingText d-none">Loading...</span>
                        </button>
                    </div>
                </form>

            </div>
            <div class="modal-footer bg-light">

            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var submitButton = $("#QtrChange button[type='submit']");
                    $("#QtrChange").validate({
                        rules: {
                            txtQD: "required",
                        },
                        messages: {
                            txtQD: "You must fill the quantity field. example 40 to add 40 units and -40 for substract 40 units from existing number",
                        },
                        submitHandler: function(form) {
                            var form_action = $("#QtrChange").attr("action");

                            submitButton.find(".spinner-border").removeClass("d-none");
                            submitButton.find(".submitText").addClass("d-none");
                            submitButton.find(".loadingText").removeClass("d-none");
                            submitButton.prop("disabled", true);


                            $.ajax({
                                data: $('#QtrChange').serialize(),
                                url: form_action,
                                type: "POST",
                                dataType: 'json',
                                beforeSend: function() {
                                    NioApp.Toast("Loading...", 'info', {
                                        position: 'top-right',
                                        icon: 'auto',
                                        ui: 'is-dark'
                                    });
                                },
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
                                            location.reload();
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
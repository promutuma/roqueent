<!-- content @s -->
<?= $this->extend('1layouts/main') ?>

<?= $this->section('cp') ?>



<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">New Order / <strong class="text-primary small"><?= $saleId ?></strong></h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        <li>Order ID: <span class="text-base"><?= $saleId ?></span></li>
                        <li>Cashier: <span class="text-base"><?= session()->get('user_name') ?></span></li>
                    </ul>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="html/kyc-list-regular.html" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                <a href="html/kyc-list-regular.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <?php if (!$activeShift) : ?>
            <div class="alert alert-fill alert-danger alert-icon">
                <em class="icon ni ni-cross-circle"></em>
                <div class="alert-cta flex-wrap g-3">
                    <div class="alert-text">
                        <p><strong>Shift Required!</strong> You must have an active shift to process payments and complete sales.</p>
                    </div>
                    <div class="alert-actions">
                        <button type="button" class="btn btn-sm btn-white text-danger" data-bs-toggle="modal" data-bs-target="#openShiftModal">
                            <em class="icon ni ni-plus"></em><span>Open Shift Now</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row gy-5">
            <div class="col-lg-5">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Products</h5>
                        <p>Select Products from the list below and press the button to add into the cart</p>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <div class="card-inner">
                        <table class="table datatable-init table-striped">
                            <caption>All Available products</caption>
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Available Stock</th>
                                    <th>Price per unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($product as $r) {
                                ?>
                                    <tr>
                                        <td><?= $r['product_name'] ?></td>
                                        <td><?= $r['stock'] ?></td>
                                        <td><?= $r['sale_price'] ?></td>
                                        <td><a class="btn item-row" data-id="<?= $r['product_sku'] ?>" data-name="<?= $r['product_name'] ?>" data-stock="<?= $r['stock'] ?>" data-price=" <?= $r['sale_price'] ?>"><em class=" icon ni ni-plus"></em></a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> <!-- card inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-lg-7">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Cart</h5>
                        <p>Info here will be auto calculated. Data is not yet saved in the computer</p>
                    </div>
                </div>
                <div class="card card-bordered">
                    <div class="card-inner">
                        <form id="frmSubmitOrder" name="frmSubmitOrder" action="/html/sale-save-new-order.html" method="post">
                            <h5>Order Sheet</h5>
                            <hr>
                            <p>Payment details will appear once you have saved this form</p>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Customer</span>
                                                </div>
                                                <select class="form-select js-select2" name="txtCustomerId" id="txtCustomerId" data-search="on">
                                                    <option value="">Walking Customer</option>
                                                    <?php foreach ($customers as $c) : ?>
                                                        <option value="<?= $c['id'] ?>"><?= $c['customer_name'] ?> (<?= $c['phone_number'] ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="txtSaleId">Sale or Order ID / REF</span>
                                                </div>
                                                <input type="text" class="form-control" id="txtSaleId" name="txtSaleId" value="<?= $saleId ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <hr>
                                <h6>Order Items</h6>


                                <table id="selected-items-table" class="table table-striped">
                                    <caption></caption>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Selected items will be displayed here -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Subtotal:</td>
                                            <td id="subtotal-amount">0.00</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-6">Discount</div>
                                                    <div class="col-6">
                                                        <select class="form-select form-select-sm" name="txtDiscountType" id="txtDiscountType">
                                                            <option value="Fixed">Ksh (Fixed)</option>
                                                            <option value="Percent">% (Percent)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" step="0.01" class="form-control form-control-sm" name="txtDiscountAmount" id="txtDiscountAmount" value="0.00">
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr class="bg-lighter">
                                            <td colspan="2" class="font-weight-bold">Net Total:</td>
                                            <td id="total-amount" class="font-weight-bold text-primary" style="font-size: 1.25rem;">0.00</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-submit" disabled>
                                        <span class="submitText">
                                            <span>Proceed to payment</span>
                                        </span>
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <span class="loadingText d-none">Loading...</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var submitButton = $("#frmSubmitOrder button[type='submit']");
                                $("#frmSubmitOrder").validate({
                                    rules: {},
                                    messages: {},
                                    submitHandler: function(form) {
                                        var form_action = $("#frmSubmitOrder").attr("action");

                                        submitButton.find(".spinner-border").removeClass("d-none");
                                        submitButton.find(".submitText").addClass("d-none");
                                        submitButton.find(".loadingText").removeClass("d-none");
                                        submitButton.prop("disabled", true);


                                        $.ajax({
                                            data: $('#frmSubmitOrder').serialize(),
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
                                                        window.location.href = "/html/sales-new.html/<?= $saleId ?>";
                                                    });
                                                }

                                            },
                                            error: function(xhr, status, error) {
                                                NioApp.Toast("<h5> Error: " + xhr.status + "</h5>" + error, 'error', {
                                                    position: 'top-center',
                                                    icon: 'auto',
                                                    ui: 'is-dark'
                                                });
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

                    </div> <!-- card inner -->
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(document).ready(function() {
            // Add click event listener to items
            $(".item-row").click(function() {
                // Get data attributes of the clicked item
                var id = $(this).data("id");
                var name = $(this).data("name");
                var price = $(this).data("price");
                var stock = $(this).data("stock");

                // Add item to the form
                $("#selected-items-table tbody").append(
                    "<tr>" +
                    "<td><input type='hidden' name='items[]' value='" + id + "'>" + name + "</td>" +
                    "<td class='price'>" + price + "</td>" +
                    "<td><input type='number' id='" + id + "' name='quantities[]' step='0.01' value='1' min='0.01' max='" + stock + "' class='form-control quantity'></td>" +
                    "<td class='total-price'>" + price + "</td>" +
                    "<td><button class='btn btn-danger remove-item'>Remove</button></td>" +
                    "</tr>"
                );
                updateTotals();
            });

            // Update total when quantity changes
            $(document).on('change', '.quantity', function() {
                updateTotals();
            });

            // Remove item from form
            $(document).on('click', '.remove-item', function() {
                $(this).closest('tr').remove();
                updateTotals();
            });

            // Update subtotal/total when discount changes
            $(document).on('change keyup', '#txtDiscountAmount, #txtDiscountType', function() {
                updateTotals();
            });

            // Function to update totals
            function updateTotals() {
                var subtotal = 0;
                $("#selected-items-table tbody tr").each(function() {
                    var price = parseFloat($(this).find('.price').text());
                    var quantity = parseFloat($(this).find('.quantity').val());
                    var totalPrice = price * quantity;
                    $(this).find('.total-price').text(totalPrice.toFixed(2));
                    subtotal += totalPrice;
                });
                $("#subtotal-amount").text(subtotal.toFixed(2));

                // Calculate Discount
                var discountAmount = parseFloat($("#txtDiscountAmount").val()) || 0;
                var discountType = $("#txtDiscountType").val();
                var netTotal = subtotal;

                if (discountType === 'Percent') {
                    var discountVal = (discountAmount / 100) * subtotal;
                    netTotal = subtotal - discountVal;
                } else {
                    netTotal = subtotal - discountAmount;
                }

                if (netTotal < 0) {
                    netTotal = 0;
                }

                $("#total-amount").text(netTotal.toFixed(2));

                // Update submit button state
                updateSubmitButton(subtotal);
            }

            // Function to update submit button state based on subtotal amount
            function updateSubmitButton(subtotal) {
                if (subtotal <= 0) {
                    $(".btn-submit").prop('disabled', true);
                } else {
                    $(".btn-submit").prop('disabled', false);
                }
            }

            // Warn user before leaving the page if the form is dirty (data not saved)
            var formDirty = false;
            $(document).on('change', 'input', function() {
                formDirty = true;
            });
            $(window).on('beforeunload', function() {
                if (formDirty) {
                    return "You have unsaved changes. Are you sure you want to leave this page?";
                }
            });
        });
    });
</script>

<!-- content ends here -->
<?= $this->endSection('cp') ?>
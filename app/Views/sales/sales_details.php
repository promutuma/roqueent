<!-- content @s -->
<?= $this->extend('1layouts/main') ?>

<?= $this->section('cp') ?>



<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Sale #<?php echo $saleId; ?></h3>
                    <div class="nk-block-des text-soft">
                        <p>You have total <?php echo $itemsN; ?> items added.</p>
                    </div>
                </div><!-- .nk-block-head-content -->

                <?php
                if ($sale['sale_status'] == 'Complete') {
                    # code...
                } else {
                    # code...
                ?>
                    <div class="nk-block-head-content">
                        <a data-id="<?php echo $saleId ?>" class="btn btnAddItem btn-xl btn-outline-info"> Add Item</a>
                    </div><!-- .nk-block-head-content -->
                <?php
                }
                ?>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="card card-bordered card-stretch">

                <div class="card-inner-group">



                    <div class="card-inner position-relative card-tools-toggle">

                        <div class="brand-logo pb-4 text-center">
                            <a class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="<?php echo base_url() ?>/files/images/logo.png" srcset="<?php echo base_url() ?>/files/images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="<?php echo base_url() ?>/files/images/logo-dark.png" srcset="<?php echo base_url() ?>/files/images/logo-dark2x.png 2x" alt="logo-dark">
                                <hr>
                                <p>Camera20 POS</p>
                            </a>
                        </div>

                    </div><!-- .card-inner -->

                    <div class="card-inner">
                        <div class="card-inner p-0">
                            <table class="table table-striped table-hover table-bordered" id="itemlist">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <?php
                                        if ($sale['sale_status'] == 'Complete') {
                                            # code...
                                        } else {
                                            # code...
                                        ?>
                                            <th scope="col">Action</th>
                                        <?php
                                        }
                                        ?>
                                        <th scope="col">Item SKU</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($item as $row) : ?>
                                        <tr>

                                            <?php
                                            if ($sale['sale_status'] == 'Complete') {
                                                # code...
                                            } else {
                                                # code...
                                            ?>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a data-id="<?php echo $row['item_sale_id'] ?>" class="btn btnAddQ"><em class="icon ni ni-edit"></em><span>Add / Deduct Quantity</span></a></li>
                                                                <li><a data-id="<?php echo $row['item_sale_id'] ?>" class="btn btnRemoveItem"><em class="icon ni ni-trash"></em><span>Remove Item</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                            <td><?php echo $row['product_sku'] ?></th>
                                            <td><span class="tb-sub"><?php echo $row['product_name'] ?></span></td>
                                            <td><span class="tb-lead">Ksh <?php echo $row['price_per_unit'] ?></span></td>
                                            <td><?php echo $row['quantity'] ?></td>
                                            <td>Ksh <?php echo $row['total_price'] ?></td>


                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td rowspan=4></td>
                                        <?php
                                        if ($sale['sale_status'] == 'Complete') {
                                            # code...
                                        } else {
                                            # code...
                                        ?>
                                            <td colspan=1 rowspan=4><b></b></td>
                                        <?php
                                        }
                                        ?>
                                        <td colspan=2><b>Total Price</b></td>
                                        <td><b></b></td>
                                        <td><b>Ksh <?php echo $totalPrice; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2><b>Total Items In Cart</b></td>
                                        <td><b><?php echo $totalQuantity; ?></b></td>
                                        <td><b></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2><b>Total Payment</b></td>
                                        <td><b></b></td>
                                        <td><b>Ksh <?php echo $Payment; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan=2><b>Amount Not Paid</b></td>
                                        <td><b></b></td>
                                        <td><b>Ksh <?php echo $totalPrice - $Payment; ?></b></td>
                                    </tr>
                                </tfoot>
                            </table>


                        </div>

                        <div class="card-inner">
                            <?php
                            if ($sale['sale_status'] == 'Complete') {
                                # code...
                            } else {
                                # code...
                            ?>
                                <a data-id="<?php echo $saleId ?>" class="btn btnRecievePayment btn-xl btn-dim btn-primary">Recieve Payment</a>
                            <?php
                            }
                            ?>

                            <a class="btn btn-xl btn-success">Generate Invoice</a>
                            <a class="btn btn-xl btn-danger">Cancel Sale</a>
                        </div><!-- .card-inner -->

                    </div>
                </div><!-- .card-inner-group -->

            </div><!-- .card -->
            <!-- With Footer Header -->

        </div><!-- .nk-block -->
    </div>
</div>
<!-- content @e -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('body').on('click', '.btnRemoveItem', function() {
            var item_sale_id = $(this).attr('data-id');
            Swal.fire({
                icon: 'warning',
                title: 'Warning...',
                text: 'Do you want to remove item with sale ID ' + item_sale_id + ' from the Cart',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'YES, Remove This Item',
                denyButtonText: `NO`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/html/item-sale-id-remove.html/' + item_sale_id,
                        type: "GET",
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
                                    position: 'center',
                                    icon: 'success',
                                    title: JSON.stringify(res.data.message),
                                    showConfirmButton: false,
                                    timer: 2500
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Failed',
                                text: "An error: " + JSON.stringify(data.responseText) + " has occured",

                            })
                        }
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Action Canceled Successfully'
                    })
                }
            })
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('body').on('click', '.btnAddQ', function() {
            var $itemId = $(this).attr('data-id');
            $.ajax({
                url: '/html/item-get-item.html/' + $itemId,
                type: "GET",
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
                    if ($status < "1") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops...',
                            text: JSON.stringify(res.data)
                        })
                    } else {
                        $('#addQuantityModal').modal('show');
                        $('#addQuantityModal #txtItemSaleId').val(res.data.item_sale_id);
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
        });
    })
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('body').on('click', '.btnAddItem', function() {
            var $saleId = $(this).attr('data-id');
            $.ajax({
                url: '/html/sales-add-item.html/' + $saleId,
                type: "GET",
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

                    if ($status < "1") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops...',
                            text: JSON.stringify(res.data)
                        })
                    } else {
                        $('#addItemModal').modal('show');
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

        });
    })
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('body').on('click', '.btnRecievePayment', function() {
            var $saleId = $(this).attr('data-id');
            $.ajax({
                url: '/html/sales-get-payment.html/' + $saleId,
                type: "GET",
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

                    if ($status < "1") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops...',
                            text: JSON.stringify(res.data)
                        })
                    } else {
                        Swal.fire({
                            icon: 'info',
                            text: JSON.stringify(res.data),
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            denyButtonText: `No, Not now`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                $('#addPaymentModal').modal('show');
                            } else {
                                Swal.fire('You Canceled the Transaction', '', 'info')
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
                }
            });
        });
    })
</script>


<!-- Load Modals -->
<?= $this->include('sales/sales_modals') ?>
<!-- End Load Modals -->



<!-- content ends here -->
<?= $this->endSection('cp') ?>
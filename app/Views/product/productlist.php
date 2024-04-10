<!-- content @s -->
<?= $this->extend('1layouts/main') ?>

<?= $this->section('cp') ?>



<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Products</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-search"></em>
                                    </div>
                                    <input type="text" class="form-control" id="default-04" placeholder="Quick search by id">
                                </div>
                            </li>
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Status</a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>New Items</span></a></li>
                                            <li><a href="#"><span>Featured</span></a></li>
                                            <li><a href="#"><span>Out of Stock</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="#" data-target="addProduct" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                <a href="#" data-target="addProduct" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Product</span></a>
                            </li>

                            <li class="nk-block-tools-opt">
                                <a href="#" data-target="addCategory" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                <a href="#" data-target="addCategory" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Category</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table class="datatable-init-export nowrap table" data-export-title="Export Products">
                    <caption>Product Lists & Stock by <?= date('D, jS M Y \a\t H:i:s \h\r\s'); ?></caption>
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($product as $row) : ?>
                            <tr>
                                <td><?php echo $row['product_sku'] ?></th>
                                <td><span class="tb-sub"><?php echo $row['product_name'] ?></span></td>
                                <td><span class="tb-lead">Ksh <?php echo $row['sale_price'] ?></span></td>
                                <td><?php echo $row['stock'] ?></td>
                                <td><?php echo $row['category'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a data-id="<?php echo $row['product_sku'] ?>" class="btn btnEdit"><em class="icon ni ni-edit"></em><span>Edit Product</span></a></li>
                                                <li><a data-id="<?php echo $row['product_sku'] ?>" class="btn btnAddStock"><em class="icon ni ni-eye"></em><span>Add Stock</span></a></li>
                                                <li><a data-id="<?php echo $row['product_sku'] ?>" class="btn btnDelete"><em class="icon ni ni-trash"></em><span>Remove Product</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div><!-- .pagination-goto -->
        </div><!-- .nk-block-between -->
    </div>
</div><!-- .nk-block -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('body').on('click', '.btnDelete', function() {
            var product_sku = $(this).attr('data-id');
            Swal.fire({
                icon: 'warning',
                title: 'Warning...',
                text: 'Do you want to delete item with SKU Number ' + product_sku + ' Note this cannot be Undone',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't Delete`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/html/product-delete.html/' + product_sku,
                        type: "GET",
                        dataType: 'json',
                        beforeSend: function() {
                            NioApp.Toast("Deleting...", 'info', {
                                position: 'top-right',
                                icon: 'auto',
                                ui: 'is-dark'
                            });
                        },
                        success: function(res) {
                            $('#loading').modal('hide');
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Product Deleted Successfully'
                            }).then(() => {
                                window.location.href = "/html/product-list.html";
                            });
                        },
                        error: function(data) {
                            $('#loading').modal('hide');
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
                        title: 'Product Deletetion Canceled Successfully',
                        showConfirmButton: false,
                        timer: 3500
                    })
                }
            })
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('body').on('click', '.btnAddStock', function() {
            var product_sku = $(this).attr('data-id');
            $.ajax({
                url: '/html/product-find.html/' + product_sku,
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
                    if (res.status === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops...',
                            text: res.message
                        })
                    } else {
                        $('#loading').modal('hide');
                        $('#addstockModal').modal('show');
                        $('#addStock #txtProductSku').val(res.data.product_sku);
                        $('#addStock #txtProductName').val(res.data.product_name);
                        $('#addStock #txtStock').val(res.data.stock);
                    }
                },
                error: function(data) {
                    $('#loading').modal('hide');
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooops...',
                        text: "An error: " + JSON.stringify(data.responseText) + " has occured"
                    })
                }
            });

        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('body').on('click', '.btnEdit', function() {
            var product_sku = $(this).attr('data-id');
            $.ajax({
                url: '/html/product-find.html/' + product_sku,
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
                    if (res.status === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops...',
                            text: res.message
                        })
                    } else {
                        $('#loading').modal('hide');
                        $('#updateModal').modal('show');
                        $('#updateproduct #txtProductSku').val(res.data.product_sku);
                        $('#updateproduct #txtProductName').val(res.data.product_name);
                        $('#updateproduct #txtRPrice').val(res.data.regular_price);
                        $('#updateproduct #txtSPrice').val(res.data.sale_price);
                        $('#updateproduct #txtStock').val(res.data.stock);
                        $('#updateproduct #txtECategory').val(res.data.category).change();
                    }
                },
                error: function(data) {
                    $('#loading').modal('hide');
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooops...',
                        text: "An error: " + JSON.stringify(res.responseText) + " has occured"
                    })
                }
            });

        });
    });
</script>



<!-- Load Modals -->
<?= $this->include('product/product_modals') ?>
<!-- End Load Modals -->

<!-- content ends here -->

<?= $this->endSection('cp') ?>
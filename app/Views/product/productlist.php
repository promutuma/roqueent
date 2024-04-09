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
                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-toggle="dropdown">Status</a>
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
        <div class="card card-bordered">
            <div class="card-inner-group">
                <div class="card-inner p-0">




                    <table class="table datatable-init-export" id="productlist">
                        <thead>
                            <tr>
                                <th scope="col">SKU</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($product as $row) : ?>
                                <tr>
                                    <td scope="col"><?php echo $row['product_sku'] ?></th>
                                    <td scope="col"><span class="tb-sub"><?php echo $row['product_name'] ?></span></td>
                                    <td scope="col"><span class="tb-lead">Ksh <?php echo $row['sale_price'] ?></span></td>
                                    <td scope="col"><?php echo $row['stock'] ?></td>
                                    <td scope="col"><?php echo $row['category'] ?></td>
                                    <td scope="col">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a data-id="<?php echo $row['product_sku'] ?>" class="btn btnEdit"><em class="icon ni ni-edit"></em><span>Edit Product</span></a></li>
                                                    <li><a data-id="<?php echo $row['product_sku'] ?>" class="btn btnAddStock"><em class="icon ni ni-eye"></em><span>Add Stock</span></a></li>
                                                    <li><a data-id="<?php echo $row['product_sku'] ?>" class="btn btnOrders"><em class="icon ni ni-activity-round"></em><span>Product Orders</span></a></li>
                                                    <li><a data-id="<?php echo $row['product_sku'] ?>" class="btn btnDelete"><em class="icon ni ni-trash"></em><span>Remove Product</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>





                </div>

            </div><!-- .pagination-goto -->
        </div><!-- .nk-block-between -->
    </div>
</div><!-- .nk-block -->

<!-- content @e -->


<script>
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
                        $('#loading').modal('show');
                    },
                    complete: function() {
                        $('#loading').modal('hide');
                    },
                    success: function(res) {
                        $('#loading').modal('hide');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Product Deleted Successfully',
                            showConfirmButton: false,
                            timer: 2500
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
</script>


<script>
    $('body').on('click', '.btnAddStock', function() {
        var product_sku = $(this).attr('data-id');
        $.ajax({
            url: '/html/product-find.html/' + product_sku,
            type: "GET",
            dataType: 'json',
            beforeSend: function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Loading...',
                    showConfirmButton: false,
                    timer: 2500
                })
            },
            success: function(res) {
                $('#loading').modal('hide');
                $('#addstockModal').modal('show');
                $('#addStock #txtProductSku').val(res.data.product_sku);
                $('#addStock #txtProductName').val(res.data.product_name);
                $('#addStock #txtStock').val(res.data.stock);
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
</script>


<script>
    $('body').on('click', '.btnEdit', function() {
        var product_sku = $(this).attr('data-id');
        $.ajax({
            url: '/html/product-find.html/' + product_sku,
            type: "GET",
            dataType: 'json',
            beforeSend: function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Loading...',
                    showConfirmButton: false,
                    timer: 2500
                })
            },
            success: function(res) {
                $('#loading').modal('hide');
                $('#updateModal').modal('show');
                $('#updateproduct #txtProductSku').val(res.data.product_sku);
                $('#updateproduct #txtProductName').val(res.data.product_name);
                $('#updateproduct #txtRPrice').val(res.data.regular_price);
                $('#updateproduct #txtSPrice').val(res.data.sale_price);
                $('#updateproduct #txtStock').val(res.data.stock);
                $('#updateproduct #txtCategory').val(res.data.category);

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
</script>



<!-- Load Modals -->
<?= $this->include('product/product_modals') ?>
<!-- End Load Modals -->

<!-- content ends here -->

<?= $this->endSection('cp') ?>
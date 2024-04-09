<!-- Modal to add stock to a certain item -->
<div class="modal fade" tabindex="-1" id="addstockModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add Stock To this Product</h5>
            </div>
            <div class="modal-body">
                <form id="addStock" name="addStock" action="/html/product-add-stock.html" method="post">
                    <div class="form-group">
                        <label class="form-label" for="default-01">Product SKU</label>
                        <div class="form-control-wrap">
                            <input type="text" name="txtProductSku" id="txtProductSku" class="form-control" placeholder="Product SKU" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Product Name</label>
                        <div class="form-control-wrap">
                            <input type="text" name="txtProductName" id="txtProductName" class="form-control" placeholder="Product Name" readonly>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="default-01">Current Stock</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtStock" id="txtStock" placeholder="Stock" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Stock to add</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtAddStock" id="txtAddStock" placeholder="Stock">
                        </div>
                    </div>

            </div>
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                </form>
                <script>
                    $("#addStock").validate({
                        rules: {
                            txtAddStock: "required",
                        },
                        messages: {},
                        submitHandler: function(form) {
                            var form_action = $("#addStock").attr("action");
                            $.ajax({
                                data: $('#addStock').serialize(),
                                url: form_action,
                                type: "POST",
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
                                    $('#addStock')[0].reset();
                                    $('#addstockModal').modal('hide');

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: "Stock added to " + JSON.stringify(res.data.product_name) + " with SKU number " + JSON.stringify(res.data.product_sku) + " Successfully",

                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "/html/product-list.html";
                                        } else if (result.isDenied) {
                                            window.location.href = "/html/product-list.html";
                                        }
                                    })
                                },
                                error: function(res) {
                                    $('#loading').modal('hide');
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ooops...',
                                        text: "An error: " + JSON.stringify(res.responseText) + " has occured"
                                    })

                                }
                            })
                        }

                    });
                </script>
            </div>
        </div>
    </div>
</div>



<!-- modal to update product -->
<div class="modal fade" tabindex="-1" id="updateModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
            </div>
            <div class="modal-body">
                <form id="updateproduct" name="updateproduct" action="/html/product-update.html" method="post">
                    <div class="form-group">
                        <label class="form-label" for="default-01">Product SKU</label>
                        <div class="form-control-wrap">
                            <input type="text" name="txtProductSku" id="txtProductSku" class="form-control" placeholder="Product SKU" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Product Name</label>
                        <div class="form-control-wrap">
                            <input type="text" name="txtProductName" id="txtProductName" class="form-control" placeholder="Product Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Regular Price</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtRPrice" id="txtRPrice" placeholder="Regular Price">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Selling Price</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtSPrice" id="txtSPrice" placeholder="Selling Price">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Stock</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="txtStock" id="txtStock" placeholder="Stock">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="default-01">Category</label>

                        <div class="form-control-wrap">
                            <select class="form-select" data-search="on" name="txtCategory" id="txtCategory" placeholder="Category">
                                <?php foreach ($category as $row) : ?>
                                    <option value="<?php echo $row['category_name'] ?>"><?php echo $row['category_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer bg-light">

            </div>
            <script>
                $("#updateproduct").validate({
                    rules: {
                        txtProductName: "required",
                        txtRPrice: "required",
                        txtSPrice: "required",
                        txtStock: "required",
                        txtCategory: "required"
                    },
                    messages: {},

                    submitHandler: function(form) {
                        var form_action = $("#updateproduct").attr("action");
                        $.ajax({
                            data: $('#updateproduct').serialize(),
                            url: form_action,
                            type: "POST",
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
                                $('#updateproduct')[0].reset();
                                $('#updateModal').modal('hide');
                                $('#loading').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: "Product " + JSON.stringify(res.data.product_name) + " with SKU number " + JSON.stringify(res.data.product_sku) + " updated Successfully",

                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "/html/product-list.html";
                                    } else if (result.isDenied) {
                                        window.location.href = "/html/product-list.html";
                                    }
                                })
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
                    }
                });
            </script>

        </div>
    </div>
</div>



<!-- modal to create new category -->

<div id="Sidenav" class="nk-add-product toggle-slide toggle-slide-right" data-content="addCategory" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">New Category</h5>
            <div class="nk-block-des">
                <p>Add information and add new Category.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <form id="addcategory" name="addcategory" action="/html/category-add.html" method="post">
            <div class="form-group">
                <label class="form-label" for="default-01">Category Name</label>
                <div class="form-control-wrap">
                    <input type="text" name="txtCategoryName" id="txtCategoryName" class="form-control" placeholder="Category Name">
                </div>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>

        <script>
            $("#addcategory").validate({
                rules: {
                    txtCategoryName: "required",

                },
                messages: {},

                submitHandler: function(form) {
                    var form_action = $("#addcategory").attr("action");
                    $.ajax({
                        data: $('#addcategory').serialize(),
                        url: form_action,
                        type: "POST",
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "Category " + JSON.stringify(res.data.category_name) + " added Successfully",

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#addcategory')[0].reset();
                                    window.location.href = "/html/product-list.html";
                                } else if (result.isDenied) {
                                    window.location.href = "/html/product-list.html";
                                }
                            })
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
                }
            });
        </script>
    </div>
</div>




<!-- Modal to add new product -->
<div id="Sidenav" class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">New Product</h5>
            <div class="nk-block-des">
                <p>Add information and add new product.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <form id="addproduct" name="addproduct" action="/html/product-add.html" method="post">
            <div class="form-group">
                <label class="form-label" for="default-01">Product Name</label>
                <div class="form-control-wrap">
                    <input type="text" name="txtProductName" id="txtProductName" class="form-control" placeholder="Product Name">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="default-01">Regular Price</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" name="txtRPrice" id="txtRPrice" placeholder="Regular Price">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="default-01">Selling Price</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" name="txtSPrice" id="txtSPrice" placeholder="Selling Price">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="default-01">Stock</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" name="txtStock" id="txtStock" placeholder="Stock">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="default-01">Category</label>

                <div class="form-control-wrap">
                    <select class="form-control" data-search="on" name="txtCategory" id="txtCategory" placeholder="Category">
                        <?php foreach ($category as $row) : ?>
                            <option value="<?php echo $row['category_name'] ?>"><?php echo $row['category_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>




        <script>
            $("#addproduct").validate({
                rules: {
                    txtProductName: "required",
                    txtRPrice: "required",
                    txtSPrice: "required",
                    txtStock: "required",
                    txtCategory: "required"
                },
                messages: {},

                submitHandler: function(form) {
                    var form_action = $("#addproduct").attr("action");
                    $.ajax({
                        data: $('#addproduct').serialize(),
                        url: form_action,
                        type: "POST",
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "Product " + JSON.stringify(res.data.product_name) + " with SKU number " + JSON.stringify(res.data.product_sku) + " Added Successfully",

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#addproduct')[0].reset();
                                    window.location.href = "/html/product-list.html";
                                } else if (result.isDenied) {
                                    window.location.href = "/html/product-list.html";
                                }
                            })

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
                }
            });
        </script>

    </div>
</div>
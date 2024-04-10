<!-- Modal to add stock to a certain item -->
<div class="modal fade" tabindex="-1" id="addstockModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                            <input type="text" class="form-control" name="txtAddStock" id="txtAddStock" placeholder="Stock" required>
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

                        var submitButton = $("#addStock button[type='submit']");

                        $("#addStock").validate({
                            rules: {
                                txtAddStock: "required",
                            },
                            messages: {},
                            submitHandler: function(form) {
                                var form_action = $("#addStock").attr("action");

                                submitButton.find(".spinner-border").removeClass("d-none");
                                submitButton.find(".submitText").addClass("d-none");
                                submitButton.find(".loadingText").removeClass("d-none");
                                submitButton.prop("disabled", true);


                                $.ajax({
                                    data: $('#addStock').serialize(),
                                    url: form_action,
                                    type: "POST",
                                    dataType: 'json',
                                    beforeSend: function() {
                                        NioApp.Toast("Updating Stock...", 'info', {
                                            position: 'top-right',
                                            icon: 'auto',
                                            ui: 'is-dark'
                                        });
                                    },
                                    success: function(res) {
                                        if (res.status < 1) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Ooops...',
                                                text: res.message
                                            })
                                        } else {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: res.message,

                                            }).then((result) => {
                                                window.location.href = "/html/product-list.html";
                                            })
                                        }
                                    },
                                    error: function(res) {
                                        $('#loading').modal('hide');
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Ooops...',
                                            text: "An error: " + JSON.stringify(res.responseText) + " has occured"
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
            <div class="modal-footer bg-light">

            </div>
        </div>
    </div>
</div>



<!-- modal to update product -->
<div class="modal fade" tabindex="-1" id="updateModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
            </div>
            <div class="modal-body">
                <form id="updateproduct" name="updateproduct" action="/html/product-update.html" method="post">

                    <input type="hidden" name="txtProductSku" id="txtProductSku">

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
                            <select class="form-select js-select2" data-search="on" name="txtCategory" id="txtECategory" data-placeholder="Category">
                                <?php foreach ($category as $row) : ?>
                                    <option value="<?php echo $row['category_name'] ?>"><?php echo $row['category_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
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
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var submitButton = $("#updateproduct button[type='submit']");
                    $("#updateproduct").validate({
                        rules: {
                            txtProductName: "required",
                            txtRPrice: "required",
                            txtSPrice: "required",
                            txtStock: "required",
                            txtECategory: "required"
                        },
                        messages: {},

                        submitHandler: function(form) {
                            var form_action = $("#updateproduct").attr("action");

                            submitButton.find(".spinner-border").removeClass("d-none");
                            submitButton.find(".submitText").addClass("d-none");
                            submitButton.find(".loadingText").removeClass("d-none");
                            submitButton.prop("disabled", true);


                            $.ajax({
                                data: $('#updateproduct').serialize(),
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
                                    if (res.status < 1) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Ooops...',
                                            text: res.message
                                        })
                                    } else {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: res.message,

                                        }).then((result) => {
                                            window.location.href = "/html/product-list.html";
                                        })
                                    }
                                },
                                error: function(data) {
                                    $('#loading').modal('hide');
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
                var submitButton = $("#addcategory button[type='submit']");
                $("#addcategory").validate({
                    rules: {
                        txtCategoryName: "required",

                    },
                    messages: {},

                    submitHandler: function(form) {
                        var form_action = $("#addcategory").attr("action");

                        submitButton.find(".spinner-border").removeClass("d-none");
                        submitButton.find(".submitText").addClass("d-none");
                        submitButton.find(".loadingText").removeClass("d-none");
                        submitButton.prop("disabled", true);


                        $.ajax({
                            data: $('#addcategory').serialize(),
                            url: form_action,
                            type: "POST",
                            dataType: 'json',
                            beforeSend: function() {
                                NioApp.Toast("Adding New Category", 'info', {
                                    position: 'top-right',
                                    icon: 'auto',
                                    ui: 'is-dark'
                                });
                            },
                            success: function(res) {
                                if (res.status < 1) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ooops...',
                                        text: res.message
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: res.message,

                                    }).then((result) => {
                                        window.location.href = "/html/product-list.html";
                                    })
                                }
                            },
                            error: function(data) {
                                $('#loading').modal('hide');
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
                    <select class="form-select  js-select2" data-search="on" name="txtCategory" id="txtCategory" data-placeholder="Select Category">
                        <?php foreach ($category as $row) : ?>
                            <option label="empty"></option>
                            <option value="<?php echo $row['category_name'] ?>"><?php echo $row['category_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
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

                var submitButton = $("#addproduct button[type='submit']");

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

                        submitButton.find(".spinner-border").removeClass("d-none");
                        submitButton.find(".submitText").addClass("d-none");
                        submitButton.find(".loadingText").removeClass("d-none");
                        submitButton.prop("disabled", true);


                        $.ajax({
                            data: $('#addproduct').serialize(),
                            url: form_action,
                            type: "POST",
                            dataType: 'json',
                            beforeSend: function() {
                                NioApp.Toast("Adding New Product", 'info', {
                                    position: 'top-right',
                                    icon: 'auto',
                                    ui: 'is-dark'
                                });
                            },
                            success: function(res) {
                                if (res.status < 1) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ooops...',
                                        text: res.message
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: res.message,

                                    }).then((result) => {
                                        window.location.href = "/html/product-list.html";
                                    })
                                }
                            },
                            error: function(data) {
                                $('#loading').modal('hide');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ooops...',
                                    text: "An error: " + data.responseText + " has occured"
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
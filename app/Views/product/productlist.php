<!-- content @s -->
<div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
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
  <?php foreach($product as $row):?>
    <tr>
      <td scope="col"><?php echo $row['product_sku']?></th>
      <td scope="col"><span class="tb-sub"><?php echo $row['product_name']?></span></td>
      <td scope="col">Ksh <?php echo $row['sale_price']?></td>
      <td scope="col"><?php echo $row['stock']?></td>
      <td scope="col"><?php echo $row['category']?></td>
      <td scope="col">
      <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a data-id="<?php echo $row['product_sku']?>" class="btn btnEdit"><em class="icon ni ni-edit" ></em><span>Edit Product</span></a></li>
                                                                            <li><a data-id="<?php echo $row['product_sku']?>" class="btn btnAddStock"><em class="icon ni ni-eye"></em><span>Add Stock</span></a></li>
                                                                            <li><a data-id="<?php echo $row['product_sku']?>" class="btn btnOrders"><em class="icon ni ni-activity-round"></em><span>Product Orders</span></a></li>
                                                                            <li><a data-id="<?php echo $row['product_sku']?>" class="btn btnDelete"><em class="icon ni ni-trash"></em><span>Remove Product</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                    </div>
      </td>
    </tr>
    <?php endforeach;?> 
   
  </tbody>
</table>




                                           
                                        </div>
                                        
                                                </div><!-- .pagination-goto -->
                                            </div><!-- .nk-block-between -->
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .nk-block -->




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
        <input type="text" name="txtProductName" id="txtProductName" class="form-control"  placeholder="Product Name">
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
                                                                <?php foreach($category as $row):?>
                                                                <option value="<?php echo $row['category_name']?>"><?php echo $row['category_name']?></option>
                                                                <?php endforeach;?> 
                                                            </select>
                                                        </div>
</div>


<div class="form-group">
<button type="submit" class="btn btn-primary">Submit</button>
</div>

                                    </form>
  </div>
  </div>
                                                                


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
        <input type="text" name="txtCategoryName" id="txtCategoryName" class="form-control"  placeholder="Category Name">
    </div>
</div>


<div class="form-group">
<button type="submit" class="btn btn-primary">Submit</button>
</div>

                                    </form>
  </div>
                                                                </div>





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
        <input type="text" name="txtProductSku" id="txtProductSku" class="form-control"  placeholder="Product SKU" readonly>
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="default-01">Product Name</label>
    <div class="form-control-wrap">
        <input type="text" name="txtProductName" id="txtProductName" class="form-control"  placeholder="Product Name">
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
                                                                <?php foreach($category as $row):?>
                                                                <option value="<?php echo $row['category_name']?>"><?php echo $row['category_name']?></option>
                                                                <?php endforeach;?> 
                                                            </select>
                                                        </div>
</div>


            </div>
            <div class="modal-footer bg-light">
            <div class="form-group">
<button type="submit" class="btn btn-primary">Submit</button>
</div>

                                    </form>
            </div>
        </div>
    </div>
</div>


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
        <input type="text" name="txtProductSku" id="txtProductSku" class="form-control"  placeholder="Product SKU" readonly>
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="default-01">Product Name</label>
    <div class="form-control-wrap">
        <input type="text" name="txtProductName" id="txtProductName" class="form-control"  placeholder="Product Name" readonly>
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
            </div>
        </div>
    </div>
</div>
 





                                    
                                </div><!-- .nk-block -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->


            <script>
                    $('body').on('click','.btnDelete',function(){
                        var product_sku = $(this).attr('data-id');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning...',
                            text: 'Do you want to delete item with SKU Number '+product_sku +' Note this cannot be Undone',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Delete',
                            denyButtonText: `Don't Delete`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/html/product-delete.html/'+product_sku,
                                    type: "GET",
                                    dataType: 'json',
                                    beforeSend:function(){$('#loading').modal('show');},
                                    complete:function(){$('#loading').modal('hide');},
                                    success: function (res) {
                                        $('#loading').modal('hide');
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: 'Product Deleted Successfully',
                                            showConfirmButton: false,
                                            timer: 2500
                                        }).then(()=>{
                                            window.location.href = "/html/product-list.html";
                                        });
                                    },
                                    error: function (data) {
                                        $('#loading').modal('hide');
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'Failed',
                                            text: "An error: "+JSON.stringify(data.responseText)+" has occured",
                                            
                                        })
                                    }
                                });
                            } else{
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
$("#addproduct").validate({
        rules: {
            txtProductName: "required",
            txtRPrice: "required",
            txtSPrice: "required",
            txtStock: "required",
            txtCategory: "required"
        },
        messages: {
        },
           
        submitHandler: function(form) {
            var form_action = $("#addproduct").attr("action");
            $.ajax({
                data: $('#addproduct').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                beforeSend:function(){Swal.fire({icon: 'info',title: 'Loading...',showConfirmButton: false,timer: 2500})},
                success: function (res) { 
                    $('#loading').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Product "+JSON.stringify(res.data.product_name)+" with SKU number "+JSON.stringify(res.data.product_sku)+" Added Successfully",
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#addproduct')[0].reset();
                            window.location.href = "/html/product-list.html";
                        } else if (result.isDenied) {
                            window.location.href = "/html/product-list.html";
                        }
                    })
                    
                },
                    error: function (data) {
                        $('#loading').modal('hide');
                        Swal.fire({
                            icon:'error',
                            title: 'Ooops...',
                            text: "An error: "+JSON.stringify(data.responseText)+" has occured"
                        })
                        
                }
            });
        }
    });
</script>

<script>
    $('body').on('click','.btnAddStock',function(){
        var product_sku = $(this).attr('data-id');
        $.ajax({
            url: '/html/product-find.html/'+product_sku,
            type: "GET",
            dataType: 'json',
            beforeSend:function(){Swal.fire({icon: 'info',title: 'Loading...',showConfirmButton: false,timer: 2500})},
            success: function (res) {
                $('#loading').modal('hide');
                $('#addstockModal').modal('show');
                $('#addStock #txtProductSku').val(res.data.product_sku); 
                $('#addStock #txtProductName').val(res.data.product_name);
                $('#addStock #txtStock').val(res.data.stock);
            },
            error: function (data) {
                $('#loading').modal('hide');
                Swal.fire({
                            icon:'error',
                            title: 'Ooops...',
                            text: "An error: "+JSON.stringify(data.responseText)+" has occured"
                        })
            }
        });
        
    });
</script>

<script>
    $("#addStock").validate({
        rules:{
            txtAddStock: "required",
        },
        messages:{
        },
        submitHandler: function(form) {
            var form_action = $("#addStock").attr("action");
            $.ajax({
                data: $('#addStock').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                beforeSend:function(){Swal.fire({icon: 'info',title: 'Loading...',showConfirmButton: false,timer: 2500})},
                success: function (res) {
                    $('#loading').modal('hide');
                    $('#addStock')[0].reset();
                    $('#addstockModal').modal('hide');
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Stock added to "+JSON.stringify(res.data.product_name)+" with SKU number "+JSON.stringify(res.data.product_sku)+" Successfully",
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/html/product-list.html";
                        } else if (result.isDenied) {
                            window.location.href = "/html/product-list.html";
                        }
                    })
                },
                    error: function (res) {
                        $('#loading').modal('hide');
                        Swal.fire({
                            icon:'error',
                            title: 'Ooops...',
                            text: "An error: "+JSON.stringify(res.responseText)+" has occured"
                        })
                        
                }})}
        
    });
</script>

<script>
    $('body').on('click', '.btnEdit', function () {
        var product_sku = $(this).attr('data-id');
        $.ajax({
            url: '/html/product-find.html/'+product_sku,
            type: "GET",
            dataType: 'json',
            beforeSend:function(){Swal.fire({icon: 'info',title: 'Loading...',showConfirmButton: false,timer: 2500})},
            success: function (res) {
                $('#loading').modal('hide');
                $('#updateModal').modal('show');
                $('#updateproduct #txtProductSku').val(res.data.product_sku); 
                $('#updateproduct #txtProductName').val(res.data.product_name);
                $('#updateproduct #txtRPrice').val(res.data.regular_price);
                $('#updateproduct #txtSPrice').val(res.data.sale_price);
                $('#updateproduct #txtStock').val(res.data.stock);
                $('#updateproduct #txtCategory').val(res.data.category);
                
            },
                error: function (data) {
                    $('#loading').modal('hide');
                    Swal.fire({
                            icon:'error',
                            title: 'Ooops...',
                            text: "An error: "+JSON.stringify(res.responseText)+" has occured"
                        })
            }
        });
        
    });
</script>

<script>
    $("#updateproduct").validate({
        rules: {
            txtProductName: "required",
            txtRPrice: "required",
            txtSPrice: "required",
            txtStock: "required",
            txtCategory: "required"
        },
        messages: {
        },
           
        submitHandler: function(form) {
            var form_action = $("#updateproduct").attr("action");
            $.ajax({
                data: $('#updateproduct').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                beforeSend:function(){Swal.fire({icon: 'info',title: 'Loading...',showConfirmButton: false,timer: 2500})},
                success: function (res) {                 
                    $('#updateproduct')[0].reset();
                    $('#updateModal').modal('hide');
                    $('#loading').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Product "+JSON.stringify(res.data.product_name)+" with SKU number "+JSON.stringify(res.data.product_sku)+" updated Successfully",
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/html/product-list.html";
                        } else if (result.isDenied) {
                            window.location.href = "/html/product-list.html";
                        }
                    })
                },
                    error: function (data) {
                        $('#loading').modal('hide');
                        Swal.fire({
                            icon:'error',
                            title: 'Ooops...',
                            text: "An error: "+JSON.stringify(data.responseText)+" has occured"
                        })
                        
                }
            });
        }
    });
 
</script>


<script>

$("#addcategory").validate({
        rules: {
            txtCategoryName: "required",
            
        },
        messages: {
        },
           
        submitHandler: function(form) {
            var form_action = $("#addcategory").attr("action");
            $.ajax({
                data: $('#addcategory').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                beforeSend:function(){Swal.fire({icon: 'info',title: 'Loading...',showConfirmButton: false,timer: 2500})},
                success: function (res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Category "+JSON.stringify(res.data.category_name)+" added Successfully",
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#addcategory')[0].reset();
                            window.location.href = "/html/product-list.html";
                        } else if (result.isDenied) {
                            window.location.href = "/html/product-list.html";
                        }
                    })
                },
                    error: function (data) {
                        $('#loading').modal('hide');
                        Swal.fire({
                            icon:'error',
                            title: 'Ooops...',
                            text: "An error: "+JSON.stringify(data.responseText)+" has occured"
                        })
                        
                }
            });
        }
    });
 
</script>
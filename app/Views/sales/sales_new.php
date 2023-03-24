<!-- content @s -->
<div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">New Sale #<?php echo $saleId;?></h3>
                                        <div class="nk-block-des text-soft">
                                            <p>You have total <?php echo $itemsN;?> items added.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                    <a data-id="<?php echo $saleId ?>" class="btn btnAddItem btn-xl btn-outline-info"> Add Item</a>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-bordered card-stretch">
                                
                                    <div class="card-inner-group">
                                    
                                        

                                    <div class="card-inner position-relative card-tools-toggle">
                                            
                                            <div class="card-search search-wrap" data-search="search">
                                                <div class="card-body">
                                                    <div class="search-content">
                                                        <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                        <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                                                        <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                    </div>
                                                </div>
                                            </div><!-- .card-search -->
                                        </div><!-- .card-inner -->

                                        <div class="table-responsive">
<table class="table table-striped table-hover table-bordered" id="itemlist">
  <thead>
    <tr>
      <th scope="col">Item SKU</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
      <th scope="col">Action</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach($item as $row):?>
    <tr>
      <td><?php echo $row['product_sku']?></th>
      <td><span class="tb-sub"><?php echo $row['product_name']?></span></td>
      <td><span class="tb-lead">Ksh <?php echo $row['price_per_unit']?></span></td>
      <td><?php echo $row['quantity']?></td>
      <td>Ksh <?php echo $row['total_price']?></td>
      <td>
      <div class="dropdown">
                                                                    <a href="" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a data-id="<?php echo $row['item_sale_id']?>" class="btn btnAddQ"><em class="icon ni ni-edit" ></em><span>Add / Deduct Quantity</span></a></li>
                                                                            <li><a data-id="<?php echo $row['item_sale_id']?>" class="btn btnRemoveItem"><em class="icon ni ni-trash"></em><span>Remove Item</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                    </div>
      </td>
    </tr>
    <?php endforeach;?> 
   
  </tbody>
  <tfoot>
    <tr>
        <td colspan=3><b>Total</b></td>
        <td><b><?php echo $totalQuantity;?></b></td>
        <td><b>Ksh <?php echo $totalPrice;?></b></td>
    </tr>
  </tfoot>
</table>


  </div>
                                        
                                        <div class="card-inner">
                                        <a data-id="<?php echo $saleId?>" class="btn btnRecievePayment btn-xl btn-dim btn-primary">Recieve Payment</a>
                                        <a href="#" class="btn btn-xl btn-success">Generate Invoice</a>
                                        <a href="#" class="btn btn-xl btn-danger">Cancel Sale</a>
                                        </div><!-- .card-inner -->

  
                                    </div><!-- .card-inner-group -->

                                </div><!-- .card -->
                                <!-- With Footer Header -->

                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->


<div class="modal fade" tabindex="-1" id="addItemModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
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
        <input type="text" class="form-control" name="txtSaleId" id="txtSaleId" placeholder="Stock" value="<?php echo $saleId;?>" readonly>
    </div>
</div>


            <div class="form-group">
    <label class="form-label" for="default-01">Select Product</label>
    
    <div class="form-control-wrap">
                                                            <select class="form-select" data-search="on" name="txtItem" id="txtItem" placeholder="Select Item">
                                                                <?php foreach($product as $row):?>
                                                                <option value="<?php echo $row['product_sku']?>"><?php echo $row['product_name']?> @ <?php echo $row['sale_price']?></option>
                                                                <?php endforeach;?> 
                                                            </select>
                                                        </div>
</div>

<div class="form-group">
    <label class="form-label" for="default-01">Quantity</label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" name="txtQuantity" id="txtQuantity" placeholder="Quantity">
    </div>
</div>
            </div>
            <div class="modal-footer bg-light">
            <div class="form-group">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
            </div>
</form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="addPaymentModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
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
        <input type="text" class="form-control" name="txtSaleId" id="txtSaleId" placeholder="Stock" value="<?php echo $saleId;?>" readonly>
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="default-01">Amount</label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" name="txtAmount" id="txtAmount" placeholder="Amount">
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

<div class="modal fade" tabindex="-1" id="addQuantityModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
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
        <input type="text" class="form-control" name="txtItemSaleId" id="txtItemSaleId" placeholder="Stock" value="<?php echo $saleId;?>" readonly>
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="default-01">Quantity to Add / Deduct</label>
    <div class="form-control-wrap">
        <input type="text" class="form-control" name="txtQD" id="txtQD" placeholder="Quantity to Add or Deduct">
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

<script>
    $("#QtrChange").validate({
        rules:{
            txtQD: "required",
        },
        messages:{
            txtQD: "You must fill the quantity field. example 40 to add 40 units and -40 for substract 40 units from existing number",
        },
        submitHandler: function(form){
            var form_action = $("#QtrChange").attr("action");
            $.ajax({
                data: $('#QtrChange').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                success: function (res) {
                    var $status =  JSON.stringify(res.status);
                    var $sts = 'false';
                    if ($status < "1"){
                        Swal.fire({
                        icon:'error',
                        title: 'Ooops...',
                        text: JSON.stringify(res.data)
                        })
                    }else{
                        Swal.fire({
                        icon:'success',
                        title: 'Success',
                        text: JSON.stringify(res.data)
                        })
                    }

                },
                error: function (data) {
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
    $("#addPayment").validate({
        rules:{
            txtAmount: "required",
        },
        messages: {
            txtAmount: "Please enter the Amount Paid",
        },
        submitHandler: function(form){
            var form_action = $("#addPayment").attr("action");
            $.ajax({
                data: $('#addPayment').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                success: function (res) {
                    var $status =  JSON.stringify(res.status);
                    var $sts = 'false';
                    if ($status < "1"){
                        Swal.fire({
                        icon:'error',
                        title: 'Ooops...',
                        text: JSON.stringify(res.data)
                        })
                    }else{
                        Swal.fire({
                        icon:'success',
                        title: 'Success',
                        text: JSON.stringify(res.data)
                        })
                    }

                },
                error: function (data) {
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
    $('body').on('click','.btnRemoveItem',function(){
        var item_sale_id = $(this).attr('data-id');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning...',
                            text: 'Do you want to remove item with sale ID '+item_sale_id +' from the Cart',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'YES, Remove This Item',
                            denyButtonText: `NO`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/html/item-sale-id-remove.html/'+item_sale_id,
                                    type: "GET",
                                    dataType: 'json',
                                    success: function (res) {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: 'Product Deleted Successfully',
                                            showConfirmButton: false,
                                            timer: 2500
                                        }).then(()=>{
                                            window.location.href = "/html/sales-new.html/"+<?php echo $saleId;?>;
                                        });
                                    },
                                    error: function (data) {
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
                                            title: 'Action Canceled Successfully',
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                            }
                        })
    });
</script>

<script>
    $("#addItem").validate({
        rules:{
            txtItem: "required",
            txtQuantity: "required",
        },
        messages: {},
        submitHandler: function(form) {
            var form_action = $("#addItem").attr("action");
            $.ajax({
                data: $('#addItem').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                success: function (res) {
                    var $status =  JSON.stringify(res.status);
                    var $sts = 'false';
                    if ($status < "1"){
                        Swal.fire({
                        icon:'error',
                        title: 'Ooops...',
                        text: JSON.stringify(res.data)
                        })
                    }else{
                        Swal.fire({
                        icon:'success',
                        title: 'Success',
                        text: JSON.stringify(res.data)
                        }).then((result) => {
                            if (result.isConfirmed) {
                            $('#addItem')[0].reset();
                                window.location.href = "/html/sales-new.html/"+<?php echo $saleId;?>;
                            } else if (result.isDenied) {
                                window.location.href = "/html/sales-new.html/"+<?php echo $saleId;?>;
                            }
                        })
                    }

                },
                error: function (data) {
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
    $('body').on('click','.btnAddQ',function(){
        var $itemId = $(this).attr('data-id');
        $.ajax({
            url: '/html/item-get-item.html/'+$itemId,
            type: "GET",
            dataType: 'json',
            success: function(res){
                var $status =  JSON.stringify(res.status);                    
                    if ($status < "1"){
                        Swal.fire({
                        icon:'error',
                        title: 'Ooops...',
                        text: JSON.stringify(res.data)
                        })
                    }else{
                        $('#addQuantityModal').modal('show');
                        $('#addQuantityModal #txtItemSaleId').val(res.data.item_sale_id);
                    }
            },
            error: function (data){
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
    $('body').on('click','.btnAddItem',function(){
        var $saleId = $(this).attr('data-id');
        $.ajax({
            url: '/html/sales-add-item.html/'+$saleId,
            type: "GET",
            dataType: 'json',
            success: function (res) {
                var $status =  JSON.stringify(res.status);
                    
                    if ($status < "1"){
                        Swal.fire({
                        icon:'error',
                        title: 'Ooops...',
                        text: JSON.stringify(res.data)
                        })
                    }else{
                        $('#addItemModal').modal('show');
                    }
            },
            error: function (data) {
                Swal.fire({
                            icon:'error',
                            title: 'Ooops...',
                            text: "An error: "+JSON.stringify(data.responseText)+" has occured"
                        })
            }
        });
        
    });
</script>
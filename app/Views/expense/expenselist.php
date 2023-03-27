<!-- content @s -->
<div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Expenses</h3>
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
                                                        <a href="#" data-target="addProduct" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Expense</span></a>
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
                                            


                                        <table class="table table-striped table-hover" id="expenselist">
  <thead>
    <tr>
      <th scope="col">Expense ID</th>
      <th scope="col">Date/Time</th>
      <th scope="col">Description</th>
      <th scope="col">Amount</th>
      <th scope="col">Remarks</th>
      <th scope="col">Action</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach($allexpense as $row):?>
    <tr>
      <td><?php echo $row['expense_ID']?></th>
      <td><span class="tb-sub"><?php echo $row['date']?> - <?php echo $row['time']?></span></td>
      <td><?php echo $row['expense_description']?></td>
      <td><span class="tb-lead">Ksh <?php echo $row['expense_amount']?></span></td>
      <td><?php echo $row['remarks']?></td>
      <td>
      <div class="dropdown">
                                                                    <a href="" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a data-id="<?php echo $row['expense_ID']?>" class="btn btnEditEX"><em class="icon ni ni-edit" ></em><span>Edit Expense</span></a></li>
                                                                            <li><a data-id="<?php echo $row['expense_ID']?>" class="btn btnDeleteEX"><em class="icon ni ni-trash"></em><span>Remove Item</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                    </div>
      </td>
    </tr>
    <?php endforeach;?> 
   
  </tbody>
 
</table>



                                        </div>
                                        <div class="card-inner">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .nk-block -->
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
  </form>
                                    </div>
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
  </form>
    </div>
  </div>
</div>
            <!-- content @e -->
            <!-- Scripts -->
            <script>
                $("#ee").validate({
                    rules:{
                        txtAmount: "required",
                        txtDesc: "required",
                    },
                    messages:{
                        txtAmount: "Amount required",
                        txtDesc: "Description required",
                    },
                    submitHandler: function(form){
                    var form_action = $("#ee").attr("action");
                    $.ajax({
                        data: $('#ee').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        success: function (res) {
                            var $status =  + JSON.stringify(res.status);
                            var $sts = 'false';
                            if ($status < 1){
                                Swal.fire({
                                icon:'error',
                                title: 'Ooops...',
                                text: JSON.stringify(res.data.message)
                                })
                            }else{
                                Swal.fire({
                                icon:'success',
                                title: 'Success',
                                text: JSON.stringify(res.data.message)
                                }).then(()=>{
                                    window.location.href = "/html/expense-list.html";
                                });
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
                $('body').on('click','.btnDeleteEX',function(){
                    var $expenseId = $(this).attr('data-id');
                    Swal.fire({
                            icon: 'warning',
                            title: 'Warning...',
                            text: 'Do you want to remove Expense with ID '+$expenseId +' from the System',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'YES, Remove This Item',
                            denyButtonText: `NO`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/html/expense-remove-item.html/'+ $expenseId,
                                    type: "GET",
                                    dataType: 'json',
                                    success: function (res) {
                                        var $status = + JSON.stringify(res.status);
                                        if ($status < 1) {
                                            Swal.fire({
                                                icon:'error',
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
                                        }).then(()=>{
                                            window.location.href = "/html/expense-list.html";
                                        });                                        
                                        }
                                    },
                                    error: function (data) {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'Failed',
                                            text: JSON.stringify(data.responseText),
                                            
                                        })
                                    }
                                });
                            } else{
                                Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: 'Action Canceled Successfully',
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(()=>{
                                            window.location.href = "/html/expense-list.html";
                                        });
                            }
                        })
                    });
            </script>
            <script>
                $('body').on('click','.btnEditEX',function(){
                    var $expenseId = $(this).attr('data-id');
                    $.ajax({
                        url: '/html/expense-get-item.html/Edit/'+$expenseId,
                        type: "GET",
                        dataType: 'json',
                        success: function(res){
                            var $status =  + JSON.stringify(res.status);
                            if ($status < 1) {
                                Swal.fire({icon:'error',title: 'Ooops...',text: JSON.stringify(res.data.message)})
                            } else {
                                Swal.fire({
                                    icon:'info',
                                    text: JSON.stringify(res.data.message),
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes',
                                    denyButtonText: `No, Not now`,
                                }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        $('#editExpense').modal('show');
                                        $('#editExpense #txtExpID').val(res.data.expense.expense_ID);
                                        $('#editExpense #txtDesc').val(res.data.expense.expense_description);
                                        $('#editExpense #txtAmount').val(res.data.expense.expense_amount);
                                        $('#editExpense #txtRemarks').val(res.data.expense.remarks);
                                    }
                                    else{
                                        Swal.fire('You Canceled the edit process', '', 'info')
                                }   
                            })
                            }
                        },
                        error: function (data){
                            Swal.fire({icon:'error',title: 'Ooops...',text: "An error: "+JSON.stringify(data.responseText)+" has occured"})
                        }
                    });
                });
            </script>
           
            <script>
                $("#addExpense").validate({
                    rules:{
                        txtDesc: "required",
                        txtAmount: "required",
                        txtRemarks: "required",
                    },
                    messages:{
                        txtDesc: "Please enter expense discription",
                        txtAmount: "Please enter Expense Amount in Kenya Shillings",
                        txtRemarks: "Please enter you remarks and any other infomation",
                    },
                    submitHandler: function(form){
            var form_action = $("#addExpense").attr("action");
            $.ajax({
                data: $('#addExpense').serialize(),
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
                        }).then(()=>{
                                        window.location.href = "/html/expense-list.html";
                                    });
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
                $(document).ready( function () {
    $('#expenselist').DataTable();
} );
            </script>
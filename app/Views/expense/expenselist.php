<!-- content @s -->
<?= $this->extend('1layouts/main') ?>

<?= $this->section('cp') ?>



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
                    <table class="table table-striped table-hover datatable-init-export" id="">
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
                            <?php foreach ($allexpense as $row) : ?>
                                <tr>
                                    <td><?php echo $row['expense_ID'] ?></th>
                                    <td><span class="tb-sub"><?php echo $row['date'] ?> - <?php echo $row['time'] ?></span></td>
                                    <td><?php echo $row['expense_description'] ?></td>
                                    <td><span class="tb-lead">Ksh <?php echo $row['expense_amount'] ?></span></td>
                                    <td><?php echo $row['remarks'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a data-id="<?php echo $row['expense_ID'] ?>" class="btn btnEditEX"><em class="icon ni ni-edit"></em><span>Edit Expense</span></a></li>
                                                    <li><a data-id="<?php echo $row['expense_ID'] ?>" class="btn btnDeleteEX"><em class="icon ni ni-trash"></em><span>Remove Item</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-inner">
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
</div>
<!-- content @e -->



<script>
    $('body').on('click', '.btnDeleteEX', function() {
        var $expenseId = $(this).attr('data-id');
        Swal.fire({
            icon: 'warning',
            title: 'Warning...',
            text: 'Do you want to remove Expense with ID ' + $expenseId + ' from the System',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'YES, Remove This Item',
            denyButtonText: `NO`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/html/expense-remove-item.html/' + $expenseId,
                    type: "GET",
                    dataType: 'json',
                    success: function(res) {
                        var $status = +JSON.stringify(res.status);
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
                                window.location.href = "/html/expense-list.html";
                            });
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Failed',
                            text: JSON.stringify(data.responseText),

                        })
                    }
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Action Canceled Successfully',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "/html/expense-list.html";
                });
            }
        })
    });
</script>



<script>
    $('body').on('click', '.btnEditEX', function() {
        var $expenseId = $(this).attr('data-id');
        $.ajax({
            url: '/html/expense-get-item.html/Edit/' + $expenseId,
            type: "GET",
            dataType: 'json',
            success: function(res) {
                var $status = +JSON.stringify(res.status);
                if ($status < 1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooops...',
                        text: JSON.stringify(res.data.message)
                    })
                } else {
                    Swal.fire({
                        icon: 'info',
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
                        } else {
                            Swal.fire('You Canceled the edit process', '', 'info')
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
</script>



<script>
    $(document).ready(function() {
        $('#expenselist').DataTable();
    });
</script>


<!-- Load Modals -->
<?= $this->include('expense/expense_modals') ?>
<!-- End Load Modals -->

<!-- content ends here -->

<?= $this->endSection('cp') ?>
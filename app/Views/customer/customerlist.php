<!-- content @s -->
<?= $this->extend('1layouts/main') ?>

<?= $this->section('cp') ?>

<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Customers</h3>
                <div class="nk-block-des text-soft">
                    <p>You have a total of <?php echo count($allCustomers) ?> customers.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addCustomerModal" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add Customer</span></a>
                            </li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span class="sub-text">Customer Name</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Phone Number</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Loyalty Points</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Credit Balance</span></div>
                            <div class="nk-tb-col nk-tb-col-tools text-right">
                                <span class="sub-text">Action</span>
                            </div>
                        </div><!-- .nk-tb-item -->

                        <?php foreach ($allCustomers as $row) : ?>
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary">
                                            <span><?php echo strtoupper(substr($row['customer_name'], 0, 1)) ?></span>
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead"><?php echo $row['customer_name'] ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount"><?php echo $row['customer_email'] ?? 'N/A' ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span><?php echo $row['phone_number'] ?? 'N/A' ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <span class="badge badge-dim badge-primary"><?php echo $row['loyalty_points'] ?> Pts</span>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <span class="amount">Ksh <?php echo $row['credit_balance'] ?></span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="javascript:void(0)" class="btnEdit" data-id="<?php echo $row['id'] ?>"><em class="icon ni ni-edit"></em><span>Edit Customer</span></a></li>
                                                        <li><a href="javascript:void(0)" class="btnDelete" data-id="<?php echo $row['id'] ?>"><em class="icon ni ni-trash"></em><span>Delete Customer</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .nk-tb-item -->
                        <?php endforeach; ?>
                    </div><!-- .nk-tb-list -->
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>

<!-- Add Modals -->
<?= $this->include('customer/customer_modals') ?>

<script>
    $(document).ready(function() {
        // Edit button click
        $('.btnEdit').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/html/customer/getCustomer/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        $('#editCustomerModal #txtId').val(res.data.id);
                        $('#editCustomerModal #txtName').val(res.data.customer_name);
                        $('#editCustomerModal #txtEmail').val(res.data.customer_email);
                        $('#editCustomerModal #txtPhone').val(res.data.phone_number);
                        $('#editCustomerModal').modal('show');
                    }
                }
            });
        });

        // Delete button click
        $('.btnDelete').on('click', function() {
            var id = $(this).data('id');
            if (confirm("Are you sure you want to delete this customer?")) {
                $.ajax({
                    url: '/html/customer/delete/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 1) {
                            alert(res.message);
                            location.reload();
                        } else {
                            alert(res.message);
                        }
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection('cp') ?>

<!-- Add Customer Modal -->
<div class="modal fade" tabindex="-1" id="addCustomerModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add Customer</h5>
            </div>
            <div class="modal-body">
                <form action="#" id="formAddCustomer" class="form-validate is-alter" novalidate="novalidate">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="txtName">Customer Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="txtName" name="txtName" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="txtEmail">Email Address</label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="txtEmail" name="txtEmail">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="txtPhone">Phone Number</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="txtPhone" name="txtPhone">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit" id="btnSaveCustomer" class="btn btn-primary">Save Customer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Customer Modal -->
<div class="modal fade" tabindex="-1" id="editCustomerModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Edit Customer</h5>
            </div>
            <div class="modal-body">
                <form action="#" id="formEditCustomer" class="form-validate is-alter" novalidate="novalidate">
                    <input type="hidden" id="txtId" name="txtId">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="txtName">Customer Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="txtName" name="txtName" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="txtEmail">Email Address</label>
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="txtEmail" name="txtEmail">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="txtPhone">Phone Number</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="txtPhone" name="txtPhone">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="submit" id="btnUpdateCustomer" class="btn btn-primary">Update Customer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Save Customer
        $('#formAddCustomer').on('submit', function(e) {
            e.preventDefault();
            if ($('#txtName').val() == "") {
                alert("Please enter customer name");
                return;
            }
            $('#btnSaveCustomer').attr('disabled', true).text('Saving...');
            $.ajax({
                url: '/html/customer/add',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res) {
                    $('#btnSaveCustomer').attr('disabled', false).text('Save Customer');
                    if (res.status == 1) {
                        alert(res.message);
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function() {
                    $('#btnSaveCustomer').attr('disabled', false).text('Save Customer');
                    alert("An error occurred. Please try again.");
                }
            });
        });

        // Update Customer
        $('#formEditCustomer').on('submit', function(e) {
            e.preventDefault();
            $('#btnUpdateCustomer').attr('disabled', true).text('Updating...');
            $.ajax({
                url: '/html/customer/update',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res) {
                    $('#btnUpdateCustomer').attr('disabled', false).text('Update Customer');
                    if (res.status == 1) {
                        alert(res.message);
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function() {
                    $('#btnUpdateCustomer').attr('disabled', false).text('Update Customer');
                    alert("An error occurred. Please try again.");
                }
            });
        });
    });
</script>

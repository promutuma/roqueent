<!-- Open Shift Modal -->
<div class="modal fade" tabindex="-1" id="openShiftModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Open Shift / Register</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form id="formOpenShift" class="form-validate is-alter">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label class="form-label" for="txtOpeningFloat">Opening Float (Cash in Drawer)</label>
                        <div class="form-control-wrap">
                            <input type="number" step="0.01" class="form-control" id="txtOpeningFloat" name="txtOpeningFloat" required value="0.00">
                        </div>
                        <p class="text-soft small mt-2">Enter the amount of cash you have in the register at the start of your shift.</p>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnOpenShift" class="btn btn-lg btn-primary btn-block">Open Shift</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Close Shift Modal -->
<div class="modal fade" tabindex="-1" id="closeShiftModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Close Shift / Register Reconciliation</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form id="formCloseShift" class="form-validate is-alter">
                    <?= csrf_field() ?>
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group text-center">
                                <label class="form-label">Shift Identification</label>
                                <div class="amount text-soft small">
                                    ID: #<?= $activeShift['id'] ?? 'N/A' ?><br>
                                    Opened: <?= $activeShift['opening_date'] ?? '' ?> <?= $activeShift['opening_time'] ?? '' ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="txtActualCash">Actual Cash in Drawer</label>
                                <div class="form-control-wrap text-center">
                                    <input type="number" step="0.01" class="form-control form-control-lg" id="txtActualCash" name="txtActualCash" required placeholder="0.00">
                                    <p class="text-soft small">Count all physical cash in your drawer now.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="txtNotes">Shift Notes (Optional)</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" id="txtNotes" name="txtNotes" placeholder="Any discrepancies or notes?"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" id="btnCloseShift" class="btn btn-lg btn-danger btn-block">Close & Reconcile Shift</button>
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
        // Open Shift
        $('#formOpenShift').on('submit', function(e) {
            e.preventDefault();
            $('#btnOpenShift').attr('disabled', true).text('Opening...');
            $.ajax({
                url: '/html/shift/open',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res) {
                    $('#btnOpenShift').attr('disabled', false).text('Open Shift');
                    // Update CSRF token
                    if (res.tn) {
                        $('input[name="csrf_test_name"]').val(res.tn);
                    }
                    if (res.status == 1) {
                        Swal.fire('Success', res.message, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error', res.message || "Failed to open shift.", 'error');
                    }
                },
                error: function(xhr) {
                    $('#btnOpenShift').attr('disabled', false).text('Open Shift');
                    let errorMsg = "An error occurred. Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', errorMsg, 'error');
                }
            });
        });

        // Close Shift
        $('#formCloseShift').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Closing your register will end your shift and finalize the reconciliation.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Close Register'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#btnCloseShift').attr('disabled', true).text('Closing Shift...');
                    $.ajax({
                        url: '/html/shift/close',
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(res) {
                            $('#btnCloseShift').attr('disabled', false).text('Close & Reconcile Shift');
                            // Update CSRF token
                            if (res.tn) {
                                $('input[name="csrf_test_name"]').val(res.tn);
                            }
                            if (res.status == 1) {
                                Swal.fire('Shift Closed', res.message, 'success').then(() => location.reload());
                            } else {
                                Swal.fire('Error', res.message || "Failed to close shift.", 'error');
                            }
                        },
                        error: function(xhr) {
                            $('#btnCloseShift').attr('disabled', false).text('Close & Reconcile Shift');
                            let errorMsg = "An error occurred. Please try again.";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            Swal.fire('Error', errorMsg, 'error');
                        }
                    });
                }
            });
        });
    });
</script>

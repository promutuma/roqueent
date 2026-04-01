<?= $this->extend('1layouts/main') ?>

<?= $this->section('cp') ?>

<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Shift Management</h3>
                <div class="nk-block-des text-soft">
                    <p>Manage your daily cash register and shifts here.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <?php if ($activeShift) : ?>
                    <button data-bs-toggle="modal" data-bs-target="#closeShiftModal" class="btn btn-danger">
                        <em class="icon ni ni-signout"></em><span>Close Shift</span>
                    </button>
                <?php else : ?>
                    <button data-bs-toggle="modal" data-bs-target="#openShiftModal" class="btn btn-primary">
                        <em class="icon ni ni-plus"></em><span>Open New Shift</span>
                    </button>
                <?php endif; ?>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <?php if ($activeShift) : ?>
        <div class="nk-block">
            <div class="row g-gs">
                <div class="col-md-4">
                    <div class="card card-bordered card-full">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-0">
                                <div class="card-title">
                                    <h6 class="subtitle">Current Status</h6>
                                </div>
                            </div>
                            <div class="card-amount">
                                <span class="amount text-success">Active / Open</span>
                            </div>
                            <div class="invest-data">
                                <div class="invest-data-amount g-2">
                                    <div class="invest-data-history">
                                        <div class="title">Opened On</div>
                                        <div class="amount"><?= $activeShift['opening_date'] ?> <?= $activeShift['opening_time'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-bordered card-full">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-0">
                                <div class="card-title">
                                    <h6 class="subtitle">Opening Float</h6>
                                </div>
                            </div>
                            <div class="card-amount">
                                <span class="amount">Ksh <?= number_format($activeShift['opening_float'], 2) ?></span>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-md-4">
                    <div class="card card-bordered card-full">
                        <div class="card-inner text-center">
                            <p class="text-soft mb-2">Ready to finish your day?</p>
                            <button data-bs-toggle="modal" data-bs-target="#closeShiftModal" class="btn btn-lg btn-outline-danger">Close Register</button>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
    <?php else : ?>
        <div class="nk-block">
            <div class="alert alert-warning">
                <div class="alert-cta flex-wrap g-3">
                    <div class="alert-text">
                        <p><strong>Warning:</strong> You do not have an open shift. Please open a shift with an initial float to start recording sales.</p>
                    </div>
                    <div class="alert-actions">
                        <button data-bs-toggle="modal" data-bs-target="#openShiftModal" class="btn btn-warning">Open Shift Now</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Shift History</h5>
            </div>
        </div>
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span class="sub-text">Opening</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Closing</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Float</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Expected Cash</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Actual Cash</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Difference</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Status</span></div>
                        </div><!-- .nk-tb-item -->

                        <?php foreach ($shiftHistory as $row) : ?>
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-amount"><?= $row['opening_date'] ?> <?= $row['opening_time'] ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount"><?= $row['closing_date'] ?? '-' ?> <?= $row['closing_time'] ?? '' ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span>Ksh <?= number_format($row['opening_float'], 2) ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <span>Ksh <?= number_format($row['closing_cash_expected'] ?? 0, 2) ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <span>Ksh <?= number_format($row['closing_cash_actual'] ?? 0, 2) ?></span>
                                </div>
                                <div class="nk-tb-col">
                                    <?php 
                                        $diff = ($row['closing_cash_actual'] ?? 0) - ($row['closing_cash_expected'] ?? 0);
                                        $class = $diff == 0 ? 'text-success' : ($diff > 0 ? 'text-info' : 'text-danger');
                                    ?>
                                    <span class="<?= $class ?> font-weight-bold">Ksh <?= number_format($diff, 2) ?></span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="badge badge-dim <?= $row['status'] == 'Open' ? 'badge-success' : 'badge-light' ?>"><?= $row['status'] ?></span>
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
<?= $this->include('shift/shift_modals') ?>

<?= $this->endSection('cp') ?>

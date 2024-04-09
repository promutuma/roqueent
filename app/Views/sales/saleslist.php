<!-- content @s -->
<?= $this->extend('1layouts/main') ?>

<?= $this->section('cp') ?>



<div class="nk-content-body">
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Sales</h3>
                <div class="nk-block-des text-soft">
                    <p>You have a total of <?php echo $CSales ?> sales.</p>
                </div>
            </div><!-- .nk-block-head-content -->

        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title">All Sales</h5>
                        </div>
                        <div class="card-tools mr-n1">
                            <ul class="btn-toolbar">
                                <li>
                                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                </li><!-- li -->
                                <li class="btn-toolbar-sep"></li><!-- li -->
                                <li>
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                            <em class="icon ni ni-setting"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                            <ul class="link-check">
                                                <li><span>Show</span></li>
                                                <li class="active"><a href="#">10</a></li>
                                                <li><a href="#">20</a></li>
                                                <li><a href="#">50</a></li>
                                            </ul>
                                            <ul class="link-check">
                                                <li><span>Order</span></li>
                                                <li class="active"><a href="#">DESC</a></li>
                                                <li><a href="#">ASC</a></li>
                                            </ul>
                                            <ul class="link-check">
                                                <li><span>Density</span></li>
                                                <li class="active"><a href="#">Regular</a></li>
                                                <li><a href="#">Compact</a></li>
                                            </ul>
                                        </div>
                                    </div><!-- .dropdown -->
                                </li><!-- li -->
                            </ul><!-- .btn-toolbar -->
                        </div><!-- card-tools -->
                        <div class="card-search search-wrap" data-search="search">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input type="text" class="form-control form-control-sm border-transparent form-focus-none" placeholder="Quick search by order id">
                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                            </div>
                        </div><!-- card-search -->
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">


                    <div class="table-responsive">
                        <table class="table datatable-init-export table-orders" id="saleslist">
                            <thead class="tb-odr-head">
                                <tr class="tb-odr-item">
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Sale ID</span>
                                        <span class="tb-odr-date d-none d-md-inline-block">Date & Time</span>
                                    </th>
                                    <th class="tb-odr-amount">
                                        <span class="tb-odr-total">Amount</span>
                                        <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                                    </th>
                                    <th class="tb-odr-action">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody class="tb-odr-body">
                                <?php foreach ($allSales as $row) : ?>
                                    <tr class="tb-odr-item">
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id"><a href="/html/sales-new.html/<?php echo $row['sale_id'] ?>">#<?php echo $row['sale_id'] ?></a></span>
                                            <span class="tb-odr-date"><?php echo $row['sale_date'] ?>, <?php echo $row['sale_time'] ?></span>
                                        </td>
                                        <td class="tb-odr-amount">
                                            <span class="tb-odr-total">
                                                <span class="amount">Ksh <?php echo $row['amount'] ?></span>
                                            </span>
                                            <span class="tb-odr-status">
                                                <span class="badge badge-dot <?php if ($row['sale_status'] == 'Complete') {
                                                                                    echo "badge-success";
                                                                                } elseif ($row['sale_status'] == 'Created') {
                                                                                    echo "badge-danger";
                                                                                } else {
                                                                                    echo "badge-warning";
                                                                                } ?>"><?php echo $row['sale_status'] ?></span>
                                            </span>
                                        </td>
                                        <td class="tb-odr-action">
                                            <div class="tb-odr-btns d-none d-sm-inline">
                                                <a href="/html/sales-new.html/<?php echo $row['sale_id'] ?>" target="_blank" class="btn btn-icon btn-white btn-dim btn-sm btn-primary"><em class="icon ni ni-printer-fill"></em></a>
                                                <a href="/html/sales-new.html/<?php echo $row['sale_id'] ?>" class="btn btn-dim btn-sm btn-primary">View</a>
                                            </div>
                                            <a href="/html/sales-new.html/" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                        </td>
                                    </tr><!-- .tb-odr-item -->
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>


                </div><!-- .card-inner -->

            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>
<!-- content @e -->


<!-- content ends here -->
<?= $this->endSection('cp') ?>
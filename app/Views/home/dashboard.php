            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Dashboard</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>Welcome to DashLite Dashboard Template.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                            <div class="toggle-expand-content" data-content="pageMenu">
                                                <ul class="nk-block-tools g-3">
                                                    <li><a href="#" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                                    <li><a href="#" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                                                    <li class="nk-block-tools-opt">
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="html/user-list-regular.html"><em class="icon ni ni-user-add-fill"></em><span>Add User</span></a></li>
                                                                    <li><a href="html/sales-new.html"><em class="icon ni ni-coin-alt-fill"></em><span>Add Sale</span></a></li>
                                                                    <li><a href="/html/expense-list.html"><em class="icon ni ni-note-add-fill-c"></em><span>Add Expense</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div><!-- .toggle-expand-content -->
                                        </div><!-- .toggle-wrap -->
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="row g-gs">
                                    <div class="col-md-4">
                                        <div class="card card-bordered card-full">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-0">
                                                    <div class="card-title">
                                                        <h6 class="subtitle">Total Sales</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Sales"></em>
                                                    </div>
                                                </div>
                                                <div class="card-amount">
                                                    <span class="amount"><span class="currency currency-usd">KSh</span> 49,595.34 
                                                    </span>
                                                    <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span>
                                                </div>
                                                <div class="invest-data">
                                                    <div class="invest-data-amount g-2">
                                                        <div class="invest-data-history">
                                                            <div class="title">This Month</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> 2,940.59 </div>
                                                        </div>
                                                        <div class="invest-data-history">
                                                            <div class="title">This Week</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> 1,259.28 </div>
                                                        </div>
                                                    </div>
                                                    <div class="invest-data-ck">
                                                        <canvas class="iv-data-chart" id="totalDeposit"></canvas>
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
                                                        <h6 class="subtitle">Total Expense</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Expenses"></em>
                                                    </div>
                                                </div>
                                                <div class="card-amount">
                                                    <span class="amount"><span class="currency currency-usd">KSh</span> 49,595.34 
                                                    </span>
                                                    <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span>
                                                </div>
                                                <div class="invest-data">
                                                    <div class="invest-data-amount g-2">
                                                        <div class="invest-data-history">
                                                            <div class="title">This Month</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> 2,940.59 </div>
                                                        </div>
                                                        <div class="invest-data-history">
                                                            <div class="title">This Week</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> 1,259.28 </div>
                                                        </div>
                                                    </div>
                                                    <div class="invest-data-ck">
                                                        <canvas class="iv-data-chart" id="totalWithdraw"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-md-4">
                                        <div class="card card-bordered  card-full">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-0">
                                                    <div class="card-title">
                                                        <h6 class="subtitle">Total Profit</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Profit"></em>
                                                    </div>
                                                </div>
                                                <div class="card-amount">
                                                    <span class="amount"><span class="currency currency-usd">KSh</span> 79,358.50 
                                                    </span>
                                                </div>
                                                <div class="invest-data">
                                                    <div class="invest-data-amount g-2">
                                                        <div class="invest-data-history">
                                                            <div class="title">This Month</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> 2,940.59 </div>
                                                        </div>
                                                        <div class="invest-data-history">
                                                            <div class="title">This Week</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> 1,259.28 </div>
                                                        </div>
                                                    </div>
                                                    <div class="invest-data-ck">
                                                        <canvas class="iv-data-chart" id="totalBalance"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-md-6 col-xxl-4">
                                        <div class="card card-bordered card-full">
                                            <div class="card-inner">
                                                <div class="card-title-group mb-1">
                                                    <div class="card-title">
                                                        <h6 class="title">Shop Overview</h6>
                                                        <p>The shop overview. <a href="#">Today sales,expenses and users</a></p>
                                                    </div>
                                                </div>
                                                <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#overview">Today</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#thisyear">This Year</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#alltime">All Time</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content mt-0">
                                                    <div class="tab-pane active" id="overview">
                                                        <div class="invest-ov gy-2">
                                                            <div class="subtitle">Shop Count</div>
                                                            <div class="invest-ov-details">
                                                                <div class="invest-ov-info">
                                                                    <div class="amount">49</div>
                                                                    <div class="title">Sales</div>
                                                                </div>
                                                                <div class="invest-ov-stats">
                                                                    <div><span class="amount">56</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                                                    <div class="title">Expenses</div>
                                                                </div>
                                                            </div>
                                                            <div class="invest-ov-details">
                                                                <div class="invest-ov-info">
                                                                    <div class="amount">4 </div>
                                                                    <div class="title">Users</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-ov gy-2">
                                                            <div class="subtitle">Stock</div>
                                                            <div class="invest-ov-details">
                                                                <div class="invest-ov-info">
                                                                    <div class="amount">395 </div>
                                                                    <div class="title">Ice Cream</div>
                                                                </div>
                                                                <div class="invest-ov-stats">
                                                                    <div><span class="amount">23</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                                                    <div class="title">Juice</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="thisyear">
                                                    <div class="invest-ov gy-2">
                                                            <div class="subtitle">Shop Count</div>
                                                            <div class="invest-ov-details">
                                                                <div class="invest-ov-info">
                                                                    <div class="amount">49</div>
                                                                    <div class="title">Sales</div>
                                                                </div>
                                                                <div class="invest-ov-stats">
                                                                    <div><span class="amount">56</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                                                    <div class="title">Expenses</div>
                                                                </div>
                                                            </div>
                                                            <div class="invest-ov-details">
                                                                <div class="invest-ov-info">
                                                                    <div class="amount">4 </div>
                                                                    <div class="title">Users</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-ov gy-2">
                                                            <div class="subtitle">Stock</div>
                                                            <div class="invest-ov-details">
                                                                <div class="invest-ov-info">
                                                                    <div class="amount">395 </div>
                                                                    <div class="title">Ice Cream</div>
                                                                </div>
                                                                <div class="invest-ov-stats">
                                                                    <div><span class="amount">23</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                                                    <div class="title">Juice</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="alltime">
                                                    <div class="invest-ov gy-2">
                                                            <div class="subtitle">Shop Count</div>
                                                            <div class="invest-ov-details">
                                                                <div class="invest-ov-info">
                                                                    <div class="amount">49</div>
                                                                    <div class="title">Sales</div>
                                                                </div>
                                                                <div class="invest-ov-stats">
                                                                    <div><span class="amount">56</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                                                    <div class="title">Expenses</div>
                                                                </div>
                                                            </div>
                                                            <div class="invest-ov-details">
                                                                <div class="invest-ov-info">
                                                                    <div class="amount">4 </div>
                                                                    <div class="title">Users</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-ov gy-2">
                                                            <div class="subtitle">Stock</div>
                                                            <div class="invest-ov-details">
                                                                <div class="invest-ov-info">
                                                                    <div class="amount">395 </div>
                                                                    <div class="title">Ice Cream</div>
                                                                </div>
                                                                <div class="invest-ov-stats">
                                                                    <div><span class="amount">23</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                                                    <div class="title">Juice</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                    

                                    
                                    <div class="col-xl-12 col-xxl-8">
                                        <div class="card card-bordered card-full">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Recent Sales</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="/html/sales-list.html" class="link">View All</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-tb-list">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col"><span>Plan</span></div>
                                                    <div class="nk-tb-col tb-col-sm"><span>Who</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span>Date</span></div>
                                                    <div class="nk-tb-col"><span>Amount</span></div>
                                                    <div class="nk-tb-col tb-col-sm"><span>&nbsp;</span></div>
                                                    <div class="nk-tb-col"><span>&nbsp;</span></div>
                                                </div>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>P2</span>
                                                            </div>
                                                            <span class="tb-sub ml-2">Dimond <span class="d-none d-md-inline">- Daily 8.52% for 14 Days</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs bg-azure-dim">
                                                                <span>VA</span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">Victoria Aguilar</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub">18/10/2019</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub text-success">Completed</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a href="#">Invoice</a></li>
                                                                    <li><a href="#">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>P3</span>
                                                            </div>
                                                            <span class="tb-sub ml-2">Platinam <span class="d-none d-md-inline">- Daily 14.82% for 7 Days</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs bg-purple-dim">
                                                                <span>EH</span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">Emma Henry</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub">18/10/2019</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub text-success">Completed</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a href="#">Invoice</a></li>
                                                                    <li><a href="#">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>P1</span>
                                                            </div>
                                                            <span class="tb-sub ml-2">Silver <span class="d-none d-md-inline">- Daily 4.76% for 21 Days</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs bg-teal-dim">
                                                                <span>AF</span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">Alice Ford</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub">18/10/2019</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub text-success">Completed</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a href="#">Invoice</a></li>
                                                                    <li><a href="#">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>P3</span>
                                                            </div>
                                                            <span class="tb-sub ml-2">Platinam <span class="d-none d-md-inline">- Daily 14.82% for 7 Days</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs bg-orange-dim">
                                                                <span>HW</span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">Harold Walker</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub">18/10/2019</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub text-success">Completed</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a href="#">Invoice</a></li>
                                                                    <li><a href="#">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->

                                    <div class="col-md-6 col-xxl-4">
                                        <div class="card card-bordered card-full">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Recent Activities</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <ul class="card-tools-nav">
                                                            <li><a href="#"><span>Cancel</span></a></li>
                                                            <li class="active"><a href="#"><span>All</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nk-activity">
                                                <li class="nk-activity-item">
                                                    <div class="nk-activity-media user-avatar bg-success"><img src="./images/avatar/c-sm.jpg" alt=""></div>
                                                    <div class="nk-activity-data">
                                                        <div class="label">Keith Jensen requested to Widthdrawl.</div>
                                                        <span class="time">2 hours ago</span>
                                                    </div>
                                                </li>
                                                <li class="nk-activity-item">
                                                    <div class="nk-activity-media user-avatar bg-warning">HS</div>
                                                    <div class="nk-activity-data">
                                                        <div class="label">Harry Simpson placed a Order.</div>
                                                        <span class="time">2 hours ago</span>
                                                    </div>
                                                </li>
                                                <li class="nk-activity-item">
                                                    <div class="nk-activity-media user-avatar bg-azure">SM</div>
                                                    <div class="nk-activity-data">
                                                        <div class="label">Stephanie Marshall got a huge bonus.</div>
                                                        <span class="time">2 hours ago</span>
                                                    </div>
                                                </li>
                                                <li class="nk-activity-item">
                                                    <div class="nk-activity-media user-avatar bg-purple"><img src="./images/avatar/d-sm.jpg" alt=""></div>
                                                    <div class="nk-activity-data">
                                                        <div class="label">Nicholas Carr deposited funds.</div>
                                                        <span class="time">2 hours ago</span>
                                                    </div>
                                                </li>
                                                <li class="nk-activity-item">
                                                    <div class="nk-activity-media user-avatar bg-pink">TM</div>
                                                    <div class="nk-activity-data">
                                                        <div class="label">Timothy Moreno placed a Order.</div>
                                                        <span class="time">2 hours ago</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div><!-- .card -->
                                    </div><!-- .col -->

                                    <div class="col-xl-12 col-xxl-8">
                                        <div class="card card-bordered card-full">
                                            <div class="card-inner border-bottom">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Recent Expenses</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="/html/expense-list.html" class="link">View All</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-tb-list">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col"><span>Plan</span></div>
                                                    <div class="nk-tb-col tb-col-sm"><span>Who</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span>Date</span></div>
                                                    <div class="nk-tb-col"><span>Amount</span></div>
                                                    <div class="nk-tb-col tb-col-sm"><span>&nbsp;</span></div>
                                                    <div class="nk-tb-col"><span>&nbsp;</span></div>
                                                </div>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>P2</span>
                                                            </div>
                                                            <span class="tb-sub ml-2">Dimond <span class="d-none d-md-inline">- Daily 8.52% for 14 Days</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs bg-azure-dim">
                                                                <span>VA</span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">Victoria Aguilar</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub">18/10/2019</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub text-success">Completed</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a href="#">Invoice</a></li>
                                                                    <li><a href="#">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>P3</span>
                                                            </div>
                                                            <span class="tb-sub ml-2">Platinam <span class="d-none d-md-inline">- Daily 14.82% for 7 Days</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs bg-purple-dim">
                                                                <span>EH</span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">Emma Henry</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub">18/10/2019</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub text-success">Completed</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a href="#">Invoice</a></li>
                                                                    <li><a href="#">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>P1</span>
                                                            </div>
                                                            <span class="tb-sub ml-2">Silver <span class="d-none d-md-inline">- Daily 4.76% for 21 Days</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs bg-teal-dim">
                                                                <span>AF</span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">Alice Ford</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub">18/10/2019</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub text-success">Completed</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a href="#">Invoice</a></li>
                                                                    <li><a href="#">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>P3</span>
                                                            </div>
                                                            <span class="tb-sub ml-2">Platinam <span class="d-none d-md-inline">- Daily 14.82% for 7 Days</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs bg-orange-dim">
                                                                <span>HW</span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">Harold Walker</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub">18/10/2019</span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub text-success">Completed</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="#">View</a></li>
                                                                    <li><a href="#">Invoice</a></li>
                                                                    <li><a href="#">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->

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
                                            <p>Welcome to Camera 20 Production Point of Sale Dashboard.</p>
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
                                                    <span class="amount"><span class="currency currency-usd">KSh</span> <?php echo number_format($salesThisToday,2)?>  
                                                    </span>
                                                    <span class="change up text-danger"><em class=""></em>Today</span>
                                                </div>
                                                <div class="invest-data">
                                                    <div class="invest-data-amount g-2">
                                                        <div class="invest-data-history">
                                                            <div class="title">This Month</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> <?php echo number_format($salesThisMonth,2)?> </div>
                                                        </div>
                                                        <div class="invest-data-history">
                                                            <div class="title">This Week</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> <?php echo number_format($salesThisWeek,2)?></div>
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
                                                    <span class="amount"><span class="currency currency-usd">KSh</span> <?php echo number_format($expenseToday,2)?>
                                                    </span>
                                                    <span class="change down text-danger"><em class=""></em>Today</span>
                                                </div>
                                                <div class="invest-data">
                                                    <div class="invest-data-amount g-2">
                                                        <div class="invest-data-history">
                                                            <div class="title">This Month</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> <?php echo number_format($expenseThisMonth,2)?> </div>
                                                        </div>
                                                        <div class="invest-data-history">
                                                            <div class="title">This Week</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> <?php echo number_format($expenseThisWeek,2)?> </div>
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
                                                        <h6 class="subtitle">All Time Totals</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total Profit"></em>
                                                    </div>
                                                </div>
                                                <div class="card-amount">
                                                    <span class="amount"><span class="currency currency-usd">KSh</span> <?php echo number_format($totalProfit,2)?> 
                                                    </span>
                                                    <span class="change up text-info"><em class=""></em>Profit</span>
                                                </div>
                                                <div class="invest-data">
                                                    <div class="invest-data-amount g-2">
                                                        <div class="invest-data-history">
                                                            <div class="title">Expense</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> <?php echo number_format($expenseTotal,2)?></div>
                                                        </div>
                                                        <div class="invest-data-history">
                                                            <div class="title">Sales</div>
                                                            <div class="amount"><span class="currency currency-usd">KSh</span> <?php echo number_format($salesToday,2)?></div>
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
                                                        <p>The shop overview. <a href="">Today sales,expenses and users</a></p>
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
                                                     <!--   <div class="invest-ov gy-2">
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
                                                        </div> -->
                                                        <div class="invest-ov gy-2">
                                                            <div class="subtitle">Stock</div>
                                                            <div class="invest-ov-details">
                                                            <?php foreach($stock as $row):?>
                                                                <div class="invest-ov-info">
                                                                    <div><span class="amount"><?php echo $row['stock']?></span><span class="change down text-info"><em class="icon ni ni-arrow-long-down"></em>0%</span></div>
                                                                    <div class="title"><?php echo $row['product_name']?></div>
                                                                </div>
                                                            <?php endforeach;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="thisyear">
                                                  <!--  <div class="invest-ov gy-2">
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
                                                        </div> -->
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
                                                    <div class="nk-tb-col tb-col-sm"><span>Created By</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span>Date</span></div>
                                                    <div class="nk-tb-col"><span>Total Amount</span></div>
                                                    <div class="nk-tb-col tb-col-sm"><span>&nbsp;</span></div>
                                                    <div class="nk-tb-col"><span>&nbsp;</span></div>
                                                </div>
                                                <?php foreach($sales as $row):?>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>RS</span>
                                                            </div>
                                                            <span class="tb-sub ml-2">SALE<span class="d-none d-md-inline"><?php echo $row['sale_id']?></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs <?php if ($row['sale_id']%4==0) {echo 'bg-azure-dim';}elseif ($row['sale_id']%3==0) {echo 'bg-purple-dim';}elseif ($row['sale_id']%2==0) {echo 'bg-teal-dim';}else{echo 'bg-orange-dim';}?>">
                                                                <span><?php echo substr($row['user_fname'],0,1) ?><?php echo substr($row['user_oname'],0,1) ?></span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead"><?php echo $row['user_fname']?> <?php echo $row['user_oname']?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub"><?php $date=date_create($row['sale_date']." ".$row['sale_time']); echo date_format($date,"D, jS M Y H:i:s (e)")?></span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount"><span>KSh </span><?php echo number_format($row['amount'],2)?></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub <?php if($row['sale_status']=='Complete'){echo "text-success";}elseif($row['sale_status']=='Created'){echo "text-danger";}else{echo "text-warning";}?>"><?php echo $row['sale_status']?></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="/html/sales-new.html/<?php echo $row['sale_id']?>">View</a></li>
                                                                    <li><a href="/html/sales-new.html/<?php echo $row['sale_id']?>">Invoice</a></li>
                                                                    <li><a href="/html/sales-new.html/<?php echo $row['sale_id']?>">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach;?>
                                                
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
                                                            <li><a href=""><span>Cancel</span></a></li>
                                                            <li class="active"><a href=""><span>All</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nk-activity">
                                            <?php foreach($logs as $row):?>
                                                <li class="nk-activity-item">
                                                    <div class="nk-activity-media user-avatar <?php if ($row['session_id']%4==0) {echo 'bg-azure';}elseif ($row['session_id']%3==0) {echo 'bg-warning';}elseif ($row['session_id']%2==0) {echo 'bg-purple';}else{echo 'bg-pink';}?>"><?php echo substr($row['user_fname'],0,1) ?><?php echo substr($row['user_oname'],0,1) ?></div>
                                                    <div class="nk-activity-data">
                                                        <div class="label"><?php echo $row['log_desc']?></div>
                                                        <span class="time"><?php $minutes = ($currentTime-$row['log_id'])/60; if($minutes<120){echo number_format($minutes)." Minutes ago";}elseif($minutes<2880){echo number_format($minutes/60)." Hours ago";}else{echo number_format($minutes/1440)." Days ago";} ?></span>
                                                    </div>
                                                </li>
                                                <?php endforeach;?>                                            
                                
                
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
                                                    <div class="nk-tb-col"><span>Expense</span></div>
                                                    <div class="nk-tb-col tb-col-sm"><span>Added By</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span>Date</span></div>
                                                    <div class="nk-tb-col"><span>Amount</span></div>
                                                    <div class="nk-tb-col tb-col-sm"><span>&nbsp;</span></div>
                                                    <div class="nk-tb-col"><span>&nbsp;</span></div>
                                                </div>

                                                <?php foreach($expense as $row):?>
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="align-center">
                                                            <div class="user-avatar user-avatar-sm bg-light">
                                                                <span>EX</span>
                                                            </div>
                                                            <span class="tb-sub ml-2"><?php echo $row['expense_description']?><span class="d-none d-md-inline"> - <?php echo $row['remarks']?></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="user-card">
                                                            <div class="user-avatar user-avatar-xs <?php if ($row['expense_ID']%4==0) {echo 'bg-azure-dim';}elseif ($row['expense_ID']%3==0) {echo 'bg-purple-dim';}elseif ($row['expense_ID']%2==0) {echo 'bg-teal-dim';}else{echo 'bg-orange-dim';}?>">
                                                                <span><?php echo substr($row['user_fname'],0,1) ?><?php echo substr($row['user_oname'],0,1) ?></span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead"><?php echo $row['user_fname']?> <?php echo $row['user_oname']?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-sub"><?php $date=date_create($row['date']." ".$row['time']); echo date_format($date,"D, jS M Y H:i:s (e)")?></span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub tb-amount"><span>KSh </span><?php echo number_format($row['expense_amount'],2)?></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <span class="tb-sub text-success">Completed</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="">View</a></li>
                                                                    <li><a href="">Invoice</a></li>
                                                                    <li><a href="">Print</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach;?>

                                                
                                                
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

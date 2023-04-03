<!-- content @s -->
<div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="card-aside-wrap">
                                        <div class="card-inner card-inner-lg">
                                            <div class="nk-block-head nk-block-head-lg">
                                                <div class="nk-block-between">
                                                    <div class="nk-block-head-content">
                                                        <h4 class="nk-block-title">Login Activity</h4>
                                                        <div class="nk-block-des">
                                                            <p>Here is your last 20 login activities log. <span class="text-soft"><em class="icon ni ni-info"></em></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head -->
                                            <div class="nk-block card card-bordered">
                                                <table class="table table-ulogs" id="logs" style="width:100%">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="tb-col-os"><span class="overline-title">Browser <span class="d-sm-none">/ IP</span></span></th>
                                                            <th class="tb-col-ip"><span class="overline-title">IP</span></th>
                                                            <th class="tb-col-time"><span class="overline-title">Time</span></th>
                                                            <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($logs as $row):?>
                                                       
                                                        <tr>
                                                            <td class="tb-col-os"><?php echo $row['browser']; ?> <?php echo $row['device']; ?> on <?php echo $row['os_platform']; ?></td>
                                                            <td class="tb-col-ip"><span class="sub-text"><?php echo $row['ip_address']; ?></span></td>
                                                            <td class="tb-col-time"><span class="sub-text"><?php echo $row['date_time']; ?></span></td>
                                                            <td class="tb-col-action"><a href="" class="link-cross mr-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                                                        </tr>

                                                        <?php endforeach;?> 

                                                    </tbody>
                                                </table>
                                            </div><!-- .nk-block-head -->
                                        </div><!-- .card-inner -->
                                      

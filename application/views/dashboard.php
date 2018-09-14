<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">COMPANY</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $totalcompany; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">help</i>
                    </div>
                    <div class="content">
                        <div class="text">PRODUCTS</div>
                        <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $totalproduct; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">CUSTOMERS</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo $totalcustomer; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">STAFF</div>
                        <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?php echo $totauser; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->


        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="header">
                        <h2>Company Orders Today</h2>                        
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order No</th>
                                        <th>Name</th>     
                                        <th>Price</th>                      
                                        <th>Quantity</th>                      
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($companyorder) > 0) {
                                        $i = 1;
                                        foreach ($companyorder as $key => $lists) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo isset($lists['orderno']) ? $lists['orderno'] : ""; ?></td>
                                                <td><?php echo isset($lists['name']) ? $lists['name'] : ""; ?></td>                                                   
                                                <td><?php echo isset($lists['price']) ? $lists['price'] : ""; ?></td>    
                                                <td><?php echo isset($lists['quantity']) ? $lists['quantity'] : ""; ?></td>    
                                                <td><?php echo isset($lists['total_amount']) ? $lists['total_amount'] : ""; ?></td> 
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" align="center">No Records</td>
                                        </tr> 
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
            <!-- Browser Usage -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-teal">
                        <div class="font-bold m-b--35">ORDERS</div>
                        <ul class="dashboard-stat-list">
                            <li>
                                TODAY
                                <span class="pull-right"><b><?php echo $todayorder; ?></b> <small>ORDERS</small></span>
                            </li>
                            <li>
                                YESTERDAY
                                <span class="pull-right"><b><?php echo $yesterdayorder; ?></b> <small>ORDERS</small></span>
                            </li>
                            <li>
                                LAST WEEK
                                <span class="pull-right"><b><?php echo $lastweekorder; ?></b> <small>ORDERS</small></span>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #END# Browser Usage -->
        </div>
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="header">
                        <h2>Customer Orders Today</h2>                        
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order No</th>
                                        <th>Name</th>     
                                        <th>Price</th>                      
                                        <th>Quantity</th>                      
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($customerorder) > 0) {
                                        $j = 1;
                                        foreach ($customerorder as $key => $lists) {
                                            ?>
                                            <tr>
                                                <td><?php echo $j; ?></td>
                                                <td><?php echo isset($lists['orderno']) ? $lists['orderno'] : ""; ?></td>
                                                <td><?php echo isset($lists['name']) ? $lists['name'] : ""; ?></td>                                                   
                                                <td><?php echo isset($lists['price']) ? $lists['price'] : ""; ?></td>    
                                                <td><?php echo isset($lists['quantity']) ? $lists['quantity'] : ""; ?></td>    
                                                <td><?php echo isset($lists['total_amount']) ? $lists['total_amount'] : ""; ?></td> 
                                            </tr>
                                            <?php
                                            $j++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" align="center">No Records</td>
                                        </tr> 
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->            
        </div>
    </div>
</section>
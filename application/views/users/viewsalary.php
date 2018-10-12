<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                View Salary List               
            </h2>
        </div>        
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-6 col-xs-8">
                                <h2>
                                    View Salary List
                                </h2>
                            </div>                             
                        </div>
                    </div>
                    <div class="body">
                        <?php if ($this->session->flashdata('ErrorMessages') != '') { ?>                            
                            <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php echo $this->session->flashdata('ErrorMessages'); ?>
                            </div>
                            <?php
                        }
                        if ($this->session->flashdata('SucMessage') != '') {
                            ?>
                            <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php echo $this->session->flashdata('SucMessage'); ?>
                            </div>                            
                        <?php } ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>                                        
                                        <th>Created On</th>  
                                        <th>Status</th>  
                                        <th>Balance Amount</th>
                                        <th>Debit Amount</th>
                                    </tr>
                                </thead>                                
                                <tbody>
                                    <?php
                                    $debitamount = $balanceamount = 0;
                                    if (count($balance_lists) > 0) {
                                        foreach ($balance_lists as $key => $lists) {
                                            $debitamount += $lists['debitamount'];
                                            $balanceamount += $lists['balanceamount'];
                                            ?>
                                            <tr>
                                                <td><?php echo isset($lists['firstname']) ? $lists['firstname'] . " " . $lists['lastname'] : ""; ?></td>
                                                <td><?php echo isset($lists['created_on']) ? $lists['created_on'] : ""; ?></td>                                            
                                                <td><?php echo (isset($lists['status']) && !empty($lists['status'])) ? 'Paid' : "Un Paid"; ?></td>                                            
                                                <td><?php echo isset($lists['balanceamount']) ? $lists['balanceamount'] : ""; ?></td>
                                                <td><?php echo isset($lists['debitamount']) ? $lists['debitamount'] : ""; ?></td>

                                            </tr>       
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" align="center">No Records Found</td></tr>';
                                    }
                                    ?>
                                    <tr>

                                        <td colspan="4" class="text-right"><b>Total Balance</b></td>
                                        <td class="text-right"><div id="total"><?php echo number_format($balanceamount, 2); ?></div></td>
                                    </tr>
                                    <tr>

                                        <td colspan="4" class="text-right"><b>Total Debit</b></td>
                                        <td class="text-right"><div id="total"><?php echo number_format($debitamount, 2); ?></div></td>
                                    </tr>
                                    <tr>

                                        <td colspan="4" class="text-right"><b>Total Salary Amount</b></td>
                                        <td class="text-right"><div id="total"><?php echo number_format($balanceamount - $debitamount, 2); ?></div></td>
                                    </tr>
                                </tbody>                                
                            </table>   
                            <?php
                            if (count($balance_lists) > 0) {
                                ?>
                            <div class="pull-right"><button onclick="location.href = '<?php echo base_url() . "users/staffsalarypaid/" . $userid; ?>';" type="button" class="btn bg-cyan waves-effect">Submit</button></div>
                                   
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
<link href="<?php echo base_url() . 'assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css'; ?>" rel="stylesheet">

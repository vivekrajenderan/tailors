<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Product Types               
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
                                    Product Types
                                </h2>
                            </div>
                            <div class="col-md-6 col-xs-4">
                                <div class="pull-right"><button onclick="location.href = '<?php echo base_url() . "producttype/add"; ?>';" type="button" class="btn bg-cyan waves-effect">Add Product Type</button></div>
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
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Type Name</th>                      
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                         <th>Product Name</th>
                                        <th>Product Type Name</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($products_lists as $key => $lists) { ?>
                                        <tr>
                                            <td><?php echo isset($lists['productname']) ? $lists['productname'] : ""; ?></td>
                                            <td><?php echo isset($lists['typename']) ? $lists['typename'] : ""; ?></td>
                                            <td>
                                                <a href="<?php echo base_url() . 'producttype/add/' . md5($lists['id']); ?>" title="Edit" ><i class="material-icons" style="font-size: 20px;">edit</i></a>&nbsp;<a href="<?php echo base_url() . 'producttype/delete/' . md5($lists['id']); ?>" title="Delete" onclick="return confirm('Are you sure delete the data?')"><i class="material-icons" style="font-size: 20px;">delete</i></a>
                                            </td>                                        

                                        </tr>       
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
<link href="<?php echo base_url() . 'assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css'; ?>" rel="stylesheet">
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/jquery.dataTables.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/jszip.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js'; ?>"></script>
<script type="text/javascript">
                                    $(function () {
                                        setTimeout(function () {
                                            $('.bg-red').hide('slow');
                                            $('.bg-green').hide('slow');
                                        }, 4000);

                                        $('.js-basic-example').DataTable({
                                            responsive: true
                                        });

                                        //Exportable table
                                        $('.js-exportable').DataTable({
                                            dom: 'Bfrtip',
                                            buttons: [
                                                {
                                                    extend: 'copy',
                                                    exportOptions: {
                                                        columns: ':not(:last-child)',
                                                    }
                                                },
                                                {
                                                    extend: 'csv',
                                                    exportOptions: {
                                                        columns: ':not(:last-child)',
                                                    }
                                                },
                                                {
                                                    extend: 'excel',
                                                    exportOptions: {
                                                        columns: ':not(:last-child)',
                                                    }
                                                },
                                                {
                                                    extend: 'pdf',
                                                    exportOptions: {
                                                        columns: ':not(:last-child)',
                                                    }
                                                },
                                                {
                                                    extend: 'print',
                                                    exportOptions: {
                                                        columns: ':not(:last-child)',
                                                    }
                                                }
                                            ],
                                            "aoColumnDefs": [
                                                {'bSortable': false, 'aTargets': [2]}  //Not sorting the first and last columns

                                            ],
                                        });
                                    });
</script>
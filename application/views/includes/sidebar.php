
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <?php
                $image_name = "no_image.png";
                if ($this->session->userdata('userimage')) {
                    if (file_exists("./upload/users/" .$this->session->userdata('userimage'))) {
                        $image_name = $this->session->userdata('userimage');
                    } 
                }
                ?>
                <img src="<?php echo base_url() . 'upload/users/' . $image_name; ?>" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'); ?></div>
                <div class="email"><?php echo $this->session->userdata('email'); ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo base_url() . 'users/profile'; ?>"><i class="material-icons">person</i>Profile</a></li>
                        <li><a href="<?php echo base_url() . 'users/changepassword'; ?>"><i class="material-icons">lock</i>Change Password</a></li>

                        <li><a href="<?php echo base_url() . 'logout'; ?>"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <?php if ($this->session->userdata('role') == '1') { ?>

                    <li class="active">
                        <a href="<?php echo base_url() . 'dashboard'; ?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Staff</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo base_url() . 'users'; ?>">List</a>
                            </li>                        
<!--                            <li>
                                <a href="<?php echo base_url() . 'users/staffbalance'; ?>">Balance</a>
                            </li>                        -->
                            <li>
                                <a href="<?php echo base_url() . 'users/staffsalary'; ?>">Salary</a>
                            </li>                        
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Customer</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo base_url() . 'customer'; ?>">List</a>
                            </li>                        
                            <li>
                                <a href="<?php echo base_url() . 'Customerorders'; ?>">Order</a>
                            </li>                        
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Company</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo base_url() . 'company'; ?>">List</a>
                            </li>                        
                            <li>
                                <a href="<?php echo base_url() . 'Companyorders'; ?>">Order</a>
                            </li>                        
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Products</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo base_url() . 'products'; ?>">List</a>
                            </li>                        
                            <li>
                                <a href="<?php echo base_url() . 'producttype'; ?>">Type</a>
                            </li>                        
                        </ul>
                    </li>                             
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo base_url() . 'reports/company'; ?>">Company</a>
                            </li>                        
                            <li>
                                <a href="<?php echo base_url() . 'reports/customer'; ?>">Customer</a>
                            </li>                        
<!--                            <li>
                                <a href="<?php echo base_url() . 'reports/staff'; ?>">Staff</a>
                            </li>                        -->
                            <li>
                                <a href="<?php echo base_url() . 'expenses'; ?>">Expenses</a>
                            </li>                        
                            <li>
                                <a href="<?php echo base_url() . 'income'; ?>">Income</a>
                            </li>                        
                            <li>
                                <a href="<?php echo base_url() . 'income/cashonhand'; ?>">Cash On Hand</a>
                            </li>                        
                        </ul>
                    </li>    
                <?php } else { ?>                    
<!--                    <li>
                        <a href="<?php echo base_url() . 'users/staffbalance'; ?>">
                            <i class="material-icons">text_fields</i>
                            <span>Staff Balance</span>
                        </a>
                    </li>                    -->
                    <li class="active">
                        <a href="<?php echo base_url() . 'customer'; ?>">
                            <i class="material-icons">text_fields</i>
                            <span>Customer</span>
                        </a>
                    </li>                                   
                    <li>
                        <a href="<?php echo base_url() . 'customerorders'; ?>">
                            <i class="material-icons">layers</i>
                            <span>Customer Orders</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2018 <a href="javascript:void(0);">Gen IT Design</a>
            </div>            
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->

</section>
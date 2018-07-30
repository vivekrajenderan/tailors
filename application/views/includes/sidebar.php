
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?php echo base_url() . 'assets/images/user.png'; ?>" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'); ?></div>
                <div class="email"><?php echo $this->session->userdata('email'); ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        
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
                <li class="active">
                    <a href="<?php echo base_url() . 'dashboard'; ?>">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'company'; ?>">
                        <i class="material-icons">text_fields</i>
                        <span>Company</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'customer'; ?>">
                        <i class="material-icons">text_fields</i>
                        <span>Customer</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'products'; ?>">
                        <i class="material-icons">layers</i>
                        <span>Products</span>
                    </a>
                </li>                
                <li>
                    <a href="<?php echo base_url() . 'Companyorders'; ?>">
                        <i class="material-icons">layers</i>
                        <span>Company Orders</span>
                    </a>
                </li>                
                <li>
                    <a href="<?php echo base_url() . 'Customerorders'; ?>">
                        <i class="material-icons">layers</i>
                        <span>Customer Orders</span>
                    </a>
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
                    </ul>
                </li>                
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
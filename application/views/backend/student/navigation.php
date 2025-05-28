    <!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span> </div>
                        <!-- /input-group -->
            </li>
            
            <!-- Hide the complete user profile dropdown -->
            <!-- <li class="user-pro">
                        <?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                            if (!file_exists($face_file)) {
                                $face_file = 'uploads/default.jpg';                                 
                            }
                            ?>

                    <a href="#" class="waves-effect"><img src="<?php echo base_url() . $face_file;?>" alt="user-img" class="img-circle"> <span class="hide-menu">

                       <?php 
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                        ?>
                        <span class="fa arrow"></span></span>
                    </a>
                        <ul class="nav nav-second-level">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                            <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                </li> -->

    <li class="enhanced-nav-item"> 
        <a href="<?php echo base_url();?>student/dashboard" class="waves-effect enhanced-nav-link">
            <i class="ti-dashboard p-r-10 enhanced-icon"></i> 
            <span class="hide-menu enhanced-text"><?php echo get_phrase('Dashboard') ;?></span>
        </a> 
    </li>

    <li class="enhanced-nav-item"> 
        <a href="#" class="waves-effect enhanced-nav-link">
            <i data-icon="&#xe006;" class="fa fa-book p-r-10 enhanced-icon"></i> 
            <span class="hide-menu enhanced-text"><?php echo get_phrase('Academics');?><span class="fa arrow"></span></span>
        </a>
        
        <ul class=" nav nav-second-level<?php
            if ($page_name == 'subject' ||
                    $page_name == 'teacher' ||
                    $page_name == 'class_mate' ||
                    $page_name == 'assignment' || $page_name == 'study_material' )
                echo 'opened active';
            ?>">

            <li class="<?php if ($page_name == 'subject') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>student/subject" class="enhanced-sub-link">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                    <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Subject'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>student/teacher" class="enhanced-sub-link">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                    <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Teacher'); ?></span>
                </a>
            </li>

            <!-- Hide Class Mate -->
            <!-- <li class="<?php if ($page_name == 'class_mate') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>student/class_mate" class="enhanced-sub-link">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Class Mate'); ?></span>
                </a>
            </li> -->
                    
            <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>assignment/assignment" class="enhanced-sub-link">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Assignment'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>studymaterial/study_material" class="enhanced-sub-link">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Study Material'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'timetable') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>student/timetable" class="enhanced-sub-link">
                    <i class="fa fa-calendar p-r-10"></i>
                    <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('class_timetable'); ?></span>
                </a>
            </li>
         </ul>
    </li>

    <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> enhanced-nav-item">
        <a href="<?php echo base_url(); ?>student/attendance_report" class="enhanced-nav-link">
            <i class="fa fa-calendar-check-o p-r-10 enhanced-icon"></i>
                <span class="hide-menu enhanced-text"><?php echo get_phrase('Attendance Report'); ?></span>
        </a>
    </li> 

    <!-- Invoice Link Hidden 
    <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> enhanced-nav-item">
        <a href="<?php echo base_url(); ?>student/invoice" class="enhanced-nav-link">
            <i class="fa fa-paypal p-r-10 enhanced-icon"></i>
                <span class="hide-menu enhanced-text"><?php echo get_phrase('Invoice'); ?></span>
        </a>
    </li> 
    -->

    <li class="<?php if ($page_name == 'payment_history') echo 'active'; ?> enhanced-nav-item">
        <a href="<?php echo base_url(); ?>student/payment_history" class="enhanced-nav-link">
            <i class="fa fa-credit-card p-r-10 enhanced-icon"></i>
                <span class="hide-menu enhanced-text"><?php echo get_phrase('Payment History'); ?></span>
        </a>
    </li>               
                            
    <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> enhanced-nav-item enhanced-profile-item">
        <a href="<?php echo base_url(); ?>student/manage_profile" class="enhanced-nav-link">
            <i class="fa fa-cog p-r-10 enhanced-icon"></i>
                <span class="hide-menu enhanced-text"><?php echo get_phrase('manage_profile'); ?></span>
        </a>
    </li>

    <li class="enhanced-nav-item enhanced-logout-item">
        <a href="<?php echo base_url(); ?>login/logout" class="enhanced-nav-link">
            <i class="fa fa-sign-out p-r-10 enhanced-icon"></i>
                <span class="hide-menu enhanced-text"><?php echo get_phrase('Logout'); ?></span>
        </a>
    </li>
                  
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->
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
                            // Create a URL friendly path
                            $face_file_url = base_url() . str_replace('\\', '/', $face_file);
                            ?>

                    <a href="#" class="waves-effect"><img src="<?php echo $face_file_url;?>" alt="user-img" class="img-circle"> <span class="hide-menu">

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
        <a href="<?php echo base_url();?>teacher/dashboard" class="waves-effect enhanced-nav-link">
            <i class="ti-dashboard p-r-10 enhanced-icon"></i> 
            <span class="hide-menu enhanced-text"><?php echo get_phrase('Dashboard') ;?></span>
        </a> 
    </li>

    

    <li class="enhanced-nav-item"> 
        <a href="#" class="waves-effect enhanced-nav-link">
            <i data-icon="&#xe006;" class="fa fa-graduation-cap p-r-10 enhanced-icon"></i> 
            <span class="hide-menu enhanced-text"><?php echo get_phrase('assessment');?><span class="fa arrow"></span></span>
        </a>
        
        <ul class=" nav nav-second-level<?php
            if ($page_name == 'assignment' ||
                    $page_name == 'study_material')
                echo 'opened active';
            ?> ">
                                     

            <li class="<?php if ($page_name == 'assignment') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>assignment/assignment" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                    <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('assignments'); ?></span>
                </a>
            </li>

   

                <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>studymaterial/study_material" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('study_materials'); ?></span>
                </a>
            </li>

     
                 </ul>
        </li>

    <!-- Hide Manage Attendance Section -->
    <!-- <li class="attendance"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-hospital-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('manage_attendance');?><span class="fa arrow"></span></span></a>
        
        <ul class=" nav nav-second-level<?php
            if ($page_name == 'manage_attendance' || $page_name == 'staff_attendance' ||
                $page_name == 'attendance_report')
            echo 'opened active';
            ?>">
                    

                <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>teacher/manage_attendance">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('mark_attendance'); ?></span>
                    </a>
                </li>


                <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>teacher/attendance_report">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('view_attendance'); ?></span>
                    </a>
                </li>


        </ul>
    </li> -->

    <!-- New Attendance Report Section -->
    <li class="<?php if ($page_name == 'teacher_attendance_report') echo 'active'; ?> enhanced-nav-item">
        <a href="<?php echo base_url(); ?>teacher/teacher_attendance_report" class="waves-effect enhanced-nav-link">
            <i class="fa fa-calendar-check-o p-r-10 enhanced-icon"></i>
            <span class="hide-menu enhanced-text"><?php echo get_phrase('attendance_report'); ?></span>
        </a>
    </li>

    <li class="enhanced-nav-item"> 
        <a href="#" class="waves-effect enhanced-nav-link">
            <i data-icon="&#xe006;" class="fa fa-bar-chart-o p-r-10 enhanced-icon"></i> 
            <span class="hide-menu enhanced-text"><?php echo get_phrase('report_cards');?><span class="fa arrow"></span></span>
        </a>
        
        <ul class=" nav nav-second-level<?php
            if ($page_name == 'marks' ||
                    $page_name == 'exam_marks_sms'||
                    $page_name == 'tabulation_sheet')
                echo 'opened active';
            ?>">

        <?php $select_role = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('teacher_id')))->row()->role;?>
        <?php if($select_role == '1'):?>
                    <li class="<?php if ($page_name == 'marks') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>teacher/marks" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('generate_report_card'); ?></span>
                        </a>
                    </li>
        <?php endif;?>
        
        <?php $select_role = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('teacher_id')))->row()->role;?>
        <?php if($select_role == '2'):?>
                    <li class="<?php if ($page_name == 'student_marksheet_subject') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>teacher/student_marksheet_subject" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('subject_teacher'); ?></span>
                        </a>
                    </li>
        <?php endif;?>
     
        </ul>
    </li>

            <li class="<?php if($page_name == 'my_diaries' || $page_name == 'view_diary' || $page_name == 'edit_diary') echo 'active'; ?> enhanced-nav-item">
                <a href="<?php echo base_url(); ?>teacher/my_diaries" class="enhanced-nav-link">
                    <i class="fa fa-book p-r-10 enhanced-icon"></i>
                    <span class="enhanced-text"><?php echo get_phrase('my_diaries'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'my_timetable') echo 'active'; ?> enhanced-nav-item">
                <a href="<?php echo base_url(); ?>teacher/my_timetable" class="enhanced-nav-link">
                    <i class="fa fa-calendar p-r-10 enhanced-icon"></i>
                    <span class="enhanced-text"><?php echo get_phrase('my_schedule'); ?></span>
                </a>
            </li>
                        
            <!-- Move Manage Profile above Logout -->                        
            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> enhanced-nav-item enhanced-profile-item">
                <a href="<?php echo base_url(); ?>teacher/manage_profile" class="enhanced-nav-link">
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
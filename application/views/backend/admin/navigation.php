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

     <!---  Permission for Admin Dashboard starts here ------>
            <li class="enhanced-nav-item"> 
                <a href="<?php echo base_url();?>admin/dashboard" class="waves-effect enhanced-nav-link">
                    <i class="ti-dashboard p-r-10 enhanced-icon"></i> 
                    <span class="hide-menu enhanced-text"><?php echo get_phrase('Dashboard') ;?></span>
                </a> 
            </li>
         
    <!---  Permission for Admin Dashboard ends here ------>
                    
     <!---  Permission for Admin Manage Academics starts here ------>
        <li class="enhanced-nav-item"> 
            <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                <i class="fa fa-mortar-board p-r-10 enhanced-icon" data-icon="7"></i> 
                <span class="hide-menu enhanced-text"> <?php echo get_phrase('Manage Academics');?> <span class="fa arrow"></span></span>
            </a>
                        <ul class=" nav nav-second-level<?php
            if (    $page_name == 'enquiry_category'||
                    $page_name == 'list_enquiry'||
                    $page_name == 'club'||
                    $page_name == 'circular'||
                    $page_name == 'academic_syllabus') echo 'opened active';
            ?> ">
                            
        <!-- Hide Enquiry Category -->
        <!-- <li class="<?php if ($page_name == 'enquiry_category') echo 'active';?> enhanced-sub-item"> 
            <a href="<?php echo base_url();?>admin/enquiry_category" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Equiry Category');?></span>
            </a> 
        </li> -->

        <!-- Hide List Enquiries -->
        <!-- <li class="<?php if ($page_name == 'enquiry') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>admin/list_enquiry" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('list_enquiries'); ?></span>
                </a>
        </li> -->

        <!-- Hide School Clubs -->
        <!-- <li class="<?php if ($page_name == 'club') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>admin/club">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu"><?php echo get_phrase('school_clubs'); ?></span>
                </a>
        </li> -->

        <!-- Hide Manage Circulars -->
        <!-- <li class="<?php if ($page_name == 'circular') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>admin/circular" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                 <span class="hide-menu enhanced-sub-text"> <?php echo get_phrase('manage_circular'); ?></span>
                </a>
        </li> -->

        <!-- Hide Syllabus -->
        <!-- <li class="<?php if ($page_name == 'academic_syllabus') echo 'active'; ?>">
                <a href="<?php echo base_url(); ?>admin/academic_syllabus">
                <i class="fa fa-angle-double-right p-r-10"></i>
                     <span class="hide-menu"><?php echo get_phrase('syllabus'); ?></span>
                </a>
        </li> -->

        <li class="<?php if ($page_name == 'subject') echo 'active'; ?> enhanced-sub-item">
            <a href="<?php echo base_url(); ?>subject/subject" class="enhanced-sub-link">
            <i class="fa fa-angle-double-right p-r-10"></i>
                 <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('subjects'); ?></span>
            </a>
        </li>

        <li class="<?php if ($page_name == 'classes') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>admin/classes" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                     <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('classes'); ?></span>
                </a>
        </li>

        <li class="<?php if ($page_name == 'section') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>admin/section" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                     <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('sections'); ?></span>
                </a>
        </li>

        <li class="<?php if ($page_name == 'class_timetable') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>admin/calendar_timetable" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                     <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('calendar_timetable'); ?></span>
                </a>
        </li>

        <li class="<?php if ($page_name == 'teacher_diaries' || $page_name == 'view_teacher_diary') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>admin/teacher_diaries" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                     <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('teacher_diaries'); ?></span>
                </a>
        </li>
                           
        </ul>
    </li>
     <!---  Permission for Admin Manage Academics ends here ------>

    <!---  Permission for Admin Manage Employee starts here ------>
        <li class="staff enhanced-nav-item"> 
            <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                <i data-icon="&#xe006;" class="fa fa-users p-r-10 enhanced-icon"></i> 
                <span class="hide-menu enhanced-text"><?php echo get_phrase('Manage Employees');?><span class="fa arrow"></span></span>
            </a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'teacher' ||
                    $page_name == 'librarian'||
                    $page_name == 'accountant'||
                    $page_name == 'teacher_attendance' || 
                    $page_name == 'teacher_attendance_report' || 
                    $page_name == 'teacher_attendance_report_view')
                echo 'opened active';
            ?> ">
                        
            <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>admin/teacher" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                     <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('teachers'); ?></span>
                </a>
            </li>

            <!-- Hidden Librarian menu item -->
            <!-- <li class="<?php if ($page_name == 'librarian') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>admin/librarian" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('librarians'); ?></span>
                </a>
            </li> -->

            <!-- Hidden Accountant menu item -->
            <!-- <li class="<?php if ($page_name == 'accountant') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>admin/accountant" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                      <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('accountants'); ?></span>
                </a>
            </li> -->

            <!-- Move Teacher Attendance here from separate section -->
            <li class="<?php if ($page_name == 'teacher_attendance' || $page_name == 'teacher_attendance_report' || $page_name == 'teacher_attendance_report_view') echo 'active'; ?> enhanced-sub-item">
                    <a href="<?php echo base_url(); ?>admin/teacher_attendance" class="enhanced-sub-link">
                    <i class="fa fa-calendar p-r-10"></i>
                         <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('teacher_attendance'); ?></span>
                    </a>
            </li>
        
        </ul>
    </li>
     <!---  Permission for Admin Manage Employee ends here ------>

    <!---  Permission for Admin Manage Student starts here ------>               
        <li class="student enhanced-nav-item"> 
            <a href="#" class="waves-effect enhanced-nav-link">
                <i data-icon="&#xe006;" class="fa fa-graduation-cap p-r-10 enhanced-icon"></i> 
                <span class="hide-menu enhanced-text"><?php echo get_phrase('manage_students');?><span class="fa arrow"></span></span>
            </a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'new_student' ||
                    $page_name == 'student_class' ||
                    $page_name == 'student_information' ||
                    $page_name == 'view_student' ||
                    $page_name == 'searchStudent')
                echo 'opened active has-sub';
            ?> ">
                        
                    <li class="<?php if ($page_name == 'new_student') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/new_student" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('admission_form'); ?></span>
                        </a>
                    </li>
                    
                     <li class="<?php if ($page_name == 'student_information' || $page_name == 'student_information' || $page_name == 'view_student') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/student_information" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('list_students'); ?></span>
                        </a>
                    </li>

    <!-- Hide Student Categories -->
    <!-- <li class="<?php if ($page_name == 'studentCategory') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>studentcategory/studentCategory">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Student Categories'); ?></span>
                        </a>
     </li> -->
     
     <!-- Hide Student House -->
     <!-- <li class="<?php if ($page_name == 'studentHouse') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>studenthouse/studentHouse">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Student House'); ?></span>
                        </a>
     </li> -->
     
     <!-- Hide Student Activity -->
     <!-- <li class="<?php if ($page_name == 'clubActivity') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>activity/clubActivity">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Student Activity'); ?></span>
                        </a>
     </li> -->
     
     <!-- Hide Social Category -->
     <!-- <li class="<?php if ($page_name == 'socialCategory') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>socialcategory/socialCategory">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('Social Category'); ?></span>
                        </a>
     </li> -->
     
     <li class="<?php if ($page_name == 'transfer_certificate' || $page_name == 'transfer_certificate_add' || $page_name == 'transfer_certificate_print') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/transfer_certificate" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Transfer Certificate'); ?></span>
                        </a>
     </li>
        
                 </ul>
    </li>
     <!---  Permission for Admin Manage Student ends here ------>

    <!---  Permission for Admin Student's Attendance starts here ------>
        <li class="attendance enhanced-nav-item"> 
            <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                <i data-icon="&#xe006;" class="fa fa-hospital-o p-r-10 enhanced-icon"></i> 
                <span class="hide-menu enhanced-text"><?php echo get_phrase('students_attendance');?><span class="fa arrow"></span></span>
            </a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'manage_attendance' || $page_name == 'attendance_report')
                echo 'opened active';
            ?>">
                        
                    <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/manage_attendance/<?php echo date("d/m/Y"); ?>" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('mark_attendance'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/attendance_report" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('view_attendance'); ?></span>
                        </a>
                    </li>
                
                 </ul>
                </li>
            <!---  Permission for Admin Student's Attendance ends here ------>

    <!---  Permission for Admin Assessment starts here (changed from Download Page) ------>
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
                  <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('homework'); ?></span>
            </a>
        </li>

    </ul>
    </li>
     <!---  Permission for Admin Assessment ends here ------>

    <!-- Hide Complete Manage Parent Section -->
    <!-- <li class="manage_parent"> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('manage_parents');?><span class="fa arrow"></span></span></a>

                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'parent' ||
                $page_name == 'parent_add' ||
                $page_name == 'parent_edit')
                echo 'opened active';
            ?>">

                 <li class="<?php if ($page_name == 'parent') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/parent">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('parent_list'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'parent_add') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>admin/parent_add">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu"><?php echo get_phrase('add_parent'); ?></span>
                        </a>
                    </li>

                 </ul>
                </li> -->

     <!-- Hide Complete Manage Alumni Section -->
     <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-graduation-cap p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('manage_alumni');?></span></a> </li> -->

                     <li class="collect_fee enhanced-nav-item"> 
                         <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                             <i data-icon="&#xe006;" class="fa fa-paypal p-r-10 enhanced-icon"></i> 
                             <span class="hide-menu enhanced-text"><?php echo get_phrase('fee_collection');?><span class="fa arrow"></span></span>
                         </a>
                        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'income' ||
                        $page_name == 'student_payment'||
                        $page_name == 'view_invoice_details'||
                        $page_name == 'invoice_add'||
                        $page_name == 'list_invoice'||
                        $page_name == 'studentSpecificPaymentQuery'||
                        $page_name == 'student_invoice')
                echo 'opened active';
            ?>">

                 <li class="<?php if ($page_name == 'student_payment') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/student_payment" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('collect_fees'); ?></span>
                        </a>
                    </li>
                    
                     <li class="<?php if ($page_name == 'student_invoice') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/student_invoice" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('manage_invoice'); ?></span>
                        </a>
                    </li>
     
                 </ul>
                </li>
                
                <!-- Hide Complete Expenditure Section -->
                <!-- <li class="enhanced-nav-item"> 
                        <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                            <i data-icon="&#xe006;" class="fa fa-credit-card p-r-10 enhanced-icon"></i> 
                            <span class="hide-menu enhanced-text"><?php echo get_phrase('expenditure');?><span class="fa arrow"></span></span>
                        </a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'expense' ||
                    $page_name == 'expense_category' )
                echo 'opened active';
            ?> ">
                     
                    <li class="<?php if ($page_name == 'expense') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>expense/expense" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('expense'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'expense_category') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>expense/expense_category" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('expense_category'); ?></span>
                        </a>
                    </li>
     
                 </ul>
                </li> -->

        <!-- Hide Complete Manage Messages Section -->
        <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-envelope p-r-10"></i> <span class="hide-menu"> <?php echo get_phrase('manage_messages');?> <span class="fa arrow"></span></span></a>   
            <ul class=" nav nav-second-level<?php
            if ($page_name == 'message') echo 'opened active';
            ?> \">

        <li class="<?php if ($page_name == 'sendEmailMessage') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>emailmessage/sendEmailMessage">
                <i class="fa fa-angle-double-right p-r-10"></i>
                   <span class="hide-menu"><?php echo get_phrase('Send Email Message'); ?></span>
                </a>
        </li>

                 </ul>
                </li> -->
                
            <li class="enhanced-nav-item"> 
                <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                    <i data-icon="&#xe006;" class="fa fa-car p-r-10 enhanced-icon"></i> 
                    <span class="hide-menu enhanced-text"><?php echo get_phrase('manage_transport');?><span class="fa arrow"></span></span>
                </a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'transport' ||
                    $page_name == 'transport_route' ||
                    $page_name == 'vehicle' )
                echo 'opened active';
            ?>">
                
                <li class="<?php if ($page_name == 'transport') echo 'active'; ?> enhanced-sub-item">
                <a href="<?php echo base_url(); ?>transportation/transport" class="enhanced-sub-link">
                <i class="fa fa-angle-double-right p-r-10"></i>
                   <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('transports'); ?></span>
                </a>
            </li>

                    <li class="<?php if ($page_name == 'transport_route') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>transportation/transport_route" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('transport_route'); ?></span>
                        </a>
                    </li>
                    
                     <li class="<?php if ($page_name == 'vehicle') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>transportation/vehicle" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                            <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('manage_vehicle'); ?></span>
                        </a>
                    </li>
     
                 </ul>
                </li>

    <!---  Permission for Admin Manage Examinations starts here ------>
        <li class="enhanced-nav-item"> 
            <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                <i data-icon="&#xe006;" class="fa fa-trophy p-r-10 enhanced-icon"></i> 
                <span class="hide-menu enhanced-text"><?php echo get_phrase('manage_examinations');?><span class="fa arrow"></span></span>
            </a>
        
                        <ul class=" nav nav-second-level<?php
            if ($page_name == 'createExamination' || $page_name == 'marks' || $page_name == 'examQuestion' || $page_name == 'student_marksheet_subject')
                echo 'opened active';
            ?>">
                        
                    <li class="<?php if ($page_name == 'createExamination') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/createExamination" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('manage_exams'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'marks') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/marks" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('student_marks'); ?></span>
                        </a>
                    </li>

                    <li class="<?php if ($page_name == 'student_marksheet_subject') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/student_marksheet_subject" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('marks_by_subject'); ?></span>
                        </a>
                    </li>

                    <!-- Hide Exam Questions -->
                    <!-- <li class="<?php if ($page_name == 'examQuestion') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/examQuestion" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                              <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('exam_questions'); ?></span>
                        </a>
                    </li> -->
                
                 </ul>
                </li>
            <!---  Permission for Admin Manage Examinations ends here ------>

        <li class="enhanced-nav-item"> 
            <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                <i data-icon="&#xe006;" class="fa fa-gears p-r-10 enhanced-icon"></i> 
                <span class="hide-menu enhanced-text"><?php echo get_phrase('system_settings');?> <span class="fa arrow"></span></span>
            </a>
        
        <ul class=" nav nav-second-level<?php
                if ($page_name == 'system_settings' ||
                    $page_name == 'manage_language' ||
                    $page_name == 'paymentSetting' ||
                    $page_name == 'sms_settings')
                    echo 'opened active';
                ?>">  
 
                 <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>systemsetting/system_settings" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('general_settings'); ?></span>
                        </a>
                    </li>

                    <!-- Hide SMS API Settings -->
                    <!-- <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>smssetting/sms_settings" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('manage_sms_api'); ?></span>
                        </a>
                    </li> -->

                    <!-- Hide Language Management -->
                    <!-- <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>admin/manage_language" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('manage_language'); ?></span>
                        </a>
                    </li> -->

                    <!-- Hide Payment Settings -->
                    <!-- <li class="<?php if ($page_name == 'paymentSetting') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>payment/paymentSetting" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Payment Settings'); ?></span>
                        </a>
                    </li> -->
     
                 </ul>
                </li>
                
        <!-- Hide Complete Generate Reports Section -->
        <!-- <li class="enhanced-nav-item"> 
            <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                <i data-icon="&#xe006;" class="fa fa-bar-chart-o p-r-10 enhanced-icon"></i> 
                <span class="hide-menu enhanced-text"><?php echo get_phrase('generate_reports');?><span class="fa arrow"></span></span>
            </a>
        
                        <ul class=" nav nav-second-level">  
   
                <li class="<?php if ($page_name == 'studentPaymentReport') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>report/studentPaymentReport" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Student Payments'); ?></span>
                        </a>
                </li>
                
                <li class="<?php if ($page_name == 'classAttendanceReport') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>report/classAttendanceReport" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Attendance Report'); ?></span>
                        </a>
                </li>
                
                <li class="<?php if ($page_name == 'examMarkReport') echo 'active'; ?> enhanced-sub-item">
                        <a href="<?php echo base_url(); ?>report/examMarkReport" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                             <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('Exam Mark Report'); ?></span>
                        </a>
                </li>
     
                 </ul>
                </li> -->

        <?php $checking_level = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->level;?>

        <li class="enhanced-nav-item"> 
            <a href="javascript:void(0);" class="waves-effect enhanced-nav-link">
                <i data-icon="&#xe006;" class="fa fa-cubes p-r-10 enhanced-icon"></i> 
                <span class="hide-menu enhanced-text"><?php echo get_phrase('role_managements');?><span class="fa arrow"></span></span>
            </a>
        
            <ul class=" nav nav-second-level<?php
                        if ($page_name == 'newAdministrator') echo 'opened active'; ?>">

                        <li class="<?php if ($page_name == 'admin_add') echo 'active'; ?> enhanced-sub-item">
                            <a href="<?php echo base_url(); ?>admin/newAdministrator" class="enhanced-sub-link">
                            <i class="fa fa-angle-double-right p-r-10"></i>
                                 <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('new_admin'); ?></span>
                            </a>
                        </li>
     
                 </ul>
            </li>

        <?php $checking_level = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->level;?>

                        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> enhanced-nav-item enhanced-profile-item">
                            <a href="<?php echo base_url(); ?>admin/manage_profile" class="enhanced-nav-link">
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

        <?php if($this->session->userdata('admin_role') == 1 ):?>
        <li class="enhanced-nav-item"> 
            <a href="#" class="waves-effect enhanced-nav-link">
                <i data-icon="&#xe006;" class="fa fa-certificate p-r-10 enhanced-icon"></i> 
                <span class="hide-menu enhanced-text"><?php echo get_phrase('Certificates');?><span class="fa arrow"></span></span>
            </a>
            <ul class=" nav nav-second-level<?php
            if ($page_name == 'generate_student_idcard' || $page_name == 'generate_teacher_idcard' || $page_name == 'transfer_certificate') echo 'opened active'; ?>">

                <li class="<?php if ($page_name == 'generate_student_idcard') echo 'active'; ?> enhanced-sub-item">
                    <a href="<?php echo base_url(); ?>admin/generate_student_idcard" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                         <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('generate_student_idcard'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'generate_teacher_idcard') echo 'active'; ?> enhanced-sub-item">
                    <a href="<?php echo base_url(); ?>admin/generate_teacher_idcard" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                         <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('generate_teacher_idcard'); ?></span>
                    </a>
                </li>
                
                <li class="<?php if ($page_name == 'transfer_certificate') echo 'active'; ?> enhanced-sub-item">
                    <a href="<?php echo base_url(); ?>admin/transfer_certificate" class="enhanced-sub-link">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                         <span class="hide-menu enhanced-sub-text"><?php echo get_phrase('transfer_certificate'); ?></span>
                    </a>
                </li>

            </ul>
        </li>
        <?php endif;?>
<!--Enhanced Admin Dashboard -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px; margin-bottom: 30px;">
                <div class="text-center">
                    <h2 style="margin: 20px 0; font-weight: 300; font-size: 2.5em;">
                        <i class="fa fa-dashboard" style="margin-right: 15px;"></i>
                        <?php echo get_phrase('Admin Dashboard'); ?>
                    </h2>
                    <p style="font-size: 1.2em; opacity: 0.9; margin-bottom: 20px;">
                        <?php echo get_phrase('Welcome back'); ?>! <?php echo get_phrase('Here is your school overview'); ?>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Statistics Cards -->
<div class="row">
    <!-- Students Card -->
    <div class="col-md-4 col-sm-6">
        <div class="enhanced-stat-card students-card">
            <div class="card-content">
                <div class="icon-section">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <div class="stats-section">
                    <h3 class="stat-number"><?php echo $this->db->count_all_results('student');?></h3>
                    <p class="stat-label"><?php echo get_phrase('Students');?></p>
                    <div class="stat-progress">
                        <div class="progress-bar students-progress"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('admin/student_information'); ?>" class="view-details">
                    <i class="fa fa-eye"></i> <?php echo get_phrase('View Details'); ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Teachers Card -->
    <div class="col-md-4 col-sm-6">
        <div class="enhanced-stat-card teachers-card">
            <div class="card-content">
                <div class="icon-section">
                    <i class="fa fa-users"></i>
                </div>
                <div class="stats-section">
                    <h3 class="stat-number"><?php echo $this->db->count_all_results('teacher');?></h3>
                    <p class="stat-label"><?php echo get_phrase('Teachers');?></p>
                    <div class="stat-progress">
                        <div class="progress-bar teachers-progress"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('admin/teacher'); ?>" class="view-details">
                    <i class="fa fa-eye"></i> <?php echo get_phrase('View Details'); ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Admins Card -->
    <div class="col-md-4 col-sm-6">
        <div class="enhanced-stat-card admins-card">
            <div class="card-content">
                <div class="icon-section">
                    <i class="fa fa-user-secret"></i>
                </div>
                <div class="stats-section">
                    <h3 class="stat-number"><?php echo $this->db->count_all_results('admin');?></h3>
                    <p class="stat-label"><?php echo get_phrase('Admins');?></p>
                    <div class="stat-progress">
                        <div class="progress-bar admins-progress"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('admin/newAdministrator'); ?>" class="view-details">
                    <i class="fa fa-eye"></i> <?php echo get_phrase('View Details'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="row" style="margin-top: 36px;">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-header" style="background: #f8f9fa; padding: 18px; border-radius: 9px 9px 0 0;">
                <h3 style="margin: 0; color: #2c3e50; font-weight: 600;">
                    <i class="fa fa-bolt" style="color: #f39c12; margin-right: 9px;"></i>
                    <?php echo get_phrase('Quick Actions'); ?>
                </h3>
            </div>
            <div class="panel-body" style="padding: 27px;">
                <div class="quick-actions-container">
                    <div class="col-md-2-4">
                        <a href="<?php echo base_url('admin/new_student'); ?>" class="quick-action-btn student-action">
                            <i class="fa fa-user-plus"></i>
                            <span><?php echo get_phrase('Add Student'); ?></span>
                        </a>
                    </div>
                    <div class="col-md-2-4">
                        <a href="<?php echo base_url('admin/teacher'); ?>" class="quick-action-btn teacher-action">
                            <i class="fa fa-plus-circle"></i>
                            <span><?php echo get_phrase('Add Teacher'); ?></span>
                        </a>
                    </div>
                    <div class="col-md-2-4">
                        <a href="<?php echo base_url('admin/manage_attendance/' . date('d/m/Y')); ?>" class="quick-action-btn attendance-action">
                            <i class="fa fa-calendar-check-o"></i>
                            <span><?php echo get_phrase('Mark Student Attendance'); ?></span>
                        </a>
                    </div>
                    <div class="col-md-2-4">
                        <a href="<?php echo base_url('admin/teacher_attendance'); ?>" class="quick-action-btn teacher-attendance-action">
                            <i class="fa fa-calendar-plus-o"></i>
                            <span><?php echo get_phrase('Teacher Attendance'); ?></span>
                        </a>
                    </div>
                    <div class="col-md-2-4">
                        <a href="<?php echo base_url('admin/student_payment'); ?>" class="quick-action-btn payment-action">
                            <i class="fa fa-money"></i>
                            <span><?php echo get_phrase('Collect Fees'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced CSS Styling -->
<style>
.enhanced-stat-card {
    background: #fff;
    border-radius: 13.5px;
    box-shadow: 0 9px 27px rgba(0,0,0,0.1);
    margin-bottom: 27px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: none;
}

.enhanced-stat-card:hover {
    transform: translateY(-9px);
    box-shadow: 0 18px 36px rgba(0,0,0,0.15);
}

.card-content {
    padding: 27px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.icon-section {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.25em;
    color: white;
    margin-right: 18px;
}

.students-card .icon-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.teachers-card .icon-section {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.admins-card .icon-section {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.stats-section {
    flex: 1;
    text-align: right;
}

.stat-number {
    font-size: 2.7em;
    font-weight: 700;
    margin: 0;
    color: #2c3e50;
    line-height: 1;
}

.stat-label {
    font-size: 1.08em;
    color: #7f8c8d;
    margin: 4.5px 0 13.5px 0;
    font-weight: 500;
}

.stat-progress {
    width: 100%;
    height: 3.6px;
    background: #ecf0f1;
    border-radius: 1.8px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    border-radius: 1.8px;
    animation: progressAnimation 2s ease-in-out;
}

.students-progress {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    width: 85%;
}

.teachers-progress {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    width: 70%;
}

.admins-progress {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    width: 60%;
}

@keyframes progressAnimation {
    from { width: 0%; }
}

.card-footer {
    background: #f8f9fa;
    padding: 13.5px 27px;
    border-top: 1px solid #ecf0f1;
}

.view-details {
    color: #7f8c8d;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.view-details:hover {
    color: #2c3e50;
    text-decoration: none;
}

.view-details i {
    margin-right: 7.2px;
}

/* Quick Actions Styling */
.quick-action-btn {
    display: block;
    background: #fff;
    border: 2px solid #ecf0f1;
    border-radius: 9px;
    padding: 22.5px 18px;
    text-align: center;
    text-decoration: none;
    color: #2c3e50;
    transition: all 0.3s ease;
    margin-bottom: 18px;
    box-shadow: 0 4.5px 13.5px rgba(0,0,0,0.05);
}

.quick-action-btn:hover {
    text-decoration: none;
    transform: translateY(-4.5px);
    box-shadow: 0 9px 22.5px rgba(0,0,0,0.1);
}

.quick-action-btn i {
    font-size: 1.8em;
    margin-bottom: 10.8px;
    display: block;
}

.quick-action-btn span {
    font-weight: 600;
    font-size: 0.9em;
}

.student-action:hover {
    border-color: #667eea;
    color: #667eea;
}

.teacher-action:hover {
    border-color: #f093fb;
    color: #f093fb;
}

.attendance-action:hover {
    border-color: #4facfe;
    color: #4facfe;
}

.teacher-attendance-action:hover {
    border-color: #28a745;
    color: #28a745;
}

.payment-action:hover {
    border-color: #f39c12;
    color: #f39c12;
}

/* Custom 5-column layout - FIXED to ensure all 5 in one row */
.col-md-2-4 {
    width: 20% !important;
    float: left;
    position: relative;
    min-height: 1px;
    padding-left: 9px;
    padding-right: 9px;
    box-sizing: border-box;
}

/* Responsive adjustments for 5 columns - more conservative breakpoints */
@media (min-width: 1200px) {
    .col-md-2-4 {
        width: 20% !important;
    }
}

@media (min-width: 992px) and (max-width: 1199px) {
    .col-md-2-4 {
        width: 20% !important;
    }
}

@media (min-width: 768px) and (max-width: 991px) {
    .col-md-2-4 {
        width: 33.333333% !important;
    }
}

@media (max-width: 767px) {
    .col-md-2-4 {
        width: 50% !important;
        margin-bottom: 13.5px;
    }
}

@media (max-width: 480px) {
    .col-md-2-4 {
        width: 100% !important;
        margin-bottom: 13.5px;
    }
    
    .quick-action-btn {
        padding: 18px 13.5px;
    }
    
    .quick-action-btn i {
        font-size: 1.62em;
    }
    
    /* Responsive design for stat cards */
    .card-content {
        flex-direction: column;
        text-align: center;
    }
    
    .icon-section {
        margin-right: 0;
        margin-bottom: 18px;
    }
    
    .stats-section {
        text-align: center;
    }
    
    .stat-number {
        font-size: 2.25em;
    }
}

/* Ensure proper clearfix for the row */
.quick-actions-row:after {
    content: "";
    display: table;
    clear: both;
}

/* Animation for cards */
.enhanced-stat-card {
    animation: slideInUp 0.6s ease-out;
}

.enhanced-stat-card:nth-child(1) { animation-delay: 0.1s; }
.enhanced-stat-card:nth-child(2) { animation-delay: 0.2s; }
.enhanced-stat-card:nth-child(3) { animation-delay: 0.3s; }

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(27px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Additional fixes for proper 5-column layout */
.quick-actions-container {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -9px;
}

.quick-actions-container .col-md-2-4 {
    flex: 0 0 20%;
    max-width: 20%;
    padding: 0 9px;
}

/* Responsive flex adjustments */
@media (max-width: 991px) {
    .quick-actions-container .col-md-2-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

@media (max-width: 767px) {
    .quick-actions-container .col-md-2-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 480px) {
    .quick-actions-container .col-md-2-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
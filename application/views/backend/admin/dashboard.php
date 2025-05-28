<!--Enhanced Admin Dashboard -->
<!-- Smaller, more compact header -->
<div class="row" style="margin-top: 10px; margin-bottom: 15px;">
    <div class="col-md-12">
        <div class="compact-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px; padding: 15px 20px; text-align: center;">
            <h3 style="margin: 0; font-weight: 500; font-size: 1.4em;">
                <i class="fa fa-dashboard" style="margin-right: 10px;"></i>
                <?php echo get_phrase('Admin Dashboard'); ?>
            </h3>
            <p style="font-size: 0.9em; opacity: 0.9; margin: 5px 0 0 0;">
                <?php echo get_phrase('Welcome back'); ?>! <?php echo get_phrase('Here is your school overview'); ?>.
            </p>
        </div>
    </div>
</div>

<!-- Enhanced Statistics Cards -->
<div class="row" style="margin-top: 15px;"> <!-- Reduced top margin -->
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
<div class="row" style="margin-top: 20px;"> <!-- Reduced from 36px -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-header" style="background: #f8f9fa; padding: 12px; border-radius: 8px 8px 0 0;"> <!-- Reduced padding -->
                <h3 style="margin: 0; color: #2c3e50; font-weight: 600; font-size: 1.1em;"> <!-- Reduced font size -->
                    <i class="fa fa-bolt" style="color: #f39c12; margin-right: 8px;"></i>
                    <?php echo get_phrase('Quick Actions'); ?>
                </h3>
            </div>
            <div class="panel-body" style="padding: 20px;"> <!-- Reduced from 27px -->
                <div class="quick-actions-container">
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/new_student'); ?>" class="quick-action-btn student-action">
                            <i class="fa fa-user-plus"></i>
                            <span><?php echo get_phrase('Add Student'); ?></span>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/teacher'); ?>" class="quick-action-btn teacher-action">
                            <i class="fa fa-plus-circle"></i>
                            <span><?php echo get_phrase('Add Teacher'); ?></span>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/manage_attendance/' . date('d/m/Y')); ?>" class="quick-action-btn attendance-action">
                            <i class="fa fa-calendar-check-o"></i>
                            <span><?php echo get_phrase('Mark Student Attendance'); ?></span>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/teacher_attendance'); ?>" class="quick-action-btn teacher-attendance-action">
                            <i class="fa fa-calendar-plus-o"></i>
                            <span><?php echo get_phrase('Teacher Attendance'); ?></span>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/student_payment'); ?>" class="quick-action-btn payment-action">
                            <i class="fa fa-money"></i>
                            <span><?php echo get_phrase('Collect Fees'); ?></span>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo base_url('transportation/transport'); ?>" class="quick-action-btn transport-action">
                            <i class="fa fa-car"></i>
                            <span><?php echo get_phrase('Manage Transport'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced CSS Styling -->
<style>
/* Compact header styling */
.compact-header {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.compact-header:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.enhanced-stat-card {
    background: #fff;
    border-radius: 10px; /* Reduced from 13.5px */
    box-shadow: 0 6px 20px rgba(0,0,0,0.08); /* Reduced shadow */
    margin-bottom: 20px; /* Reduced from 27px */
    overflow: hidden;
    transition: all 0.3s ease;
    border: none;
}

.enhanced-stat-card:hover {
    transform: translateY(-6px); /* Reduced from -9px */
    box-shadow: 0 12px 25px rgba(0,0,0,0.12); /* Reduced shadow */
}

.card-content {
    padding: 20px; /* Reduced from 27px */
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.icon-section {
    width: 60px; /* Reduced from 72px */
    height: 60px; /* Reduced from 72px */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8em; /* Reduced from 2.25em */
    color: white;
    margin-right: 15px; /* Reduced from 18px */
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
    font-size: 2.2em; /* Reduced from 2.7em */
    font-weight: 700;
    margin: 0;
    color: #2c3e50;
    line-height: 1;
}

.stat-label {
    font-size: 0.95em; /* Reduced from 1.08em */
    color: #7f8c8d;
    margin: 3px 0 10px 0; /* Reduced margins */
    font-weight: 500;
}

.stat-progress {
    width: 100%;
    height: 3px; /* Reduced from 3.6px */
    background: #ecf0f1;
    border-radius: 1.5px; /* Reduced from 1.8px */
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    border-radius: 1.5px; /* Reduced from 1.8px */
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
    padding: 10px 20px; /* Reduced from 13.5px 27px */
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
    font-size: 0.9em; /* Reduced font size */
}

.view-details:hover {
    color: #2c3e50;
    text-decoration: none;
}

.view-details i {
    margin-right: 6px; /* Reduced from 7.2px */
}

/* Quick Actions Styling */
.quick-action-btn {
    display: block;
    background: #fff;
    border: 2px solid #ecf0f1;
    border-radius: 8px; /* Reduced from 9px */
    padding: 16px 12px; /* Reduced from 22.5px 18px */
    text-align: center;
    text-decoration: none;
    color: #2c3e50;
    transition: all 0.3s ease;
    margin-bottom: 15px; /* Reduced from 18px */
    box-shadow: 0 3px 10px rgba(0,0,0,0.04); /* Reduced shadow */
}

.quick-action-btn:hover {
    text-decoration: none;
    transform: translateY(-3px); /* Reduced from -4.5px */
    box-shadow: 0 6px 15px rgba(0,0,0,0.08); /* Reduced shadow */
}

.quick-action-btn i {
    font-size: 1.5em; /* Reduced from 1.8em */
    margin-bottom: 8px; /* Reduced from 10.8px */
    display: block;
}

.quick-action-btn span {
    font-weight: 600;
    font-size: 0.8em; /* Reduced from 0.9em */
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

.transport-action:hover {
    border-color: #17a2b8;
    color: #17a2b8;
}

/* Updated 6-column layout for quick actions */
.quick-actions-container {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -8px; /* Reduced from -9px */
}

.quick-actions-container .col-md-2 {
    flex: 0 0 16.666667%; /* 6 columns = 100/6 = 16.67% */
    max-width: 16.666667%;
    padding: 0 8px; /* Reduced from 9px */
}

/* Responsive adjustments for 6 columns */
@media (min-width: 1200px) {
    .quick-actions-container .col-md-2 {
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }
}

@media (min-width: 992px) and (max-width: 1199px) {
    .quick-actions-container .col-md-2 {
        flex: 0 0 33.333333%; /* 3 columns on medium screens */
        max-width: 33.333333%;
    }
}

@media (min-width: 768px) and (max-width: 991px) {
    .quick-actions-container .col-md-2 {
        flex: 0 0 50%; /* 2 columns on tablets */
        max-width: 50%;
    }
}

@media (max-width: 767px) {
    .quick-actions-container .col-md-2 {
        flex: 0 0 50%; /* 2 columns on small screens */
        max-width: 50%;
        margin-bottom: 10px;
    }
}

@media (max-width: 480px) {
    .quick-actions-container .col-md-2 {
        flex: 0 0 100%; /* 1 column on very small screens */
        max-width: 100%;
        margin-bottom: 10px;
    }
    
    .quick-action-btn {
        padding: 14px 10px; /* Reduced padding for mobile */
    }
    
    .quick-action-btn i {
        font-size: 1.3em; /* Reduced icon size for mobile */
    }
    
    /* Responsive design for stat cards */
    .card-content {
        flex-direction: column;
        text-align: center;
        padding: 15px; /* Reduced padding for mobile */
    }
    
    .icon-section {
        margin-right: 0;
        margin-bottom: 12px; /* Reduced from 18px */
    }
    
    .stats-section {
        text-align: center;
    }
    
    .stat-number {
        font-size: 1.8em; /* Reduced from 2.25em */
    }
    
    /* Compact header responsive */
    .compact-header {
        padding: 12px 15px;
    }
    
    .compact-header h3 {
        font-size: 1.2em;
    }
    
    .compact-header p {
        font-size: 0.8em;
    }
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
        transform: translateY(20px); /* Reduced from 27px */
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
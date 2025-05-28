<!--Enhanced Student Dashboard -->
<!-- Welcome Header -->
<div class="row" style="margin-top: 10px; margin-bottom: 20px;">
    <div class="col-md-12">
        <div class="student-welcome-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 12px; padding: 20px 25px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h2 style="margin: 0; font-weight: 600; font-size: 1.8em;">
                <i class="fa fa-graduation-cap" style="margin-right: 12px;"></i>
                <?php echo get_phrase('Student Dashboard'); ?>
            </h2>
            <p style="font-size: 1em; opacity: 0.9; margin: 8px 0 0 0;">
                <?php echo get_phrase('Welcome back'); ?>! <?php echo get_phrase('Here is your academic overview'); ?>.
            </p>
        </div>
    </div>
</div>

<!-- Recent Attendance Section -->
<div class="row" style="margin-bottom: 25px;">
    <div class="col-md-12">
        <div class="student-card attendance-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-calendar-check-o"></i>
                    <?php echo get_phrase('Recent_Attendance');?>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table student-table">
                        <thead>
                            <tr>
                                <th><?php echo get_phrase('Date');?></th>
                                <th><?php echo get_phrase('Day');?></th>
                                <th><?php echo get_phrase('Status');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $current_dt = new DateTime($start_date);
                            $end_dt = new DateTime($today_date);
                            
                            while ($current_dt <= $end_dt):
                                $full_date = $current_dt->format('Y-m-d');
                                $timestamp = $current_dt->getTimestamp();
                                $day_name = date('l', $timestamp);
                                $status = isset($attendance_data[$full_date]) ? $attendance_data[$full_date] : null;
                            ?>
                            <tr>
                                <td><?php echo date('d M Y', $timestamp); ?></td>
                                <td><?php echo get_phrase(strtolower($day_name)); ?></td>
                                <td>
                                    <?php if ($status == '1'): ?>
                                        <span class="status-badge present"><?php echo get_phrase('present');?></span>
                                    <?php elseif ($status == '2'): ?>
                                        <span class="status-badge absent"><?php echo get_phrase('absent');?></span>
                                    <?php elseif ($status == '3'): ?>
                                        <span class="status-badge holiday"><?php echo get_phrase('holiday');?></span>
                                    <?php elseif ($status !== null): ?>
                                        <span class="status-badge info"><?php echo get_phrase('status_') . $status;?></span>
                                    <?php else: ?>
                                        <span class="status-badge undefined"><?php echo get_phrase('undefined');?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php 
                                $current_dt->modify('+1 day');
                            endwhile; 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- School Teachers Section -->
<div class="row" style="margin-bottom: 25px;">
    <div class="col-md-12">
        <div class="student-card teachers-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-users"></i>
                    <?php echo get_phrase('School_Teachers');?>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table student-table">
                        <thead>
                            <tr>
                                <th width="80"><?php echo get_phrase('photo');?></th>
                                <th><?php echo get_phrase('name');?></th>
                                <th><?php echo get_phrase('role');?></th>
                                <th><?php echo get_phrase('email');?></th>
                                <th><?php echo get_phrase('phone');?></th>
                                <th><?php echo get_phrase('gender');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($all_teachers as $row): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']);?>" 
                                         class="teacher-avatar" width="40" height="40">
                                </td>
                                <td class="teacher-name"><?php echo $row['name'];?></td>
                                <td>
                                    <span class="role-badge">
                                        <?php 
                                        if($row['role'] == 1) echo get_phrase('class_teacher');
                                        elseif($row['role'] == 2) echo get_phrase('subject_teacher');
                                        else echo get_phrase('teacher'); 
                                        ?>
                                    </span>
                                </td>
                                <td><?php echo $row['email'] ? $row['email'] : '-';?></td>
                                <td><?php echo $row['phone'] ? $row['phone'] : '-';?></td>
                                <td><?php echo $row['sex'] ? $row['sex'] : '-';?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($all_teachers)): ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; color: #7f8c8d; font-style: italic;">
                                        <?php echo get_phrase('no_teachers_found');?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Payment History Section -->
<div class="row" style="margin-bottom: 25px;">
    <div class="col-md-12">
        <div class="student-card payments-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-credit-card"></i>
                    <?php echo get_phrase('Recent_Payment_History');?>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table student-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('title');?></th>
                                <th><?php echo get_phrase('method');?></th>
                                <th><?php echo get_phrase('amount');?></th>
                                <th><?php echo get_phrase('date');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $count = 1;
                            $currency_symbol = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
                            foreach($recent_payments as $row): 
                        ?>
                            <tr>
                                <td><span class="row-number"><?php echo $count++;?></span></td>
                                <td class="payment-title"><?php echo $row['title'];?></td>
                                <td>
                                    <span class="method-badge">
                                        <?php 
                                            if($row['method'] == 1) echo get_phrase('card');
                                            if($row['method'] == 2) echo get_phrase('cash');
                                            if($row['method'] == 3) echo get_phrase('cheque');
                                            if($row['method'] == 'paypal') echo get_phrase('paypal');
                                        ?>
                                    </span>
                                </td>
                                <td class="payment-amount"><?php echo $currency_symbol; ?><?php echo $row['amount'];?></td>
                                <td><?php echo date('d M, Y', $row['timestamp']);?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($recent_payments)): ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: #7f8c8d; font-style: italic;">
                                    <?php echo get_phrase('no_recent_payments_found');?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced CSS Styling -->
<style>
/* Welcome Header Animation */
.student-welcome-header {
    transition: all 0.3s ease;
    animation: slideInDown 0.6s ease-out;
}

.student-welcome-header:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Student Card Styling */
.student-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    margin-bottom: 25px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: none;
    animation: slideInUp 0.6s ease-out;
}

.student-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}

/* Card Headers */
.card-header {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    padding: 20px 25px;
    border-bottom: none;
}

.teachers-card .card-header {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.payments-card .card-header {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

.card-title {
    margin: 0;
    font-size: 1.4em;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.card-title i {
    margin-right: 12px;
    font-size: 1.2em;
}

.card-body {
    padding: 25px;
}

/* Table Styling */
.student-table {
    margin-bottom: 0;
    border: none;
}

.student-table thead th {
    background: #f8f9fa;
    border: none;
    color: #2c3e50;
    font-weight: 600;
    padding: 15px 12px;
    font-size: 0.9em;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.student-table tbody td {
    border: none;
    padding: 15px 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
}

.student-table tbody tr:hover {
    background: #f8f9fa;
    transform: scale(1.01);
    transition: all 0.2s ease;
}

/* Status Badges */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8em;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.present {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.status-badge.absent {
    background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
    color: white;
}

.status-badge.holiday {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
}

.status-badge.info {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
    color: white;
}

.status-badge.undefined {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
}

/* Teacher Avatar */
.teacher-avatar {
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.teacher-avatar:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

.teacher-name {
    font-weight: 600;
    color: #2c3e50;
}

/* Role Badge */
.role-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 0.8em;
    font-weight: 500;
}

/* Method Badge */
.method-badge {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 0.8em;
    font-weight: 500;
}

/* Row Number */
.row-number {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    padding: 4px 8px;
    border-radius: 50%;
    font-size: 0.8em;
    font-weight: 600;
    min-width: 25px;
    text-align: center;
    display: inline-block;
}

.payment-title {
    font-weight: 600;
    color: #2c3e50;
}

.payment-amount {
    font-weight: 700;
    color: #28a745;
    font-size: 1.1em;
}

/* Animation for cards */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.attendance-card { animation-delay: 0.1s; }
.teachers-card { animation-delay: 0.2s; }
.payments-card { animation-delay: 0.3s; }

/* Responsive Design */
@media (max-width: 768px) {
    .student-welcome-header {
        padding: 15px 20px;
    }
    
    .student-welcome-header h2 {
        font-size: 1.4em;
    }
    
    .card-header {
        padding: 15px 20px;
    }
    
    .card-title {
        font-size: 1.2em;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .student-table thead th,
    .student-table tbody td {
        padding: 10px 8px;
        font-size: 0.85em;
    }
    
    .teacher-avatar {
        width: 30px;
        height: 30px;
    }
}

/* Table Responsive Improvements */
.table-responsive {
    border-radius: 8px;
    overflow: hidden;
}

/* Hover Effects for Interactive Elements */
.status-badge,
.role-badge,
.method-badge,
.row-number {
    transition: all 0.3s ease;
}

.status-badge:hover,
.role-badge:hover,
.method-badge:hover,
.row-number:hover {
    transform: scale(1.05);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
</style>
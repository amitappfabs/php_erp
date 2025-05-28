<?php 
// Get current year for dropdown
$current_year = date('Y'); 
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> 
                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo get_phrase('Select Report Month/Year');?>
            </div>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'student/attendance_report/', array('class' => 'form-horizontal', 'method' => 'post')); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="month" class="control-label"><?php echo get_phrase('Month'); ?>:</label>
                                <select name="month" class="form-control" id="month">
                                    <?php for ($m = 1; $m <= 12; $m++): ?>
                                        <option value="<?php echo $m; ?>" <?php if ($month == $m) echo 'selected'; ?> >
                                            <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="year" class="control-label"><?php echo get_phrase('Year'); ?>:</label>
                                <select name="year" class="form-control" id="year">
                                    <?php for ($y = $current_year; $y >= $current_year - 5; $y--): ?>
                                        <option value="<?php echo $y; ?>" <?php if ($year == $y) echo 'selected'; ?> >
                                            <?php echo $y; ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" style="visibility: hidden;">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-info btn-lg" style="padding: 10px 25px;">
                                        <i class="fa fa-search"></i> <?php echo get_phrase('View Report'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php 
// Only show table if month and year are set (form submitted or default used)
if (!empty($month) && !empty($year)):
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> 
                <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('Attendance for') . ' ' . date('F Y', mktime(0, 0, 0, $month, 1, $year)); ?>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped student-attendance-table">
                        <thead>
                            <tr>
                                <th><?php echo get_phrase('Date');?></th>
                                <th><?php echo get_phrase('Day');?></th>
                                <th><?php echo get_phrase('Status');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            for ($i = 1; $i <= $days_in_month; $i++):
                                $full_date = $year . '-' . sprintf('%02d', $month) . '-' . sprintf('%02d', $i);
                                $timestamp = strtotime($full_date);
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
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="attendance-summary">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="summary-card present-summary">
                                    <i class="fa fa-check-circle"></i>
                                    <div class="summary-content">
                                        <h4><?php echo $total_present; ?></h4>
                                        <p><?php echo get_phrase('Total Present');?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary-card absent-summary">
                                    <i class="fa fa-times-circle"></i>
                                    <div class="summary-content">
                                        <h4><?php echo $total_absent; ?></h4>
                                        <p><?php echo get_phrase('Total Absent');?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Enhanced CSS for Attendance Report -->
<style>
/* Form styling improvements */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.form-control {
    border-radius: 6px;
    border: 2px solid #e9ecef;
    padding: 10px 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Button styling */
.btn-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-info:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

/* Panel improvements */
.panel {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: none;
    margin-bottom: 25px;
}

.panel-heading {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px 10px 0 0;
    padding: 15px 20px;
    font-weight: 600;
}

.panel-body {
    padding: 25px;
}

/* Table styling */
.student-attendance-table {
    margin-bottom: 0;
    border-radius: 8px;
    overflow: hidden;
}

.student-attendance-table thead th {
    background: #f8f9fa;
    border: none;
    color: #2c3e50;
    font-weight: 600;
    padding: 15px 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9em;
}

.student-attendance-table tbody td {
    border: none;
    padding: 15px 12px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
}

.student-attendance-table tbody tr:hover {
    background: #f8f9fa;
    transition: all 0.2s ease;
}

/* Status badges - reuse from dashboard */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8em;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
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

.status-badge:hover {
    transform: scale(1.05);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

/* Summary cards */
.attendance-summary {
    margin-top: 25px;
}

.summary-card {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    margin-bottom: 15px;
}

.summary-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
}

.present-summary {
    border-left: 5px solid #28a745;
}

.absent-summary {
    border-left: 5px solid #dc3545;
}

.summary-card i {
    font-size: 2.5em;
    margin-right: 20px;
}

.present-summary i {
    color: #28a745;
}

.absent-summary i {
    color: #dc3545;
}

.summary-content h4 {
    margin: 0;
    font-size: 2em;
    font-weight: 700;
    color: #2c3e50;
}

.summary-content p {
    margin: 5px 0 0 0;
    color: #7f8c8d;
    font-weight: 500;
}

/* Responsive design */
@media (max-width: 768px) {
    .panel-body {
        padding: 15px;
    }
    
    .summary-card {
        padding: 15px;
        flex-direction: column;
        text-align: center;
    }
    
    .summary-card i {
        margin-right: 0;
        margin-bottom: 10px;
        font-size: 2em;
    }
    
    .student-attendance-table thead th,
    .student-attendance-table tbody td {
        padding: 10px 8px;
        font-size: 0.85em;
    }
}
</style> 
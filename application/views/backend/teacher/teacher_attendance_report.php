<?php
$teacher_id = $this->session->userdata('teacher_id');
$current_month = date('Y-m');
$current_year = date('Y');

// Get attendance data for current month
$attendance_data = array();
$total_present = 0;
$total_absent = 0;
$total_late = 0;
$total_half_day = 0;
$total_days = 0;

try {
    if($this->db->table_exists('teacher_attendance')) {
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('date >=', $current_month.'-01');
        $this->db->where('date <=', $current_month.'-31');
        $this->db->order_by('date', 'DESC');
        $attendance_data = $this->db->get('teacher_attendance')->result_array();
        
        // Calculate statistics
        foreach($attendance_data as $record) {
            $total_days++;
            switch($record['status']) {
                case 1: $total_present++; break;
                case 2: $total_absent++; break;
                case 3: $total_late++; break;
                case 4: $total_half_day++; break;
            }
        }
    }
} catch (Exception $e) {
    // Handle database errors
}

// Get teacher information
$teacher_info = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-calendar-check-o"></i>&nbsp;
                <?php echo get_phrase('teacher_attendance_report'); ?>
                <div class="pull-right">
                    <button class="btn btn-success btn-sm" onclick="printDiv('attendance_report')">
                        <i class="fa fa-print"></i> <?php echo get_phrase('print'); ?>
                    </button>
                </div>
            </div>
            <div class="panel-body" id="attendance_report">
                
                <!-- Header Information -->
                <div class="row m-b-30">
                    <div class="col-md-6">
                        <h4><strong><?php echo get_phrase('teacher_name'); ?>:</strong> <?php echo $teacher_info->name; ?></h4>
                        <p><strong><?php echo get_phrase('employee_id'); ?>:</strong> <?php echo $teacher_info->teacher_id; ?></p>
                        <p><strong><?php echo get_phrase('email'); ?>:</strong> <?php echo $teacher_info->email; ?></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4><strong><?php echo get_phrase('month'); ?>:</strong> <?php echo date('F Y'); ?></h4>
                        <p><strong><?php echo get_phrase('report_generated_on'); ?>:</strong> <?php echo date('d M Y, h:i A'); ?></p>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row m-b-30">
                    <div class="col-md-3">
                        <div class="white-box text-center">
                            <div class="stats-icon bg-success" style="width: 60px; height: 60px; margin: 0 auto 15px;">
                                <i class="fa fa-check-circle" style="font-size: 24px; line-height: 60px;"></i>
                            </div>
                            <h3 class="text-success"><?php echo $total_present; ?></h3>
                            <p class="text-muted"><?php echo get_phrase('present_days'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="white-box text-center">
                            <div class="stats-icon bg-danger" style="width: 60px; height: 60px; margin: 0 auto 15px;">
                                <i class="fa fa-times-circle" style="font-size: 24px; line-height: 60px;"></i>
                            </div>
                            <h3 class="text-danger"><?php echo $total_absent; ?></h3>
                            <p class="text-muted"><?php echo get_phrase('absent_days'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="white-box text-center">
                            <div class="stats-icon bg-warning" style="width: 60px; height: 60px; margin: 0 auto 15px;">
                                <i class="fa fa-clock-o" style="font-size: 24px; line-height: 60px;"></i>
                            </div>
                            <h3 class="text-warning"><?php echo $total_late; ?></h3>
                            <p class="text-muted"><?php echo get_phrase('late_days'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="white-box text-center">
                            <div class="stats-icon bg-info" style="width: 60px; height: 60px; margin: 0 auto 15px;">
                                <i class="fa fa-adjust" style="font-size: 24px; line-height: 60px;"></i>
                            </div>
                            <h3 class="text-info"><?php echo $total_half_day; ?></h3>
                            <p class="text-muted"><?php echo get_phrase('half_days'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Attendance Table -->
                <div class="white-box">
                    <h4 class="box-title m-b-20">
                        <i class="fa fa-list"></i> <?php echo get_phrase('detailed_attendance_record'); ?>
                    </h4>
                    
                    <?php if(!empty($attendance_data)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo get_phrase('date'); ?></th>
                                    <th><?php echo get_phrase('day'); ?></th>
                                    <th><?php echo get_phrase('status'); ?></th>
                                    <th><?php echo get_phrase('remarks'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($attendance_data as $record): 
                                    $date = $record['date'];
                                    $day_name = date('l', strtotime($date));
                                    $formatted_date = date('d M, Y', strtotime($date));
                                    
                                    $status_class = '';
                                    $status_text = '';
                                    $status_icon = '';
                                    
                                    switch($record['status']) {
                                        case 1:
                                            $status_class = 'success';
                                            $status_text = get_phrase('present');
                                            $status_icon = 'fa-check-circle';
                                            break;
                                        case 2:
                                            $status_class = 'danger';
                                            $status_text = get_phrase('absent');
                                            $status_icon = 'fa-times-circle';
                                            break;
                                        case 3:
                                            $status_class = 'warning';
                                            $status_text = get_phrase('late');
                                            $status_icon = 'fa-clock-o';
                                            break;
                                        case 4:
                                            $status_class = 'info';
                                            $status_text = get_phrase('half_day');
                                            $status_icon = 'fa-adjust';
                                            break;
                                        default:
                                            $status_class = 'default';
                                            $status_text = get_phrase('not_marked');
                                            $status_icon = 'fa-question-circle';
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $formatted_date; ?></td>
                                    <td><?php echo $day_name; ?></td>
                                    <td>
                                        <span class="label label-<?php echo $status_class; ?>">
                                            <i class="fa <?php echo $status_icon; ?>"></i> 
                                            <?php echo $status_text; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php 
                                        if($record['status'] == 2) {
                                            echo '<span class="text-muted">'.get_phrase('absent_on_this_day').'</span>';
                                        } elseif($record['status'] == 3) {
                                            echo '<span class="text-muted">'.get_phrase('arrived_late').'</span>';
                                        } elseif($record['status'] == 4) {
                                            echo '<span class="text-muted">'.get_phrase('worked_half_day').'</span>';
                                        } else {
                                            echo '<span class="text-muted">'.get_phrase('regular_attendance').'</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info text-center">
                        <i class="fa fa-info-circle"></i> 
                        <?php echo get_phrase('no_attendance_records_found_for_this_month'); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Summary -->
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h4 class="box-title"><?php echo get_phrase('attendance_summary'); ?></h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong><?php echo get_phrase('total_working_days'); ?>:</strong> <?php echo $total_days; ?></p>
                                    <p><strong><?php echo get_phrase('present_days'); ?>:</strong> <?php echo $total_present; ?></p>
                                    <p><strong><?php echo get_phrase('absent_days'); ?>:</strong> <?php echo $total_absent; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong><?php echo get_phrase('late_arrivals'); ?>:</strong> <?php echo $total_late; ?></p>
                                    <p><strong><?php echo get_phrase('half_days'); ?>:</strong> <?php echo $total_half_day; ?></p>
                                    <p><strong><?php echo get_phrase('attendance_percentage'); ?>:</strong> 
                                        <?php 
                                        $percentage = $total_days > 0 ? round(($total_present / $total_days) * 100, 2) : 0;
                                        echo $percentage . '%';
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.white-box {
    background: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.box-title {
    margin-bottom: 20px;
    font-size: 18px;
    font-weight: 600;
    color: #333;
}

.stats-icon {
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.bg-success { background-color: #5cb85c; }
.bg-danger { background-color: #d9534f; }
.bg-warning { background-color: #f0ad4e; }
.bg-info { background-color: #5bc0de; }

.label {
    display: inline-block;
    padding: 4px 8px;
    font-size: 11px;
    font-weight: bold;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 3px;
}

.label-success { background-color: #5cb85c; }
.label-danger { background-color: #d9534f; }
.label-warning { background-color: #f0ad4e; }
.label-info { background-color: #5bc0de; }
.label-default { background-color: #777; }

.m-b-30 { margin-bottom: 30px; }
.m-t-30 { margin-top: 30px; }
.m-b-20 { margin-bottom: 20px; }

@media print {
    .panel-heading .pull-right {
        display: none;
    }
    .white-box {
        box-shadow: none;
        border: 1px solid #ddd;
    }
}
</style>

<!-- Print Function -->
<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
}
</script> 
 <!--row -->
 <div class="row">
    <!-- Recent Attendance Section -->
    <div class="col-md-8">
                        <div class="white-box">
            <h3 class="box-title m-b-20">
                <i class="fa fa-calendar-check-o text-primary"></i> 
                <?php echo get_phrase('my_recent_attendance'); ?>
            </h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('day'); ?></th>
                            <th><?php echo get_phrase('status'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Get current teacher ID from session
                        $teacher_id = $this->session->userdata('teacher_id');
                        
                        // Get last 3 days attendance
                        for($i = 0; $i < 3; $i++) {
                            $date = date('Y-m-d', strtotime('-'.$i.' days'));
                            $day_name = date('l', strtotime($date));
                            $formatted_date = date('d M, Y', strtotime($date));
                            
                            // Check attendance for this date - with error handling
                            $attendance = null;
                            try {
                                if($this->db->table_exists('teacher_attendance')) {
                                    $attendance = $this->db->get_where('teacher_attendance', array(
                                        'teacher_id' => $teacher_id,
                                        'date' => $date
                                    ))->row();
                                }
                            } catch (Exception $e) {
                                // Ignore database errors for now
                            }
                            
                            $status_class = '';
                            $status_text = '';
                            $status_icon = '';
                            
                            if($attendance) {
                                switch($attendance->status) {
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
                            } else {
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
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                                </div>
            <div class="text-right">
                <a href="<?php echo base_url('teacher/teacher_attendance_view'); ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-eye"></i> <?php echo get_phrase('view_full_attendance'); ?>
                </a>
                            </div>
                        </div>
                    </div>

    <!-- Quick Stats Section -->
    <div class="col-md-4">
                        <div class="white-box">
            <h3 class="box-title m-b-20">
                <i class="fa fa-tachometer text-info"></i> 
                <?php echo get_phrase('quick_stats'); ?>
            </h3>
            
            <!-- Total Diaries -->
            <div class="stats-item m-b-15">
                <div class="stats-icon bg-primary">
                    <i class="fa fa-book"></i>
                                </div>
                <div class="stats-content">
                    <h4 class="stats-number">
                        <?php 
                        $total_diaries = 0;
                        try {
                            if($this->db->table_exists('teacher_diary')) {
                                $total_diaries = $this->db->get_where('teacher_diary', array('teacher_id' => $teacher_id))->num_rows();
                            }
                        } catch (Exception $e) {
                            // Ignore database errors
                        }
                        echo $total_diaries;
                        ?>
                    </h4>
                    <span class="stats-label"><?php echo get_phrase('total_diaries'); ?></span>
                            </div>
                        </div>

            <!-- This Month Diaries -->
            <div class="stats-item m-b-15">
                <div class="stats-icon bg-success">
                    <i class="fa fa-calendar"></i>
                    </div>
                <div class="stats-content">
                    <h4 class="stats-number">
                        <?php 
                        $month_diaries = 0;
                        try {
                            if($this->db->table_exists('teacher_diary')) {
                                $this_month = date('Y-m');
                                $month_diaries = $this->db->where('teacher_id', $teacher_id)
                                                         ->where('date >=', $this_month.'-01')
                                                         ->where('date <=', $this_month.'-31')
                                                         ->get('teacher_diary')->num_rows();
                            }
                        } catch (Exception $e) {
                            // Ignore database errors
                        }
                        echo $month_diaries;
                        ?>
                    </h4>
                    <span class="stats-label"><?php echo get_phrase('this_month_diaries'); ?></span>
                        </div>
                    </div>
                    
            <!-- Attendance This Month -->
            <div class="stats-item">
                <div class="stats-icon bg-warning">
                    <i class="fa fa-user-check"></i>
                </div>
                <div class="stats-content">
                    <h4 class="stats-number">
                                    <?php 
                        $present_days = 0;
                        try {
                            if($this->db->table_exists('teacher_attendance')) {
                                $this_month = date('Y-m');
                                $present_days = $this->db->where('teacher_id', $teacher_id)
                                                         ->where('status', 1)
                                                         ->where('date >=', $this_month.'-01')
                                                         ->where('date <=', $this_month.'-31')
                                                         ->get('teacher_attendance')->num_rows();
                            }
                        } catch (Exception $e) {
                            // Ignore database errors
                        }
                        echo $present_days;
                        ?>
                                    </h4>
                    <span class="stats-label"><?php echo get_phrase('present_days_this_month'); ?></span>
                </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!-- Recent Diaries Section -->
                <div class="row">
    <div class="col-md-12">
                        <div class="white-box">
            <h3 class="box-title m-b-20">
                <i class="fa fa-book text-success"></i> 
                <?php echo get_phrase('my_recent_diaries'); ?>
            </h3>
            
            <?php 
            // Get recent diaries for this teacher - with error handling
            $recent_diaries = array();
            try {
                if($this->db->table_exists('teacher_diary')) {
                    $recent_diaries = $this->db->where('teacher_id', $teacher_id)
                                               ->order_by('date', 'DESC')
                                               ->limit(5)
                                               ->get('teacher_diary')->result_array();
                }
            } catch (Exception $e) {
                // Ignore database errors
            }
            
            if(!empty($recent_diaries)): 
            ?>
                            <div class="table-responsive">
                <table class="table table-hover">
                                    <thead>
                                        <tr>
                            <th><?php echo get_phrase('title'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('class'); ?></th>
                            <th><?php echo get_phrase('description'); ?></th>
                            <th><?php echo get_phrase('actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        <?php foreach($recent_diaries as $diary): 
                            // Get class and section name if available
                            $class_name = '';
                            try {
                                if (!empty($diary['class_id'])) {
                                    $class_info = $this->db->get_where('class', array('class_id' => $diary['class_id']))->row();
                                    if($class_info) {
                                        $class_name = $class_info->name;
                                        
                                        if (!empty($diary['section_id'])) {
                                            $section_info = $this->db->get_where('section', array('section_id' => $diary['section_id']))->row();
                                            if($section_info) {
                                                $class_name .= ' - ' . $section_info->name;
                                            }
                                        }
                                    }
                                }
                            } catch (Exception $e) {
                                // Ignore database errors
                            }
                        ?>
                        <tr>
                            <td>
                                <strong><?php echo isset($diary['title']) ? $diary['title'] : 'N/A'; ?></strong>
                            </td>
                            <td>
                                <?php 
                                if(isset($diary['date'])) {
                                    echo date('d M, Y', strtotime($diary['date'])); 
                                    if (!empty($diary['time'])) {
                                        echo '<br><small class="text-muted">' . date('h:i A', strtotime($diary['time'])) . '</small>';
                                    }
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo !empty($class_name) ? $class_name : '<span class="text-muted">'.get_phrase('not_specified').'</span>'; ?>
                            </td>
                            <td>
                                <?php 
                                if(isset($diary['description'])) {
                                    $description = $diary['description'];
                                    echo strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if(isset($diary['diary_id'])): ?>
                                <a href="<?php echo base_url('teacher/view_diary/'.$diary['diary_id']); ?>" class="btn btn-primary btn-xs">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="<?php echo base_url('teacher/edit_diary/'.$diary['diary_id']); ?>" class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <?php endif; ?>
                            </td>
                                        </tr>
                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
            <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="fa fa-info-circle"></i> 
                <?php echo get_phrase('no_diary_entries_found'); ?>. 
                <a href="<?php echo base_url('teacher/my_diaries'); ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> <?php echo get_phrase('create_your_first_diary'); ?>
                </a>
                        </div>
            <?php endif; ?>
            
            <div class="text-right m-t-15">
                <a href="<?php echo base_url('teacher/my_diaries'); ?>" class="btn btn-success">
                    <i class="fa fa-book"></i> <?php echo get_phrase('view_all_diaries'); ?>
                </a>
                            </div>
                        </div>
                    </div>
                </div>

<!-- Custom Styles for Dashboard -->
<style>
.stats-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.stats-item:last-child {
    border-bottom: none;
}

.stats-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: white;
    font-size: 20px;
}

.stats-content {
    flex: 1;
}

.stats-number {
    margin: 0;
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.stats-label {
    color: #666;
    font-size: 12px;
    text-transform: uppercase;
}

.bg-primary { background-color: #5b9bd5; }
.bg-success { background-color: #70ad47; }
.bg-warning { background-color: #ffc000; }
.bg-info { background-color: #44bcd8; }

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

.m-b-15 { margin-bottom: 15px; }
.m-b-20 { margin-bottom: 20px; }
.m-t-15 { margin-top: 15px; }

.table > thead > tr > th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
}

.btn-xs {
    padding: 2px 6px;
    font-size: 11px;
    line-height: 1.5;
    border-radius: 3px;
}
</style>

<!-- Error Suppression Script -->
<script>
// Suppress JavaScript errors for missing libraries
window.addEventListener('error', function(e) {
    // Suppress errors for missing vendor files
    if (e.filename && (
        e.filename.includes('fullcalendar') ||
        e.filename.includes('toastr') ||
        e.filename.includes('moment') ||
        e.filename.includes('vendors')
    )) {
        e.preventDefault();
        return true;
    }
});

// Provide fallbacks for missing libraries
if (typeof moment === 'undefined') {
    window.moment = function() {
        return {
            format: function() { return new Date().toLocaleDateString(); }
        };
    };
}

if (typeof toastr === 'undefined') {
    window.toastr = {
        success: function(msg) { console.log('Success: ' + msg); },
        error: function(msg) { console.log('Error: ' + msg); },
        warning: function(msg) { console.log('Warning: ' + msg); },
        info: function(msg) { console.log('Info: ' + msg); }
    };
}

// Ensure jQuery is available before running any scripts
$(document).ready(function() {
    console.log('Teacher Dashboard loaded successfully');
});
</script>
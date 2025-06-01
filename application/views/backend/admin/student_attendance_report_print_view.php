<?php
$class_id = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
$section_id = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
// Ensure $month is numeric for cal_days_in_month
$month_num = is_numeric($month) ? intval($month) : date('n', strtotime($month));
$month_name = date('F', mktime(0, 0, 0, $month_num, 1));
// Ensure $attendance_data is an array
if (!isset($attendance_data) || !is_array($attendance_data)) {
    $attendance_data = array();
    echo '<div style="color:red;font-weight:bold;">Attendance data is missing or invalid.</div>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo get_phrase('student_attendance_report'); ?></title>
    <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .print-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #1a237e;
            padding-bottom: 15px;
        }
        .school-logo {
            width: 350px;
            height: 120px;
            margin: 0 auto 10px;
            display: block;
        }
        .school-name {
            font-size: 24px;
            font-weight: bold;
            color: #1a237e;
            margin: 10px 0;
            font-family: 'Georgia', serif;
        }
        .report-title {
            font-size: 18px;
            font-weight: bold;
            margin: 15px 0;
            padding: 8px;
            background: linear-gradient(135deg, #1a237e 0%, #3f51b5 100%);
            color: white;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .print-header p {
            margin: 5px 0;
            font-size: 14px;
            color: #333;
        }
        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .attendance-table th,
        .attendance-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .attendance-table th {
            background-color: #f5f5f5;
        }
        .attendance-legend {
            margin: 20px 0;
            text-align: center;
        }
        .legend-item {
            display: inline-block;
            margin: 0 15px;
        }
        .present { color: #00a651; }
        .absent { color: #EE4749; }
        .half-day { color: #0000FF; }
        .late { color: #FF6600; }
        .undefined { color: black; }
        .summary-box {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .summary-item {
            display: inline-block;
            margin: 0 20px;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                margin: 0;
                padding: 15px;
            }
            .school-logo {
                width: 350px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="print-header">
        <!-- National Public School Logo -->
        <img src="<?php echo base_url('uploads/school_logo.png.png'); ?>" class="school-logo" alt="National Public School Logo">
        
        <div class="school-name">National Public School</div>
        
        <div class="report-title">Student Attendance Report</div>
        
        <p><?php echo get_phrase('class'); ?>: <?php echo $class_id; ?> | <?php echo get_phrase('section'); ?>: <?php echo $section_id; ?></p>
        <p><?php echo get_phrase('month'); ?>: <?php echo $month_name; ?> | <?php echo get_phrase('year'); ?>: <?php echo $year; ?></p>
    </div>

    <div class="attendance-legend">
        <span class="legend-item"><i class="fa fa-circle present"></i> <?php echo get_phrase('present'); ?></span>
        <span class="legend-item"><i class="fa fa-circle absent"></i> <?php echo get_phrase('absent'); ?></span>
        <span class="legend-item"><i class="fa fa-circle half-day"></i> <?php echo get_phrase('half_day'); ?></span>
        <span class="legend-item"><i class="fa fa-circle late"></i> <?php echo get_phrase('late'); ?></span>
        <span class="legend-item"><i class="fa fa-circle undefined"></i> <?php echo get_phrase('undefined'); ?></span>
    </div>

    <div class="summary-box">
        <?php
        $total_days = cal_days_in_month(CAL_GREGORIAN, $month_num, $year);
        $total_present = 0;
        $total_absent = 0;
        $total_half_day = 0;
        $total_late = 0;
        $total_undefined = 0;

        // Calculate totals from the attendance data
        foreach ($attendance_data as $student) {
            foreach ($student['attendance'] as $status) {
                switch ($status) {
                    case 1: $total_present++; break;
                    case 2: $total_absent++; break;
                    case 3: $total_half_day++; break;
                    case 4: $total_late++; break;
                    default: $total_undefined++; break;
                }
            }
        }
        ?>
        <div class="summary-item">
            <strong><?php echo get_phrase('total_days'); ?>:</strong> <?php echo $total_days; ?>
        </div>
        <div class="summary-item">
            <strong><?php echo get_phrase('total_present'); ?>:</strong> <?php echo $total_present; ?>
        </div>
        <div class="summary-item">
            <strong><?php echo get_phrase('total_absent'); ?>:</strong> <?php echo $total_absent; ?>
        </div>
        <div class="summary-item">
            <strong><?php echo get_phrase('total_half_day'); ?>:</strong> <?php echo $total_half_day; ?>
        </div>
        <div class="summary-item">
            <strong><?php echo get_phrase('total_late'); ?>:</strong> <?php echo $total_late; ?>
        </div>
    </div>

    <table class="attendance-table">
        <thead>
            <tr>
                <th><?php echo get_phrase('student_name'); ?></th>
                <?php
                $total_days = cal_days_in_month(CAL_GREGORIAN, $month_num, $year);
                for ($i = 1; $i <= $total_days; $i++) {
                    echo '<th>' . $i . '</th>';
                }
                ?>
                <th><?php echo get_phrase('total_present'); ?></th>
                <th><?php echo get_phrase('total_leave'); ?></th>
                <th><?php echo get_phrase('total_half_day'); ?></th>
                <th><?php echo get_phrase('total_late'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attendance_data as $student): ?>
            <?php
                $present_count = 0;
                $absent_count = 0;
                $half_day_count = 0;
                $late_count = 0;
            ?>
            <tr>
                <td><?php echo $student['name']; ?></td>
                <?php
                foreach ($student['attendance'] as $status) {
                    $status_class = '';
                    switch ($status) {
                        case 1:
                            $status_class = 'present';
                            $present_count++;
                            break;
                        case 2:
                            $status_class = 'absent';
                            $absent_count++;
                            break;
                        case 3:
                            $status_class = 'half-day';
                            $half_day_count++;
                            break;
                        case 4:
                            $status_class = 'late';
                            $late_count++;
                            break;
                        default:
                            $status_class = 'undefined';
                            break;
                    }
                    echo '<td class="' . $status_class . '"><i class="fa fa-circle"></i></td>';
                }
                ?>
                <td><?php echo $present_count; ?></td>
                <td><?php echo $absent_count; ?></td>
                <td><?php echo $half_day_count; ?></td>
                <td><?php echo $late_count; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="no-print" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fa fa-print"></i> <?php echo get_phrase('print'); ?>
        </button>
    </div>

    <script>
        window.onload = function() {
            // Auto-print when the page loads
            window.print();
        }
    </script>
</body>
</html> 
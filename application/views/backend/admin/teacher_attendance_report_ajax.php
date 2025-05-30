<?php
// Add fallback if CAL_GREGORIAN constant is not defined
if (!defined('CAL_GREGORIAN')) {
    define('CAL_GREGORIAN', 0);
}

// Add fallback if cal_days_in_month is not available
if (!function_exists('cal_days_in_month')) {
    function cal_days_in_month($calendar, $month, $year) {
        // Ignore $calendar parameter since we don't need it
        return date('t', mktime(0, 0, 0, $month, 1, $year));
    }
}

// Calculate days in month and month name
$number_of_days = date('t', mktime(0, 0, 0, $month, 1, $year));
$month_name = date('F', mktime(0, 0, 0, $month, 1, $year));
$days = array();
for ($i = 1; $i <= $number_of_days; $i++) {
    $days[] = $i;
}

// Debug information
error_log('Rendering attendance report for ' . $month_name . ' ' . $year);
error_log('Number of days: ' . $number_of_days);
error_log('Number of attendance records: ' . (isset($attendance_report) && is_array($attendance_report) ? count($attendance_report) : 'No data'));
?>

<!-- Debug Information (hidden in production) -->
<div class="debug-info" style="display: none;">
    <p>Month: <?php echo $month_name; ?> (<?php echo $month; ?>)</p>
    <p>Year: <?php echo $year; ?></p>
    <p>Days in month: <?php echo $number_of_days; ?></p>
    <p>Records: <?php echo isset($attendance_report) && is_array($attendance_report) ? count($attendance_report) : 'No data'; ?></p>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title"><?php echo get_phrase('teacher_attendance_report_for'); ?> <?php echo $month_name . ' ' . $year; ?></h4>
    </div>
    <div class="panel-body">
        <?php 
        // Check if data is valid
        if (!isset($attendance_report) || !is_array($attendance_report) || empty($attendance_report)) {
            echo '<div class="alert alert-warning">';
            echo get_phrase('no_attendance_data_available');
            echo '</div>';
        } else {
        ?>
        <div class="table-responsive teacher-attendance-table-container" style="overflow-x: auto; max-height: 70vh; overflow-y: auto; border: 2px solid #c4b5fd; border-radius: 8px;">
            <table class="table table-bordered teacher-attendance-table">
                <thead class="thead-fixed">
                    <tr class="purple-gradient-header">
                        <th style="position: sticky; left: 0; background: linear-gradient(to right, #ddd6fe, #f3f4f6); z-index: 10; min-width: 150px; font-weight: bold; color: #4c1d95;">
                            <?php echo get_phrase('teacher'); ?>
                        </th>
                        <?php foreach ($days as $day) : ?>
                            <th class="text-center" style="min-width: 35px; font-weight: bold; color: #4c1d95;"><?php echo $day; ?></th>
                        <?php endforeach; ?>
                        <th class="text-center" style="background: linear-gradient(to right, #ddd6fe, #f3f4f6); font-weight: bold; color: #4c1d95; min-width: 80px;">
                            <?php echo get_phrase('present'); ?>
                        </th>
                        <th class="text-center" style="background: linear-gradient(to right, #ddd6fe, #f3f4f6); font-weight: bold; color: #4c1d95; min-width: 80px;">
                            <?php echo get_phrase('absent'); ?>
                        </th>
                        <th class="text-center" style="background: linear-gradient(to right, #ddd6fe, #f3f4f6); font-weight: bold; color: #4c1d95; min-width: 80px;">
                            <?php echo get_phrase('late'); ?>
                        </th>
                        <th class="text-center" style="background: linear-gradient(to right, #ddd6fe, #f3f4f6); font-weight: bold; color: #4c1d95; min-width: 80px;">
                            <?php echo get_phrase('half_day'); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($attendance_report)) : ?>
                        <tr>
                            <td colspan="<?php echo $number_of_days + 5; ?>" class="text-center">
                                <?php echo get_phrase('no_data_found'); ?>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php 
                        try {
                            foreach ($attendance_report as $teacher_data) : 
                                if (!isset($teacher_data['teacher_name']) || !isset($teacher_data['attendance_data']) || !is_array($teacher_data['attendance_data'])) {
                                    continue; // Skip invalid entries
                                }
                        ?>
                            <tr>
                                <td style="position: sticky; left: 0; background-color: #fff; z-index: 5; font-weight: bold; border-right: 2px solid #ddd;">
                                    <?php echo $teacher_data['teacher_name']; ?>
                                </td>
                                <?php foreach ($days as $day) : ?>
                                    <td class="text-center teacher-attendance-cell">
                                        <?php
                                        if (isset($teacher_data['attendance_data'][$day])) {
                                            $status = $teacher_data['attendance_data'][$day];
                                            $display_text = '';
                                            $cell_class = '';
                                            
                                            switch ($status) {
                                                case 1:
                                                    $display_text = 'P';
                                                    $cell_class = 'present';
                                                    break;
                                                case 2:
                                                    $display_text = 'A';
                                                    $cell_class = 'absent';
                                                    break;
                                                case 3:
                                                    $display_text = 'L';
                                                    $cell_class = 'late';
                                                    break;
                                                case 4:
                                                    $display_text = 'H';
                                                    $cell_class = 'half-day';
                                                    break;
                                                default:
                                                    $display_text = '-';
                                                    $cell_class = 'undefined';
                                                    break;
                                            }
                                        } else {
                                            $display_text = '-';
                                            $cell_class = 'undefined';
                                        }
                                        ?>
                                        <span class="teacher-attendance-letter <?php echo $cell_class; ?>">
                                            <?php echo $display_text; ?>
                                        </span>
                                    </td>
                                <?php endforeach; ?>
                                <td class="text-center summary-cell present-summary">
                                    <strong><?php echo isset($teacher_data['present_count']) ? $teacher_data['present_count'] : '0'; ?></strong>
                                </td>
                                <td class="text-center summary-cell absent-summary">
                                    <strong><?php echo isset($teacher_data['absent_count']) ? $teacher_data['absent_count'] : '0'; ?></strong>
                                </td>
                                <td class="text-center summary-cell late-summary">
                                    <strong><?php echo isset($teacher_data['late_count']) ? $teacher_data['late_count'] : '0'; ?></strong>
                                </td>
                                <td class="text-center summary-cell half-day-summary">
                                    <strong><?php echo isset($teacher_data['half_day_count']) ? $teacher_data['half_day_count'] : '0'; ?></strong>
                                </td>
                            </tr>
                        <?php 
                            endforeach; 
                        } catch (Exception $e) {
                            error_log('Error in rendering attendance table: ' . $e->getMessage());
                            echo '<tr><td colspan="' . ($number_of_days + 5) . '" class="text-center text-danger">';
                            echo 'Error rendering data: ' . $e->getMessage();
                            echo '</td></tr>';
                        }
                        ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
</div>

<div class="panel panel-default" style="display: none;">
    <div class="panel-heading">
        <h4 class="panel-title"><?php echo get_phrase('legend'); ?></h4>
    </div>
    <div class="panel-body">
        <span class="badge badge-success"><?php echo get_phrase('present'); ?></span>
        <span class="badge badge-danger"><?php echo get_phrase('absent'); ?></span>
        <span class="badge badge-warning"><?php echo get_phrase('late'); ?></span>
        <span class="badge badge-info"><?php echo get_phrase('half_day'); ?></span>
        <span class="badge badge-default"><?php echo get_phrase('undefined'); ?></span>
    </div>
</div>

<!-- Enhanced CSS for Teacher Attendance Display -->
<style>
/* Purple Gradient Header */
.purple-gradient-header {
    background: linear-gradient(to right, #ddd6fe, #f3f4f6) !important;
    color: #4c1d95 !important;
    font-weight: bold !important;
}

.purple-gradient-header th {
    background: linear-gradient(to right, #ddd6fe, #f3f4f6) !important;
    color: #4c1d95 !important;
    font-weight: bold !important;
    text-shadow: none;
    border: 1px solid #c4b5fd;
}

/* Teacher Attendance Letter Styling */
.teacher-attendance-letter {
    display: inline-block;
    width: 22px;
    height: 22px;
    line-height: 22px;
    text-align: center;
    font-weight: bold;
    font-size: 14px;
    border-radius: 4px;
    border: 2px solid #ddd;
}

.teacher-attendance-letter.present {
    background-color: #d4edda;
    color: #155724;
    border-color: #c3e6cb;
    font-weight: 900;
}

.teacher-attendance-letter.absent {
    background-color: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
    font-weight: 900;
}

.teacher-attendance-letter.late {
    background-color: #fff3cd;
    color: #856404;
    border-color: #ffeaa7;
    font-weight: 900;
}

.teacher-attendance-letter.half-day {
    background-color: #d1ecf1;
    color: #0c5460;
    border-color: #bee5eb;
    font-weight: 900;
}

.teacher-attendance-letter.undefined {
    background-color: #f8f9fa;
    color: #6c757d;
    border-color: #dee2e6;
    font-weight: 600;
}

/* Table Styling */
.teacher-attendance-table {
    font-size: 13px;
    margin-bottom: 0;
    font-weight: 600;
}

.teacher-attendance-table th {
    padding: 10px 6px;
    text-align: center;
    vertical-align: middle;
    font-size: 12px;
    font-weight: bold;
}

.teacher-attendance-table td {
    padding: 8px 6px;
    vertical-align: middle;
    font-weight: 600;
}

.teacher-attendance-cell {
    min-width: 40px;
    max-width: 40px;
    padding: 5px !important;
}

/* Summary columns styling */
.summary-cell {
    font-size: 14px;
    padding: 10px !important;
    font-weight: bold;
}

.present-summary {
    background-color: #d4edda !important;
    color: #155724;
    font-weight: bold;
}

.absent-summary {
    background-color: #f8d7da !important;
    color: #721c24;
    font-weight: bold;
}

.late-summary {
    background-color: #fff3cd !important;
    color: #856404;
    font-weight: bold;
}

.half-day-summary {
    background-color: #d1ecf1 !important;
    color: #0c5460;
    font-weight: bold;
}

/* Fixed header and sticky column */
.thead-fixed th {
    position: sticky;
    top: 0;
    z-index: 8;
}

/* Panel styling */
.panel-default {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: 2px solid #c4b5fd;
    margin-bottom: 25px;
}

.panel-heading {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px 10px 0 0;
    padding: 15px 20px;
    font-weight: 600;
    border: none;
}

.panel-body {
    padding: 25px;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .teacher-attendance-table {
        font-size: 11px;
    }
    
    .teacher-attendance-letter {
        width: 20px;
        height: 20px;
        line-height: 20px;
        font-size: 12px;
        font-weight: bold;
    }
    
    .teacher-attendance-table th,
    .teacher-attendance-table td {
        padding: 6px 4px;
        font-size: 10px;
    }
}

/* Print Styles */
@media print {
    .teacher-attendance-table-container {
        overflow: visible !important;
        max-height: none !important;
        border: none !important;
    }
    
    .teacher-attendance-table {
        font-size: 9px;
        width: 100% !important;
        page-break-inside: auto;
    }
    
    .teacher-attendance-table th,
    .teacher-attendance-table td {
        font-size: 9px !important;
        padding: 2px !important;
        border: 1px solid #000 !important;
        page-break-inside: avoid;
    }
    
    .teacher-attendance-letter {
        width: 16px !important;
        height: 16px !important;
        line-height: 16px !important;
        font-size: 10px !important;
        border: 1px solid #000 !important;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }
    
    .purple-gradient-header th {
        background: #f0f0f0 !important;
        color: #000 !important;
        font-weight: bold !important;
    }
    
    .summary-cell {
        font-weight: bold !important;
        background: #f8f9fa !important;
        color: #000 !important;
    }
}
</style>

<script>
// Add a client-side script to debug table rendering
$(document).ready(function() {
    console.log('Teacher attendance report AJAX view loaded');
    console.log('Month: <?php echo $month_name; ?> (<?php echo $month; ?>)');
    console.log('Year: <?php echo $year; ?>');
    console.log('Days in month: <?php echo $number_of_days; ?>');
    console.log('Records: <?php echo isset($attendance_report) && is_array($attendance_report) ? count($attendance_report) : 'No data'; ?>');
});
</script> 
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
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo get_phrase('teacher'); ?></th>
                        <?php foreach ($days as $day) : ?>
                            <th class="text-center"><?php echo $day; ?></th>
                        <?php endforeach; ?>
                        <th class="text-center bg-success"><?php echo get_phrase('present'); ?></th>
                        <th class="text-center bg-danger"><?php echo get_phrase('absent'); ?></th>
                        <th class="text-center bg-warning"><?php echo get_phrase('late'); ?></th>
                        <th class="text-center bg-info"><?php echo get_phrase('half_day'); ?></th>
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
                                <td><?php echo $teacher_data['teacher_name']; ?></td>
                                <?php foreach ($days as $day) : ?>
                                    <td class="text-center">
                                        <?php
                                        if (isset($teacher_data['attendance_data'][$day])) {
                                            $status = $teacher_data['attendance_data'][$day];
                                            if ($status == 1) {
                                                echo '<span class="label label-success">P</span>';
                                            } else if ($status == 2) {
                                                echo '<span class="label label-danger">A</span>';
                                            } else if ($status == 3) {
                                                echo '<span class="label label-warning">L</span>';
                                            } else if ($status == 4) {
                                                echo '<span class="label label-info">H</span>';
                                            } else {
                                                echo '<span class="label label-default">-</span>';
                                            }
                                        } else {
                                            echo '<span class="label label-default">-</span>';
                                        }
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="text-center bg-success"><strong><?php echo isset($teacher_data['present_count']) ? $teacher_data['present_count'] : '0'; ?></strong></td>
                                <td class="text-center bg-danger"><strong><?php echo isset($teacher_data['absent_count']) ? $teacher_data['absent_count'] : '0'; ?></strong></td>
                                <td class="text-center bg-warning"><strong><?php echo isset($teacher_data['late_count']) ? $teacher_data['late_count'] : '0'; ?></strong></td>
                                <td class="text-center bg-info"><strong><?php echo isset($teacher_data['half_day_count']) ? $teacher_data['half_day_count'] : '0'; ?></strong></td>
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

<div class="panel panel-default">
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
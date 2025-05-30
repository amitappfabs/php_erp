<?php if($section_id!=null && $month!=null && $year!=null && $class_id!=null):?>

<div class="row" align="center">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <h3 style="color: #696969;">Attendance Sheet</h3>
                    <?php 
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $key => $class) {
                            if(isset($class_id) && $class_id==$class['class_id']) $class_name = $class['name'];
                        }
                        $sections = $this->db->get('section')->result_array();
                        foreach ($sections as $key => $section) {
                            if(isset($section_id) && $section_id==$section['section_id']) $section_name = $section['name'];
                        }
                    ?>
                    <?php
                        $full_date = "5"."-".$month."-".$year;
                        $full_date = date_create($full_date);
                        $full_date = date_format($full_date,"F, Y");?>
                    <h4 style="color: #696969;">Class <?php echo $class_name; ?> : Section <?php echo $section_name; ?><br><?php echo $full_date; ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <!-- Legend Section -->
                    <div class="attendance-legend" style="text-align: center; margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 5px; display: none;">
                        <h5 style="margin-bottom: 10px; color: #333;"><strong>Attendance Legend:</strong></h5>
                        <div class="row">
                            <div class="col-xs-6 col-sm-3">
                                <span class="legend-item">
                                    <span class="attendance-letter present">P</span> - Present
                                </span>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <span class="legend-item">
                                    <span class="attendance-letter absent">A</span> - Absent
                                </span>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <span class="legend-item">
                                    <span class="attendance-letter late">L</span> - Late
                                </span>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <span class="legend-item">
                                    <span class="attendance-letter undefined">-</span> - Undefined
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Table Container -->
                    <div id="attendance-table-area" class="table-responsive" style="overflow-x: auto; max-height: 70vh; overflow-y: auto;">
                        <table class="table table-bordered table-striped attendance-table">
                            <thead class="thead-fixed">
                                <tr class="purple-gradient-header">
                                    <th style="position: sticky; left: 0; background: linear-gradient(to right, #ddd6fe, #f3f4f6); z-index: 10; min-width: 150px; font-weight: bold;">
                                        <?php echo get_phrase('student_name'); ?>
                                    </th>
                                    <?php
                                    $days = date("t",mktime(0,0,0,$month,1,$year)); 
                                    for ($i=1; $i <= $days; $i++) { 
                                        echo '<th style="min-width: 35px; text-align: center; font-weight: bold;">' . $i . '</th>';
                                    }
                                    ?>
                                    <th style="min-width: 80px; text-align: center; background: linear-gradient(to right, #ddd6fe, #f3f4f6); font-weight: bold;">
                                        <?php echo get_phrase('total_present'); ?>
                                    </th>
                                    <th style="min-width: 80px; text-align: center; background: linear-gradient(to right, #ddd6fe, #f3f4f6); font-weight: bold;">
                                        <?php echo get_phrase('total_absent'); ?>
                                    </th>
                                    <th style="min-width: 80px; text-align: center; background: linear-gradient(to right, #ddd6fe, #f3f4f6); font-weight: bold;">
                                        <?php echo get_phrase('total_late'); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                //STUDENTS ATTENDANCE
                                $students = $this->db->get_where('student' , array('class_id'=>$class_id))->result_array();
                                foreach($students as $key => $student)
                                {
                                    $present_count = 0;
                                    $absent_count = 0;
                                    $half_day_count = 0;
                                    $late_count = 0;
                                    ?>
                                <tr>
                                    <td style="position: sticky; left: 0; background-color: #fff; z-index: 5; font-weight: bold; border-right: 2px solid #ddd;">
                                        <?php echo $student['name']; ?>
                                    </td>
                                    <?php 
                                    for ($i=1; $i <= $days; $i++) {
                                        $full_date = $year."-".sprintf('%02d', $month)."-".sprintf('%02d', $i);
                                        $verify_data = array('student_id' => $student['student_id'], 'date' => $full_date);
                                        $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                                        $status = isset($attendance->status) ? $attendance->status : 0;
                                        
                                        $display_text = '';
                                        $cell_class = '';
                                        
                                        switch ($status) {
                                            case 1: 
                                                $display_text = 'P';
                                                $cell_class = 'present';
                                                $present_count++;
                                                break;
                                            case 2: 
                                                $display_text = 'A';
                                                $cell_class = 'absent';
                                                $absent_count++;
                                                break;
                                            case 3: 
                                                $display_text = 'H';
                                                $cell_class = 'half-day';
                                                $half_day_count++;
                                                break;
                                            case 4: 
                                                $display_text = 'L';
                                                $cell_class = 'late';
                                                $late_count++;
                                                break;
                                            default: 
                                                $display_text = '';
                                                $cell_class = 'undefined';
                                                break;
                                        }
                                        ?>
                                        <td class="text-center attendance-cell <?php echo $cell_class; ?>">
                                            <span class="attendance-letter <?php echo $cell_class; ?>">
                                                <?php echo $display_text; ?>
                                            </span>
                                        </td>
                                        <?php 
                                    }
                                    ?>
                                    <td class="text-center summary-cell present-summary">
                                        <strong><?php echo $present_count; ?></strong>
                                    </td>
                                    <td class="text-center summary-cell absent-summary">
                                        <strong><?php echo $absent_count; ?></strong>
                                    </td>
                                    <td class="text-center summary-cell late-summary">
                                        <strong><?php echo $late_count; ?></strong>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Print Button -->
                    <div style="margin-top: 20px; text-align: center;">
                        <a href="#" onclick="printTableArea('attendance-table-area'); return false;" 
                           class="btn btn-success btn-lg" style="color:white; padding: 10px 30px;">
                            <i class="fa fa-print"></i> Print Attendance Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced CSS for Better Attendance Display -->
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

/* Attendance Letter Styling */
.attendance-letter {
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

.attendance-letter.present {
    background-color: #d4edda;
    color: #155724;
    border-color: #c3e6cb;
    font-weight: 900;
}

.attendance-letter.absent {
    background-color: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
    font-weight: 900;
}

.attendance-letter.late {
    background-color: #fff3cd;
    color: #856404;
    border-color: #ffeaa7;
    font-weight: 900;
}

.attendance-letter.half-day {
    background-color: #d1ecf1;
    color: #0c5460;
    border-color: #bee5eb;
    font-weight: 900;
}

.attendance-letter.undefined {
    background-color: #f8f9fa;
    color: #6c757d;
    border-color: #dee2e6;
    font-weight: 600;
}

/* Table Styling */
.attendance-table {
    font-size: 13px;
    margin-bottom: 0;
    font-weight: 600;
}

.attendance-table th {
    padding: 10px 6px;
    text-align: center;
    vertical-align: middle;
    font-size: 12px;
    font-weight: bold;
}

.attendance-table td {
    padding: 8px 6px;
    vertical-align: middle;
    font-weight: 600;
}

.attendance-cell {
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

/* Legend Styling */
.attendance-legend {
    border: 2px solid #c4b5fd;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    background: linear-gradient(to right, #faf5ff, #f9fafb);
}

.legend-item {
    display: inline-block;
    margin: 8px;
    font-weight: 700;
    color: #4c1d95;
}

/* Responsive Table Container */
.table-responsive {
    border: 2px solid #c4b5fd;
    border-radius: 8px;
}

/* Fixed header and sticky column */
.thead-fixed th {
    position: sticky;
    top: 0;
    z-index: 8;
}

/* Hide any old color legend elements */
.old-legend,
.color-legend,
div[style*="color: #00a651"],
div[style*="color: #EE4749"],
div[style*="color: #0000FF"],
div[style*="color: #FF6600"] {
    display: none !important;
}

/* Hide specific legacy KEYS sections */
div[align="center"]:contains("KEYS"),
div:contains("Present") i.fa-circle,
div:contains("Absent") i.fa-circle,
div:contains("Half Day") i.fa-circle,
div:contains("Late") i.fa-circle,
div:contains("Undefined") i.fa-circle,
div:contains("Undefine") i.fa-circle {
    display: none !important;
}

/* Target any remaining color circles from attendance legend */
i.fa-circle[style*="color: #00a651"],
i.fa-circle[style*="color: #EE4749"], 
i.fa-circle[style*="color: #0000FF"],
i.fa-circle[style*="color: #FF6600"],
i.fa-circle[style*="color: black"],
i.fa-circle[style*="color:black"],
i.fa-circle[style*="color: green"],
i.fa-circle[style*="color: red"],
i.fa-circle[style*="color: blue"],
i.fa-circle[style*="color: yellow"],
i.fa-circle[style*="color: grey"] {
    display: none !important;
}

/* Hide parent divs that contain only color legends */
div:has(> i.fa-circle[style*="color:"]) {
    display: none !important;
}

/* Print Styles */
@media print {
    .panel-heading,
    .btn,
    .attendance-legend {
        display: none !important;
    }
    
    .table-responsive {
        overflow: visible !important;
        max-height: none !important;
        border: none !important;
    }
    
    .attendance-table {
        font-size: 9px;
        width: 100% !important;
        page-break-inside: auto;
    }
    
    .attendance-table th,
    .attendance-table td {
        font-size: 9px !important;
        padding: 2px !important;
        border: 1px solid #000 !important;
        page-break-inside: avoid;
    }
    
    .attendance-letter {
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
    
    /* Ensure all columns are visible in print */
    .attendance-table thead,
    .attendance-table tbody,
    .attendance-table th,
    .attendance-table td {
        display: table-cell !important;
        visibility: visible !important;
    }
    
    /* Force table to fit on page */
    .attendance-table {
        table-layout: fixed !important;
        width: 100% !important;
    }
    
    .attendance-table th:first-child,
    .attendance-table td:first-child {
        width: 20% !important;
    }
    
    .summary-cell {
        width: 8% !important;
    }
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .attendance-table {
        font-size: 11px;
    }
    
    .attendance-letter {
        width: 20px;
        height: 20px;
        line-height: 20px;
        font-size: 12px;
        font-weight: bold;
    }
    
    .attendance-legend .col-xs-6 {
        margin-bottom: 15px;
    }
    
    .legend-item {
        font-size: 13px;
        font-weight: bold;
    }
}
</style>

<script>
function printTableArea(divId) {
    // Get the complete table content including all columns
    var tableElement = document.querySelector('#' + divId + ' table');
    var printContents = '';
    
    if (tableElement) {
        // Clone the table to avoid modifying the original
        var clonedTable = tableElement.cloneNode(true);
        
        // Ensure all elements are visible
        var allElements = clonedTable.querySelectorAll('*');
        allElements.forEach(function(element) {
            element.style.display = '';
            element.style.visibility = 'visible';
        });
        
        printContents = clonedTable.outerHTML;
    } else {
        printContents = document.getElementById(divId).innerHTML;
    }
    
    // Create a clean print layout
    var printWindow = window.open('', '_blank', 'width=1200,height=800');
    printWindow.document.write(`
        <html>
        <head>
            <title>JP International - Student Attendance Report</title>
            <style>
                @page {
                    size: A4 landscape;
                    margin: 15mm;
                }
                
                body { 
                    font-family: Arial, sans-serif; 
                    margin: 0; 
                    padding: 10px;
                    font-size: 10px;
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
                    display: inline-block;
                }
                
                h4 { 
                    text-align: center; 
                    color: #333; 
                    margin: 10px 0;
                    font-size: 14px;
                }
                
                table { 
                    width: 100%; 
                    border-collapse: collapse; 
                    font-size: 9px; 
                    margin: 0 auto;
                    table-layout: fixed;
                }
                
                th, td { 
                    border: 1px solid #000; 
                    padding: 2px; 
                    text-align: center; 
                    vertical-align: middle;
                    overflow: hidden;
                    word-wrap: break-word;
                }
                
                th { 
                    background-color: #f0f0f0; 
                    font-weight: bold; 
                    font-size: 8px;
                }
                
                th:first-child,
                td:first-child {
                    width: 18%;
                    text-align: left;
                    padding-left: 4px;
                }
                
                .attendance-letter { 
                    display: inline-block; 
                    width: 16px; 
                    height: 16px; 
                    line-height: 16px;
                    text-align: center; 
                    font-weight: bold; 
                    border: 1px solid #000;
                    font-size: 9px;
                    border-radius: 2px;
                }
                
                .present { 
                    background-color: #d4edda !important; 
                    color: #155724 !important;
                }
                
                .absent { 
                    background-color: #f8d7da !important; 
                    color: #721c24 !important;
                }
                
                .late { 
                    background-color: #fff3cd !important; 
                    color: #856404 !important;
                }
                
                .half-day { 
                    background-color: #d1ecf1 !important; 
                    color: #0c5460 !important;
                }
                
                .undefined { 
                    background-color: #f8f9fa !important; 
                    color: #6c757d !important;
                }
                
                .summary-cell { 
                    font-weight: bold !important; 
                    background-color: #f8f9fa !important;
                    width: 7%;
                }
                
                .present-summary {
                    background-color: #d4edda !important;
                    color: #155724 !important;
                }
                
                .absent-summary {
                    background-color: #f8d7da !important;
                    color: #721c24 !important;
                }
                
                .late-summary {
                    background-color: #fff3cd !important;
                    color: #856404 !important;
                }
                
                /* Hide sticky positioning for print */
                th[style*="position: sticky"],
                td[style*="position: sticky"] {
                    position: static !important;
                }
                
                /* Ensure table fits on page */
                .table-responsive {
                    overflow: visible !important;
                    max-height: none !important;
                }
                
                /* Legend at bottom */
                .print-legend {
                    margin-top: 15px; 
                    text-align: center;
                    font-size: 10px;
                    font-weight: bold;
                    border-top: 2px solid #000;
                    padding-top: 10px;
                }
            </style>
        </head>
        <body>
            <div class="print-header">
                <img src="<?php echo base_url('uploads/school_logo.png.png'); ?>" class="school-logo" alt="JP International School Logo">
                <div class="school-name">JP International</div>
                <div class="report-title">Student Attendance Report</div>
            </div>
            
            <h4><?php echo isset($class_name) ? "Class: " . $class_name : ""; ?> <?php echo isset($section_name) ? "| Section: " . $section_name : ""; ?></h4>
            <h4><?php echo isset($full_date) ? $full_date : ""; ?></h4>
            
            <div class="table-responsive">
                ${printContents}
            </div>
            
            <div class="print-legend">
                <strong>Legend:</strong> P = Present | A = Absent | L = Late | H = Half Day | - = Undefined
            </div>
        </body>
        </html>
    `);
    
    printWindow.document.close();
    
    // Wait for content to load before printing
    setTimeout(function() {
        printWindow.print();
        // Don't close immediately to allow user to save as PDF if needed
        setTimeout(function() {
            printWindow.close();
        }, 1000);
    }, 500);
}

// Hide any remaining old legend elements on page load
document.addEventListener('DOMContentLoaded', function() {
    // Hide any divs containing color circle legends
    var colorCircles = document.querySelectorAll('i.fa-circle[style*="color:"]');
    colorCircles.forEach(function(circle) {
        var parentDiv = circle.closest('div');
        if (parentDiv && (parentDiv.innerHTML.includes('KEYS') || 
                         parentDiv.innerHTML.includes('Present') || 
                         parentDiv.innerHTML.includes('Absent') ||
                         parentDiv.innerHTML.includes('Late') ||
                         parentDiv.innerHTML.includes('Half Day') ||
                         parentDiv.innerHTML.includes('Undefined'))) {
            parentDiv.style.display = 'none';
        }
    });
    
    // Hide any text containing "KEYS:" followed by colored circles
    var allDivs = document.querySelectorAll('div');
    allDivs.forEach(function(div) {
        if (div.innerHTML.includes('KEYS:') && div.querySelector('i.fa-circle')) {
            div.style.display = 'none';
        }
    });
});
</script>

<?php endif;?>
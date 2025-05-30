<?php $active_sms_gateway = $this->db->get_where('sms_settings' , array('type' => 'active_sms_gateway'))->row()->info; ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="fa fa-bar-chart"></i>
                    <?php echo get_phrase('student_attendance_report'); ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('class'); ?></label>
                            <select class="form-control selectboxit" id="class_id" onchange="return get_class_sections(this.value)">
                                <option value=""><?php echo get_phrase('select_class'); ?></option>
                                <?php 
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $key => $class): ?>
                                <option value="<?php echo $class['class_id']; ?>"
                                    <?php if(isset($class_id) && $class_id==$class['class_id']) echo 'selected="selected"'; ?>>
                                    <?php echo $class['name']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('section'); ?></label>
                            <select class="form-control selectboxit" id="section_id">
                                <option value=""><?php echo get_phrase('select_class_first'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('month'); ?></label>
                            <select class="form-control selectboxit" id="month">
                                <?php
                                for ($i = 1; $i <= 12; $i++):
                                    if ($i == 1) $m = get_phrase('january');
                                    else if ($i == 2) $m = get_phrase('february');
                                    else if ($i == 3) $m = get_phrase('march');
                                    else if ($i == 4) $m = get_phrase('april');
                                    else if ($i == 5) $m = get_phrase('may');
                                    else if ($i == 6) $m = get_phrase('june');
                                    else if ($i == 7) $m = get_phrase('july');
                                    else if ($i == 8) $m = get_phrase('august');
                                    else if ($i == 9) $m = get_phrase('september');
                                    else if ($i == 10) $m = get_phrase('october');
                                    else if ($i == 11) $m = get_phrase('november');
                                    else if ($i == 12) $m = get_phrase('december');
                                    ?>
                                    <option value="<?php echo $i; ?>"
                                        <?php if($i == date('n')) echo 'selected="selected"'; ?>><?php echo $m; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('year'); ?></label>
                            <select class="form-control selectboxit" id="year">
                                <?php
                                for ($i = 2019; $i <= 2050; $i++) {
                                    $selected = ($i == date('Y')) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12 text-center">
                        <div class="btn-group" role="group" style="display: inline-flex;">
                            <button type="button" class="btn btn-primary btn-lg" style="width: 180px; height: 45px;" onclick="get_attendance_report()">
                                <i class="fa fa-search"></i> <?php echo get_phrase('show_report'); ?>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12 text-center">
                        <div class="attendance-legend" style="display: none;">
                            <span class="legend-item"><i class="fa fa-circle" style="color: #00a651;"></i> <?php echo get_phrase('present'); ?></span>
                            <span class="legend-item"><i class="fa fa-circle" style="color: #EE4749;"></i> <?php echo get_phrase('absent'); ?></span>
                            <span class="legend-item"><i class="fa fa-circle" style="color: #0000FF;"></i> <?php echo get_phrase('half_day'); ?></span>
                            <span class="legend-item"><i class="fa fa-circle" style="color: #FF6600;"></i> <?php echo get_phrase('late'); ?></span>
                            <span class="legend-item"><i class="fa fa-circle" style="color: black;"></i> <?php echo get_phrase('undefined'); ?></span>
                        </div>
                    </div>
                </div>
                
                <div id="status_message" class="alert" style="display:none; margin-top: 15px;"></div>
                <div id="ajax_loading" style="display:none; text-align:center; margin-top: 20px; margin-bottom: 20px;">
                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                    <p><?php echo get_phrase('loading'); ?>...</p>
                </div>
                <div id="report_holder" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
</div>

<style>
.attendance-legend {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    display: inline-block;
}
.legend-item {
    margin: 0 15px;
    font-size: 14px;
}
.legend-item i {
    margin-right: 5px;
}
</style>

<script type="text/javascript">
function get_attendance_report() {
    var class_id = $('#class_id').val();
    var section_id = $('#section_id').val();
    var month = $('#month').val();
    var year = $('#year').val();
    
    if(class_id != '' && section_id != '' && month != '' && year != '') {
        $('#report_holder').empty();
        $('#ajax_loading').show();
        $('#status_message').hide();
        
        $.ajax({
            url: '<?php echo base_url();?>admin/loadAttendanceReport/' + class_id + '/' + section_id + '/' + month + '/' + year,
            type: 'GET',
            dataType: 'html',
            success: function(response) {
                $('#ajax_loading').hide();
                if (response.trim() === '') {
                    $('#status_message').html('No data available for the selected criteria').addClass('alert-warning').show();
                    $('#report_holder').html('<div class="alert alert-warning">No attendance records found</div>');
                } else {
                    $('#report_holder').html(response);
                }
            },
            error: function(xhr, status, error) {
                $('#ajax_loading').hide();
                $('#status_message').html('Error loading attendance report: ' + error).addClass('alert-danger').show();
                $('#report_holder').html('<div class="alert alert-danger">Failed to load attendance report</div>');
            }
        });
    } else {
        $('#status_message').html('Please select class, section, month and year').addClass('alert-info').show();
        $('#report_holder').html('<div class="alert alert-info">Please select all required fields</div>');
    }
}

function get_class_sections(class_id) {
    $.ajax({
        url: '<?php echo base_url();?>admin/get_class_section/' + class_id,
        success: function(response) {
            $('#section_id').html(response);
        }
    });
}

$(document).ready(function() {
    $('.selectboxit').selectBoxIt({
        showFirstOption: true
    });
    
    // Auto-hide status messages after 5 seconds
    setTimeout(function() {
        $('.alert-dismissible').fadeOut('slow');
    }, 5000);
});
</script>
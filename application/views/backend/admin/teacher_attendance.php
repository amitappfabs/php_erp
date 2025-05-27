<?php $active_sms_gateway = $this->db->get_where('sms_settings' , array('type' => 'active_sms_gateway'))->row()->info;?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Teacher Attendance');?>
            </div>
            <div class="panel-body table-responsive">
                <?php echo form_open(base_url() . 'admin/teacher_attendance_selector', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                
                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('date');?></label>
                    <div class="col-sm-12">
                        <input type="date" class="form-control datepicker" id="example-date-input" name="date" data-format="dd-mm-yyyy" value="<?php echo date('Y-m-d');?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('get_teachers');?></button>
                </div>
                
                </form>  
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="<?php echo base_url();?>admin/teacher_attendance_report" class="btn btn-info btn-block btn-rounded btn-sm text-white">
                            <i class="fa fa-bar-chart"></i>&nbsp;<?php echo get_phrase('View Attendance Report');?>
                        </a>
                    </div>
                </div>              
            </div>                
        </div>
    </div>
</div>

<?php if(isset($date)):?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-body table-responsive">
                <h3 style="color:#696969;"><?php echo get_phrase('Teacher Attendance');?></h3>
                <h3 style="color:#696969;"><?php echo date('d M Y', strtotime($date));?></h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-body table-responsive">
                <form action="<?php echo base_url();?>admin/teacher_attendance/take_attendance" method="post">
                    <input type="hidden" name="date" value="<?php echo $date;?>">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><div>#</div></th>
                                <th><div><?php echo get_phrase('Image');?></div></th>
                                <th><div><?php echo get_phrase('Name');?></div></th>
                                <th><div><?php echo get_phrase('Department');?></div></th>
                                <th><div><?php echo get_phrase('Status');?></div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($teachers) && !empty($teachers)):
                                // Create attendance status array for quick lookup
                                $attendance_status = array();
                                if (isset($attendance_data) && !empty($attendance_data)) {
                                    foreach($attendance_data as $row) {
                                        $attendance_status[$row['teacher_id']] = $row['status'];
                                    }
                                }
                                
                                $i = 1;
                                foreach($teachers as $teacher):
                                    $status = isset($attendance_status[$teacher['teacher_id']]) ? $attendance_status[$teacher['teacher_id']] : 0;
                            ?>
                            <tr>
                                <td><?php echo $i++;?></td>
                                <td><img src="<?php echo $this->crud_model->get_image_url('teacher', $teacher['teacher_id']);?>" class="img-circle" style="max-height:30px; margin-right:10px;"></td>
                                <td><?php echo $teacher['name'];?></td>
                                <td>
                                    <?php 
                                    if (isset($teacher['department_id']) && $teacher['department_id'] != '') {
                                        $department = $this->db->get_where('department', array('department_id' => $teacher['department_id']))->row();
                                        echo $department ? $department->name : '-';
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <input type="hidden" name="teacher_id[]" value="<?php echo $teacher['teacher_id'];?>">
                                    <select name="status[]" class="form-control">
                                        <option value="0" <?php if($status == 0) echo 'selected';?>><?php echo get_phrase('Undefined');?></option>
                                        <option value="1" <?php if($status == 1) echo 'selected';?>><?php echo get_phrase('Present');?></option>
                                        <option value="2" <?php if($status == 2) echo 'selected';?>><?php echo get_phrase('Absent');?></option>
                                        <option value="3" <?php if($status == 3) echo 'selected';?>><?php echo get_phrase('Late');?></option>
                                        <option value="4" <?php if($status == 4) echo 'selected';?>><?php echo get_phrase('Half Day');?></option>
                                    </select>
                                </td>
                            </tr>
                            <?php 
                                endforeach;
                            else:
                            ?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-warning">
                                            <?php echo get_phrase('no_teachers_found'); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <?php if (isset($teachers) && !empty($teachers)): ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
                    </div>
                    <?php endif; ?>
                </form>

                <!-- <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="<?php echo base_url();?>admin/teacher_attendance_report" class="btn btn-info btn-block btn-rounded btn-sm text-white">
                            <i class="fa fa-bar-chart"></i>&nbsp;<?php echo get_phrase('View Attendance Report');?>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<?php endif;?>

<style>
    div.datepicker{
        border: 1px solid #c4c4c4 !important;
    }
</style>


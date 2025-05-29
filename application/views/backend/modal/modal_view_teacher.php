<?php 
$teacher_info = $this->db->get_where('teacher', array('teacher_id' => $param2))->result_array();
foreach($teacher_info as $row):
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><i class="fa fa-user"></i> Teacher Details</h4>
</div>

<div class="modal-body" style="max-height: 500px; overflow-y: auto;">
    <div class="row">
        <div class="col-md-4 text-center">
            <img src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']);?>" 
                 class="img-circle" width="120" height="120" style="border: 3px solid #ddd;">
            <h4 style="margin-top: 10px;"><?php echo $row['name'];?></h4>
            <p class="text-muted">
                <?php 
                if($row['role'] == 1) echo 'Class Teacher';
                if($row['role'] == 2) echo 'Subject Teacher';
                ?>
            </p>
        </div>
        
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <h5><i class="fa fa-info-circle"></i> Personal Information</h5>
                    <hr style="margin: 5px 0;">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Email:</strong> <?php echo $row['email'];?></p>
                    <p><strong>Phone:</strong> <?php echo $row['phone'];?></p>
                    <p><strong>Gender:</strong> <?php echo ucfirst($row['sex']);?></p>
                    <p><strong>Birthday:</strong> <?php echo date('d M Y', strtotime($row['birthday']));?></p>
                    <p><strong>Religion:</strong> <?php echo $row['religion'];?></p>
                    <p><strong>Blood Group:</strong> <?php echo $row['blood_group'];?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Address:</strong> <?php echo $row['address'];?></p>
                    <p><strong>Qualification:</strong> <?php echo $row['qualification'];?></p>
                    <p><strong>Marital Status:</strong> <?php echo ucfirst($row['marital_status']);?></p>
                    <p><strong>Date of Joining:</strong> 
                        <?php echo $row['date_of_joining'] ? date('d M Y', strtotime($row['date_of_joining'])) : 'N/A';?>
                    </p>
                    <p><strong>Joining Salary:</strong> ₹<?php echo number_format($row['joining_salary']);?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <h5><i class="fa fa-id-card"></i> Identity Information</h5>
            <hr style="margin: 5px 0;">
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <p><strong>Teacher Number:</strong> <?php echo $row['teacher_number'];?></p>
        </div>
        <div class="col-md-4">
            <p><strong>Aadhar Number:</strong> 
                <?php echo isset($row['aadhar_number']) && !empty($row['aadhar_number']) ? $row['aadhar_number'] : 'N/A';?>
            </p>
        </div>
        <div class="col-md-4">
            <p><strong>PAN Number:</strong> 
                <?php echo isset($row['pan_number']) && !empty($row['pan_number']) ? $row['pan_number'] : 'N/A';?>
            </p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <p><strong>Family ID:</strong> 
                <?php echo isset($row['family_id']) && !empty($row['family_id']) ? $row['family_id'] : 'N/A';?>
            </p>
        </div>
    </div>
    
    <?php 
    // Get bank details
    $bank_info = $this->db->get_where('bank', array('bank_id' => $row['bank_id']))->row();
    if($bank_info):
    ?>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <h5><i class="fa fa-bank"></i> Bank Account Details</h5>
            <hr style="margin: 5px 0;">
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <p><strong>Account Holder:</strong> <?php echo $bank_info->account_holder_name;?></p>
            <p><strong>Account Number:</strong> <?php echo $bank_info->account_number;?></p>
            <p><strong>Bank Name:</strong> <?php echo $bank_info->bank_name;?></p>
        </div>
        <div class="col-md-6">
            <p><strong>Branch:</strong> <?php echo $bank_info->branch;?></p>
            <p><strong>IFSC Code:</strong> 
                <?php echo isset($bank_info->ifsc_code) && !empty($bank_info->ifsc_code) ? $bank_info->ifsc_code : 'N/A';?>
            </p>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if(!empty($row['facebook']) || !empty($row['twitter']) || !empty($row['linkedin'])): ?>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <h5><i class="fa fa-share-alt"></i> Social Media</h5>
            <hr style="margin: 5px 0;">
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <?php if(!empty($row['facebook'])): ?>
            <p><strong>Facebook:</strong> <a href="<?php echo $row['facebook'];?>" target="_blank"><?php echo $row['facebook'];?></a></p>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <?php if(!empty($row['twitter'])): ?>
            <p><strong>Twitter:</strong> <a href="<?php echo $row['twitter'];?>" target="_blank"><?php echo $row['twitter'];?></a></p>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <?php if(!empty($row['linkedin'])): ?>
            <p><strong>LinkedIn:</strong> <a href="<?php echo $row['linkedin'];?>" target="_blank"><?php echo $row['linkedin'];?></a></p>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if(!empty($row['file_name'])): ?>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <h5><i class="fa fa-file"></i> Documents</h5>
            <hr style="margin: 5px 0;">
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <p><strong>CV/Documents:</strong> 
                <a href="<?php echo base_url().'uploads/teacher_image/'.$row['file_name'];?>" target="_blank" class="btn btn-sm btn-info">
                    <i class="fa fa-download"></i> Download
                </a>
            </p>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <a href="<?php echo base_url();?>admin/teacher/edit/<?php echo $row['teacher_id'];?>" class="btn btn-primary">
        <i class="fa fa-edit"></i> Edit Teacher
    </a>
</div>

<?php endforeach; ?> 
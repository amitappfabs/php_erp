<?php 
$edit_teacher		=	$this->db->get_where('teacher' , array('teacher_id' => $param2) )->result_array();
foreach ( $edit_teacher as $key => $row):
?>
	
            
            
            <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <?php echo get_phrase('edit_teacher');?></div>
						
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                    <?php echo form_open(base_url() . 'admin/teacher/update/'. $row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                    <div class="row">
                    <div class="col-sm-6">
                                
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
							
							<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('role');?></label>
                    <div class="col-sm-12">
							<select name="role" class="form-control select2" required>
                                    	<option value="1" <?php if($row['role'] == '1')echo 'selected';?>><?php echo get_phrase('class_teacher');?></option>
                                    	<option value="2" <?php if($row['role'] == '2')echo 'selected';?>><?php echo get_phrase('subject_teacher');?></option>
                          </select>
						</div> 
					</div>
					
					  <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('birthday');?></label>
                    <div class="col-sm-12">
		<input class="form-control m-r-10" name="birthday" type="date" value="<?php echo $row['birthday'];?>" id="example-date-input" required>
						</div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('gender');?></label>
                    <div class="col-sm-12">
							<select name="sex" class="form-control select2" style="width:100%" required>
                              <option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                              <option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('religion');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="religion" value="<?php echo $row['religion'];?>" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('blood_group');?></label>
                    <div class="col-sm-12">
							<select name="blood_group" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="A+" <?php if($row['blood_group'] == 'A+')echo 'selected';?>>A+</option>
                              <option value="A-" <?php if($row['blood_group'] == 'A-')echo 'selected';?>>A-</option>
                              <option value="B+" <?php if($row['blood_group'] == 'B+')echo 'selected';?>>B+</option>
                              <option value="B-" <?php if($row['blood_group'] == 'B-')echo 'selected';?>>B-</option>
                              <option value="AB+" <?php if($row['blood_group'] == 'AB+')echo 'selected';?>>AB+</option>
                              <option value="AB-" <?php if($row['blood_group'] == 'AB-')echo 'selected';?>>AB-</option>
                              <option value="O+" <?php if($row['blood_group'] == 'O+')echo 'selected';?>>O+</option>
                              <option value="O-" <?php if($row['blood_group'] == 'O-')echo 'selected';?>>O-</option>
                          </select>
						</div> 
					</div>
					
						<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('address');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>" required>
						</div> 
					</div>
					
				<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('phone');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>" required >
						</div>
					</div>
                    
					<!-- Email and Password together -->
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('email');?></label>
                    <div class="col-sm-12">
							<input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>" required>
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('password');?></label>
                    <div class="col-sm-12">
						<input type="password" class="form-control" name="password" value="" placeholder="Leave blank to keep current password">
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('qualification');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="qualification" value="<?php echo $row['qualification'];?>">
						</div>
					</div>
					
					<div class="form-group">
                                    <label class="col-sm-12"><?php echo get_phrase('marital_status');?>*</label>
                                    <div class="col-sm-12">
                                       <select class=" form-control select2" name="marital_status" style="width:100%" required>
                                         <option value="Married" <?php if($row['marital_status'] == 'Married')echo 'selected';?>><?php echo get_phrase('married');?></option>
                                        <option value="Single" <?php if($row['marital_status'] == 'Single')echo 'selected';?>><?php echo get_phrase('single');?></option>
                                        <option value="Divorced" <?php if($row['marital_status'] == 'Divorced')echo 'selected';?>><?php echo get_phrase('divorced');?></option>
                                        <option value="Engaged" <?php if($row['marital_status'] == 'Engaged')echo 'selected';?>><?php echo get_phrase('engaged');?></option>
                                    </select>
                                    </div>
                                </div>
					
					<!-- Social Media Fields with Optional Labels -->
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('facebook');?> (Optional)</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="facebook" value="<?php echo $row['facebook'];?>">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('twitter');?> (Optional)</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="twitter" value="<?php echo $row['twitter'];?>">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('linkedin');?> (Optional)</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="linkedin" value="<?php echo $row['linkedin'];?>">
						</div>
					</div>
					
					<!-- New Additional Fields -->
					<div class="form-group">
                 	<label class="col-md-12" for="example-text">Aadhar Number</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="aadhar_number" value="<?php echo isset($row['aadhar_number']) ? $row['aadhar_number'] : '';?>" maxlength="12" pattern="[0-9]{12}" title="Please enter 12 digit Aadhar number">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text">PAN Number</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="pan_number" value="<?php echo isset($row['pan_number']) ? $row['pan_number'] : '';?>" maxlength="10" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Please enter valid PAN number (e.g., ABCDE1234F)" style="text-transform: uppercase;">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text">Family ID</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="family_id" value="<?php echo isset($row['family_id']) ? $row['family_id'] : '';?>">
						</div>
					</div>
					
					</div>
					
					<div class="col-sm-6">
					
					<div class="form-group"> 
					 <label class="col-sm-12"><?php echo get_phrase('browse_image');?></label>        
					 <div class="col-sm-12">
  		  			  <input type='file' name="userfile" class="dropify" onChange="readURL(this);" />
					 </div>
					</div>	
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('documents');?>&nbsp;(Teacher CV and others)</label>
                    <div class="col-sm-12">
             	<input type="file" name="file_name" class="dropify">
			 
			  <p style="color:red">Accept zip, pdf, word, excel, rar and others</p>
			  
					</div>
					</div>
					
<hr>
<div class="alert alert-primary">BANK ACCOUNT DETAILS</div>
<hr>

<?php 
// Get bank details
$bank_info = $this->db->get_where('bank', array('bank_id' => $row['bank_id']))->row();
?>

<div class="form-group">
     <label class="col-sm-12"><?php echo get_phrase('account_holder_name'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="account_holder_name" value="<?php echo $bank_info ? $bank_info->account_holder_name : '';?>" required />
    </div>
</div>

<div class="form-group">
     <label class="col-sm-12"><?php echo get_phrase('account_number'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="account_number" value="<?php echo $bank_info ? $bank_info->account_number : '';?>" required />
    </div>
</div>

<div class="form-group">
     <label class="col-sm-12"><?php echo get_phrase('bank_name'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="bank_name" value="<?php echo $bank_info ? $bank_info->bank_name : '';?>" required>
    </div> 
</div>

<div class="form-group">
     <label class="col-sm-12"><?php echo get_phrase('branch'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="branch" value="<?php echo $bank_info ? $bank_info->branch : '';?>" >
    </div> 
</div>

<div class="form-group">
     <label class="col-sm-12">IFSC Code</label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="ifsc_code" value="<?php echo $bank_info && isset($bank_info->ifsc_code) ? $bank_info->ifsc_code : '';?>" maxlength="11" pattern="[A-Z]{4}[0-9]{7}" title="Please enter valid IFSC code (e.g., SBIN0001234)" style="text-transform: uppercase;">
    </div> 
</div>

<div class="form-group">
   <label class="col-sm-12"><?php echo get_phrase('joining_salary'); ?></label>
    <div class="col-sm-12">
        <input type="number" class="form-control" name="joining_salary" value="<?php echo $row['joining_salary'];?>" required>
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-12"><?php echo get_phrase('date_of_joining'); ?></label>
    <div class="col-sm-12">
        <input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo $row['date_of_joining'];?>" required>
    </div> 
</div>

</div>
</div>

<div class="form-group">			
<button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"> <i class="fa fa-edit"></i>&nbsp;<?php echo get_phrase('update_teacher');?></button>
</div>			
                    
                    
                <?php echo form_close();?>	
									
									
                                </div>
                            </div>
                        </div>
                    </div>
				</div>

<?php endforeach;?>

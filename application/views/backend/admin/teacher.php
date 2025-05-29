				
  <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><?php echo get_phrase('new_teacher');?>
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW TEACHER HERE<i class="btn btn-info btn-xs"></i></a> <a href="#" data-perform="panel-dismiss"></a> </div>
                            </div>
                            <div class="panel-wrapper collapse out" aria-expanded="true">
                                <div class="panel-body">
                                    
									
								 <?php echo form_open(base_url() . 'admin/teacher/insert/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="row">
                    <div class="col-sm-6">
	
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="name" required>
							<input type="hidden" class="form-control" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" name="teacher_number">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('role');?></label>
                    <div class="col-sm-12">
							<select name="role" class="form-control select2" style="width:100%" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="1"><?php echo get_phrase('class_teacher');?></option>
                              <option value="2"><?php echo get_phrase('subject_teacher');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('birthday');?></label>
                    <div class="col-sm-12">
		<input class="form-control m-r-10" name="birthday" type="date" value="2018-08-19" id="example-date-input" required>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('gender');?></label>
                    <div class="col-sm-12">
							<select name="sex" class="form-control select2" style="width:100%" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('religion');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="religion" value="" >
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('blood_group');?></label>
                    <div class="col-sm-12">
							<select name="blood_group" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="A+">A+</option>
                              <option value="A-">A-</option>
                              <option value="B+">B+</option>
                              <option value="B-">B-</option>
                              <option value="AB+">AB+</option>
                              <option value="AB-">AB-</option>
                              <option value="O+">O+</option>
                              <option value="O-">O-</option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('address');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="address" value="" required>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('phone');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="phone" value="" required >
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('email');?></label>
                    <div class="col-sm-12">
							<input type="email" class="form-control" name="email" value="" required>
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('password');?></label>
                    <div class="col-sm-12">
						<input type="password" class="form-control" name="password" value="" onkeyup="CheckPasswordStrength(this.value)" required>
					<strong id="password_strength"></strong>
						</div> 
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('qualification');?></label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="qualification" value="">
						</div>
					</div>
					
					<div class="form-group">
                                    <label class="col-sm-12"><?php echo get_phrase('marital_status');?>*</label>
                                    <div class="col-sm-12">
                                       <select class=" form-control select2" name="marital_status" style="width:100%" required>
                                         <option value=""><?php echo get_phrase('select_marital_status');?></option>
										<option value="Married"><?php echo get_phrase('married');?></option>
                                        <option value="Single"><?php echo get_phrase('single');?></option>
                                        <option value="Divorced"><?php echo get_phrase('divorced');?></option>
                                        <option value="Engaged"><?php echo get_phrase('engaged');?></option>
                                    </select>
                                    </div>
                                </div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('facebook');?> (Optional)</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="facebook" value="">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('twitter');?> (Optional)</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="twitter" value="">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('linkedin');?> (Optional)</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="linkedin" value="">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text">Aadhar Number</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="aadhar_number" value="" maxlength="12" pattern="[0-9]{12}" title="Please enter 12 digit Aadhar number">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text">PAN Number</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="pan_number" value="" maxlength="10" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" title="Please enter valid PAN number (e.g., ABCDE1234F)" style="text-transform: uppercase;">
						</div>
					</div>
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text">Family ID</label>
                    <div class="col-sm-12">
							<input type="text" class="form-control" name="family_id" value="">
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

<div class="form-group">
     <label class="col-sm-12"><?php echo get_phrase('account_holder_name'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="account_holder_name" value="" required />
    </div>
</div>

<div class="form-group">
     <label class="col-sm-12"><?php echo get_phrase('account_number'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="account_number" value="" required />
    </div>
</div>

<div class="form-group">
     <label class="col-sm-12"><?php echo get_phrase('bank_name'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="bank_name" value="" required>
    </div> 
</div>

<div class="form-group">
     <label class="col-sm-12"><?php echo get_phrase('branch'); ?></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="branch" value="" >
    </div> 
</div>

<div class="form-group">
     <label class="col-sm-12">IFSC Code</label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="ifsc_code" value="" maxlength="11" pattern="[A-Z]{4}[0-9]{7}" title="Please enter valid IFSC code (e.g., SBIN0001234)" style="text-transform: uppercase;">
    </div> 
</div>

<div class="form-group">
   <label class="col-sm-12"><?php echo get_phrase('joining_salary'); ?></label>
    <div class="col-sm-12">
        <input type="number" class="form-control" name="joining_salary" value="" required>
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-12"><?php echo get_phrase('date_of_joining'); ?></label>
    <div class="col-sm-12">
        <input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo date('Y-m-d');?>" required>
    </div> 
</div>

</div>
</div>

<div class="form-group">			
<button type="submit" class="btn btn-primary btn-rounded btn-block btn-sm"> <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_teacher');?></button>
<img id="install_progress" src="<?php echo base_url() ?>assets/images/loader-2.gif" style="margin-left: 20px; display: none"/>					
</div>			
                    
                    
                <?php echo form_close();?>	
									
									
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
					
            <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_teachers');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('gender');?></div></th>
                            <th><div><?php echo get_phrase('address');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $teachers = $this->db->get('teacher')->result_array();
                        foreach($teachers as $key => $teacher):?>
                        <tr>
                            <td>
                                <img src="<?php echo $this->crud_model->get_image_url('teacher', $teacher['teacher_id']);?>" class="img-circle" width="30" />
                            </td>
                            <td><?php echo $teacher['name'];?></td>
                            <td><?php echo $teacher['email'];?></td>
                            <td><?php echo $teacher['phone'];?></td>
                            <td><?php echo ucfirst($teacher['sex']);?></td>
                            <td><?php echo $teacher['address'];?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_view_teacher/<?php echo $teacher['teacher_id'];?>');">
                                            <i class="fa fa-eye"></i> View</a></li>
                                        <li><a href="<?php echo base_url();?>admin/teacher/edit/<?php echo $teacher['teacher_id'];?>">
                                            <i class="fa fa-edit"></i> Edit</a></li>
                                        <li><a href="<?php echo base_url();?>admin/teacher/delete/<?php echo $teacher['teacher_id'];?>" onclick="return confirm('Are you sure you want to delete this teacher?');">
                                            <i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
</div>


<script type="text/javascript">
    
    function get_designation_val(department_id) {
        if(department_id != '')
            $.ajax({
                url: '<?php echo base_url();?>admin/get_designation/' + department_id,
                success: function(response)
                {
                    console.log(response);
                    jQuery('#designation_holder').html(response);
                }
            });
        else
            jQuery('#designation_holder').html('<option value=""><?php echo get_phrase("select_a_department_first"); ?></option>');
    }
    
</script>

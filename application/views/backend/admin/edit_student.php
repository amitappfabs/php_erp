<?php $students = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
        foreach($students as $key => $student):

// Set active tab, defaulting to 'student' if not specified
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'student';
?>

<style>
    /* Custom Navigation Tabs Styling */
    .admission-nav {
        background: #fff;
        padding: 15px 15px 0;
        border-radius: 8px 8px 0 0;
        border: 1px solid #e0e0e0;
        border-bottom: none;
    }

    .admission-nav .nav-tabs {
        border-bottom: none;
        display: flex;
        gap: 10px;
    }

    .admission-nav .nav-tabs > li {
        margin-bottom: 0;
        flex: 1;
        text-align: center;
    }

    .admission-nav .nav-tabs > li > a {
        margin: 0;
        padding: 15px;
        border-radius: 8px 8px 0 0;
        color: #555;
        font-size: 15px;
        font-weight: 500;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        background: #f8f9fa;
        position: relative;
        overflow: hidden;
    }

    .admission-nav .nav-tabs > li > a i {
        margin-right: 8px;
        font-size: 18px;
        vertical-align: middle;
    }

    .admission-nav .nav-tabs > li > a:hover {
        background: #e9ecef;
        border-color: #e9ecef;
        color: #333;
    }

    .admission-nav .nav-tabs > li.active > a,
    .admission-nav .nav-tabs > li.active > a:focus,
    .admission-nav .nav-tabs > li.active > a:hover {
        border: 2px solid #2196F3;
        border-bottom: 2px solid #2196F3;
        background: #2196F3;
        color: #fff;
    }

    .admission-nav .nav-tabs > li > a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 3px;
        background: #2196F3;
        transition: width 0.3s ease;
    }

    .admission-nav .nav-tabs > li > a:hover::after {
        width: 100%;
    }

    /* Tab Content Styling */
    .tab-content > .tab-pane {
        display: none;
    }
    
    .tab-content > .active {
        display: block;
    }

    /* Progress indicator */
    .progress-indicator {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
        position: relative;
        padding: 0 50px;
    }

    .progress-indicator::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: #e0e0e0;
        transform: translateY(-50%);
        z-index: 1;
    }

    .progress-step {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #666;
        position: relative;
        z-index: 2;
    }

    .progress-step.active {
        background: #2196F3;
        border-color: #2196F3;
        color: #fff;
    }

    .progress-step.completed {
        background: #4CAF50;
        border-color: #4CAF50;
        color: #fff;
    }

    /* Form Section Styling */
    .form-section-title {
        background: #f5f5f5;
        padding: 10px 15px;
        margin: 30px 0 20px;
        border-left: 4px solid #2196F3;
        font-weight: 600;
        color: #333;
        border-radius: 0 4px 4px 0;
    }

    /* Navigation Button Container */
    .nav-buttons {
        margin-top: 30px;
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }

    /* Button Styling */
    .btn-next, .btn-prev, .btn-save, .btn-print {
        padding: 12px 25px;
        font-weight: 500;
        letter-spacing: 0.5px;
        border-radius: 4px;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        border: none;
    }

    .btn:hover {
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        transform: translateY(-2px);
    }
    
    .btn:active {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        transform: translateY(1px);
    }

    /* Primary Button - Next */
    .btn-next {
        background: linear-gradient(45deg, #2196F3, #1976D2);
        color: white;
    }

    .btn-next:hover {
        background: linear-gradient(45deg, #1976D2, #0D47A1);
        color: white;
    }

    /* Secondary Button - Previous */
    .btn-prev {
        background: linear-gradient(45deg, #78909C, #546E7A);
        color: white;
    }

    .btn-prev:hover {
        background: linear-gradient(45deg, #546E7A, #37474F);
        color: white;
    }

    /* Success Button - Save */
    .btn-save {
        background: linear-gradient(45deg, #4CAF50, #388E3C);
        color: white;
    }

    .btn-save:hover {
        background: linear-gradient(45deg, #388E3C, #1B5E20);
        color: white;
    }

    /* Info Button - Print */
    .btn-print {
        background: linear-gradient(45deg, #9C27B0, #7B1FA2);
        color: white;
    }

    .btn-print:hover {
        background: linear-gradient(45deg, #7B1FA2, #4A148C);
        color: white;
    }

    .btn i {
        margin-right: 8px;
    }
    
    /* Content Panel Styling */
    .panel-info {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .panel-info > .panel-body {
        padding: 0;
    }

    .tab-content {
        background: #fff;
        padding: 30px;
        border: 1px solid #e0e0e0;
        border-top: none;
        border-radius: 0 0 8px 8px;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 25px;
    }

    .form-control {
        height: 45px;
        border-radius: 4px;
        border: 1px solid #e0e0e0;
        padding: 10px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #2196F3;
        box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
    }

    textarea.form-control {
        height: auto;
        min-height: 100px;
    }
    
    /* Print Styles */
    @media print {
        body {
            background: white;
            font-size: 12pt;
            color: #000;
        }
        
        .admission-nav, 
        .nav-buttons,
        .header, 
        .sidebar,
        .page-wrapper,
        .no-print {
            display: none !important;
        }
        
        .tab-content > .tab-pane {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        .form-section-title {
            padding: 8px;
            margin: 15px 0;
            border-left: 3px solid #000;
            background: #f5f5f5;
            page-break-after: avoid;
        }
        
        .panel, .panel-body {
            border: none !important;
            box-shadow: none !important;
        }
        
        .form-group {
            margin-bottom: 10px;
        }
        
        input.form-control {
            border: none;
            border-bottom: 1px solid #ddd;
            box-shadow: none;
            border-radius: 0;
            height: auto;
            padding: 5px 0;
        }
        
        select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: none;
            border-bottom: 1px solid #ddd;
            background: transparent;
            padding: 5px 0;
        }
        
        .row {
            page-break-inside: avoid;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        /* Page breaks */
        #parent {
            page-break-before: always;
        }
        
        #transport {
            page-break-before: always;
        }
        
        #documents {
            page-break-before: always;
        }
    }
</style>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-info">
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
								
                                <?php if($this->session->flashdata('error_message')): ?>
                                <div class="alert alert-danger">
                            <i class="fa fa-exclamation-circle"></i>
                                    <?php echo $this->session->flashdata('error_message'); ?>
                                </div>
                                <?php endif; ?>
								
                    <?php if($this->session->flashdata('flash_message')): ?>
                        <div class="alert alert-success">
                            <i class="fa fa-check-circle"></i>
                            <?php echo $this->session->flashdata('flash_message'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Form validation errors container -->
                    <div id="form-validation-errors" class="alert alert-danger" style="display: none;">
                        <i class="fa fa-exclamation-circle"></i>
                        <strong>Form Validation Errors:</strong>
                        <ul id="error-list"></ul>
                    </div>

                    <?php echo form_open(base_url() . 'admin/student/update/' . $student_id, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data', 'id' => 'student-edit-form', 'novalidate' => 'novalidate')); ?>

                    <!-- Progress Indicator -->
                    <div class="progress-indicator">
                        <div class="progress-step <?php echo $activeTab == 'student' ? 'active' : ($activeTab == 'parent' || $activeTab == 'transport' || $activeTab == 'documents' ? 'completed' : ''); ?>">1</div>
                        <div class="progress-step <?php echo $activeTab == 'parent' ? 'active' : ($activeTab == 'transport' || $activeTab == 'documents' ? 'completed' : ''); ?>">2</div>
                        <div class="progress-step <?php echo $activeTab == 'transport' ? 'active' : ($activeTab == 'documents' ? 'completed' : ''); ?>">3</div>
                        <div class="progress-step <?php echo $activeTab == 'documents' ? 'active' : ''; ?>">4</div>
                    </div>

                    <!-- Navigation Tabs -->
                    <div class="admission-nav">
                        <ul class="nav nav-tabs">
                            <li class="<?php echo $activeTab == 'student' ? 'active' : ''; ?>">
                                <a href="#student" data-toggle="tab">
                                    <i class="fa fa-user"></i> <?php echo get_phrase('Student Information'); ?>
                                </a>
                            </li>
                            <li class="<?php echo $activeTab == 'parent' ? 'active' : ''; ?>">
                                <a href="#parent" data-toggle="tab">
                                    <i class="fa fa-users"></i> <?php echo get_phrase('Parent Information'); ?>
                                </a>
                            </li>
                            <li class="<?php echo $activeTab == 'transport' ? 'active' : ''; ?>">
                                <a href="#transport" data-toggle="tab">
                                    <i class="fa fa-bus"></i> <?php echo get_phrase('Transport & Facilities'); ?>
                                </a>
                            </li>
                            <li class="<?php echo $activeTab == 'documents' ? 'active' : ''; ?>">
                                <a href="#documents" data-toggle="tab">
                                    <i class="fa fa-file-text"></i> <?php echo get_phrase('Documents'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Student Information Tab -->
                        <div class="tab-pane <?php echo $activeTab == 'student' ? 'active' : ''; ?>" id="student">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle"></i> 
                                        <strong>Required Fields:</strong> Admission Number, Student Name, Email, and Class are required. All other fields are optional.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Student Photo Upload -->
                            <div class="form-section-title">
                                <i class="fa fa-image"></i> <?php echo get_phrase('Student Photo'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group required-field"> 
                                        <label class="col-md-12"><?php echo get_phrase('student_photo'); ?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control dropify" name="userfile" 
                                                  data-allowed-file-extensions="jpg jpeg png" 
                                                  data-max-file-size="5M" 
                                                  data-show-errors="true" 
                                                  data-errors-position="outside" 
                                                  data-height="200" 
                                                  data-width="150"
                                                  data-default-file="<?php echo base_url();?>uploads/student_image/<?php echo $student['student_id'].'.jpg';?>">
                                            <small class="text-muted"><?php echo get_phrase('Allowed: JPG, JPEG, PNG. Max size: 5MB. Dimensions: 3.5cm x 4.5cm'); ?></small>
                                            <div id="photo-upload-error" class="text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
					
                            <!-- Basic Information -->
                            <div class="form-section-title">
                                <i class="fa fa-info-circle"></i> <?php echo get_phrase('Basic Information'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('student_code');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="student_code" value="<?php echo isset($student['student_code']) ? $student['student_code'] : substr(md5(uniqid(rand(), true)), 0, 7); ?>">
                                            <small class="text-muted"><?php echo get_phrase('Unique student code (up to 6 digits)'); ?></small>
                                        </div>
						</div>
					</div>
					
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('admission_no');?> <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="admission_number" value="<?php echo $student['admission_number'];?>">
                                            <small class="text-muted"><?php echo get_phrase('Enter admission number (Required)'); ?></small>
                                        </div>
						</div>
					</div>
					
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('full_name');?> <span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="name" value="<?php echo $student['name'];?>">
                                            <small class="text-muted"><?php echo get_phrase('(Required) Enter student\'s full name'); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
						<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('email');?> <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                                            <input type="email" class="form-control" name="email" value="<?php echo $student['email'];?>">
                                            <small class="text-muted"><?php echo get_phrase('(Required) Enter student\'s email address'); ?></small>
                                        </div>
						</div>
					</div>

                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('password');?></label>
                    <div class="col-sm-12">
                                            <input type="password" class="form-control" name="password" id="student_password" onkeyup="CheckPasswordStrength(this.value)">
                                            <span id="password_strength"></span>
                                            <small class="text-muted"><?php echo get_phrase('Leave blank to keep current password'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('phone');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="phone" value="<?php echo $student['phone'];?>" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <small class="text-muted"><?php echo get_phrase('(Optional) Enter 10-digit mobile number'); ?></small>
                                        </div>
                                    </div>
						</div> 
						</div>
					
                            <!-- Academic Information -->
                            <div class="form-section-title">
                                <i class="fa fa-graduation-cap"></i> <?php echo get_phrase('Academic Information'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('class');?> <span class="text-danger">*</span></label>
                    <div class="col-sm-12">
                                            <select name="class_id" class="form-control select2" style="width:100%" id="class_id" 
								data-message-required="<?php echo get_phrase('value_required');?>"
                                                    onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $key => $class):
									?>
                            		<option value="<?php echo $class['class_id'];?>"<?php if($student['class_id'] == $class['class_id']) echo 'selected';?>>
											<?php echo $class['name'];?>
                                            </option>
                                                <?php endforeach; ?>
                          </select>
                                        </div>
						</div> 
					</div>

                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('section');?></label>
                    <div class="col-sm-12">
		                        <select name="section_id" class="form-control select2" style="width:100%" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                    </select>
                                        </div>
			                </div>
					</div>						
					
                                <div class="col-md-4">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('session');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="session" value="<?php echo $student['session'];?>">
                                            <small class="text-muted"><?php echo get_phrase('Enter academic session (e.g. 2023-2024)'); ?></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('admission_date');?></label>
                    <div class="col-sm-12">
                                            <input type="date" class="form-control datepicker" name="am_date" value="<?php echo $student['am_date'];?>">
                                        </div>
						</div> 
					</div>
					
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('birthday');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="birthday" value="<?php echo $student['birthday'];?>" id="birthday">
                                        </div>
						</div> 
					</div>
					
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('age');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control calculated-field" name="age" id="age" value="<?php echo $student['age'];?>" readonly>
                                        </div>
                                    </div>
						</div> 
					</div>
					
                            <!-- Personal Information -->
                            <div class="form-section-title">
                                <i class="fa fa-user"></i> <?php echo get_phrase('Personal Information'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('gender');?></label>
                    <div class="col-sm-12">
							<select name="sex" class="form-control select2" style="width:100%">
                              <option value=""><?php echo get_phrase('select');?></option>
                                                <option value="male" <?php if($student['sex'] == 'male') echo 'selected';?>><?php echo get_phrase('male');?></option>
                                                <option value="female" <?php if($student['sex'] == 'female') echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
                                        </div>
						</div> 
					</div>
					
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('blood_group');?></label>
                    <div class="col-sm-12">
                                            <select name="blood_group" class="form-control select2" style="width:100%">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <?php
                                                $blood_groups = array('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-');
                                                foreach($blood_groups as $blood_group):
                                                ?>
                                                <option value="<?php echo $blood_group;?>" <?php if($student['blood_group'] == $blood_group) echo 'selected';?>><?php echo $blood_group;?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
						</div> 
					</div>
				
					
                            <div class="row">
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('Admission Category');?></label>
                    <div class="col-sm-12">
                                            <select name="admission_category" class="form-control select2" style="width:100%">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <option value="general" <?php if(isset($student['admission_category']) && $student['admission_category'] == 'general') echo 'selected';?>><?php echo get_phrase('general');?></option>
                                                <option value="disadvantaged" <?php if(isset($student['admission_category']) && $student['admission_category'] == 'disadvantaged') echo 'selected';?>><?php echo get_phrase('disadvantaged_group');?></option>
                                                <option value="ews" <?php if(isset($student['admission_category']) && $student['admission_category'] == 'ews') echo 'selected';?>><?php echo get_phrase('ews');?></option>
                                            </select>
                                            <small class="text-muted"><?php echo get_phrase('Select admission category'); ?></small>
                                        </div>
						</div> 
					</div>
					
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('Caste');?></label>
                    <div class="col-sm-12">
                                            <select name="caste" class="form-control select2" style="width:100%">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <option value="general" <?php if(isset($student['caste']) && $student['caste'] == 'general') echo 'selected';?>><?php echo get_phrase('general');?></option>
                                                <option value="sc" <?php if(isset($student['caste']) && $student['caste'] == 'sc') echo 'selected';?>><?php echo get_phrase('sc');?></option>
                                                <option value="st" <?php if(isset($student['caste']) && $student['caste'] == 'st') echo 'selected';?>><?php echo get_phrase('st');?></option>
                                                <option value="obc" <?php if(isset($student['caste']) && $student['caste'] == 'obc') echo 'selected';?>><?php echo get_phrase('obc');?></option>
                                                <option value="other" <?php if(isset($student['caste']) && $student['caste'] == 'other') echo 'selected';?>><?php echo get_phrase('other');?></option>
                                            </select>
                                            <small class="text-muted"><?php echo get_phrase('Select caste'); ?></small>
                                        </div>
						</div> 
					</div>
					
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('religion');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="religion" value="<?php echo $student['religion'];?>">
                                        </div>
					</div> 
				</div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('apaar_ID');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="apaar_id" value="<?php echo isset($student['apaar_id']) ? $student['apaar_id'] : ''; ?>" pattern="\d{0,12}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <small class="text-muted"><?php echo get_phrase('(Optional) Enter 12-digit Apaar ID'); ?></small>
                                        </div>
						</div> 
					</div>
					
                                <div class="col-md-6">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('aadhar_card_number');?></label>
                    	<div class="col-sm-12">
                                            <input type="text" class="form-control" name="adhar_no" value="<?php echo isset($student['adhar_no']) ? $student['adhar_no'] : ''; ?>" pattern="[0-9]{12}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <small class="text-muted"><?php echo get_phrase('Enter 12-digit Aadhar Card number'); ?></small>
                                        </div>
                                    </div>
						</div> 
					</div>
						
                            <!-- Address Information -->
                            <div class="form-section-title">
                                <i class="fa fa-home"></i> <?php echo get_phrase('Address Information'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
				<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('address');?></label>
                    <div class="col-sm-12">
                                            <textarea name="address" class="form-control" rows="4"><?php echo $student['address'];?></textarea>
                                            <small class="text-muted"><?php echo get_phrase('Enter present address'); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('city');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="city" value="<?php echo $student['city'];?>">
						</div> 
					</div>
			</div>
					
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('state');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="state" value="<?php echo $student['state'];?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('pincode');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="pincode" value="<?php echo isset($student['pincode']) ? $student['pincode'] : ''; ?>" pattern="[0-9]{6}" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <small class="text-muted"><?php echo get_phrase('Enter 6-digit pincode'); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section-title">
                                <i class="fa fa-home"></i> <?php echo get_phrase('Permanent Address'); ?>
                                <div class="pull-right">
                                    <label>
                                        <input type="checkbox" id="same_as_present" name="same_as_present" <?php 
                                            // Check if permanent address matches present address
                                            if(isset($student['address']) && isset($student['permanent_address']) && 
                                               $student['address'] == $student['permanent_address'] && 
                                               $student['city'] == $student['permanent_city'] && 
                                               $student['state'] == $student['permanent_state'] && 
                                               $student['pincode'] == $student['permanent_pincode']) echo 'checked'; 
                                        ?>> 
                                        <?php echo get_phrase('Same as present address'); ?>
                                    </label>
                                </div>
                            </div>
                            
                            <div id="permanent_address_fields" <?php 
                                // Hide fields if addresses match
                                if(isset($student['address']) && isset($student['permanent_address']) && 
                                   $student['address'] == $student['permanent_address'] && 
                                   $student['city'] == $student['permanent_city'] && 
                                   $student['state'] == $student['permanent_state'] && 
                                   $student['pincode'] == $student['permanent_pincode']) echo 'style="display:none;"'; 
                            ?>>
                                <div class="row">
                                    <div class="col-md-12">
				<div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('permanent_address');?></label>
                    <div class="col-sm-12">
                                                <textarea name="permanent_address" class="form-control" rows="4"><?php echo isset($student['permanent_address']) ? $student['permanent_address'] : ''; ?></textarea>
                                                <small class="text-muted"><?php echo get_phrase('Enter permanent address'); ?></small>
                                            </div>
                                        </div>
						</div> 
					</div>
					
                                <div class="row">
                                    <div class="col-md-4">
						<div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('permanent_city');?></label>
                    <div class="col-sm-12">
                                                <input type="text" class="form-control" name="permanent_city" value="<?php echo isset($student['permanent_city']) ? $student['permanent_city'] : ''; ?>">
                                            </div>
						</div> 
					</div>
					
                                    <div class="col-md-4">
					<div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('permanent_state');?></label>
                    <div class="col-sm-12">
                                                <input type="text" class="form-control" name="permanent_state" value="<?php echo isset($student['permanent_state']) ? $student['permanent_state'] : ''; ?>">
                                            </div>
						</div> 
					</div>
					
                                    <div class="col-md-4">
					<div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('permanent_pincode');?></label>
                    <div class="col-sm-12">
                                                <input type="text" class="form-control" name="permanent_pincode" value="<?php echo isset($student['permanent_pincode']) ? $student['permanent_pincode'] : ''; ?>" pattern="[0-9]{6}" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                <small class="text-muted"><?php echo get_phrase('Enter 6-digit permanent pincode'); ?></small>
                                            </div>
                                        </div>
                                    </div>
						</div>
					</div>
					
                            <!-- Navigation Buttons -->
                            <div class="nav-buttons">
                                <button type="button" class="btn btn-next next-tab" data-next="parent">
                                    <i class="fa fa-arrow-right"></i> <?php echo get_phrase('Next: Parent Information'); ?>
                                </button>
                            </div>
                        </div>

                        <!-- Parent Information Tab -->
                        <div class="tab-pane <?php echo $activeTab == 'parent' ? 'active' : ''; ?>" id="parent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle"></i> 
                                        <strong>Parent Information:</strong> Fill in details about the student's parents or guardians.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Father's Information -->
                            <div class="form-section-title">
                                <i class="fa fa-male"></i> <?php echo get_phrase('Father\'s Information'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
						<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_name');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="father_name" value="<?php echo $student['father_name'];?>">
                                        </div>
						</div>
					</div>
					
                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_phone');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="father_phone" value="<?php echo $student['father_phone'];?>" pattern="[0-9]{10}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <small class="text-muted"><?php echo get_phrase('Enter 10-digit mobile number'); ?></small>
                                        </div>
						</div>
					</div>
					
                                <div class="col-md-4">
						<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_email');?></label>
                    <div class="col-sm-12">
                                            <input type="email" class="form-control" name="father_email" value="<?php echo $student['father_email'];?>">
                                        </div>
                                    </div>
						</div>
					</div>

                            <div class="row">
                                <div class="col-md-4">
						<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_occupation');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="father_occupation" value="<?php echo $student['father_occupation'];?>">
                                        </div>
						</div>
					</div>

                                <div class="col-md-4">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_designation');?></label>
                    <div class="col-sm-12">
                                            <select name="father_designation" class="form-control select2" style="width:100%">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <option value="Administrator" <?php if($student['father_designation'] == 'Administrator') echo 'selected';?>><?php echo get_phrase('Administrator');?></option>
                                                <option value="Art & Craft Teacher" <?php if($student['father_designation'] == 'Art & Craft Teacher') echo 'selected';?>><?php echo get_phrase('Art & Craft Teacher');?></option>
                                                <option value="Assistant Teacher" <?php if($student['father_designation'] == 'Assistant Teacher') echo 'selected';?>><?php echo get_phrase('Assistant Teacher');?></option>
                                                <option value="Computer Teacher" <?php if($student['father_designation'] == 'Computer Teacher') echo 'selected';?>><?php echo get_phrase('Computer Teacher');?></option>
                                                <option value="Dance Teacher" <?php if($student['father_designation'] == 'Dance Teacher') echo 'selected';?>><?php echo get_phrase('Dance Teacher');?></option>
                                                <option value="Driver" <?php if($student['father_designation'] == 'Driver') echo 'selected';?>><?php echo get_phrase('Driver');?></option>
                                                <option value="Librarian" <?php if($student['father_designation'] == 'Librarian') echo 'selected';?>><?php echo get_phrase('Librarian');?></option>
                                                <option value="Music Teacher" <?php if($student['father_designation'] == 'Music Teacher') echo 'selected';?>><?php echo get_phrase('Music Teacher');?></option>
                                                <option value="Nursery Teacher" <?php if($student['father_designation'] == 'Nursery Teacher') echo 'selected';?>><?php echo get_phrase('Nursery Teacher');?></option>
                                                <option value="Peon" <?php if($student['father_designation'] == 'Peon') echo 'selected';?>><?php echo get_phrase('Peon');?></option>
                                                <option value="PGT" <?php if($student['father_designation'] == 'PGT') echo 'selected';?>><?php echo get_phrase('PGT');?></option>
                                                <option value="Physical Education Teacher" <?php if($student['father_designation'] == 'Physical Education Teacher') echo 'selected';?>><?php echo get_phrase('Physical Education Teacher');?></option>
                                                <option value="Physical Training Instructor" <?php if($student['father_designation'] == 'Physical Training Instructor') echo 'selected';?>><?php echo get_phrase('Physical Training Instructor');?></option>
                                                <option value="Primary Teacher" <?php if($student['father_designation'] == 'Primary Teacher') echo 'selected';?>><?php echo get_phrase('Primary Teacher');?></option>
                                                <option value="Receptionist" <?php if($student['father_designation'] == 'Receptionist') echo 'selected';?>><?php echo get_phrase('Receptionist');?></option>
                                                <option value="Sweeper" <?php if($student['father_designation'] == 'Sweeper') echo 'selected';?>><?php echo get_phrase('Sweeper');?></option>
                                                <option value="Trained Graduate Teacher" <?php if($student['father_designation'] == 'Trained Graduate Teacher') echo 'selected';?>><?php echo get_phrase('Trained Graduate Teacher');?></option>
                                                <option value="Transport Incharge" <?php if($student['father_designation'] == 'Transport Incharge') echo 'selected';?>><?php echo get_phrase('Transport Incharge');?></option>
                                                <option value="Other" <?php if($student['father_designation'] == 'Other') echo 'selected';?>><?php echo get_phrase('Other');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_annual_income');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="father_annual_income" value="<?php echo $student['father_annual_income'];?>">
                                        </div>
                                    </div>
						</div> 
					</div>
					
                            <div class="row">
                                <div class="col-md-4">
						<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_adhar');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="father_adhar" value="<?php echo $student['father_adhar'];?>" pattern="[0-9]{12}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <small class="text-muted"><?php echo get_phrase('Enter 12-digit Aadhar Card number'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_qualification');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="father_qualification" value="<?php echo $student['father_qualification'];?>">
                                        </div>
						</div> 
					</div>

                                <div class="col-md-4">
				<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_photo');?></label>
                    <div class="col-sm-12">
                                            <input type="file" class="form-control" name="father_image">
                                            <?php if(isset($student['father_photo']) && !empty($student['father_photo'])): ?>
                                                <img src="<?php echo base_url('uploads/parent_image/' . $student['father_photo']); ?>" alt="Father's Photo" height="100" class="mt-2">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Mother's Information -->
                            <div class="form-section-title">
                                <i class="fa fa-female"></i> <?php echo get_phrase('Mother\'s Information'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_name');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="mother_name" value="<?php echo $student['mother_name'];?>">
                                        </div>
						</div> 
					</div>
					
                                <div class="col-md-4">
				<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_phone');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="mother_phone" value="<?php echo $student['mother_phone'];?>" pattern="[0-9]{10}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <small class="text-muted"><?php echo get_phrase('Enter 10-digit mobile number'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_email');?></label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" name="mother_email" value="<?php echo $student['mother_email'];?>">
                                        </div>
                                    </div>
						</div> 
					</div>

                            <div class="row">
                                <div class="col-md-4">
				<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_occupation');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="mother_occupation" value="<?php echo $student['mother_occupation'];?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_designation');?></label>
                                        <div class="col-sm-12">
                                            <select name="mother_designation" class="form-control select2" style="width:100%">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <option value="Administrator" <?php if($student['mother_designation'] == 'Administrator') echo 'selected';?>><?php echo get_phrase('Administrator');?></option>
                                                <option value="Art & Craft Teacher" <?php if($student['mother_designation'] == 'Art & Craft Teacher') echo 'selected';?>><?php echo get_phrase('Art & Craft Teacher');?></option>
                                                <option value="Assistant Teacher" <?php if($student['mother_designation'] == 'Assistant Teacher') echo 'selected';?>><?php echo get_phrase('Assistant Teacher');?></option>
                                                <option value="Computer Teacher" <?php if($student['mother_designation'] == 'Computer Teacher') echo 'selected';?>><?php echo get_phrase('Computer Teacher');?></option>
                                                <option value="Dance Teacher" <?php if($student['mother_designation'] == 'Dance Teacher') echo 'selected';?>><?php echo get_phrase('Dance Teacher');?></option>
                                                <option value="Driver" <?php if($student['mother_designation'] == 'Driver') echo 'selected';?>><?php echo get_phrase('Driver');?></option>
                                                <option value="Librarian" <?php if($student['mother_designation'] == 'Librarian') echo 'selected';?>><?php echo get_phrase('Librarian');?></option>
                                                <option value="Music Teacher" <?php if($student['mother_designation'] == 'Music Teacher') echo 'selected';?>><?php echo get_phrase('Music Teacher');?></option>
                                                <option value="Nursery Teacher" <?php if($student['mother_designation'] == 'Nursery Teacher') echo 'selected';?>><?php echo get_phrase('Nursery Teacher');?></option>
                                                <option value="Peon" <?php if($student['mother_designation'] == 'Peon') echo 'selected';?>><?php echo get_phrase('Peon');?></option>
                                                <option value="PGT" <?php if($student['mother_designation'] == 'PGT') echo 'selected';?>><?php echo get_phrase('PGT');?></option>
                                                <option value="Physical Education Teacher" <?php if($student['mother_designation'] == 'Physical Education Teacher') echo 'selected';?>><?php echo get_phrase('Physical Education Teacher');?></option>
                                                <option value="Physical Training Instructor" <?php if($student['mother_designation'] == 'Physical Training Instructor') echo 'selected';?>><?php echo get_phrase('Physical Training Instructor');?></option>
                                                <option value="Primary Teacher" <?php if($student['mother_designation'] == 'Primary Teacher') echo 'selected';?>><?php echo get_phrase('Primary Teacher');?></option>
                                                <option value="Receptionist" <?php if($student['mother_designation'] == 'Receptionist') echo 'selected';?>><?php echo get_phrase('Receptionist');?></option>
                                                <option value="Sweeper" <?php if($student['mother_designation'] == 'Sweeper') echo 'selected';?>><?php echo get_phrase('Sweeper');?></option>
                                                <option value="Trained Graduate Teacher" <?php if($student['mother_designation'] == 'Trained Graduate Teacher') echo 'selected';?>><?php echo get_phrase('Trained Graduate Teacher');?></option>
                                                <option value="Transport Incharge" <?php if($student['mother_designation'] == 'Transport Incharge') echo 'selected';?>><?php echo get_phrase('Transport Incharge');?></option>
                                                <option value="Other" <?php if($student['mother_designation'] == 'Other') echo 'selected';?>><?php echo get_phrase('Other');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_annual_income');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="mother_annual_income" value="<?php echo $student['mother_annual_income'];?>">
                                        </div>
                                    </div>
						</div> 
					</div>

                            <div class="row">
                                <div class="col-md-4">
						<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_adhar');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="mother_adhar" value="<?php echo $student['mother_adhar'];?>" pattern="[0-9]{12}" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <small class="text-muted"><?php echo get_phrase('Enter 12-digit Aadhar Card number'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_qualification');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="mother_qualification" value="<?php echo $student['mother_qualification'];?>">
                                        </div>
						</div> 
					</div>

                                <div class="col-md-4">
						<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_photo');?></label>
                    <div class="col-sm-12">
                                            <input type="file" class="form-control" name="mother_image">
                                            <?php if(isset($student['mother_photo']) && !empty($student['mother_photo'])): ?>
                                                <img src="<?php echo base_url('uploads/parent_image/' . $student['mother_photo']); ?>" alt="Mother's Photo" height="100" class="mt-2">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Guardian Information -->
                            <div class="form-section-title">
                                <i class="fa fa-user-plus"></i> <?php echo get_phrase('Guardian Information'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('guardian_name');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="guardian_name" value="<?php echo isset($student['guardian_name']) ? $student['guardian_name'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('guardian_phone');?></label>
                                        <div class="col-sm-12">
                                            <input type="tel" class="form-control" name="guardian_phone" 
                                                value="<?php echo isset($student['guardian_phone']) ? $student['guardian_phone'] : ''; ?>"
                                                pattern="[0-9]{10}" 
                                                maxlength="10"
                                                title="Guardian phone must be a 10-digit number"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <small class="text-muted"><?php echo get_phrase('Enter 10-digit mobile number'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('guardian_email');?></label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" name="guardian_email" 
                                                value="<?php echo isset($student['guardian_email']) ? $student['guardian_email'] : ''; ?>"
                                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                title="Please enter a valid email address">
                                            <small class="text-muted"><?php echo get_phrase('Enter valid email address'); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('guardian_address');?></label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="guardian_address" rows="3"><?php echo isset($student['guardian_address']) ? $student['guardian_address'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="nav-buttons">
                                <button type="button" class="btn btn-prev prev-tab" data-prev="student">
                                    <i class="fa fa-arrow-left"></i> <?php echo get_phrase('Previous: Student Information'); ?>
                                </button>
                                <button type="button" class="btn btn-next next-tab" data-next="transport">
                                    <i class="fa fa-arrow-right"></i> <?php echo get_phrase('Next: Transport & Facilities'); ?>
                                </button>
                            </div>
                        </div>

                        <!-- Transport & Facilities Tab -->
                        <div class="tab-pane <?php echo $activeTab == 'transport' ? 'active' : ''; ?>" id="transport">
                            <div class="form-section-title">
                                <i class="fa fa-bus"></i> <?php echo get_phrase('Transport Details'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('transport_mode');?></label>
                                        <div class="col-sm-12">
                                            <select name="transport_mode" class="form-control select2">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <option value="self" <?php if(isset($student['transport_mode']) && $student['transport_mode'] == 'self') echo 'selected';?>><?php echo get_phrase('self');?></option>
                                                <option value="parents" <?php if(isset($student['transport_mode']) && $student['transport_mode'] == 'parents') echo 'selected';?>><?php echo get_phrase('parents');?></option>
                                                <option value="bus" <?php if(isset($student['transport_mode']) && $student['transport_mode'] == 'bus') echo 'selected';?>><?php echo get_phrase('bus');?></option>
                          </select>
                                        </div>
						</div> 
					</div>

                                <div class="col-md-6 bus-option" <?php if(isset($student['transport_mode']) && $student['transport_mode'] != 'bus') echo 'style="display:none;"';?>>
						<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('transport_route');?></label>
                    <div class="col-sm-12">
                                            <select name="transport_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php 
                                                $transports = $this->db->get('transport')->result_array();
                                                foreach($transports as $row):
	                              ?>
                                                <option value="<?php echo $row['transport_id'];?>" <?php if($student['transport_id'] == $row['transport_id']) echo 'selected';?>>
                                                    <?php echo $row['name'];?> - <?php echo $row['route'];?>
                                                </option>
                          		<?php endforeach;?>
                          </select>
                                        </div>
                                    </div>
						</div> 
					</div>

                            <!-- Pickup Information Section -->
                            <div class="form-section-title">
                                <i class="fa fa-map-marker"></i> <?php echo get_phrase('Pickup Information'); ?>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
	<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('pick_area');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="pick_area" value="<?php echo isset($student['pick_area']) ? $student['pick_area'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('pick_stand');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="pick_stand" value="<?php echo isset($student['pick_stand']) ? $student['pick_stand'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('pick_route');?></label>
                                        <div class="col-sm-12">
                                            <select name="pick_route_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
	                              <?php 
                                                $routes = $this->db->get('transport_route')->result_array();
                                                foreach($routes as $row):
	                              ?>
                                                <option value="<?php echo $row['transport_route_id'];?>" <?php if(isset($student['pick_route_id']) && $student['pick_route_id'] == $row['transport_route_id']) echo 'selected';?>>
                                                    <?php echo $row['name'];?> (<?php echo $row['description'];?>)
                                                </option>
                          		<?php endforeach;?>
                          </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('pick_driver');?></label>
                                        <div class="col-sm-12">
                                            <select name="pick_driver_id" class="form-control select2">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <?php 
                                                $drivers = $this->db->get('vehicle')->result_array();
                                                foreach($drivers as $row):
                                                ?>
                                                <option value="<?php echo $row['vehicle_id'];?>" <?php if(isset($student['pick_driver_id']) && $student['pick_driver_id'] == $row['vehicle_id']) echo 'selected';?>>
                                                    <?php echo $row['driver_name'];?> (<?php echo $row['vehicle_number'];?>)
                                                </option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
						</div> 
					</div>
					
                            <!-- Drop Information Section -->
                            <div class="form-section-title">
                                <i class="fa fa-map-marker"></i> <?php echo get_phrase('Drop Information'); ?>
                            </div>
					
                            <div class="row">
                                <div class="col-md-6">
					<div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('drop_area');?></label>
                    <div class="col-sm-12">
                                            <input type="text" class="form-control" name="drop_area" value="<?php echo isset($student['drop_area']) ? $student['drop_area'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('drop_stand');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="drop_stand" value="<?php echo isset($student['drop_stand']) ? $student['drop_stand'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('drop_route');?></label>
                                        <div class="col-sm-12">
                                            <select name="drop_route_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
                                                $routes = $this->db->get('transport_route')->result_array();
                                                foreach($routes as $row):
									?>
                                                <option value="<?php echo $row['transport_route_id'];?>" <?php if(isset($student['drop_route_id']) && $student['drop_route_id'] == $row['transport_route_id']) echo 'selected';?>>
                                                    <?php echo $row['name'];?> (<?php echo $row['description'];?>)
                                    </option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('drop_driver');?></label>
                                        <div class="col-sm-12">
                                            <select name="drop_driver_id" class="form-control select2">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php
                                                $drivers = $this->db->get('vehicle')->result_array();
                                                foreach($drivers as $row):
							  ?>
                                                <option value="<?php echo $row['vehicle_id'];?>" <?php if(isset($student['drop_driver_id']) && $student['drop_driver_id'] == $row['vehicle_id']) echo 'selected';?>>
                                                    <?php echo $row['driver_name'];?> (<?php echo $row['vehicle_number'];?>)
                                                </option>
                                                <?php endforeach;?>
                          </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Transport Months Section -->
                            <div class="form-section-title">
                                <div class="month-selector-title-row">
                                    <div>
                                        <i class="fa fa-calendar"></i> <?php echo get_phrase('Transport Months'); ?>
                                    </div>
                                    <div class="month-selector-controls">
                                        <button type="button" class="btn btn-info btn-sm" id="select-all-months">
                                            <i class="fa fa-check-square-o"></i> <?php echo get_phrase('Select All'); ?>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" id="deselect-all-months">
                                            <i class="fa fa-square-o"></i> <?php echo get_phrase('Deselect All'); ?>
                                        </button>
                                    </div>
						</div> 
						</div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('select_months');?></label>
                                        <div class="col-sm-12">
                                            <div class="months-container" style="display: flex; flex-wrap: wrap; gap: 10px; padding: 15px; background: #f9f9f9; border-radius: 8px; border: 1px solid #e0e0e0;">
                                                <?php 
                                                $months = array(
                                                    'january' => get_phrase('January'),
                                                    'february' => get_phrase('February'),
                                                    'march' => get_phrase('March'),
                                                    'april' => get_phrase('April'),
                                                    'may' => get_phrase('May'),
                                                    'june' => get_phrase('June'),
                                                    'july' => get_phrase('July'),
                                                    'august' => get_phrase('August'),
                                                    'september' => get_phrase('September'),
                                                    'october' => get_phrase('October'),
                                                    'november' => get_phrase('November'),
                                                    'december' => get_phrase('December')
                                                );
                                                
                                                // Get selected months if any
                                                $selected_months = array();
                                                if(isset($student['transport_months'])) {
                                                    $selected_months = json_decode($student['transport_months'], true);
                                                    if(!is_array($selected_months)) {
                                                        $selected_months = array();
                                                    }
                                                }
                                                
                                                foreach($months as $key => $month):
                                                ?>
                                                <div style="width: 170px; margin-bottom: 10px; display: flex; align-items: center;">
                                                    <input id="month_<?php echo $key; ?>" type="checkbox" name="transport_months[]" value="<?php echo $key; ?>" <?php if(in_array($key, $selected_months)) echo 'checked'; ?> style="margin-right: 8px; width: 18px; height: 18px;">
                                                    <label for="month_<?php echo $key; ?>" style="display: inline-block; padding-left: 5px; font-weight: normal; cursor: pointer;"><?php echo $month; ?></label>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
					</div>
					</div>
					
                            <!-- Navigation Buttons -->
                            <div class="nav-buttons">
                                <button type="button" class="btn btn-prev prev-tab" data-prev="parent">
                                    <i class="fa fa-arrow-left"></i> <?php echo get_phrase('Previous: Parent Information'); ?>
                                </button>
                                <button type="button" class="btn btn-next next-tab" data-next="documents">
                                    <i class="fa fa-arrow-right"></i> <?php echo get_phrase('Next: Documents'); ?>
                                </button>
                            </div>

                            <script type="text/javascript">
                            $(document).ready(function() {
                                // Show/hide bus-related fields based on transport mode
                                $('select[name="transport_mode"]').on('change', function() {
                                    var mode = $(this).val();
                                    if (mode === 'bus') {
                                        $('.bus-option').show();
                                    } else {
                                        $('.bus-option').hide();
                                        // Reset transport_id when not using bus
                                        $('select[name="transport_id"]').val('').trigger('change');
                                    }
                                });

                                // Select all months
                                $('#select-all-months').click(function() {
                                    $('input[name="transport_months[]"]').prop('checked', true);
                                });
                                
                                // Deselect all months
                                $('#deselect-all-months').click(function() {
                                    $('input[name="transport_months[]"]').prop('checked', false);
                                });
                            });
                            </script>
                        </div>

                        <!-- Documents Tab -->
                        <div class="tab-pane <?php echo $activeTab == 'documents' ? 'active' : ''; ?>" id="documents">
                            <div class="form-section-title">
                                <i class="fa fa-file-text"></i> <?php echo get_phrase('Documents'); ?>
                            </div>
                            
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> All document uploads are optional. You can upload documents later.
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
 <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('transfer_certificate');?></label>
                                        <div class="col-sm-12">
                                            <select name="tran_cert" class="form-control select2">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <option value="Yes" <?php if(isset($student['tran_cert']) && $student['tran_cert'] == 'Yes') echo 'selected';?>><?php echo get_phrase('yes');?></option>
                                                <option value="No" <?php if(isset($student['tran_cert']) && $student['tran_cert'] == 'No') echo 'selected';?>><?php echo get_phrase('no');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('upload_transfer_certificate');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="transfer_certificate">
                                            <small class="text-muted">Upload transfer certificate document (PDF/JPG/PNG)</small>
                                            <?php if(isset($student['transfer_certificate']) && !empty($student['transfer_certificate'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> Transfer certificate uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('student_signature');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="signature">
                                            <?php if(isset($student['signature']) && !empty($student['signature'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> Signature uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
					</div>
					
                            <!-- Previous School Information -->
                            <!-- <div class="form-section-title">
                                <i class="fa fa-university"></i> <?php echo get_phrase('Previous School Information'); ?>
                            </div> -->
                            
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('previous_school_name');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="ps_attended" value="<?php echo $student['ps_attended'];?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('the_address');?></label>
                                        <div class="col-sm-12">
                                            <textarea name="ps_address" class="form-control" rows="4"><?php echo $student['ps_address'];?></textarea>
				</div>
			</div>		
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('purpose_of_leaving');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="ps_purpose" value="<?php echo $student['ps_purpose'];?>">
		</div>	
    </div> 
</div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('class_in_which_was_studying');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="class_study" value="<?php echo $student['class_study'];?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('date_of_leaving');?></label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control datepicker" name="date_of_leaving" value="<?php echo $student['date_of_leaving'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            
                            <!-- Identity Documents -->
                            <div class="form-section-title">
                                <i class="fa fa-id-card"></i> <?php echo get_phrase('Identity Documents'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('father_adharcard');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="father_adharcard">
                                            <?php if(isset($student['father_adharcard']) && !empty($student['father_adharcard'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> Father's Adhar card uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('mother_adharcard');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="mother_adharcard">
                                            <?php if(isset($student['mother_adharcard']) && !empty($student['mother_adharcard'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> Mother's Adhar card uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('income_certificate');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="income_certificate">
                                            <?php if(isset($student['income_certificate']) && !empty($student['income_certificate'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> Income certificate uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('date_of_birth_proof');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="dob_proof">
                                            <?php if(isset($student['dob_proof']) && !empty($student['dob_proof'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> DOB proof uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('migration_certificate');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="migration_certificate">
                                            <?php if(isset($student['migration_certificate']) && !empty($student['migration_certificate'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> Migration certificate uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('caste_certificate');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="caste_certificate">
                                            <?php if(isset($student['caste_certificate']) && !empty($student['caste_certificate'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> Caste certificate uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('aadhar_card');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="aadhar_card">
                                            <?php if(isset($student['aadhar_card']) && !empty($student['aadhar_card'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> Aadhar card uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('address_proof');?></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="address_proof">
                                            <?php if(isset($student['address_proof']) && !empty($student['address_proof'])): ?>
                                                <p class="text-success mt-2">
                                                    <i class="fa fa-check-circle"></i> Address proof uploaded
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Admission Information
                            <div class="form-section-title">
                                <i class="fa fa-calendar"></i> <?php echo get_phrase('Admission Information'); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('admission_date');?></label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control datepicker" name="admission_date" value="<?php echo $student['admission_date'];?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('date_of_joining');?></label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo isset($student['date_of_joining']) ? $student['date_of_joining'] : $student['am_date']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('session');?></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="session" value="<?php echo $student['session'];?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('birth_certificate');?></label>
                                        <div class="col-sm-12">
                                            <select name="dob_cert" class="form-control select2">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <option value="Yes" <?php if($student['dob_cert'] == 'Yes') echo 'selected';?>>Yes</option>
                                                <option value="No" <?php if($student['dob_cert'] == 'No') echo 'selected';?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo get_phrase('any_given_marksheet');?></label>
                                        <div class="col-sm-12">
                                            <select name="mark_join" class="form-control select2">
                                                <option value=""><?php echo get_phrase('select');?></option>
                                                <option value="Yes" <?php if($student['mark_join'] == 'Yes') echo 'selected';?>>Yes</option>
                                                <option value="No" <?php if($student['mark_join'] == 'No') echo 'selected';?>>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                </div>
                            </div> -->
                            
                            <!-- Navigation Buttons -->
                            <div class="nav-buttons">
                                <button type="button" class="btn btn-prev prev-tab" data-prev="transport">
                                    <i class="fa fa-arrow-left"></i> <?php echo get_phrase('Previous: Transport & Facilities'); ?>
                                </button>
                                <button type="submit" class="btn btn-save">
                                    <i class="fa fa-save"></i> <?php echo get_phrase('Update Student'); ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Tab navigation
    $(document).ready(function() {
        // Next tab button click
        $(document).on('click', '.next-tab', function() {
            var nextTab = $(this).data('next');
            $('.nav-tabs a[href="#' + nextTab + '"]').tab('show');
            
            // Update URL to maintain tab on refresh
            var url = window.location.href.split('?')[0];
            history.pushState({}, '', url + '?tab=' + nextTab);
            
            // Update progress steps
            updateProgressSteps(nextTab);
            
            // Scroll to top of form for better UX
            scrollToFormTop();
        });
        
        // Previous tab button click
        $(document).on('click', '.prev-tab', function() {
            var prevTab = $(this).data('prev');
            $('.nav-tabs a[href="#' + prevTab + '"]').tab('show');
            
            // Update URL to maintain tab on refresh
            var url = window.location.href.split('?')[0];
            history.pushState({}, '', url + '?tab=' + prevTab);
            
            // Update progress steps
            updateProgressSteps(prevTab);
            
            // Scroll to top of form for better UX
            scrollToFormTop();
        });
        
        // Tab click handler
        $('.nav-tabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
            
            var tab = $(this).attr('href').replace('#', '');
            
            // Update URL to maintain tab on refresh
            var url = window.location.href.split('?')[0];
            history.pushState({}, '', url + '?tab=' + tab);
            
            // Update progress steps
            updateProgressSteps(tab);
        });
        
        // Function to scroll to top of form
        function scrollToFormTop() {
            $('html, body').animate({
                scrollTop: $(".admission-nav").offset().top - 20
            }, 300);
        }
        
        function updateProgressSteps(activeTab) {
            // Reset all steps
            $('.progress-step').removeClass('active completed');
            
            if (activeTab == 'student') {
                $('.progress-step:eq(0)').addClass('active');
            } else if (activeTab == 'parent') {
                $('.progress-step:eq(0)').addClass('completed');
                $('.progress-step:eq(1)').addClass('active');
            } else if (activeTab == 'transport') {
                $('.progress-step:eq(0)').addClass('completed');
                $('.progress-step:eq(1)').addClass('completed');
                $('.progress-step:eq(2)').addClass('active');
            } else if (activeTab == 'documents') {
                $('.progress-step:eq(0)').addClass('completed');
                $('.progress-step:eq(1)').addClass('completed');
                $('.progress-step:eq(2)').addClass('completed');
                $('.progress-step:eq(3)').addClass('active');
            }
        }
        
        // Initialize tab system
        function initializeTabs() {
            // Get active tab from URL or default to 'student'
            var initialTab = '<?php echo $activeTab; ?>';
            
            // Activate the correct tab
            $('.nav-tabs a[href="#' + initialTab + '"]').tab('show');
            
            // Update progress steps
            updateProgressSteps(initialTab);
        }
        
        // Run initialization
        initializeTabs();
        
        // Form validation handling for tab navigation
        $('form').on('submit', function(e) {
            var isValid = true;
            
            // Check for validation errors in all tabs
            $('.tab-pane').each(function() {
                var tabPane = $(this);
                
                // Find all required inputs in this tab
                var requiredFields = tabPane.find(':input[required]');
                
                // Check each required field
                requiredFields.each(function() {
                    if (!this.checkValidity()) {
                        // If we found an invalid field, activate this tab
                        $('.nav-tabs a[href="#' + tabPane.attr('id') + '"]').tab('show');
                        
                        // Focus on the first invalid element
                        $(this).focus();
                        isValid = false;
                        return false; // break the each loop
                    }
                });
                
                if (!isValid) {
                    return false; // break the tab-pane each loop
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
        });

        // Initialize sections when page loads for class_id
        var class_id = '<?php echo $student['class_id']; ?>';
        if (class_id) {
            get_class_sections(class_id);
        }
        
        // Initialize birthday datepicker with age calculation
        $('input[name="birthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10),
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end, label) {
            // Calculate age when date changes
            var years = moment().diff(start, 'years');
            $("#age").val(years);
        });
        
        // Trigger age calculation on page load
        if($('input[name="birthday"]').val()) {
            var birthDate = moment($('input[name="birthday"]').val());
            var years = moment().diff(birthDate, 'years');
            $("#age").val(years);
        }
        
        // Initialize other date pickers
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10) + 1,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
    
    // Print functionality
    function printStudentForm() {
        var printContents = document.querySelector('.tab-content').innerHTML;
        var originalContents = document.body.innerHTML;
        
        var printHeader = '<div class="page-header">' +
                          '<h2>Student Information: <?php echo $student["name"]; ?></h2>' +
                          '<p>Admission No: <?php echo $student["admission_number"]; ?> | Class: <?php echo $this->db->get_where("class", array("class_id" => $student["class_id"]))->row()->name; ?></p>' +
                          '</div>';
        
        document.body.innerHTML = '<div class="container">' + printHeader + printContents + '</div>';
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }

    // Get class sections
    function get_class_sections(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id,
            success: function(response) {
                jQuery('#section_selector_holder').html(response);
                // Set the selected section if this is edit mode
                jQuery('#section_selector_holder').val('<?php echo $student['section_id']; ?>');
            }
        });
    }

    // Toggle same_as_present checkbox
    $(document).ready(function() {
        // Function to copy present address to permanent address
        function copyPresentToPermanent() {
            $('textarea[name="permanent_address"]').val($('textarea[name="address"]').val());
            $('input[name="permanent_city"]').val($('input[name="city"]').val());
            $('input[name="permanent_state"]').val($('input[name="state"]').val());
            $('input[name="permanent_pincode"]').val($('input[name="pincode"]').val());
        }
        
        // Toggle permanent address fields on checkbox change
        $('#same_as_present').change(function() {
            if(this.checked) {
                copyPresentToPermanent();
                $('#permanent_address_fields').hide();
            } else {
                $('#permanent_address_fields').show();
            }
        });
        
        // Also copy values when present address fields change if checkbox is checked
        $('textarea[name="address"], input[name="city"], input[name="state"], input[name="pincode"]').on('input', function() {
            if($('#same_as_present').is(':checked')) {
                copyPresentToPermanent();
            }
        });
        
        // Trigger the change event on page load if the checkbox is checked
        if($('#same_as_present').is(':checked')) {
            $('#same_as_present').trigger('change');
        }
        
        // Make sure present address fields are also copied to permanent on form submit if checkbox is checked
        $('#student-edit-form').on('submit', function() {
            if($('#same_as_present').is(':checked')) {
                copyPresentToPermanent();
            }
        });
    });

    // Check password strength
    function CheckPasswordStrength(password) {
        var password_strength = document.getElementById("password_strength");

        //TextBox left blank.
        if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
        }

        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.

        var passed = 0;

        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }

        //Display status.
        var color = "";
        var strength = "";
        switch (passed) {
            case 0:
            case 1:
            case 2:
                strength = "Weak";
                color = "red";
                break;
            case 3:
                 strength = "Medium";
                color = "orange";
                break;
            case 4:
                 strength = "Strong";
                color = "green";
                break;
        }
        password_strength.innerHTML = strength;
        password_strength.style.color = color;
    }
    
    // Image preview for photo upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    // Initialize dropify
    $('.dropify').dropify({
        messages: {
            default: '<?php echo get_phrase("Drag and drop a file here or click"); ?>',
            replace: '<?php echo get_phrase("Drag and drop or click to replace"); ?>',
            remove: '<?php echo get_phrase("Remove"); ?>',
            error: '<?php echo get_phrase("Error occurred"); ?>'
        },
        error: {
            fileSize: '<?php echo get_phrase("The file size is too big (5MB max)"); ?>',
            imageFormat: '<?php echo get_phrase("The image format is not allowed (Allowed: jpg, jpeg, png)"); ?>'
        }
    });

    // Add custom validation for photo upload
    $('form').on('submit', function(e) {
        var fileInput = $('input[name="userfile"]')[0];
        var errorDiv = $('#photo-upload-error');
        errorDiv.html('');

        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];
            
            // Check file size
            if (file.size > 5 * 1024 * 1024) { // 5MB in bytes
                errorDiv.html('<?php echo get_phrase("File size exceeds 5MB limit"); ?>');
                e.preventDefault();
                return false;
            }

            // Check file type
            var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                errorDiv.html('<?php echo get_phrase("Invalid file type. Only JPG, JPEG, and PNG are allowed"); ?>');
                e.preventDefault();
                return false;
            }
        }
    });
    
    // Form Validation Function
    function validateForm() {
        // Reset error container
        $('#form-validation-errors').hide();
        $('#error-list').empty();
        
        var errors = [];
        var isValid = true;
        
        // Required fields validation
        var requiredFields = {
            'admission_number': 'Admission Number',
            'name': 'Student Name',
            'email': 'Student Email',
            'class_id': 'Class'
        };
        
        // Check required fields
        $.each(requiredFields, function(fieldName, fieldLabel) {
            var $field = $('[name="' + fieldName + '"]');
            var value = $field.val();
            
            if (!value || value.trim() === '' || (fieldName === 'class_id' && value === '')) {
                errors.push(fieldLabel + ' is required');
                $field.addClass('is-invalid');
                
                // Show the tab with the error
                var tabId = $field.closest('.tab-pane').attr('id');
                if (tabId) {
                    $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
                }
                
                isValid = false;
            } else {
                $field.removeClass('is-invalid');
            }
        });
        
        // Email validation
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        // Validate student email
        var studentEmail = $('[name="email"]').val();
        if (studentEmail && !emailRegex.test(studentEmail)) {
            errors.push('Please enter a valid Student Email address');
            $('[name="email"]').addClass('is-invalid');
            isValid = false;
        }
        
        // Validate father email if provided
        var fatherEmail = $('[name="father_email"]').val();
        if (fatherEmail && !emailRegex.test(fatherEmail)) {
            errors.push('Please enter a valid Father\'s Email address');
            $('[name="father_email"]').addClass('is-invalid');
            isValid = false;
        }
        
        // Validate mother email if provided
        var motherEmail = $('[name="mother_email"]').val();
        if (motherEmail && !emailRegex.test(motherEmail)) {
            errors.push('Please enter a valid Mother\'s Email address');
            $('[name="mother_email"]').addClass('is-invalid');
            isValid = false;
        }
        
        // Phone number validation (10 digits)
        var phoneRegex = /^[0-9]{10}$/;
        
        // Validate father phone if provided
        var fatherPhone = $('[name="father_phone"]').val();
        if (fatherPhone && !phoneRegex.test(fatherPhone)) {
            errors.push('Father\'s Phone must be a 10-digit number');
            $('[name="father_phone"]').addClass('is-invalid');
            isValid = false;
        }
        
        // Validate mother phone if provided
        var motherPhone = $('[name="mother_phone"]').val();
        if (motherPhone && !phoneRegex.test(motherPhone)) {
            errors.push('Mother\'s Phone must be a 10-digit number');
            $('[name="mother_phone"]').addClass('is-invalid');
            isValid = false;
        }
        
        // Validate password if provided (optional in update)
        var password = $('[name="password"]').val();
        if (password && password.length < 6) {
            errors.push('Password must be at least 6 characters long');
            $('[name="password"]').addClass('is-invalid');
            isValid = false;
        }
        
        // If address fields are hidden due to same_as_present checked, they should pass validation
        if ($('#same_as_present').is(':checked')) {
            // Copy values from present address to permanent address
            $('textarea[name="permanent_address"]').val($('textarea[name="address"]').val());
            $('input[name="permanent_city"]').val($('input[name="city"]').val());
            $('input[name="permanent_state"]').val($('input[name="state"]').val());
            $('input[name="permanent_pincode"]').val($('input[name="pincode"]').val());
        }
        
        // File validation for uploaded photo if any
        var fileInput = $('input[name="userfile"]')[0];
        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];
            
            // Check file size
            if (file.size > 5 * 1024 * 1024) {
                errors.push('Student Photo size exceeds 5MB limit');
                $(fileInput).addClass('is-invalid');
                isValid = false;
            }
            
            // Check file type
            var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                errors.push('Student Photo must be JPG, JPEG, or PNG format');
                $(fileInput).addClass('is-invalid');
                isValid = false;
            }
        }
        
        // Validate Aadhar number if provided (12 digits)
        var aadharRegex = /^[0-9]{12}$/;
        var aadharNo = $('[name="adhar_no"]').val();
        if (aadharNo && !aadharRegex.test(aadharNo)) {
            errors.push('Aadhar Card Number must be a 12-digit number');
            $('[name="adhar_no"]').addClass('is-invalid');
            isValid = false;
        }
        
        // Check if there are validation errors
        if (!isValid) {
            // Show error messages
            $('#error-list').empty();
            $.each(errors, function(index, error) {
                $('#error-list').append('<li>' + error + '</li>');
            });
            $('#form-validation-errors').show();
            
            // Scroll to error container
            $('html, body').animate({
                scrollTop: $('#form-validation-errors').offset().top - 100
            }, 300);
        } else {
            // If everything is valid, show loading overlay
            showLoadingOverlay();
        }
        
        return isValid;
    }
    
    // Show loading overlay when form is being submitted
    function showLoadingOverlay() {
        var overlay = $('<div id="form-loading-overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9999;display:flex;justify-content:center;align-items:center;"><div style="background:white;padding:20px;border-radius:5px;text-align:center;box-shadow:0 0 20px rgba(0,0,0,0.3);"><i class="fa fa-spinner fa-spin fa-3x" style="color:#2196F3;margin-bottom:15px;display:block;"></i><div style="font-size:16px;font-weight:500;">Updating student information...</div><div style="font-size:13px;margin-top:10px;color:#666;">This may take a moment. Please do not close this page.</div></div></div>');
        $('body').append(overlay);
    }

    // Initialize dropify
    $('.dropify').dropify({
        messages: {
            default: '<?php echo get_phrase("Drag and drop a file here or click"); ?>',
            replace: '<?php echo get_phrase("Drag and drop or click to replace"); ?>',
            remove: '<?php echo get_phrase("Remove"); ?>',
            error: '<?php echo get_phrase("Error occurred"); ?>'
        },
        error: {
            fileSize: '<?php echo get_phrase("The file size is too big (5MB max)"); ?>',
            imageFormat: '<?php echo get_phrase("The image format is not allowed (Allowed: jpg, jpeg, png)"); ?>'
        }
    });

    // Simple form submission with loading overlay - let server handle validation
    $('form').on('submit', function(e) {
        // Show loading overlay when form is being submitted
        showLoadingOverlay();
        
        // Let the form submit normally to server for validation
        return true;
    });
    
    // Show loading overlay when form is being submitted
    function showLoadingOverlay() {
        var overlay = $('<div id="form-loading-overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9999;display:flex;justify-content:center;align-items:center;"><div style="background:white;padding:20px;border-radius:5px;text-align:center;box-shadow:0 0 20px rgba(0,0,0,0.3);"><i class="fa fa-spinner fa-spin fa-3x" style="color:#2196F3;margin-bottom:15px;display:block;"></i><div style="font-size:16px;font-weight:500;">Updating student information...</div><div style="font-size:13px;margin-top:10px;color:#666;">This may take a moment. Please do not close this page.</div></div></div>');
        $('body').append(overlay);
    }
</script>

<script>
$(document).ready(function() {
    // Initialize dropify for file uploads
    $('.dropify').dropify({
        messages: {
            default: '<?php echo get_phrase("Drag and drop a file here or click"); ?>',
            replace: '<?php echo get_phrase("Drag and drop or click to replace"); ?>',
            remove: '<?php echo get_phrase("Remove"); ?>',
            error: '<?php echo get_phrase("Error occurred"); ?>'
        },
        error: {
            fileSize: '<?php echo get_phrase("The file size is too big (5MB max)"); ?>',
            imageFormat: '<?php echo get_phrase("The image format is not allowed (Allowed: jpg, jpeg, png)"); ?>'
        }
    });

    // Simple form submission with loading overlay - let server handle all validation
    $('#student-edit-form').on('submit', function(e) {
        console.log('Form is being submitted to server for validation...');
        
        // Show loading overlay when form is being submitted
        showLoadingOverlay();
        
        // Let the form submit normally to server for validation
        return true;
    });
    
    // Show loading overlay when form is being submitted
    function showLoadingOverlay() {
        var overlay = $('<div id="form-loading-overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9999;display:flex;justify-content:center;align-items:center;"><div style="background:white;padding:20px;border-radius:5px;text-align:center;box-shadow:0 0 20px rgba(0,0,0,0.3);"><i class="fa fa-spinner fa-spin fa-3x" style="color:#2196F3;margin-bottom:15px;display:block;"></i><div style="font-size:16px;font-weight:500;">Updating student information...</div><div style="font-size:13px;margin-top:10px;color:#666;">This may take a moment. Please do not close this page.</div></div></div>');
        $('body').append(overlay);
    }
});
</script>

<?php endforeach; ?>
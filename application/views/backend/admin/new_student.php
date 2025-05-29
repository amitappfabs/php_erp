<?php
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

    .select2-container .select2-selection--single {
        height: 45px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 43px;
        padding-left: 15px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 43px;
    }

    label {
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    /* Updated Button Styling */
    .btn {
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

    .btn-sm {
        padding: 10px 20px;
        font-size: 13px;
    }

    .btn-rounded {
        border-radius: 50px;
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

    /* Navigation Button Container */
    .nav-buttons {
        margin-top: 30px;
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }

    /* File Input Styling */
    input[type="file"].form-control {
        padding: 8px 15px;
        height: auto;
    }

    /* Alert Styling */
    .alert {
        border-radius: 4px;
        padding: 15px 20px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #FFEBEE;
        border-color: #FFCDD2;
        color: #B71C1C;
    }

    /* Field Section Styling */
    .form-section-title {
        background: #f5f5f5;
        padding: 10px 15px;
        margin: 30px 0 20px;
        border-left: 4px solid #2196F3;
        font-weight: 600;
        color: #333;
        border-radius: 0 4px 4px 0;
    }
    
    .form-separator {
        border-top: 1px dashed #ddd;
        margin: 25px 0;
    }
    
    /* Address Fields */
    .address-fields {
        padding: 15px;
        background: #f9f9f9;
        border-radius: 4px;
        margin-bottom: 15px;
    }
    
    /* Auto-generated fields */
    .auto-generated {
        background-color: #f0f8ff;
        position: relative;
    }
    
    .auto-generated:after {
        content: "Auto";
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 10px;
        color: #2196F3;
        opacity: 0.7;
    }
    
    /* Calculations field */
    .calculated-field {
        background-color: #FFFDE7;
        color: #333;
    }
    
    /* Important fields */
    .required-field label:after {
        content: " *";
        color: #F44336;
    }

    .months-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }

    .checkbox-circle {
        width: 170px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .checkbox-circle input[type="checkbox"] {
        margin-right: 8px;
        width: 18px;
        height: 18px;
    }

    .checkbox-circle label {
        display: inline-block;
        padding-left: 5px;
        font-weight: normal;
        cursor: pointer;
    }

    .month-selector-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        margin-top: 5px;
    }
    
    .month-selector-controls button {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 13px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        transition: all 0.2s ease;
    }
    
    .month-selector-controls button i {
        margin-right: 6px;
    }
    
    .month-selector-title-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
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

                    <form class="form-horizontal form-material" method="post" 
                          action="<?php echo base_url();?>admin/new_student/create/" 
                          enctype="multipart/form-data"
                          id="student-admission-form"
                          onsubmit="return validateForm();"
                          novalidate>

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
                                        <i class="fa fa-bus"></i> <?php echo get_phrase('Transport'); ?>
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
                                <!-- Note about required fields -->
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> 
                                    <strong>Required Fields:</strong> Admission Number, Student ID, Student Name, Gender, Date of Birth, Student Photo, Student Email, Student Password and Class. All other fields are optional.
                                </div>
                                
                                <!-- Basic Information Section -->
                                <div class="form-section-title">
                                    <i class="fa fa-info-circle"></i> <?php echo get_phrase('Basic Information'); ?>
                                </div>
                                
                                <!-- Student Photo Upload - Full Width Top -->
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
                                                       data-default-file=""
                                                       required>
                                                <small class="text-muted"><?php echo get_phrase('Allowed: JPG, JPEG, PNG. Max size: 5MB. Dimensions: 3.5cm x 4.5cm'); ?></small>
                                                <div id="photo-upload-error" class="text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Other Fields in Left-Right Format -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('admission_no');?> </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="admission_number" 
                                                    value="<?php 
                                                        $next_id = $this->db->count_all('student') + 1;
                                                        echo $next_id; 
                                                    ?>" 
                                                    pattern="\d{1,6}"
                                                    title="Admission number must be between 1 and 6 digits"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 6) this.value = this.value.substring(0, 6);"
                                                    required>
                                                <small class="text-muted">Enter admission number (Required)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('student_code');?></label> 
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="student_code" 
                                                       value="<?php echo isset($next_student_code) ? $next_student_code : ''; ?>" 
                                                       pattern="\d{0,6}" 
                                                       maxlength="6" 
                                                       title="Student code must be up to 6 digits (Optional)"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                <small class="text-muted">(Optional) For Database Storage Please Dont Change</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('full_name'); ?> </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="name" required>
                                                <small class="text-muted">(Required) Enter student's full name</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('email');?></label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" name="student_email" 
                                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                       title="Please enter a valid email address"
                                                       required
                                                       id="student_email">
                                                <small class="text-muted">(Required) Enter student's email address</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('password');?> </label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password" id="student_password" 
                                                           pattern=".{6,}" 
                                                           title="Password must be at least 6 characters long"
                                                           required>
                                                    <div class="input-group-addon" style="cursor: pointer;" onclick="toggleStudentPasswordVisibility()">
                                                        <i class="fa fa-eye" id="student-password-toggle-icon"></i>
                                                    </div>
                                                </div>
                                                <small class="text-muted">(Required) Password must be at least 6 characters long</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('gender'); ?> </label>
                                            <div class="col-sm-12">
                                                <select name="sex" class="form-control select2" required>
                                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                                    <option value="male"><?php echo get_phrase('male'); ?></option>
                                                    <option value="female"><?php echo get_phrase('female'); ?></option>
                                                    <option value="other"><?php echo get_phrase('other'); ?></option>
                                                </select>
                                                <small class="text-muted">(Required) Select student's gender</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('date_of_birth'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control datepicker" name="birthday" id="birthday" required>
                                                <small class="text-muted">(Required) Enter student's date of birth</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('age'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control calculated-field" name="age" id="age" readonly>
                                                <small class="text-muted">(Auto-calculated)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('blood_group'); ?></label>
                                            <div class="col-sm-12">
                                                <select name="blood_group" class="form-control select2">
                                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                                <small class="text-muted">(Optional) Select blood group</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('religion'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="religion">
                                                <small class="text-muted">(Optional) Enter student's religion</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('student_mobile'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="tel" class="form-control" name="phone" 
                                                       pattern="[0-9]{10}" 
                                                       title="Please enter a valid 10-digit mobile number"
                                                       maxlength="10"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                <small class="text-muted">(Optional) Enter 10-digit mobile number</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('apaar_ID'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="apaar_id" 
                                                       pattern="\d{0,12}" 
                                                       maxlength="12" 
                                                       title="Apaar ID must be up to 12 digits (Optional)"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                <small class="text-muted">(Optional) Enter 12-digit Apaar ID</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('aadhar_card_number'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="adhar_no" 
                                                       pattern="[0-9]{12}" 
                                                       title="Please enter a valid 12-digit Aadhar Card number"
                                                       maxlength="12"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                <small class="text-muted">Enter 12-digit Aadhar Card number</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Category Information Section -->
                                <div class="form-section-title">
                                    <i class="fa fa-tags"></i> <?php echo get_phrase('Category Information'); ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('admission_category'); ?></label>
                                            <div class="col-sm-12">
                                                <select name="admission_category" class="form-control select2">
                                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                                    <option value="general"><?php echo get_phrase('general'); ?></option>
                                                    <option value="disadvantaged"><?php echo get_phrase('disadvantaged_group'); ?></option>
                                                    <option value="ews"><?php echo get_phrase('ews'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('category'); ?></label>
                                            <div class="col-sm-12">
                                                <select name="caste" class="form-control select2">
                                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                                    <option value="general"><?php echo get_phrase('general'); ?></option>
                                                    <option value="sc"><?php echo get_phrase('sc'); ?></option>
                                                    <option value="st"><?php echo get_phrase('st'); ?></option>
                                                    <option value="obc"><?php echo get_phrase('obc'); ?></option>
                                                    <option value="bc"><?php echo get_phrase('bc'); ?></option>
                                                    <option value="other"><?php echo get_phrase('other'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Academic Information Section -->
                                <div class="form-section-title">
                                    <i class="fa fa-graduation-cap"></i> <?php echo get_phrase('Academic Information'); ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('class'); ?></label>
                                            <div class="col-sm-12">
                                                <select name="class_id" class="form-control select2" id="class_id" required onchange="get_sections(this.value)">
                                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                                    <?php 
                                                    $classes = $this->db->get('class')->result_array();
                                                    foreach($classes as $key => $class):
                                                    ?>
                                                    <option value="<?php echo $class['class_id']; ?>">
                                                        <?php echo $class['name']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="text-muted">(Required) Select student's class</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('section'); ?></label>
                                            <div class="col-sm-12">
                                                <select name="section_id" class="form-control select2" id="section_selector">
                                                    <option value=""><?php echo get_phrase('select_class_first'); ?></option>
                                                </select>
                                                <small class="text-muted">(Optional) Select section after selecting class</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('previous_school'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="ps_attended">
                                                <small class="text-muted">Enter name of previous school (if applicable)</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('session'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="session">
                                                <small class="text-muted"><?php echo get_phrase('Enter academic session (e.g. 2025-2026)'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('admission_date'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control datepicker" name="admission_date" required value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <!-- <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('date_of_joining'); ?></label>
                                            <div class="col-sm-12">
                                                <input type="date" class="form-control datepicker" name="date_of_joining" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                
                                <!-- Present Address Section -->
                                <div class="form-section-title">
                                    <i class="fa fa-map-marker"></i> <?php echo get_phrase('Present Address'); ?>
                                </div>
                                
                                <div class="address-fields">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('address_line'); ?></label>
                                                <div class="col-sm-12">
                                                    <textarea name="address" class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('state'); ?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="state">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('city'); ?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="city">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('pincode');?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="pincode" 
                                                           pattern="[0-9]{6}" 
                                                           maxlength="6"
                                                           title="Please enter a valid 6-digit pincode"
                                                           oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                    <small class="text-muted">Enter 6-digit pincode</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Permanent Address Section -->
                                <div class="form-section-title">
                                    <i class="fa fa-home"></i> <?php echo get_phrase('Permanent Address'); ?>
                                    <div class="pull-right">
                                        <label>
                                            <input type="checkbox" id="same_as_present" name="same_as_present"> 
                                            <?php echo get_phrase('same_as_present_address'); ?>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="address-fields" id="permanent_address_fields">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('address_line'); ?></label>
                                                <div class="col-sm-12">
                                                    <textarea name="permanent_address" class="form-control" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('state'); ?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="permanent_state">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('city'); ?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="permanent_city">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('pincode'); ?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="permanent_pincode">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="nav-buttons">
                                            <button type="button" class="btn btn-next btn-rounded btn-sm next-tab" data-next="parent">
                                                <?php echo get_phrase('next');?> <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Parent Information Tab -->
                            <div class="tab-pane <?php echo $activeTab == 'parent' ? 'active' : ''; ?>" id="parent">
                                <!-- Father Information Section -->
                                <div class="form-section-title">
                                    <i class="fa fa-male"></i> <?php echo get_phrase('Father\'s Details'); ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('father\'s_name');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="father_name" required>
                                                <input type="hidden" name="father_id" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>">
                                                <small class="text-muted">(Required) Enter father's full name</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('father\'s_phone');?></label>
                                            <div class="col-sm-12">
                                                <input type="tel" class="form-control" name="father_phone" 
                                                       pattern="[0-9]{10}" 
                                                       title="Please enter a valid 10-digit mobile number"
                                                       maxlength="10"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                       required>
                                                <small class="text-muted">(Required) Enter 10-digit mobile number</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('father\'s_email');?> </label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" name="father_email" 
                                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                       title="Please enter a valid email address"
                                                       required>
                                                <small class="text-muted">(Required) Enter valid email address</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label class="col-md-12"><?php echo get_phrase('father\'s_email_password');?> </label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="father_password" id="father_password" 
                                                           pattern=".{6,}" 
                                                           title="Password must be at least 6 characters long"
                                                           onkeyup="CheckPasswordStrength(this.value)"
                                                           required>
                                                    <div class="input-group-addon" style="cursor: pointer;" onclick="toggleFatherPasswordVisibility()">
                                                        <i class="fa fa-eye" id="father-password-toggle-icon"></i>
                                                    </div>
                                                </div>
                                                <span id="password_strength"></span>
                                                <small class="text-muted">(Required) Password for parent login (at least 6 characters)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('father\'s_photo');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="father_image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('qualification');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="father_qualification">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('occupation');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="father_occupation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('designation');?></label>
                                            <div class="col-sm-12">
                                                <select name="father_designation" class="form-control select2">
                                                    <option value=""><?php echo get_phrase('select');?></option>
                                                    <option value="Administrator"><?php echo get_phrase('Administrator');?></option>
                                                    <option value="Art & Craft Teacher"><?php echo get_phrase('Art & Craft Teacher');?></option>
                                                    <option value="Assistant Teacher"><?php echo get_phrase('Assistant Teacher');?></option>
                                                    <option value="Computer Teacher"><?php echo get_phrase('Computer Teacher');?></option>
                                                    <option value="Dance Teacher"><?php echo get_phrase('Dance Teacher');?></option>
                                                    <option value="Driver"><?php echo get_phrase('Driver');?></option>
                                                    <option value="Librarian"><?php echo get_phrase('Librarian');?></option>
                                                    <option value="Music Teacher"><?php echo get_phrase('Music Teacher');?></option>
                                                    <option value="Nursery Teacher"><?php echo get_phrase('Nursery Teacher');?></option>
                                                    <option value="Peon"><?php echo get_phrase('Peon');?></option>
                                                    <option value="PGT"><?php echo get_phrase('PGT');?></option>
                                                    <option value="Physical Education Teacher"><?php echo get_phrase('Physical Education Teacher');?></option>
                                                    <option value="Physical Training Instructor"><?php echo get_phrase('Physical Training Instructor');?></option>
                                                    <option value="Primary Teacher"><?php echo get_phrase('Primary Teacher');?></option>
                                                    <option value="Receptionist"><?php echo get_phrase('Receptionist');?></option>
                                                    <option value="Sweeper"><?php echo get_phrase('Sweeper');?></option>
                                                    <option value="Trained Graduate Teacher"><?php echo get_phrase('Trained Graduate Teacher');?></option>
                                                    <option value="Transport Incharge"><?php echo get_phrase('Transport Incharge');?></option>
                                                    <option value="Other"><?php echo get_phrase('Other');?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('annual_income');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="father_annual_income"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                       pattern="[0-9]+"
                                                       title="Please enter digits only">
                                                <small class="text-muted">Enter annual income (digits only)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('adhar_card_no');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="father_adhar" 
                                                       pattern="[0-9]{12}" 
                                                       title="Please enter a valid 12-digit Adhar Card number"
                                                       maxlength="12"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                <small class="text-muted">Enter 12-digit Adhar Card number</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Mother Information Section -->
                                <div class="form-section-title">
                                    <i class="fa fa-female"></i> <?php echo get_phrase('Mother\'s Details'); ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('mother\'s_name');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="mother_name">
                                                <small class="text-muted">(Optional) Enter mother's full name</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('mother\'s_phone');?></label>
                                            <div class="col-sm-12">
                                                <input type="tel" class="form-control" name="mother_phone" 
                                                       pattern="[0-9]{10}" 
                                                       title="Please enter a valid 10-digit mobile number"
                                                       maxlength="10"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                <small class="text-muted">(Optional) Enter 10-digit mobile number</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('mother\'s_email');?></label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" name="mother_email" 
                                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                       title="Please enter a valid email address">
                                                <small class="text-muted">Enter valid email address</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('mother_password');?></label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="mother_password" id="mother_password" 
                                                           pattern=".{6,}" 
                                                           title="Password must be at least 6 characters long">
                                                    <div class="input-group-addon" style="cursor: pointer;" onclick="toggleMotherPasswordVisibility()">
                                                        <i class="fa fa-eye" id="mother-password-toggle-icon"></i>
                                                    </div>
                                                </div>
                                                <small class="text-muted">Password for parent login (at least 6 characters)</small>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('mother\'s_photo');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="mother_image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('qualification');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="mother_qualification">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('occupation');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="mother_occupation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('designation');?></label>
                                            <div class="col-sm-12">
                                                <select name="mother_designation" class="form-control select2">
                                                    <option value=""><?php echo get_phrase('select');?></option>
                                                    <option value="Administrator"><?php echo get_phrase('Administrator');?></option>
                                                    <option value="Art & Craft Teacher"><?php echo get_phrase('Art & Craft Teacher');?></option>
                                                    <option value="Assistant Teacher"><?php echo get_phrase('Assistant Teacher');?></option>
                                                    <option value="Computer Teacher"><?php echo get_phrase('Computer Teacher');?></option>
                                                    <option value="Dance Teacher"><?php echo get_phrase('Dance Teacher');?></option>
                                                    <option value="Driver"><?php echo get_phrase('Driver');?></option>
                                                    <option value="Librarian"><?php echo get_phrase('Librarian');?></option>
                                                    <option value="Music Teacher"><?php echo get_phrase('Music Teacher');?></option>
                                                    <option value="Nursery Teacher"><?php echo get_phrase('Nursery Teacher');?></option>
                                                    <option value="Peon"><?php echo get_phrase('Peon');?></option>
                                                    <option value="PGT"><?php echo get_phrase('PGT');?></option>
                                                    <option value="Physical Education Teacher"><?php echo get_phrase('Physical Education Teacher');?></option>
                                                    <option value="Physical Training Instructor"><?php echo get_phrase('Physical Training Instructor');?></option>
                                                    <option value="Primary Teacher"><?php echo get_phrase('Primary Teacher');?></option>
                                                    <option value="Receptionist"><?php echo get_phrase('Receptionist');?></option>
                                                    <option value="Sweeper"><?php echo get_phrase('Sweeper');?></option>
                                                    <option value="Trained Graduate Teacher"><?php echo get_phrase('Trained Graduate Teacher');?></option>
                                                    <option value="Transport Incharge"><?php echo get_phrase('Transport Incharge');?></option>
                                                    <option value="Other"><?php echo get_phrase('Other');?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('annual_income');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="mother_annual_income"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                       pattern="[0-9]+"
                                                       title="Please enter digits only">
                                                <small class="text-muted">Enter annual income (digits only)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('adhar_card_no');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="mother_adhar" 
                                                       pattern="[0-9]{12}" 
                                                       title="Please enter a valid 12-digit Adhar Card number"
                                                       maxlength="12"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                <small class="text-muted">Enter 12-digit Adhar Card number</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Guardian Information Section -->
                                <div class="form-section-title">
                                    <i class="fa fa-user"></i> <?php echo get_phrase('Guardian\'s Details'); ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('guardian\'s_name');?></label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="guardian_name">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('guardian\'s_phone');?></label>
                                            <div class="col-sm-12">
                                                <input type="tel" class="form-control" name="guardian_phone"
                                                       pattern="[0-9]{0,10}" 
                                                       maxlength="10"
                                                       title="Guardian phone must be up to 10 digits (Optional)"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                <small class="text-muted">(Optional) Enter 10-digit guardian phone number</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('guardian\'s_email');?></label>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" name="guardian_email" 
                                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                       title="Please enter a valid email address">
                                                <small class="text-muted">Enter guardian's email address</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('guardian\'s_address');?></label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control" name="guardian_address" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="nav-buttons">
                                            <button type="button" class="btn btn-prev btn-rounded btn-sm prev-tab" data-prev="student">
                                                <i class="fa fa-arrow-left"></i> <?php echo get_phrase('previous');?>
                                            </button>
                                            <button type="button" class="btn btn-next btn-rounded btn-sm next-tab" data-next="transport">
                                                <?php echo get_phrase('next');?> <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Transport Tab -->
                            <div class="tab-pane <?php echo $activeTab == 'transport' ? 'active' : ''; ?>" id="transport">
                                <div class="form-section-title">
                                    <i class="fa fa-bus"></i> <?php echo get_phrase('Transport Details'); ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('transport_mode');?></label>
                                            <div class="col-sm-12">
                                                <select name="transport_mode" class="form-control select2" required>
                                                    <option value=""><?php echo get_phrase('select');?></option>
                                                    <option value="Bus"><?php echo get_phrase('Morning Bus');?></option>
                                                    <option value="Bus"><?php echo get_phrase('Evening Bus');?></option>
                                                    <option value="Self"><?php echo get_phrase('Self');?></option>
                                                    <option value="Parent"><?php echo get_phrase('Parent');?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transport-details">
                                    <!-- Pickup Information Section -->
                                    <div class="form-section-title">
                                        <i class="fa fa-map-marker"></i> <?php echo get_phrase('Pickup Information'); ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('pick_area');?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="pick_area" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('pick_stand');?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="pick_stand" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('pick_route');?></label>
                                                <div class="col-sm-12">
                                                    <select name="pick_route_id" class="form-control select2" required>
                                                        <option value=""><?php echo get_phrase('select');?></option>
                                                        <?php
                                                        $routes = $this->db->get('transport_route')->result_array();
                                                        foreach($routes as $route):
                                                        ?>
                                                        <option value="<?php echo $route['route_id'];?>">
                                                            <?php echo $route['route_name'];?> (<?php echo $route['name'];?>)
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('pick_driver');?></label>
                                                <div class="col-sm-12">
                                                    <select name="pick_driver_id" class="form-control select2" required>
                                                        <option value=""><?php echo get_phrase('select');?></option>
                                                        <?php
                                                        $drivers = $this->db->get('vehicle')->result_array();
                                                        foreach($drivers as $driver):
                                                        ?>
                                                        <option value="<?php echo $driver['vehicle_id'];?>">
                                                            <?php echo $driver['driver_name'];?> (<?php echo $driver['vehicle_number'];?>)
                                                        </option>
                                                        <?php endforeach; ?>
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
                                                    <input type="text" class="form-control" name="drop_area" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('drop_stand');?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="drop_stand" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('drop_route');?></label>
                                                <div class="col-sm-12">
                                                    <select name="drop_route_id" class="form-control select2" required>
                                                        <option value=""><?php echo get_phrase('select');?></option>
                                                        <?php
                                                        foreach($routes as $route):
                                                        ?>
                                                        <option value="<?php echo $route['route_id'];?>">
                                                            <?php echo $route['route_name'];?> (<?php echo $route['name'];?>)
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('drop_driver');?></label>
                                                <div class="col-sm-12">
                                                    <select name="drop_driver_id" class="form-control select2" required>
                                                        <option value=""><?php echo get_phrase('select');?></option>
                                                        <?php
                                                        foreach($drivers as $driver):
                                                        ?>
                                                        <option value="<?php echo $driver['vehicle_id'];?>">
                                                            <?php echo $driver['driver_name'];?> (<?php echo $driver['vehicle_number'];?>)
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Transport Fee Section -->
                                    <div class="form-section-title">
                                        <i class="fa fa-money"></i> <?php echo get_phrase('Transport Fee Details'); ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12"><?php echo get_phrase('transport_fee');?></label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" name="transport_fee" required>
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
                                                <button type="button" class="btn btn-info" id="select-all-months">
                                                    <i class="fa fa-check-square-o"></i> <?php echo get_phrase('Select All'); ?>
                                                </button>
                                                <button type="button" class="btn btn-warning" id="deselect-all-months">
                                                    <i class="fa fa-square-o"></i> <?php echo get_phrase('Deselect All'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="months-container">
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
                                                        
                                                        foreach($months as $key => $month):
                                                        ?>
                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                            <input id="month_<?php echo $key; ?>" type="checkbox" name="transport_months[]" value="<?php echo $key; ?>" required>
                                                            <label for="month_<?php echo $key; ?>"><?php echo $month; ?></label>
                                                        </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="nav-buttons">
                                            <button type="button" class="btn btn-prev btn-rounded btn-sm prev-tab" data-prev="parent">
                                                <i class="fa fa-arrow-left"></i> <?php echo get_phrase('previous');?>
                                            </button>
                                            <button type="button" class="btn btn-next btn-rounded btn-sm next-tab" data-next="documents">
                                                <?php echo get_phrase('next');?> <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                                                    <option value="Yes"><?php echo get_phrase('yes');?></option>
                                                    <option value="No"><?php echo get_phrase('no');?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('upload_transfer_certificate');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="transfer_certificate_doc">
                                                <small class="text-muted">Upload transfer certificate document (PDF/JPG/PNG)</small>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-section-title">
                                    <i class="fa fa-id-card"></i> <?php echo get_phrase('Identity Documents'); ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('father\'s_adharcard');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="father_adharcard_doc">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('mother\'s_adharcard');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="mother_adharcard_doc">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('income_certificate');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="income_certificate_doc">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('birth_certificate');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="dob_proof_doc">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('migration_certificate');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="migration_certificate_doc">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('caste_certificate');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="caste_certificate_doc">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('student\'s_aadhar_card');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="aadhar_card_doc">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo get_phrase('address_proof');?></label>
                                            <div class="col-sm-12">
                                                <input type="file" class="form-control" name="address_proof_doc">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="nav-buttons">
                                            <button type="button" class="btn btn-prev btn-rounded btn-sm prev-tab" data-prev="transport">
                                                <i class="fa fa-arrow-left"></i> <?php echo get_phrase('previous');?>
                                            </button>
                                            <button type="submit" class="btn btn-save btn-rounded btn-sm">
                                                <i class="fa fa-save"></i> <?php echo get_phrase('save');?>
                                            </button>
                                            <button type="button" class="btn btn-print btn-rounded btn-sm" onclick="printAdmissionForm()">
                                                <i class="fa fa-print"></i> <?php echo get_phrase('print');?>
                                            </button>
                                            <button type="reset" class="btn btn-danger btn-rounded btn-sm">
                                                <i class="fa fa-refresh"></i> <?php echo get_phrase('reset');?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
/**
 * Fixed Navigation Script for Admission Form
 * This script handles tab navigation using both buttons and direct tab clicks
 */
$(document).ready(function() {
    // Direct tab activation through tab links
    $('.admission-nav .nav-tabs a').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
        
        // Get the target tab ID from href attribute
        var tabId = $(this).attr('href').substring(1);
        updateProgressIndicator(tabId);
    });
    
    // Handle the bootstrap tab show event to update progress
    $('.admission-nav .nav-tabs a').on('shown.bs.tab', function(e) {
        var tabId = $(e.target).attr('href').substring(1);
        updateProgressIndicator(tabId);
    });
    
    // Handle next button clicks
    $('.next-tab').on('click', function() {
        var nextTabId = $(this).data('next');
        if (nextTabId) {
            // Find the tab link and trigger a click
            $('.admission-nav .nav-tabs a[href="#' + nextTabId + '"]').tab('show');
            
            // Scroll to top of form for better UX
            scrollToFormTop();
        }
    });
    
    // Handle previous button clicks
    $('.prev-tab').on('click', function() {
        var prevTabId = $(this).data('prev');
        if (prevTabId) {
            // Find the tab link and trigger a click
            $('.admission-nav .nav-tabs a[href="#' + prevTabId + '"]').tab('show');
            
            // Scroll to top of form for better UX
            scrollToFormTop();
        }
    });
    
    // Function to scroll to top of form
    function scrollToFormTop() {
        $('html, body').animate({
            scrollTop: $(".admission-nav").offset().top - 20
        }, 300);
    }
    
    // Function to update progress indicator based on active tab
    function updateProgressIndicator(tabId) {
        console.log('Updating progress for tab: ' + tabId);
        
        // First reset all steps
        $('.progress-step').removeClass('active completed');
        
        // Set the appropriate classes based on active tab
        switch(tabId) {
            case 'student':
                $('.progress-step:eq(0)').addClass('active');
                break;
                
            case 'parent':
                $('.progress-step:eq(0)').addClass('completed');
                $('.progress-step:eq(1)').addClass('active');
                break;
                
            case 'transport':
                $('.progress-step:eq(0)').addClass('completed');
                $('.progress-step:eq(1)').addClass('completed');
                $('.progress-step:eq(2)').addClass('active');
                break;
                
            case 'documents':
                $('.progress-step:eq(0)').addClass('completed');
                $('.progress-step:eq(1)').addClass('completed');
                $('.progress-step:eq(2)').addClass('completed');
                $('.progress-step:eq(3)').addClass('active');
                break;
        }
    }
    
    // Initialize progress indicator based on the active tab
    function initializeProgress() {
        var activeTabId = $('.nav-tabs li.active a').attr('href');
        if (activeTabId) {
            updateProgressIndicator(activeTabId.substring(1));
        } else {
            // Default to first tab if none is active
            updateProgressIndicator('student');
        }
    }
    
    // Run initialization
    initializeProgress();

    // Show/hide bus-related fields based on transport mode
    $('.bus-option').hide();
    
    // Show/hide based on transport mode selection
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
    
    // If editing and transport mode is already set
    var currentMode = $('select[name="transport_mode"]').val();
    if (currentMode === 'bus') {
        $('.bus-option').show();
    }

    // Select all months
    $('#select-all-months').click(function() {
        $('input[name="transport_months[]"]').prop('checked', true);
    });
    
    // Deselect all months
    $('#deselect-all-months').click(function() {
        $('input[name="transport_months[]"]').prop('checked', false);
    });
    
    // Form submission handling to fix validation issues with hidden tabs
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
    
    // Initialize Select2 after showing tab to fix display issues
    $('.nav-tabs a').on('shown.bs.tab', function() {
        $($(this).attr('href')).find('.select2').select2({
            width: '100%'
        });
    });

    // Initialize dropify with custom error messages
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
        } else if ($(this).attr('action').includes('create')) {
            // Only require photo for new students
            errorDiv.html('<?php echo get_phrase("Please select a photo"); ?>');
            e.preventDefault();
            return false;
        }
    });

    // Transport section handling
    $(document).ready(function() {
        // Initially hide transport details
        $('.transport-details').hide();
        
        // Handle transport mode change
        $('select[name="transport_mode"]').on('change', function() {
            var selectedMode = $(this).val();
            if (selectedMode === 'Bus') {
                $('.transport-details').slideDown();
                // Make all transport fields required
                $('.transport-details input, .transport-details select').prop('required', true);
            } else {
                $('.transport-details').slideUp();
                // Remove required attribute from transport fields
                $('.transport-details input, .transport-details select').prop('required', false);
                // Clear all transport fields
                $('.transport-details input[type="text"], .transport-details input[type="number"]').val('');
                $('.transport-details select').val('').trigger('change');
                $('.transport-details input[type="checkbox"]').prop('checked', false);
            }
        });
        
        // Handle next button in transport section
        $('.next-tab[data-next="documents"]').on('click', function() {
            var transportMode = $('select[name="transport_mode"]').val();
            if (transportMode === 'Bus') {
                // Validate transport fields if bus is selected
                var isValid = true;
                var firstInvalidField = null;
                
                // Check all required fields
                $('.transport-details input, .transport-details select').each(function() {
                    if ($(this).prop('required')) {
                        if ($(this).is('select')) {
                            if (!$(this).val()) {
                                isValid = false;
                                $(this).addClass('is-invalid');
                                if (!firstInvalidField) firstInvalidField = $(this);
                            } else {
                                $(this).removeClass('is-invalid');
                            }
                        } else if ($(this).is('input[type="checkbox"]')) {
                            var name = $(this).attr('name');
                            if ($('input[name="' + name + '"]:checked').length === 0) {
                                isValid = false;
                                $(this).closest('.months-container').addClass('is-invalid');
                                if (!firstInvalidField) firstInvalidField = $(this);
                            } else {
                                $(this).closest('.months-container').removeClass('is-invalid');
                            }
                        } else {
                            if (!$(this).val()) {
                                isValid = false;
                                $(this).addClass('is-invalid');
                                if (!firstInvalidField) firstInvalidField = $(this);
                            } else {
                                $(this).removeClass('is-invalid');
                            }
                        }
                    }
                });
                
                if (!isValid) {
                    // Show error message
                    alert('Please fill in all required transport details');
                    // Focus on first invalid field
                    if (firstInvalidField) {
                        firstInvalidField.focus();
                    }
                    return false;
                }
            }
            
            // Proceed to next tab
            $('a[href="#documents"]').tab('show');
        });
        
        // Select all months
        $('#select-all-months').click(function() {
            $('input[name="transport_months[]"]').prop('checked', true);
            $('.months-container').removeClass('is-invalid');
        });
        
        // Deselect all months
        $('#deselect-all-months').click(function() {
            $('input[name="transport_months[]"]').prop('checked', false);
            $('.months-container').addClass('is-invalid');
        });
        
        // Validate months when checkbox changes
        $('input[name="transport_months[]"]').on('change', function() {
            var anyChecked = $('input[name="transport_months[]"]:checked').length > 0;
            $('.months-container').toggleClass('is-invalid', !anyChecked);
        });
    });
});

// Print functionality
function printAdmissionForm() {
    // Create an overlay to indicate processing
    var overlay = $('<div id="print-overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;justify-content:center;align-items:center;"><div style="background:white;padding:20px;border-radius:5px;box-shadow:0 0 10px rgba(0,0,0,0.2);"><i class="fa fa-spinner fa-spin" style="margin-right:10px;"></i> Preparing print view...</div></div>');
    $('body').append(overlay);
    
    // Get form data
    var formData = new FormData($('form')[0]);
    
    // Make sure all form fields have values (even empty) to ensure complete form data
    $('form input, form select, form textarea').each(function() {
        if (!formData.has($(this).attr('name')) && $(this).attr('name')) {
            formData.append($(this).attr('name'), $(this).val() || '');
        }
    });
    
    // Create a backup of form data in localStorage
    try {
        var formBackup = {};
        for (var pair of formData.entries()) {
            formBackup[pair[0]] = pair[1];
        }
        localStorage.setItem('admission_form_backup', JSON.stringify(formBackup));
    } catch (e) {
        console.warn('Could not create form backup in localStorage:', e);
    }
    
    // Submit form data to a temporary endpoint that will generate the print view
    $.ajax({
        url: '<?php echo base_url();?>admin/generate_admission_print',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
            // Remove overlay
            $('#print-overlay').remove();
            
            if (!response) {
                alert('Error: No response from server. Please try again.');
                return;
            }
            
            console.log('Print ID received:', response);
            
            // Store the temp ID in localStorage
            localStorage.setItem('admission_print_temp_id', response);
            
            // Open print view in new window
            var printUrl = '<?php echo base_url();?>admin/admission_print_view/' + response;
            var printWindow = window.open(printUrl, '_blank');
            if (printWindow) {
                printWindow.focus();
            } else {
                alert('Please allow popups for this site to use the print feature.');
            }
        },
        error: function(xhr, status, error) {
            // Remove overlay
            $('#print-overlay').remove();
            console.error('Print preparation error:', status, error);
            alert('There was an error preparing the print view. Please try again.');
        }
    });
}

// Calculate age from date of birth
$(document).on('change', '#birthday', function() {
    calculateAge();
});

function calculateAge() {
    var dob = $('#birthday').val();
    if(dob) {
        var dobDate = new Date(dob);
        var today = new Date();
        var age = today.getFullYear() - dobDate.getFullYear();
        
        // Check if birthday hasn't occurred yet this year
        if (today.getMonth() < dobDate.getMonth() || 
            (today.getMonth() === dobDate.getMonth() && today.getDate() < dobDate.getDate())) {
            age--;
        }
        
        $('#age').val(age);
    } else {
        $('#age').val('');
    }
}

// Handle "Same as Present Address" checkbox
$(document).on('change', '#same_as_present', function() {
    if($(this).is(':checked')) {
        // Copy values from present address to permanent address
        $('textarea[name="permanent_address"]').val($('textarea[name="address"]').val());
        $('input[name="permanent_state"]').val($('input[name="state"]').val());
        $('input[name="permanent_city"]').val($('input[name="city"]').val());
        $('input[name="permanent_pincode"]').val($('input[name="pincode"]').val());
        
        // Disable permanent address fields
        $('#permanent_address_fields').find('input, textarea').prop('readonly', true);
    } else {
        // Enable permanent address fields
        $('#permanent_address_fields').find('input, textarea').prop('readonly', false);
    }
});

// Monitor changes in present address fields when "same as present" is checked
$(document).on('input', 'textarea[name="address"], input[name="state"], input[name="city"], input[name="pincode"]', function() {
    if($('#same_as_present').is(':checked')) {
        // Copy the values to permanent address
        var fieldName = $(this).attr('name');
        var permanentFieldName = 'permanent_' + fieldName;
        
        if(fieldName === 'address') {
            $('textarea[name="permanent_address"]').val($(this).val());
        } else {
            $('input[name="' + permanentFieldName + '"]').val($(this).val());
        }
    }
});

// Function to fetch sections based on selected class
function get_sections(class_id) {
    if(class_id !== '') {
        $.ajax({
            url: '<?php echo base_url();?>admin/get_sections_by_class/' + class_id,
            type: 'GET',
            success: function(response) {
                $('#section_selector').html(response);
            },
            error: function() {
                console.log('Error loading sections');
                $('#section_selector').html('<option value=""><?php echo get_phrase("error_loading_sections"); ?></option>');
            }
        });
    } else {
        $('#section_selector').html('<option value=""><?php echo get_phrase("select_class_first"); ?></option>');
    }
}

// Initialize dropify without dimension restrictions
$('.dropify').dropify({
    messages: {
        default: 'Drag and drop a file here or click',
        replace: 'Drag and drop or click to replace',
        remove: 'Remove',
        error: 'Error. The file is either too large or not allowed.'
    },
    error: {
        imageFormat: 'The image format is not allowed (allowed formats: jpg, jpeg, png).',
        fileSize: 'The file size is too big (5MB max).'
    }
});

// Form validation
$('form').on('submit', function(e) {
    var valid = true;
    
    // Validate mobile numbers
    $('input[type="tel"]').each(function() {
        if ($(this).val() && !$(this).val().match(/^[0-9]{10}$/)) {
            alert('Please enter a valid 10-digit mobile number');
            $(this).focus();
            valid = false;
            return false;
        }
    });
    
    // Validate email addresses
    $('input[type="email"]').each(function() {
        if ($(this).val() && !$(this).val().match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)) {
            alert('Please enter a valid email address');
            $(this).focus();
            valid = false;
            return false;
        }
    });
    
    // Validate required file uploads
    $('input[type="file"][required]').each(function() {
        if (!$(this)[0].files.length) {
            alert('Please select required files for upload');
            $(this).focus();
            valid = false;
            return false;
        }
    });
    
    if (!valid) {
        e.preventDefault();
    }
});

// Add validation for pincode
$(document).on('input', 'input[name="pincode"]', function() {
    var pincode = $(this).val();
    if(pincode && pincode.length === 6) {
        if(!/^[0-9]{6}$/.test(pincode)) {
            $(this).addClass('is-invalid');
            $(this).next('small').addClass('text-danger').text('Please enter a valid 6-digit pincode');
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('small').removeClass('text-danger').text('Enter 6-digit pincode');
        }
    }
});

// Initialize all select2 elements
$(document).ready(function() {
    $('.js-example-basic-single').select2();

    // Format admission number to allow 1-6 digits
    $('input[name="admission_number"]').on('input', function() {
        // Remove non-digit characters
        this.value = this.value.replace(/[^0-9]/g, '');
        
        // Limit to 6 digits
        if (this.value.length > 6) {
            this.value = this.value.slice(0, 6);
        }
        
        // Update form validation
        validateAdmissionNumber();
    });

    // Validate admission number
    function validateAdmissionNumber() {
        var admissionNo = $('input[name="admission_number"]').val();
        var isValid = /^\d{1,6}$/.test(admissionNo) && parseInt(admissionNo) > 0;
        
        // Perform validation
        if (isValid) {
            $('input[name="admission_number"]').removeClass('is-invalid').addClass('is-valid');
        } else {
            $('input[name="admission_number"]').removeClass('is-valid').addClass('is-invalid');
        }
        
        return isValid;
    }

    // Form validation
    $('form').submit(function(e) {
        var isValid = true;
        
        // Validate admission number
        if (!validateAdmissionNumber()) {
            isValid = false;
        }
        
        // If not valid, prevent form submission
        if (!isValid) {
            e.preventDefault();
            // Show validation message
            alert('Please fix the validation errors in the form');
        }
    });
});

// Form validation 
$('form').on('submit', function(e) {
    var isValid = true;
    
    // Make sure all select2 fields are properly initialized before validation
    $('.select2').each(function() {
        if ($(this).attr('required') && $(this).val() === '') {
            var tabId = $(this).closest('.tab-pane').attr('id');
            $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
            $(this).select2('focus');
            isValid = false;
            return false;
        }
    });
    
    // Fix issue with focusable form controls by ensuring all required fields are visible
    // before browser validation occurs
    if (!isValid) {
        e.preventDefault();
        return false;
    }
});

// Initialize select2 elements properly
function initializeSelect2() {
    setTimeout(function() {
        $('.select2').select2({
            width: '100%'
        });
    }, 100);
}

// Re-initialize select2 elements when switching tabs
$('.admission-nav .nav-tabs a').on('shown.bs.tab', function() {
    initializeSelect2();
});

// Initialize on page load
initializeSelect2();

// After updateProgressIndicator() function
$(document).ready(function() {
    // Modify form submission to handle hidden tabs and required fields
    $('form').on('submit', function(e) {
        // First show all tabs one by one to make all fields visible to the browser's validation
        var allValid = true;
        var firstInvalidTab = null;
        
        // Function to validate a tab and return if it's valid
        function validateTab(tabId) {
            var isValid = true;
            var $tabPane = $('#' + tabId);
            
            // Find all required fields in this tab
            var $requiredFields = $tabPane.find('[required]');
            
            // Check each required field's validity
            $requiredFields.each(function() {
                // Special handling for Select2 fields
                if ($(this).hasClass('select2') || $(this).hasClass('select2-hidden-accessible')) {
                    if (!$(this).val() || $(this).val() === "") {
                        isValid = false;
                        $(this).next('.select2-container').css('border', '1px solid red');
                        return false; // Break the loop
                    } else {
                        $(this).next('.select2-container').css('border', '');
                    }
                } 
                // Normal field validation
                else if (!this.checkValidity()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    return false; // Break the loop
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            return isValid;
        }
        
        // Validate all tabs, but only record the first invalid one
        var tabs = ['student', 'parent', 'transport', 'documents'];
        for (var i = 0; i < tabs.length; i++) {
            var isTabValid = validateTab(tabs[i]);
            if (!isTabValid) {
                allValid = false;
                if (firstInvalidTab === null) {
                    firstInvalidTab = tabs[i];
                }
            }
        }
        
        // If any validation errors, switch to the first tab with errors
        if (!allValid && firstInvalidTab !== null) {
            $('.nav-tabs a[href="#' + firstInvalidTab + '"]').tab('show');
            e.preventDefault();
            return false;
        }
    });
    
    // Initialize Select2 elements properly to resolve focusable issues
    function initializeSelect2() {
        $('.select2').select2({
            width: '100%',
            dropdownParent: $('body') // This helps with z-index issues in tabs
        });
    }
    
    // Initialize on document ready
    initializeSelect2();
    
    // Fix Select2 when switching tabs
    $('.nav-tabs a').on('shown.bs.tab', function() {
        $($(this).attr('href')).find('.select2').select2({
            width: '100%',
            dropdownParent: $('body')
        });
    });
    
    // Fix datepicker initialization
    $('.datepicker').each(function() {
        $(this).attr('type', 'text'); // Change to text input for better validation
    });
    
    // Fix Required Select2 Validation
    $(document).on('select2:close', '.select2[required]', function() {
        $(this).valid();
    });
});

// Hide the previous school field on page load
$(document).ready(function() {
    // Find the div containing previous_school input and hide its parent row
    $('input[name="ps_attended"]').closest('.row').hide();
});

// Function to toggle password visibility
function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var toggleIcon = document.getElementById("password-toggle-icon");
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.className = "fa fa-eye-slash";
    } else {
        passwordField.type = "password";
        toggleIcon.className = "fa fa-eye";
    }
}

// Function to toggle father password visibility
function toggleFatherPasswordVisibility() {
    var passwordField = document.getElementById("father_password");
    var toggleIcon = document.getElementById("father-password-toggle-icon");
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.className = "fa fa-eye-slash";
    } else {
        passwordField.type = "password";
        toggleIcon.className = "fa fa-eye";
    }
}

// Function to toggle mother password visibility
function toggleMotherPasswordVisibility() {
    var passwordField = document.getElementById("mother_password");
    var toggleIcon = document.getElementById("mother-password-toggle-icon");
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.className = "fa fa-eye-slash";
    } else {
        passwordField.type = "password";
        toggleIcon.className = "fa fa-eye";
    }
}

// Function to toggle student password visibility
function toggleStudentPasswordVisibility() {
    var passwordField = document.getElementById("student_password");
    var toggleIcon = document.getElementById("student-password-toggle-icon");
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.className = "fa fa-eye-slash";
    } else {
        passwordField.type = "password";
        toggleIcon.className = "fa fa-eye";
    }
}

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
        'student_email': 'Student Email',
        'password': 'Password',
        'sex': 'Gender',
        'birthday': 'Date of Birth',
        'class_id': 'Class',
        'transport_mode': 'Transport Mode',
        'father_name': 'Father\'s Name',
        'father_phone': 'Father\'s Phone',
        'father_email': 'Father\'s Email',
        'father_password': 'Father\'s Password'
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
    var studentEmail = $('[name="student_email"]').val();
    if (studentEmail && !emailRegex.test(studentEmail)) {
        errors.push('Please enter a valid Student Email address');
        $('[name="student_email"]').addClass('is-invalid');
        isValid = false;
    }
    
    // Validate father email
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
    
    // Validate father phone
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
    
    // Validate Aadhar number if provided (12 digits)
    var aadharRegex = /^[0-9]{12}$/;
    var aadharNo = $('[name="adhar_no"]').val();
    if (aadharNo && !aadharRegex.test(aadharNo)) {
        errors.push('Aadhar Card Number must be a 12-digit number');
        $('[name="adhar_no"]').addClass('is-invalid');
        isValid = false;
    }
    
    // File upload validation for student photo
    var studentPhoto = $('input[name="userfile"]')[0];
    if (studentPhoto.files.length === 0) {
        errors.push('Student Photo is required');
        $(studentPhoto).addClass('is-invalid');
        isValid = false;
    } else if (studentPhoto.files.length > 0) {
        var file = studentPhoto.files[0];
        
        // Check file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            errors.push('Student Photo size exceeds 5MB limit');
            $(studentPhoto).addClass('is-invalid');
            isValid = false;
        }
        
        // Check file type
        var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            errors.push('Student Photo must be JPG, JPEG, or PNG format');
            $(studentPhoto).addClass('is-invalid');
            isValid = false;
        }
    }
    
    // Password strength validation
    var password = $('[name="password"]').val();
    if (password && password.length < 6) {
        errors.push('Password must be at least 6 characters long');
        $('[name="password"]').addClass('is-invalid');
        isValid = false;
    }
    
    // Father password validation
    var fatherPassword = $('[name="father_password"]').val();
    if (fatherPassword && fatherPassword.length < 6) {
        errors.push('Father\'s Password must be at least 6 characters long');
        $('[name="father_password"]').addClass('is-invalid');
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
    var overlay = $('<div id="form-loading-overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9999;display:flex;justify-content:center;align-items:center;"><div style="background:white;padding:20px;border-radius:5px;text-align:center;box-shadow:0 0 20px rgba(0,0,0,0.3);"><i class="fa fa-spinner fa-spin fa-3x" style="color:#2196F3;margin-bottom:15px;display:block;"></i><div style="font-size:16px;font-weight:500;">Saving student information...</div><div style="font-size:13px;margin-top:10px;color:#666;">This may take a moment. Please do not close this page.</div></div></div>');
    $('body').append(overlay);
}
</script>

<!-- Fix JavaScript errors -->
<script src="<?php echo base_url(); ?>js/form_fixes.js"></script>
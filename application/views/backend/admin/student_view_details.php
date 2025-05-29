<div class="student-details-container">
    <!-- Student Basic Info Section -->
    <div class="student-info-section">
        <div class="student-info-header">
            <i class="fa fa-user"></i> Basic Information
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="student-photo">
                    <img src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']); ?>" class="img-responsive">
                </div>
            </div>
            <div class="col-md-9">
                <div class="info-row">
                    <div class="info-label">Admission Number</div>
                    <div class="info-value"><?php echo $student['admission_number']; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Student Code</div>
                    <div class="info-value"><?php echo isset($student['student_code']) ? $student['student_code'] : 'N/A'; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Name</div>
                    <div class="info-value"><?php echo $student['name']; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Gender</div>
                    <div class="info-value"><?php echo $student['sex']; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Date of Birth</div>
                    <div class="info-value"><?php echo $student['birthday']; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Blood Group</div>
                    <div class="info-value"><?php echo isset($student['blood_group']) ? $student['blood_group'] : 'N/A'; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value"><?php echo $student['email']; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Phone</div>
                    <div class="info-value"><?php echo $student['phone']; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Religion</div>
                    <div class="info-value"><?php echo isset($student['religion']) ? $student['religion'] : 'N/A'; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Admission Category</div>
                    <div class="info-value"><?php echo isset($student['admission_category']) ? $student['admission_category'] : 'N/A'; ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Admission Date</div>
                    <div class="info-value"><?php echo isset($student['admission_date']) ? $student['admission_date'] : 'N/A'; ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Academic Information -->
    <div class="student-info-section">
        <div class="student-info-header">
            <i class="fa fa-graduation-cap"></i> Academic Information
        </div>
        
        <div class="info-row">
            <div class="info-label">Class</div>
            <div class="info-value"><?php echo $class['name']; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Session</div>
            <div class="info-value"><?php echo isset($student['session']) ? $student['session'] : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Previous School</div>
            <div class="info-value"><?php echo isset($student['ps_attended']) ? $student['ps_attended'] : 'N/A'; ?></div>
        </div>
    </div>

    <!-- Category Information -->
    <div class="student-info-section">
        <div class="student-info-header">
            <i class="fa fa-tags"></i> Category Information
        </div>
        
        <div class="info-row">
            <div class="info-label">Admission Category</div>
            <div class="info-value"><?php echo isset($student['admission_category']) ? ucfirst($student['admission_category']) : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Caste</div>
            <div class="info-value"><?php echo isset($student['caste']) ? strtoupper($student['caste']) : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Student Aadhaar Number</div>
            <div class="info-value"><?php echo isset($student['adhar_no']) ? $student['adhar_no'] : 'N/A'; ?></div>
        </div>
    </div>

    <!-- Enhanced Academic Information -->
    <div class="student-info-section">
        <div class="student-info-header">
            <i class="fa fa-graduation-cap"></i> Academic Information
        </div>
        
        <div class="info-row">
            <div class="info-label">Class</div>
            <div class="info-value"><?php echo $class['name']; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Section</div>
            <div class="info-value">
                <?php 
                if(isset($student['section_id']) && !empty($student['section_id'])) {
                    $section = $this->db->get_where('section', array('section_id' => $student['section_id']))->row();
                    echo $section ? $section->name : 'N/A';
                } else {
                    echo 'N/A';
                }
                ?>
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Roll Number</div>
            <div class="info-value"><?php echo isset($student['roll']) ? $student['roll'] : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Session</div>
            <div class="info-value"><?php echo isset($student['session']) ? $student['session'] : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Previous School</div>
            <div class="info-value"><?php echo isset($student['ps_attended']) ? $student['ps_attended'] : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Transfer Certificate Required</div>
            <div class="info-value"><?php echo isset($student['tran_cert']) ? ucfirst($student['tran_cert']) : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Date of Birth Certificate</div>
            <div class="info-value"><?php echo isset($student['dob_cert']) ? ucfirst($student['dob_cert']) : 'N/A'; ?></div>
        </div>
    </div>
    
    <!-- Enhanced Parent Information -->
    <div class="student-info-section">
        <div class="student-info-header">
            <i class="fa fa-users"></i> Parent Information
        </div>
        
        <!-- Father Information -->
        <div style="background: #f9f9f9; padding: 10px; margin: 10px 0; border-radius: 5px;">
            <h5><i class="fa fa-male"></i> Father's Details</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Name</div>
                        <div class="info-value"><?php echo isset($student['father_name']) ? $student['father_name'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Phone</div>
                        <div class="info-value"><?php echo isset($student['father_phone']) ? $student['father_phone'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo isset($student['father_email']) ? $student['father_email'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Aadhaar Number</div>
                        <div class="info-value"><?php echo isset($student['father_adhar']) ? $student['father_adhar'] : 'N/A'; ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Occupation</div>
                        <div class="info-value"><?php echo isset($student['father_occupation']) ? $student['father_occupation'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Designation</div>
                        <div class="info-value"><?php echo isset($student['father_designation']) ? $student['father_designation'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Qualification</div>
                        <div class="info-value"><?php echo isset($student['father_qualification']) ? $student['father_qualification'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Annual Income</div>
                        <div class="info-value"><?php echo isset($student['father_annual_income']) ? '₹' . number_format($student['father_annual_income']) : 'N/A'; ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mother Information -->
        <div style="background: #f9f9f9; padding: 10px; margin: 10px 0; border-radius: 5px;">
            <h5><i class="fa fa-female"></i> Mother's Details</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Name</div>
                        <div class="info-value"><?php echo isset($student['mother_name']) ? $student['mother_name'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Phone</div>
                        <div class="info-value"><?php echo isset($student['mother_phone']) ? $student['mother_phone'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo isset($student['mother_email']) ? $student['mother_email'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Aadhaar Number</div>
                        <div class="info-value"><?php echo isset($student['mother_adhar']) ? $student['mother_adhar'] : 'N/A'; ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-row">
                        <div class="info-label">Occupation</div>
                        <div class="info-value"><?php echo isset($student['mother_occupation']) ? $student['mother_occupation'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Designation</div>
                        <div class="info-value"><?php echo isset($student['mother_designation']) ? $student['mother_designation'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Qualification</div>
                        <div class="info-value"><?php echo isset($student['mother_qualification']) ? $student['mother_qualification'] : 'N/A'; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Annual Income</div>
                        <div class="info-value"><?php echo isset($student['mother_annual_income']) ? '₹' . number_format($student['mother_annual_income']) : 'N/A'; ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Guardian Information -->
        <?php if(isset($student['guardian_name']) && !empty($student['guardian_name'])): ?>
        <div style="background: #f9f9f9; padding: 10px; margin: 10px 0; border-radius: 5px;">
            <h5><i class="fa fa-user"></i> Guardian's Details</h5>
            <div class="info-row">
                <div class="info-label">Name</div>
                <div class="info-value"><?php echo $student['guardian_name']; ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Phone</div>
                <div class="info-value"><?php echo isset($student['guardian_phone']) ? $student['guardian_phone'] : 'N/A'; ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-value"><?php echo isset($student['guardian_email']) ? $student['guardian_email'] : 'N/A'; ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Address</div>
                <div class="info-value"><?php echo isset($student['guardian_address']) ? $student['guardian_address'] : 'N/A'; ?></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Transport Information -->
    <div class="student-info-section">
        <div class="student-info-header">
            <i class="fa fa-bus"></i> Transport Information
        </div>
        
        <div class="info-row">
            <div class="info-label">Transport Mode</div>
            <div class="info-value"><?php echo isset($student['transport_mode']) ? ucfirst($student['transport_mode']) : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Transport ID</div>
            <div class="info-value"><?php echo isset($student['transport_id']) ? $student['transport_id'] : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Pick Area</div>
            <div class="info-value"><?php echo isset($student['pick_area']) ? $student['pick_area'] : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Pick Stand</div>
            <div class="info-value"><?php echo isset($student['pick_stand']) ? $student['pick_stand'] : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Drop Area</div>
            <div class="info-value"><?php echo isset($student['drop_area']) ? $student['drop_area'] : 'N/A'; ?></div>
        </div>
        <div class="info-row">
            <div class="info-label">Drop Stand</div>
            <div class="info-value"><?php echo isset($student['drop_stand']) ? $student['drop_stand'] : 'N/A'; ?></div>
        </div>
    </div>
    
    <!-- Address Information -->
    <div class="student-info-section">
        <div class="student-info-header">
            <i class="fa fa-map-marker"></i> Address Information
        </div>
        
        <div style="background: #f9f9f9; padding: 10px; margin: 10px 0; border-radius: 5px;">
            <h5><i class="fa fa-home"></i> Present Address</h5>
            <div class="info-row">
                <div class="info-label">Address</div>
                <div class="info-value"><?php echo isset($student['address']) ? $student['address'] : 'N/A'; ?></div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="info-row">
                        <div class="info-label">City</div>
                        <div class="info-value"><?php echo isset($student['city']) ? $student['city'] : 'N/A'; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-row">
                        <div class="info-label">State</div>
                        <div class="info-value"><?php echo isset($student['state']) ? $student['state'] : 'N/A'; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-row">
                        <div class="info-label">Pincode</div>
                        <div class="info-value"><?php echo isset($student['pincode']) ? $student['pincode'] : 'N/A'; ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="background: #f9f9f9; padding: 10px; margin: 10px 0; border-radius: 5px;">
            <h5><i class="fa fa-home"></i> Permanent Address</h5>
            <div class="info-row">
                <div class="info-label">Address</div>
                <div class="info-value"><?php echo isset($student['permanent_address']) ? $student['permanent_address'] : 'N/A'; ?></div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="info-row">
                        <div class="info-label">City</div>
                        <div class="info-value"><?php echo isset($student['permanent_city']) ? $student['permanent_city'] : 'N/A'; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-row">
                        <div class="info-label">State</div>
                        <div class="info-value"><?php echo isset($student['permanent_state']) ? $student['permanent_state'] : 'N/A'; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-row">
                        <div class="info-label">Pincode</div>
                        <div class="info-value"><?php echo isset($student['permanent_pincode']) ? $student['permanent_pincode'] : 'N/A'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Document Preview Section -->
    <div class="student-info-section">
        <div class="student-info-header">
            <i class="fa fa-file-text"></i> Document Preview
        </div>
        
        <div class="row">
            <?php if(isset($student['signature']) && !empty($student['signature'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Student Signature</div>
                    <div class="document-preview-container">
                        <img src="<?php echo base_url('uploads/student_documents/' . $student['signature']); ?>" alt="Signature" style="max-width:100%;max-height:120px;" />
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['transfer_certificate_doc']) && !empty($student['transfer_certificate_doc'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Transfer Certificate</div>
                    <div class="document-preview-container">
                        <a href="<?php echo base_url('uploads/student_documents/' . $student['transfer_certificate_doc']); ?>" target="_blank" class="document-preview-link">
                            <i class="fa fa-file-pdf-o"></i> View Document
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['student_id']) && file_exists(FCPATH.'uploads/student_image/' . $student['student_id'] . '.jpg')): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Student Photo</div>
                    <div class="document-preview-container">
                        <img src="<?php echo base_url('uploads/student_image/' . $student['student_id'] . '.jpg'); ?>" alt="Student Photo" style="max-width:100%;max-height:120px;" />
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['father_photo']) && !empty($student['father_photo']) && file_exists(FCPATH.'uploads/parent_image/' . $student['father_photo'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Father Photo</div>
                    <div class="document-preview-container">
                        <img src="<?php echo base_url('uploads/parent_image/' . $student['father_photo']); ?>" alt="Father Photo" style="max-width:100%;max-height:120px;" />
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['mother_photo']) && !empty($student['mother_photo']) && file_exists(FCPATH.'uploads/parent_image/' . $student['mother_photo'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Mother Photo</div>
                    <div class="document-preview-container">
                        <img src="<?php echo base_url('uploads/parent_image/' . $student['mother_photo']); ?>" alt="Mother Photo" style="max-width:100%;max-height:120px;" />
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['guardian_photo']) && !empty($student['guardian_photo']) && file_exists(FCPATH.'uploads/parent_image/' . $student['guardian_photo'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Guardian Photo</div>
                    <div class="document-preview-container">
                        <img src="<?php echo base_url('uploads/parent_image/' . $student['guardian_photo']); ?>" alt="Guardian Photo" style="max-width:100%;max-height:120px;" />
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['father_adharcard_doc']) && !empty($student['father_adharcard_doc'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Father's Aadhar Card</div>
                    <div class="document-preview-container">
                        <a href="<?php echo base_url('uploads/student_documents/' . $student['father_adharcard_doc']); ?>" target="_blank" class="document-preview-link">
                            <i class="fa fa-file-pdf-o"></i> View Document
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['mother_adharcard_doc']) && !empty($student['mother_adharcard_doc'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Mother's Aadhar Card</div>
                    <div class="document-preview-container">
                        <a href="<?php echo base_url('uploads/student_documents/' . $student['mother_adharcard_doc']); ?>" target="_blank" class="document-preview-link">
                            <i class="fa fa-file-pdf-o"></i> View Document
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['income_certificate_doc']) && !empty($student['income_certificate_doc'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Income Certificate</div>
                    <div class="document-preview-container">
                        <a href="<?php echo base_url('uploads/student_documents/' . $student['income_certificate_doc']); ?>" target="_blank" class="document-preview-link">
                            <i class="fa fa-file-pdf-o"></i> View Document
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['dob_proof_doc']) && !empty($student['dob_proof_doc'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Date of Birth Proof</div>
                    <div class="document-preview-container">
                        <a href="<?php echo base_url('uploads/student_documents/' . $student['dob_proof_doc']); ?>" target="_blank" class="document-preview-link">
                            <i class="fa fa-file-pdf-o"></i> View Document
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['migration_certificate_doc']) && !empty($student['migration_certificate_doc'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Migration Certificate</div>
                    <div class="document-preview-container">
                        <a href="<?php echo base_url('uploads/student_documents/' . $student['migration_certificate_doc']); ?>" target="_blank" class="document-preview-link">
                            <i class="fa fa-file-pdf-o"></i> View Document
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['caste_certificate_doc']) && !empty($student['caste_certificate_doc'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Caste Certificate</div>
                    <div class="document-preview-container">
                        <a href="<?php echo base_url('uploads/student_documents/' . $student['caste_certificate_doc']); ?>" target="_blank" class="document-preview-link">
                            <i class="fa fa-file-pdf-o"></i> View Document
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['aadhar_card_doc']) && !empty($student['aadhar_card_doc'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Student's Aadhar Card</div>
                    <div class="document-preview-container">
                        <a href="<?php echo base_url('uploads/student_documents/' . $student['aadhar_card_doc']); ?>" target="_blank" class="document-preview-link">
                            <i class="fa fa-file-pdf-o"></i> View Document
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($student['address_proof_doc']) && !empty($student['address_proof_doc'])): ?>
            <div class="col-md-4">
                <div class="document-preview">
                    <div class="document-label">Address Proof</div>
                    <div class="document-preview-container">
                        <a href="<?php echo base_url('uploads/student_documents/' . $student['address_proof_doc']); ?>" target="_blank" class="document-preview-link">
                            <i class="fa fa-file-pdf-o"></i> View Document
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .student-details-container {
        font-family: Arial, sans-serif;
    }
    .student-info-section {
        margin-bottom: 20px;
    }
    .student-info-header {
        background: #f5f5f5;
        padding: 8px;
        font-weight: bold;
        border-bottom: 2px solid #ddd;
    }
    .info-row {
        display: flex;
        border-bottom: 1px solid #eee;
    }
    .info-label {
        width: 40%;
        padding: 8px;
        font-weight: bold;
    }
    .info-value {
        width: 60%;
        padding: 8px;
    }
    .student-photo {
        text-align: center;
        margin-bottom: 15px;
    }
    .student-photo img {
        max-width: 150px;
        border: 1px solid #ddd;
        padding: 5px;
    }
    /* Document Preview Styles */
    .document-preview {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .document-label {
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }
    .document-preview-container {
        text-align: center;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 4px;
    }
    .document-preview-link {
        display: inline-block;
        padding: 8px 15px;
        background: #2196F3;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background 0.3s ease;
    }
    .document-preview-link:hover {
        background: #1976D2;
        color: white;
        text-decoration: none;
    }
    .document-preview-link i {
        margin-right: 5px;
    }
</style> 
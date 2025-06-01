<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_phrase('National Public School - Admission Form'); ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
    <style>
        body {
            font-size: 11px;
            font-family: 'Arial', sans-serif;
            line-height: 1.2;
            margin: 0;
            padding: 12px;
            background: #f8f9fa;
        }
        
        .admission-form-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            padding: 18px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border: 2px solid #1a237e;
            border-radius: 8px;
            position: relative;
        }
        
        /* Decorative corner elements */
        .admission-form-container::before,
        .admission-form-container::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            border: 2px solid #d32f2f;
        }
        
        .admission-form-container::before {
            top: 8px;
            left: 8px;
            border-right: none;
            border-bottom: none;
        }
        
        .admission-form-container::after {
            bottom: 8px;
            right: 8px;
            border-left: none;
            border-top: none;
        }
        
        .header {
            text-align: center;
            margin-bottom: 18px;
            border-bottom: 2px double #1a237e;
            padding-bottom: 12px;
            position: relative;
        }
        
        .school-logo {
            width: 350px;
            height: 120px;
            margin: 0 auto 8px;
            display: block;
            /* Removed circle border - logo flies free! */
            background: transparent;
        }
        
        .school-name {
            font-size: 22px;
            font-weight: bold;
            color: #1a237e;
            margin-bottom: 4px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            font-family: 'Georgia', serif;
        }
        
        .form-title {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
            text-align: center;
            padding: 8px;
            background: linear-gradient(135deg, #1a237e 0%, #3f51b5 100%);
            color: white;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 2px 4px rgba(26, 35, 126, 0.3);
        }
        
        .section-title {
            font-size: 11px;
            font-weight: bold;
            margin: 12px 0 8px;
            padding: 5px 10px;
            background: linear-gradient(135deg, #d32f2f 0%, #f44336 100%);
            color: white;
            border-radius: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 1px 3px rgba(211, 47, 47, 0.3);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            background: white;
        }
        
        .label {
            font-weight: bold;
            padding: 6px 8px;
            background: #f5f5f5;
            border: 1px solid #ddd;
            color: #333;
            font-size: 9px;
            width: 25%;
            vertical-align: middle;
        }
        
        .field {
            padding: 6px 8px;
            border: 1px solid #ddd;
            font-size: 10px;
            color: #444;
            border-bottom: 1px dotted #999;
            min-height: 18px;
            vertical-align: middle;
        }
        
        .photo-box {
            width: 95px;
            height: 115px;
            border: 2px solid #1a237e;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9f9f9;
            border-radius: 3px;
            font-size: 9px;
            color: #666;
            text-align: center;
        }
        
        .photo-box img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 2px;
        }
        
        .parent-photo {
            width: 75px;
            height: 90px;
            border: 1px solid #ddd;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9f9f9;
            font-size: 8px;
            color: #666;
            text-align: center;
        }
        
        .checkbox-group {
            display: inline-flex;
            gap: 12px;
            align-items: center;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .checkbox {
            width: 12px;
            height: 12px;
            border: 1px solid #333;
            display: inline-block;
        }
        
        .signature-line {
            border-bottom: 1px dotted #999;
            height: 35px;
            margin: 10px 0;
            display: flex;
            align-items: end;
            padding-bottom: 2px;
        }
        
        /* Compact table styles */
        .compact-table {
            margin-bottom: 8px;
        }
        
        .compact-table th,
        .compact-table td {
            padding: 5px 6px;
            font-size: 8px;
            border: 1px solid #333;
            min-height: 20px;
        }
        
        .compact-table th {
            background: #f0f0f0;
            font-weight: bold;
        }
        
        /* Page break controls for 2-page layout */
        .page-1 {
            page-break-after: always;
        }
        
        .page-2 {
            page-break-before: always;
        }
        
        /* Print-specific styles */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
                font-size: 10px;
            }
            
            .no-print {
                display: none !important;
            }
            
            .admission-form-container {
                box-shadow: none;
                max-width: none;
                margin: 0;
                border-radius: 0;
                border: 2px solid #1a237e;
                padding: 12px;
            }
            
            @page {
                size: A4 portrait;
                margin: 8mm;
            }
            
            /* Ensure colors print correctly */
            .form-title,
            .section-title {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            /* Page-specific adjustments */
            .page-1 {
                min-height: 245mm;
                page-break-after: always;
            }
            
            .page-2 {
                page-break-before: always;
                min-height: 245mm;
            }
            
            /* Prevent orphaned content */
            .section-title {
                page-break-after: avoid;
            }
            
            table {
                page-break-inside: avoid;
                margin-bottom: 6px;
            }
            
            /* Smaller elements for print */
            .school-name {
                font-size: 20px;
            }
            
            .school-logo {
                width: 350px;
                height: 120px;
            }
            
            .form-title {
                font-size: 14px;
                padding: 6px;
            }
            
            .section-title {
                font-size: 10px;
                padding: 4px 8px;
                margin: 8px 0 5px;
            }
            
            .photo-box {
                width: 85px;
                height: 100px;
            }
            
            .parent-photo {
                width: 65px;
                height: 80px;
            }
            
            .label {
                font-size: 8px;
                padding: 5px 7px;
            }
            
            .field {
                font-size: 9px;
                padding: 5px 7px;
            }
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .admission-form-container {
                margin: 8px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 15px; background: white; padding: 12px; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
        <button onclick="window.print()" class="btn btn-primary btn-lg" style="margin-right: 10px;">
            <i class="fa fa-print"></i> <?php echo get_phrase('print'); ?>
        </button>
        <button onclick="window.close()" class="btn btn-secondary">
            <i class="fa fa-times"></i> <?php echo get_phrase('close'); ?>
        </button>
    </div>
    
    <div class="admission-form-container">
        <!-- PAGE 1 CONTENT -->
        <div class="page-1">
            <div class="header">
                <!-- National Public School Logo - Flying Free! -->
                <img src="<?php echo base_url('uploads/school_logo.png.png'); ?>" class="school-logo" alt="National Public  School Logo">
                
                <div class="school-name">National Public School</div>
            </div>
            
            <div class="form-title">
                ADMISSION FORM
            </div>
            
            <!-- Basic Information Row -->
            <table style="margin-bottom: 15px;">
                <tr>
                    <td class="label">Student's SRN</td>
                    <td class="field" style="width: 20%;"><?php echo isset($student['student_code']) ? $student['student_code'] : ''; ?></td>
                    <td style="width: 18%; text-align: center; font-size: 10px; color: #666; padding: 6px;">Academic Year</td>
                    <td rowspan="3" style="width: 24%; text-align: center; vertical-align: top; padding: 10px;">
                        <div class="photo-box">
                            <?php if (isset($student['student_id']) && file_exists('uploads/student_image/'.$student['student_id'].'.jpg')): ?>
                                <img src="<?php echo base_url('uploads/student_image/'.$student['student_id'].'.jpg'); ?>" alt="Student Photo">
                            <?php else: ?>
                                Affix passport<br>size photo of the<br>student
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">Admission No. & Date</td>
                    <td class="field"><?php echo isset($student['admission_number']) ? $student['admission_number'] : ''; ?></td>
                    <td class="field"><?php echo isset($student['admission_date']) ? $student['admission_date'] : ''; ?></td>
                </tr>
            </table>
            
            <!-- Student's Profile Section -->
            <div class="section-title">STUDENT'S PROFILE:</div>
            
            <table>
                <tr>
                    <td class="label">Name of pupil (In capital letters)</td>
                    <td class="field" colspan="3"><?php echo isset($student['name']) ? strtoupper($student['name']) : ''; ?></td>
                </tr>
                <tr>
                    <td class="label">Admission sought for Class</td>
                    <td class="field" style="width: 24%;"><?php echo isset($class['name']) ? $class['name'] : ''; ?></td>
                    <td style="width: 15%; text-align: right; padding: 6px; font-size: 9px;">Academic Year:</td>
                    <td class="field" style="width: 24%;"><?php echo isset($student['session']) ? $student['session'] : ''; ?></td>
                </tr>
                <tr>
                    <td class="label">Date of Birth</td>
                    <td class="field"><?php echo isset($student['birthday']) ? $student['birthday'] : ''; ?></td>
                    <td style="text-align: right; padding: 6px; font-size: 9px;">Aadhar No.:</td>
                    <td class="field"><?php echo isset($student['adhar_no']) ? $student['adhar_no'] : ''; ?></td>
                </tr>
                <tr>
                    <td class="label">Place of Birth</td>
                    <td class="field"><?php echo isset($student['birth_place']) ? $student['birth_place'] : ''; ?></td>
                    <td style="text-align: right; padding: 6px; font-size: 9px;">State:</td>
                    <td class="field"><?php echo isset($student['state']) ? $student['state'] : ''; ?></td>
                </tr>
                <tr>
                    <td class="label">Nationality</td>
                    <td class="field"><?php echo isset($student['nationality']) ? $student['nationality'] : 'Indian'; ?></td>
                    <td style="text-align: right; padding: 6px; font-size: 9px;">Religion:</td>
                    <td class="field"><?php echo isset($student['religion']) ? $student['religion'] : ''; ?></td>
                </tr>
                <tr>
                    <td class="label">Gender</td>
                    <td class="field">
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <span class="checkbox"><?php echo (isset($student['sex']) && $student['sex'] == 'male') ? '✓' : ''; ?></span>
                                <span>Male</span>
                            </div>
                            <div class="checkbox-item">
                                <span class="checkbox"><?php echo (isset($student['sex']) && $student['sex'] == 'female') ? '✓' : ''; ?></span>
                                <span>Female</span>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: right; padding: 6px; font-size: 9px;">Caste:</td>
                    <td class="field"><?php echo isset($student['caste']) ? strtoupper($student['caste']) : ''; ?></td>
                </tr>
            </table>
            
            <!-- Address Section -->
            <table>
                <tr>
                    <td class="label">Residential Address :</td>
                    <td class="field" colspan="3"><?php echo isset($student['address']) ? $student['address'] : ''; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="field" colspan="2"></td>
                    <td style="text-align: right; padding: 6px; font-size: 9px;">Pin Code: <span class="field" style="display: inline-block; width: 60px; margin-left: 5px;"><?php echo isset($student['pincode']) ? $student['pincode'] : ''; ?></span></td>
                </tr>
            </table>
            
            <!-- Additional Info -->
            <table>
                <tr>
                    <td class="label">Mother Tongue</td>
                    <td class="field" style="width: 38%;"><?php echo isset($student['mother_tongue']) ? $student['mother_tongue'] : ''; ?></td>
                    <td style="text-align: right; padding: 6px; font-size: 9px;">Blood group:</td>
                    <td class="field"><?php echo isset($student['blood_group']) ? $student['blood_group'] : ''; ?></td>
                </tr>
                <tr>
                    <td class="label">Identification Marks</td>
                    <td class="field" colspan="3">: (1) <?php echo isset($student['identification_mark1']) ? $student['identification_mark1'] : ''; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="field" colspan="3">(2) <?php echo isset($student['identification_mark2']) ? $student['identification_mark2'] : ''; ?></td>
                </tr>
            </table>
            
            <!-- Previous Academic Record -->
            <div style="margin: 12px 0; font-weight: bold; font-size: 10px;">Previous academic record</div>
            <table class="compact-table" style="border: 2px solid #333;">
                <tr style="background: #f0f0f0;">
                    <th style="border: 1px solid #333; padding: 6px; font-size: 8px;">Name of the previous school & location</th>
                    <th style="border: 1px solid #333; padding: 6px; font-size: 8px; width: 14%;">Class</th>
                    <th style="border: 1px solid #333; padding: 6px; font-size: 8px; width: 20%;">Year of Study</th>
                    <th style="border: 1px solid #333; padding: 6px; font-size: 8px; width: 20%;">Percentage/Grade</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px ; height: 22px;"><?php echo isset($student['ps_attended']) ? $student['ps_attended'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px; height: 22px;"><?php echo isset($student['ps_class']) ? $student['ps_class'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;"><?php echo isset($student['ps_year']) ? $student['ps_year'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;"><?php echo isset($student['ps_percentage']) ? $student['ps_percentage'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 6px; height: 22px;"></td>
                    <td style="border: 1px solid #333; padding: 6px;"></td>
                    <td style="border: 1px solid #333; padding: 6px;"></td>
                    <td style="border: 1px solid #333; padding: 6px;"></td>
                </tr>
            </table>
            
            <!-- Siblings Profile -->
            <div style="margin: 12px 0; font-weight: bold; font-size: 10px;">SIBLINGS' PROFILE</div>
            <table class="compact-table" style="border: 2px solid #333;">
                <tr style="background: #f0f0f0;">
                    <th style="border: 1px solid #333; padding: 6px; font-size: 8px; width: 10%;">S.No.</th>
                    <th style="border: 1px solid #333; padding: 6px; font-size: 8px;">Name of the Sibling</th>
                    <th style="border: 1px solid #333; padding: 6px; font-size: 8px; width: 14%;">Class</th>
                    <th style="border: 1px solid #333; padding: 6px; font-size: 8px;">Name of the School</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;">1.</td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px; height: 20px;"></td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;"></td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;">2.</td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px; height: 20px;"></td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;"></td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;">3.</td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px; height: 20px;"></td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;"></td>
                    <td style="border: 1px solid #333; padding: 6px; font-size: 8px;"></td>
                </tr>
            </table>
        </div>
        
        <!-- PAGE 2 CONTENT -->
        <div class="page-2">
            <!-- Parents/Guardian's Profile -->
            <div class="section-title">PARENTS' / GUARDIAN'S PROFILE</div>
            
            <!-- Photo and Signature Row -->
            <table style="margin-bottom: 15px;">
                <tr>
                    <td style="width: 33%; text-align: center; padding: 8px;">
                        <div class="parent-photo">
                            <?php if (isset($student['mother_photo']) && !empty($student['mother_photo'])): ?>
                                <img src="<?php echo base_url('uploads/parent_photos/' . $student['mother_photo']); ?>" style="max-width: 100%; max-height: 100%;" alt="Mother Photo">
                            <?php else: ?>
                                Mother's<br>Photo
                            <?php endif; ?>
                        </div>
                        <div class="signature-line" style="margin-top: 8px; font-size: 8px; text-align: center;">
                            Signature ........................
                        </div>
                    </td>
                    <td style="width: 33%; text-align: center; padding: 8px;">
                        <div class="parent-photo">
                            <?php if (isset($student['father_photo']) && !empty($student['father_photo'])): ?>
                                <img src="<?php echo base_url('uploads/parent_photos/' . $student['father_photo']); ?>" style="max-width: 100%; max-height: 100%;" alt="Father Photo">
                            <?php else: ?>
                                Father's<br>Photo
                            <?php endif; ?>
                        </div>
                        <div class="signature-line" style="margin-top: 8px; font-size: 8px; text-align: center;">
                            Signature .......................
                        </div>
                    </td>
                    <td style="width: 33%; text-align: center; padding: 8px;">
                        <div class="parent-photo">
                            <?php if (isset($student['guardian_photo']) && !empty($student['guardian_photo'])): ?>
                                <img src="<?php echo base_url('uploads/parent_photos/' . $student['guardian_photo']); ?>" style="max-width: 100%; max-height: 100%;" alt="Guardian Photo">
                            <?php else: ?>
                                Guardian's<br>Photo
                            <?php endif; ?>
                        </div>
                        <div class="signature-line" style="margin-top: 8px; font-size: 8px; text-align: center;">
                            Signature ...................
                        </div>
                    </td>
                </tr>
            </table>
            
            <!-- Parent Details Table -->
            <table class="compact-table" style="border: 2px solid #333;">
                <tr style="background: #f0f0f0;">
                    <th style="border: 1px solid #333; padding: 4px; font-size: 8px; width: 20%;">Particulars</th>
                    <th style="border: 1px solid #333; padding: 4px; font-size: 8px; width: 27%;">Mother</th>
                    <th style="border: 1px solid #333; padding: 4px; font-size: 8px; width: 27%;">Father</th>
                    <th style="border: 1px solid #333; padding: 4px; font-size: 8px; width: 26%;">Guardian</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Name</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_name']) ? $student['mother_name'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_name']) ? $student['father_name'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_name']) ? $student['guardian_name'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Qualification</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_qualification']) ? $student['mother_qualification'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_qualification']) ? $student['father_qualification'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_qualification']) ? $student['guardian_qualification'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Occupation</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_occupation']) ? $student['mother_occupation'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_occupation']) ? $student['father_occupation'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_occupation']) ? $student['guardian_occupation'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Organization</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_organization']) ? $student['mother_organization'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_organization']) ? $student['father_organization'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_organization']) ? $student['guardian_organization'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Designation</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_designation']) ? $student['mother_designation'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_designation']) ? $student['father_designation'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_designation']) ? $student['guardian_designation'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Mobile Number</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_phone']) ? $student['mother_phone'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_phone']) ? $student['father_phone'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_phone']) ? $student['guardian_phone'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Aadhar Number</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_adhar']) ? $student['mother_adhar'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_adhar']) ? $student['father_adhar'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_adhar']) ? $student['guardian_adhar'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Email</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_email']) ? $student['mother_email'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_email']) ? $student['father_email'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_email']) ? $student['guardian_email'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Annual income (Rs.)</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_annual_income']) ? $student['mother_annual_income'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_annual_income']) ? $student['father_annual_income'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_annual_income']) ? $student['guardian_annual_income'] : ''; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px; font-weight: bold; height: 18px;">Office Contact Number<br>with extn. (if any)</td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['mother_office_phone']) ? $student['mother_office_phone'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['father_office_phone']) ? $student['father_office_phone'] : ''; ?></td>
                    <td style="border: 1px solid #333; padding: 4px; font-size: 8px;"><?php echo isset($student['guardian_office_phone']) ? $student['guardian_office_phone'] : ''; ?></td>
                </tr>
            </table>
            
            <!-- Additional Information -->
            <table style="margin-top: 12px;">
                <tr>
                    <td style="font-size: 8px; padding: 4px;">Emergency Contact No.: <span style="border-bottom: 1px dotted #999; display: inline-block; width: 130px; margin-left: 8px;"><?php echo isset($student['emergency_contact']) ? $student['emergency_contact'] : ''; ?></span></td>
                    <td style="font-size: 8px; padding: 4px;">Preferred phone no. for SMS <span style="border-bottom: 1px dotted #999; display: inline-block; width: 110px; margin-left: 8px;"><?php echo isset($student['sms_phone']) ? $student['sms_phone'] : ''; ?></span></td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 8px; padding: 4px;">Transport Facility: Yes/No, (If Yes) From <span style="border-bottom: 1px dotted #999; display: inline-block; width: 160px; margin: 0 8px;"><?php echo isset($student['transport_from']) ? $student['transport_from'] : ''; ?></span> To <span style="border-bottom: 1px dotted #999; display: inline-block; width: 160px; margin-left: 8px;"><?php echo isset($student['transport_to']) ? $student['transport_to'] : ''; ?></span></td>
                </tr>
            </table>
            
            <!-- Enclosures -->
            <div style="margin: 12px 0;">
                <strong style="font-size: 9px;">Enclosures:</strong> <span style="font-size: 8px;">(All documents are necessary to submit at the time of admission)</span>
                <div style="margin-top: 6px; font-size: 8px;">
                    <div style="margin: 3px 0;">● Birth Certificate <span class="checkbox" style="margin-left: 18px;"></span></div>
                    <div style="margin: 3px 0;">● Aadhar card copy of Child/Mother/Father <span class="checkbox" style="margin-left: 18px;"></span></div>
                    <div style="margin: 3px 0;">● SLC/TC of Previous School <span class="checkbox" style="margin-left: 18px;"></span></div>
                    <div style="margin: 3px 0;">● Previous school Report Card/Mark Sheet <span class="checkbox" style="margin-left: 18px;"></span></div>
                </div>
            </div>
            
            <!-- Declaration -->
            <div style="margin: 12px 0;">
                <strong style="font-size: 9px;">Declaration</strong>
                <div style="font-size: 8px; margin-top: 4px; line-height: 1.3;">
                    I declare the statements provided in the form are correct to my knowledge and I agree to abide by the rules and regulations of the school.
                </div>
            </div>
            
            <!-- Final Signatures -->
            <table style="margin-top: 15px;">
                <tr>
                    <td style="width: 45%; font-size: 8px; padding: 6px;">
                        Signature of Mother/Father <span style="border-bottom: 1px dotted #999; display: inline-block; width: 90px; margin-left: 8px;"></span>
                    </td>
                    <td style="width: 45%; font-size: 8px; padding: 6px;">
                        Guardian <span style="border-bottom: 1px dotted #999; display: inline-block; width: 90px; margin-left: 8px;"></span>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 8px; padding: 6px;">
                        Signature of Principal <span style="border-bottom: 1px dotted #999; display: inline-block; width: 90px; margin-left: 8px;"></span>
                    </td>
                    <td></td>
                </tr>
            </table>
            
            <div style="text-align: center; margin-top: 12px; font-size: 7px; color: #666;">
                <p><?php echo get_phrase('generated_on'); ?>: <?php echo date('d-m-Y h:i A'); ?></p>
            </div>
        </div>
    </div>
    
    <script>
        // Auto print when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html> 
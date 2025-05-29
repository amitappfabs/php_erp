<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }



    // The function below insert into student house //
    function createStudentHouse(){

        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            'description'      => html_escape($this->input->post('description'))
	    );

        $this->db->insert('house', $page_data);
    }

// The function below update student house //
    function updateStudentHouse($param2){
        $page_data = array(
            'name'         => html_escape($this->input->post('name')),
            'description'  => html_escape($this->input->post('description'))
	    );

        $this->db->where('house_id', $param2);
        $this->db->update('house', $page_data);
    }

    // The function below delete from student house table //
    function deleteStudentHouse($param2){
        $this->db->where('house_id', $param2);
        $this->db->delete('house');
    }



    // The function below insert into student category //
    function createstudentCategory(){

        $page_data = array(
            'name'        => html_escape($this->input->post('name')),
            'description' => html_escape($this->input->post('description'))
	    );
        $this->db->insert('student_category', $page_data);
    }

// The function below update student category //
    function updatestudentCategory($param2){
        $page_data = array(
            'name'        => html_escape($this->input->post('name')),
            'description' => html_escape($this->input->post('description'))
	    );

        $this->db->where('student_category_id', $param2);
        $this->db->update('student_category', $page_data);
    }

    // The function below delete from student category table //
    function deletestudentCategory($param2){
        $this->db->where('student_category_id', $param2);
        $this->db->delete('student_category');
    }




    // Function to check if student_id already exists
    function check_student_id_exists($student_id, $current_id = null) {
        // If editing an existing student, exclude the current student from the check
        if ($current_id) {
            $this->db->where('student_id !=', $current_id);
        }
        
        $this->db->where('student_id', $student_id);
        $query = $this->db->get('student');
        
        return $query->num_rows() > 0;
    }
     
    //  the function below insert into student table
    function createNewStudent() {
        // Validate file upload
        if (empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('error_message', get_phrase('Please select a student photo'));
            error_log('Student creation failed: No photo uploaded');
            return false;
        }

        // Get file details
        $file = $_FILES['userfile'];
        $file_size = $file['size'];
        $file_type = $file['type'];
        
        // Validate file size (5MB)
        if ($file_size > 5 * 1024 * 1024) {
            $this->session->set_flashdata('error_message', get_phrase('File size exceeds 5MB limit'));
            error_log('Student creation failed: Photo file size exceeds limit');
            return false;
        }

        // Validate file type
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!in_array($file_type, $allowed_types)) {
            $this->session->set_flashdata('error_message', get_phrase('Invalid file type. Only JPG, JPEG, and PNG are allowed'));
            error_log('Student creation failed: Invalid photo file type');
            return false;
        }

        try {
            // Create student data array
            $page_data = array(
                'admission_number' => html_escape($this->input->post('admission_number')),
                'name' => html_escape($this->input->post('name')),
                'birthday' => html_escape($this->input->post('birthday')),
                'age' => html_escape($this->input->post('age')),
                // 'place_birth' => html_escape($this->input->post('place_birth')),
                'sex' => html_escape($this->input->post('sex')),
                // 'm_tongue' => html_escape($this->input->post('m_tongue')),
                'religion' => html_escape($this->input->post('religion')),
                'blood_group' => html_escape($this->input->post('blood_group')),
                
                // Present Address Information
                'address' => html_escape($this->input->post('address')),
                'city' => html_escape($this->input->post('city')),
                'state' => html_escape($this->input->post('state')),
                'pincode' => html_escape($this->input->post('pincode')),
                
                // Permanent Address Information
                'permanent_address' => html_escape($this->input->post('permanent_address')),
                'permanent_city' => html_escape($this->input->post('permanent_city')),
                'permanent_state' => html_escape($this->input->post('permanent_state')),
                'permanent_pincode' => html_escape($this->input->post('permanent_pincode')),
                
                // 'nationality' => html_escape($this->input->post('nationality')),
                'phone' => html_escape($this->input->post('phone')),
                'email' => html_escape($this->input->post('student_email')),
                'password' => sha1($this->input->post('password')),
                'class_id' => html_escape($this->input->post('class_id')),
                'section_id' => html_escape($this->input->post('section_id')),
                'father_id' => html_escape($this->input->post('father_id')),
                
                // Father details
                'father_name' => html_escape($this->input->post('father_name')),
                'father_phone' => html_escape($this->input->post('father_phone')),
                'father_email' => html_escape($this->input->post('father_email')),
                'father_occupation' => html_escape($this->input->post('father_occupation')),
                'father_adhar' => html_escape($this->input->post('father_adhar')),
                'father_annual_income' => html_escape($this->input->post('father_annual_income')),
                'father_designation' => html_escape($this->input->post('father_designation')),
                'father_qualification' => html_escape($this->input->post('father_qualification')),
                
                // Mother details
                'mother_name' => html_escape($this->input->post('mother_name')),
                'mother_phone' => html_escape($this->input->post('mother_phone')),
                'mother_email' => html_escape($this->input->post('mother_email')),
                'mother_occupation' => html_escape($this->input->post('mother_occupation')),
                'mother_adhar' => html_escape($this->input->post('mother_adhar')),
                'mother_annual_income' => html_escape($this->input->post('mother_annual_income')),
                'mother_designation' => html_escape($this->input->post('mother_designation')),
                'mother_qualification' => html_escape($this->input->post('mother_qualification')),
                
                'roll' => html_escape($this->input->post('roll')),
                
                // Transport Information
                'transport_mode' => html_escape($this->input->post('transport_mode')),
                'transport_id' => html_escape($this->input->post('transport_id')),
                'pick_area' => html_escape($this->input->post('pick_area')),
                'pick_stand' => html_escape($this->input->post('pick_stand')),
                'pick_route_id' => html_escape($this->input->post('pick_route_id')),
                'pick_driver_id' => html_escape($this->input->post('pick_driver_id')),
                'drop_area' => html_escape($this->input->post('drop_area')),
                'drop_stand' => html_escape($this->input->post('drop_stand')),
                'drop_route_id' => html_escape($this->input->post('drop_route_id')),
                'drop_driver_id' => html_escape($this->input->post('drop_driver_id')),
                
                'dormitory_id' => html_escape($this->input->post('dormitory_id')),
                'house_id' => html_escape($this->input->post('house_id')),
                'student_category_id' => html_escape($this->input->post('student_category_id')),
                'club_id' => html_escape($this->input->post('club_id')),
                'session' => html_escape($this->input->post('session')),
                'student_code' => html_escape($this->input->post('student_code')),
                'apaar_id' => html_escape($this->input->post('apaar_id')),
                'admission_date' => html_escape($this->input->post('admission_date')),
                'date_of_joining' => html_escape($this->input->post('date_of_joining')),
                'adhar_no' => html_escape($this->input->post('adhar_no'))
            );
            
            // Log the data for debugging
            error_log('Attempting to create new student with data: ' . json_encode($page_data));
            
            // Handle transport months array
            if ($this->input->post('transport_months')) {
                $page_data['transport_months'] = json_encode($this->input->post('transport_months'));
            } else {
                $page_data['transport_months'] = json_encode(array());
            }

            // Begin transaction
            $this->db->trans_start();

            // Insert student data
            $this->db->insert('student', $page_data);
            $student_id = $this->db->insert_id();
            
            if (!$student_id) {
                error_log('Failed to get student_id after insert. Last query: ' . $this->db->last_query());
                throw new Exception('Database insertion failed');
            }

            // Create upload directory if it doesn't exist
            $upload_path = 'uploads/student_image/';
            if (!is_dir($upload_path)) {
                if (!mkdir($upload_path, 0777, true)) {
                    error_log('Failed to create directory: ' . $upload_path);
                    throw new Exception('Failed to create upload directory');
                }
            }

            // Upload student photo
            $file_path = $upload_path . $student_id . '.jpg';
            if (!move_uploaded_file($file['tmp_name'], $file_path)) {
                error_log('Failed to move uploaded file to: ' . $file_path);
                throw new Exception('Failed to upload student photo');
            }
            
            // Upload father's photo if provided
            if (!empty($_FILES['father_image']['name'])) {
                $father_file = $_FILES['father_image'];
                $father_file_path = 'uploads/parent_image/' . $student_id . '_father.jpg';
                
                // Create directory if it doesn't exist
                if (!is_dir('uploads/parent_image/')) {
                    if (!mkdir('uploads/parent_image/', 0777, true)) {
                        error_log('Failed to create directory: uploads/parent_image/');
                        // Non-critical, so just log and continue
                    }
                }
                
                if (move_uploaded_file($father_file['tmp_name'], $father_file_path)) {
                    // Update the database with the father's photo path
                    $this->db->where('student_id', $student_id);
                    $this->db->update('student', array('father_photo' => $student_id . '_father.jpg'));
                } else {
                    error_log('Failed to move father\'s photo to: ' . $father_file_path);
                    // Non-critical, so just log and continue
                }
            }
            
            // Upload mother's photo if provided
            if (!empty($_FILES['mother_image']['name'])) {
                $mother_file = $_FILES['mother_image'];
                $mother_file_path = 'uploads/parent_image/' . $student_id . '_mother.jpg';
                
                // Create directory if it doesn't exist
                if (!is_dir('uploads/parent_image/')) {
                    if (!mkdir('uploads/parent_image/', 0777, true)) {
                        error_log('Failed to create directory: uploads/parent_image/');
                        // Non-critical, so just log and continue
                    }
                }
                
                if (move_uploaded_file($mother_file['tmp_name'], $mother_file_path)) {
                    // Update the database with the mother's photo path
                    $this->db->where('student_id', $student_id);
                    $this->db->update('student', array('mother_photo' => $student_id . '_mother.jpg'));
                } else {
                    error_log('Failed to move mother\'s photo to: ' . $mother_file_path);
                    // Non-critical, so just log and continue
                }
            }

            // Commit transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                error_log('Transaction failed in createNewStudent');
                throw new Exception('Database transaction failed');
            }

            error_log('Student created successfully with ID: ' . $student_id);
            $this->session->set_flashdata('flash_message', get_phrase('Student added successfully'));
            return true;

        } catch (Exception $e) {
            // Rollback transaction
            $this->db->trans_rollback();
            
            // Delete uploaded files if they exist
            if (isset($file_path) && file_exists($file_path)) {
                unlink($file_path);
            }
            
            if (isset($father_file_path) && file_exists($father_file_path)) {
                unlink($father_file_path);
            }
            
            if (isset($mother_file_path) && file_exists($mother_file_path)) {
                unlink($mother_file_path);
            }

            error_log('Error creating student: ' . $e->getMessage());
            error_log('Error trace: ' . $e->getTraceAsString());
            $this->session->set_flashdata('error_message', get_phrase('Error creating student: ') . $e->getMessage());
            return false;
        }
    }


    //the function below update student
    function updateNewStudent($param2){
        // Begin transaction
        $this->db->trans_start();
        
        try {
            // Verify student ID exists
            $student = $this->db->get_where('student', array('student_id' => $param2))->row_array();
            if (empty($student)) {
                error_log('ERROR: Student ID ' . $param2 . ' not found');
                return 'Student record not found';
            }
            
            // Log the update operation
            error_log('Attempting to update student ID: ' . $param2);
            
            // TEMPORARY DEBUG: Force a validation error for testing
            if ($this->input->post('name') == 'TEST') {
                return "Please fix the following errors:\n\n• This is a test validation error\n• Student name cannot be 'TEST'\n• Please enter a valid name";
            }
            
            // COMPREHENSIVE VALIDATION
            $validation_errors = array();
            
            // Validate required fields
            $required_fields = array(
                'admission_number' => 'Admission number',
                'name' => 'Student name',
                'email' => 'Email address',
                'class_id' => 'Class'
            );
            
            foreach ($required_fields as $field => $label) {
                if (empty($this->input->post($field))) {
                    $validation_errors[] = $label . ' is required';
                }
            }
            
            // Validate email format
            $email = $this->input->post('email');
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation_errors[] = 'Please enter a valid email address';
            }
            
            // Check for email uniqueness (if email changed)
            if (!empty($email) && $email != $student['email']) {
                $email_exists = $this->db->get_where('student', array('email' => $email, 'student_id !=' => $param2))->num_rows() > 0;
                if ($email_exists) {
                    $validation_errors[] = 'Email address already exists for another student';
                }
            }
            
            // Validate phone numbers (10 digits)
            $phone_fields = array(
                'phone' => 'Student phone',
                'father_phone' => 'Father\'s phone', 
                'mother_phone' => 'Mother\'s phone',
                'guardian_phone' => 'Guardian phone'
            );
            
            foreach ($phone_fields as $field => $label) {
                $phone_value = $this->input->post($field);
                if (!empty($phone_value) && !preg_match('/^[0-9]{10}$/', $phone_value)) {
                    $validation_errors[] = $label . ' must be a 10-digit number';
                }
            }
            
            // Validate email addresses
            $email_fields = array(
                'father_email' => 'Father\'s email',
                'mother_email' => 'Mother\'s email', 
                'guardian_email' => 'Guardian email'
            );
            
            foreach ($email_fields as $field => $label) {
                $email_value = $this->input->post($field);
                if (!empty($email_value) && !filter_var($email_value, FILTER_VALIDATE_EMAIL)) {
                    $validation_errors[] = 'Please enter a valid ' . strtolower($label) . ' address';
                }
            }
            
            // Validate Aadhar numbers (12 digits)
            $aadhar_fields = array(
                'adhar_no' => 'Student Aadhar Card',
                'father_adhar' => 'Father\'s Aadhar Card',
                'mother_adhar' => 'Mother\'s Aadhar Card'
            );
            
            foreach ($aadhar_fields as $field => $label) {
                $aadhar_value = $this->input->post($field);
                if (!empty($aadhar_value) && !preg_match('/^[0-9]{12}$/', $aadhar_value)) {
                    $validation_errors[] = $label . ' Number must be exactly 12 digits';
                }
            }
            
            // Validate pincode (6 digits)
            $pincode_fields = array(
                'pincode' => 'Pincode',
                'permanent_pincode' => 'Permanent address pincode'
            );
            
            foreach ($pincode_fields as $field => $label) {
                $pincode_value = $this->input->post($field);
                if (!empty($pincode_value) && !preg_match('/^[0-9]{6}$/', $pincode_value)) {
                    $validation_errors[] = $label . ' must be exactly 6 digits';
                }
            }
            
            // Validate password if provided (minimum 6 characters)
            $password = $this->input->post('password');
            if (!empty($password) && strlen($password) < 6) {
                $validation_errors[] = 'Password must be at least 6 characters long';
            }
            
            // Validate admission number format (1-6 digits)
            $admission_number = $this->input->post('admission_number');
            if (!empty($admission_number) && !preg_match('/^[0-9]{1,6}$/', $admission_number)) {
                $validation_errors[] = 'Admission number must be 1-6 digits only';
            }
            
            // Validate age (must be between 3 and 25)
            $age = $this->input->post('age');
            if (!empty($age) && (!is_numeric($age) || $age < 3 || $age > 25)) {
                $validation_errors[] = 'Age must be between 3 and 25 years';
            }
            
            // If there are validation errors, return them as a formatted message
            if (!empty($validation_errors)) {
                $error_message = "Please fix the following errors:\n\n• " . implode("\n• ", $validation_errors);
                error_log('Validation errors for student ID ' . $param2 . ': ' . implode(', ', $validation_errors));
                return $error_message;
            }
            
            // Create data array for update
            $page_data = array(
                'admission_number' => html_escape($this->input->post('admission_number')),
                'name'           => html_escape($this->input->post('name')),
                'birthday'       => html_escape($this->input->post('birthday')),
                'age'            => html_escape($this->input->post('age')),
                // 'place_birth'    => html_escape($this->input->post('place_birth')),
                'sex'            => html_escape($this->input->post('sex')),
                // 'm_tongue'       => html_escape($this->input->post('m_tongue')),
                'religion'       => html_escape($this->input->post('religion')),
                'blood_group'    => html_escape($this->input->post('blood_group')),
                
                // Present Address
                'address'        => html_escape($this->input->post('address')),
                'city'           => html_escape($this->input->post('city')),
                'state'          => html_escape($this->input->post('state')),
                'pincode'        => html_escape($this->input->post('pincode')),
                
                // Permanent Address
                'permanent_address' => html_escape($this->input->post('permanent_address')),
                'permanent_city' => html_escape($this->input->post('permanent_city')),
                'permanent_state' => html_escape($this->input->post('permanent_state')),
                'permanent_pincode' => html_escape($this->input->post('permanent_pincode')),
                
                // 'nationality'    => html_escape($this->input->post('nationality')),
                'phone'          => html_escape($this->input->post('phone')),
                'email'          => html_escape($this->input->post('email')),
                'class_id'       => html_escape($this->input->post('class_id')),
                'section_id'     => html_escape($this->input->post('section_id')),
                
                // Father details
                'father_name'    => html_escape($this->input->post('father_name')),
                'father_phone'   => html_escape($this->input->post('father_phone')),
                'father_email'   => html_escape($this->input->post('father_email')),
                'father_occupation'  => html_escape($this->input->post('father_occupation')),
                'father_adhar'   => html_escape($this->input->post('father_adhar')),
                'father_annual_income' => html_escape($this->input->post('father_annual_income')),
                'father_designation'   => html_escape($this->input->post('father_designation')),
                'father_qualification' => html_escape($this->input->post('father_qualification')),
                
                // Mother details
                'mother_name'    => html_escape($this->input->post('mother_name')),
                'mother_phone'   => html_escape($this->input->post('mother_phone')),
                'mother_email'   => html_escape($this->input->post('mother_email')),
                'mother_occupation'  => html_escape($this->input->post('mother_occupation')),
                'mother_adhar'   => html_escape($this->input->post('mother_adhar')),
                'mother_annual_income' => html_escape($this->input->post('mother_annual_income')),
                'mother_designation'   => html_escape($this->input->post('mother_designation')),
                'mother_qualification' => html_escape($this->input->post('mother_qualification')),
                
                // Guardian info
                'guardian_name'  => html_escape($this->input->post('guardian_name')),
                'guardian_phone' => html_escape($this->input->post('guardian_phone')),
                'guardian_email' => html_escape($this->input->post('guardian_email')),
                'guardian_address' => html_escape($this->input->post('guardian_address')),
                
                'roll'           => html_escape($this->input->post('roll')),
                
                // Transport Information
                'transport_mode' => html_escape($this->input->post('transport_mode')),
                'transport_id'   => html_escape($this->input->post('transport_id')),
                'pick_area'      => html_escape($this->input->post('pick_area')),
                'pick_stand'     => html_escape($this->input->post('pick_stand')),
                'pick_route_id'  => html_escape($this->input->post('pick_route_id')),
                'pick_driver_id' => html_escape($this->input->post('pick_driver_id')),
                'drop_area'      => html_escape($this->input->post('drop_area')),
                'drop_stand'     => html_escape($this->input->post('drop_stand')),
                'drop_route_id'  => html_escape($this->input->post('drop_route_id')),
                'drop_driver_id' => html_escape($this->input->post('drop_driver_id')),
                
                'dormitory_id'   => html_escape($this->input->post('dormitory_id')),
                'house_id'       => html_escape($this->input->post('house_id')),
                'student_category_id' => html_escape($this->input->post('student_category_id')),
                'admission_category' => html_escape($this->input->post('admission_category')),
                'caste'          => html_escape($this->input->post('caste')),
                'club_id'        => html_escape($this->input->post('club_id')),
                'session'        => html_escape($this->input->post('session')),
                'adhar_no'       => html_escape($this->input->post('adhar_no')),
                'student_code'   => html_escape($this->input->post('student_code')),
                'apaar_id'       => html_escape($this->input->post('apaar_id')),
                'am_date'        => html_escape($this->input->post('am_date')),
                'tran_cert'      => html_escape($this->input->post('tran_cert')),
                
                'ps_attended'    => html_escape($this->input->post('ps_attended')),
                'ps_address'     => html_escape($this->input->post('ps_address')),
                'ps_purpose'     => html_escape($this->input->post('ps_purpose')),
                'class_study'    => html_escape($this->input->post('class_study')),
                'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
                'admission_date' => html_escape($this->input->post('admission_date')),
                'date_of_joining' => html_escape($this->input->post('date_of_joining'))
            );
            
            // Log the update data for debugging
            error_log('Update data: ' . json_encode($page_data));
            
            // Handle transport months array
            if ($this->input->post('transport_months')) {
                $page_data['transport_months'] = json_encode($this->input->post('transport_months'));
            }
            
            // Handle password update
            if (!empty($this->input->post('password'))) {
                $page_data['password'] = sha1($this->input->post('password'));
            }
            
            // Update student record
            $this->db->where('student_id', $param2);
            $result = $this->db->update('student', $page_data);
            
            if (!$result) {
                $db_error = $this->db->error();
                error_log('Database error updating student: ' . $db_error['message']);
                return 'Database error: ' . $db_error['message'];
            }
            
            if ($this->db->affected_rows() == 0 && $result !== false) {
                error_log('No data was changed for student ID: ' . $param2);
                // This is not necessarily an error, the user might have submitted without changes
            }
            
            // Process file uploads
            $upload_errors = [];
            
            // Handle student photo upload
            if (!empty($_FILES['userfile']['name'])) {
                $file = $_FILES['userfile'];
                
                // Validate file size (5MB)
                if ($file['size'] > 5 * 1024 * 1024) {
                    $upload_errors[] = 'Student photo file size exceeds 5MB limit';
                    error_log('Student photo file size too large: ' . $file['size'] . ' bytes');
                } 
                // Validate file type
                else {
                    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (!in_array($file['type'], $allowed_types)) {
                        $upload_errors[] = 'Invalid student photo file type. Only JPG, JPEG, and PNG are allowed';
                        error_log('Invalid student photo file type: ' . $file['type']);
                    } 
                    else {
                        // Create upload directory if it doesn't exist
                        $upload_path = 'uploads/student_image/';
                        if (!is_dir($upload_path)) {
                            if (!mkdir($upload_path, 0777, true)) {
                                error_log('Failed to create directory: ' . $upload_path);
                                $upload_errors[] = 'Failed to create upload directory';
                            }
                        }
                        
                        // Check if directory is writable
                        if (!is_writable($upload_path)) {
                            error_log('Directory not writable: ' . $upload_path);
                            $upload_errors[] = 'Upload directory is not writable';
                        } 
                        else {
                            // Upload student photo
                            $file_path = $upload_path . $param2 . '.jpg';
                            if (!move_uploaded_file($file['tmp_name'], $file_path)) {
                                error_log('Failed to move uploaded student photo to: ' . $file_path);
                                $upload_errors[] = 'Failed to upload student photo';
                            } else {
                                error_log('Successfully uploaded student photo to: ' . $file_path);
                            }
                        }
                    }
                }
            }
            
            // Handle father's photo upload
            if (!empty($_FILES['father_image']['name'])) {
                try {
                    $father_file = $_FILES['father_image'];
                    
                    // Create directory if it doesn't exist
                    if (!is_dir('uploads/parent_image/')) {
                        if (!mkdir('uploads/parent_image/', 0777, true)) {
                            error_log('Failed to create directory: uploads/parent_image/');
                            $upload_errors[] = 'Failed to create parent image directory';
                        }
                    }
                    
                    if (is_dir('uploads/parent_image/') && is_writable('uploads/parent_image/')) {
                        $father_file_path = 'uploads/parent_image/' . $param2 . '_father.jpg';
                        if (move_uploaded_file($father_file['tmp_name'], $father_file_path)) {
                            // Update the database with the father's photo path
                            $this->db->where('student_id', $param2);
                            $this->db->update('student', array('father_photo' => $param2 . '_father.jpg'));
                            error_log('Successfully uploaded father\'s photo to: ' . $father_file_path);
                        } else {
                            error_log('Failed to move father\'s photo to: ' . $father_file_path);
                            $upload_errors[] = 'Failed to upload father\'s photo';
                        }
                    } else {
                        error_log('Parent image directory not writable: uploads/parent_image/');
                        $upload_errors[] = 'Parent image directory not writable';
                    }
                } catch (Exception $e) {
                    error_log('Error handling father image: ' . $e->getMessage());
                    $upload_errors[] = 'Error processing father\'s photo: ' . $e->getMessage();
                }
            }
            
            // Handle mother's photo upload
            if (!empty($_FILES['mother_image']['name'])) {
                try {
                    $mother_file = $_FILES['mother_image'];
                    
                    // Create directory if it doesn't exist
                    if (!is_dir('uploads/parent_image/')) {
                        if (!mkdir('uploads/parent_image/', 0777, true)) {
                            error_log('Failed to create directory: uploads/parent_image/');
                            $upload_errors[] = 'Failed to create parent image directory';
                        }
                    }
                    
                    if (is_dir('uploads/parent_image/') && is_writable('uploads/parent_image/')) {
                        $mother_file_path = 'uploads/parent_image/' . $param2 . '_mother.jpg';
                        if (move_uploaded_file($mother_file['tmp_name'], $mother_file_path)) {
                            // Update the database with the mother's photo path
                            $this->db->where('student_id', $param2);
                            $this->db->update('student', array('mother_photo' => $param2 . '_mother.jpg'));
                            error_log('Successfully uploaded mother\'s photo to: ' . $mother_file_path);
                        } else {
                            error_log('Failed to move mother\'s photo to: ' . $mother_file_path);
                            $upload_errors[] = 'Failed to upload mother\'s photo';
                        }
                    } else {
                        error_log('Parent image directory not writable: uploads/parent_image/');
                        $upload_errors[] = 'Parent image directory not writable';
                    }
                } catch (Exception $e) {
                    error_log('Error handling mother image: ' . $e->getMessage());
                    $upload_errors[] = 'Error processing mother\'s photo: ' . $e->getMessage();
                }
            }
            
            // Process document uploads
            // Handle document uploads
            if (!is_dir('uploads/student_documents/')) {
                if (!mkdir('uploads/student_documents/', 0777, true)) {
                    error_log('Failed to create directory: uploads/student_documents/');
                    $upload_errors[] = 'Failed to create student documents directory';
                }
            }
            
            $document_fields = [
                'signature' => 'signature',
                'transfer_certificate' => 'transfer_certificate_doc',
                'transfer_certificate_doc' => 'transfer_certificate_doc',
                'father_adharcard' => 'father_adharcard_doc',
                'father_adharcard_doc' => 'father_adharcard_doc',
                'mother_adharcard' => 'mother_adharcard_doc',
                'mother_adharcard_doc' => 'mother_adharcard_doc',
                'income_certificate' => 'income_certificate_doc',
                'income_certificate_doc' => 'income_certificate_doc',
                'dob_proof' => 'dob_proof_doc',
                'dob_proof_doc' => 'dob_proof_doc',
                'migration_certificate' => 'migration_certificate_doc',
                'migration_certificate_doc' => 'migration_certificate_doc',
                'caste_certificate' => 'caste_certificate_doc',
                'caste_certificate_doc' => 'caste_certificate_doc',
                'aadhar_card' => 'aadhar_card_doc',
                'aadhar_card_doc' => 'aadhar_card_doc',
                'address_proof' => 'address_proof_doc',
                'address_proof_doc' => 'address_proof_doc'
            ];
            
            if (is_dir('uploads/student_documents/') && is_writable('uploads/student_documents/')) {
                // Process each document
                foreach ($document_fields as $field_name => $db_field) {
                    if (!empty($_FILES[$field_name]['name'])) {
                        try {
                            $file = $_FILES[$field_name];
                            // Validate file type
                            $allowed_types = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
                            if (!in_array($file['type'], $allowed_types)) {
                                $upload_errors[] = 'Invalid file type for ' . $field_name . '. Only PDF, JPG, JPEG, and PNG are allowed';
                                error_log('Invalid file type for ' . $field_name . ': ' . $file['type']);
                                continue;
                            }
                            // Validate file size (5MB max)
                            if ($file['size'] > 5242880) {
                                $upload_errors[] = 'File size too large for ' . $field_name . '. Maximum size is 5MB';
                                error_log('File size too large for ' . $field_name . ': ' . $file['size'] . ' bytes');
                                continue;
                            }
                            $file_path = 'uploads/student_documents/' . $param2 . '_' . $field_name . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
                            if (move_uploaded_file($file['tmp_name'], $file_path)) {
                                // Only update DB for *_doc or signature fields
                                if (substr($db_field, -4) === '_doc' || $db_field === 'signature') {
                                    $this->db->where('student_id', $param2);
                                    $this->db->update('student', array($db_field => $param2 . '_' . $field_name . '.' . pathinfo($file['name'], PATHINFO_EXTENSION)));
                                    error_log('Successfully uploaded ' . $field_name . ' to: ' . $file_path);
                                }
                            } else {
                                error_log('Failed to move ' . $field_name . ' to: ' . $file_path);
                                $upload_errors[] = 'Failed to upload ' . $field_name;
                            }
                        } catch (Exception $e) {
                            // Only show error if the db_field is valid (ends with _doc or is signature)
                            if (substr($db_field, -4) === '_doc' || $db_field === 'signature') {
                                error_log('Error handling ' . $field_name . ': ' . $e->getMessage());
                                $upload_errors[] = 'Error processing ' . $field_name . ': ' . $e->getMessage();
                            }
                            // Otherwise, ignore error for legacy/old field names
                        }
                    }
                }
            } else {
                error_log('Student documents directory not writable: uploads/student_documents/');
                $upload_errors[] = 'Student documents directory not writable';
            }
            
            // Commit transaction
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                error_log('Transaction failed in updateNewStudent');
                return 'Database transaction failed';
            }
            
            // Suppress all file upload warnings from being shown in the UI
            
            $this->session->set_flashdata('flash_message', get_phrase('Student information updated successfully'));
            error_log('Student ID ' . $param2 . ' updated successfully');
            return true;
            
        } catch (Exception $e) {
            // Rollback transaction
            $this->db->trans_rollback();
            
            error_log('Error updating student: ' . $e->getMessage());
            error_log('Error trace: ' . $e->getTraceAsString());
            return 'Error updating student: ' . $e->getMessage();
        }
    }

    // the function below deletes from student table
    function deleteNewStudent($param2){
        $this->db->where('student_id', $param2);
        $this->db->delete('student');
    }

	


	
	
}


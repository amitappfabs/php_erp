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
        
        // VALIDATION WITH PROPER ERROR MESSAGES
        $errors = array();
        
        // Validate Aadhar numbers (should be 12 digits)
        $student_aadhar = $this->input->post('adhar_no');
        if (!empty($student_aadhar) && !preg_match('/^\d{12}$/', $student_aadhar)) {
            $errors[] = "Student Aadhar number must be exactly 12 digits";
        }
        
        $father_aadhar = $this->input->post('father_adhar');
        if (!empty($father_aadhar) && !preg_match('/^\d{12}$/', $father_aadhar)) {
            $errors[] = "Father's Aadhar number must be exactly 12 digits";
        }
        
        $mother_aadhar = $this->input->post('mother_adhar');
        if (!empty($mother_aadhar) && !preg_match('/^\d{12}$/', $mother_aadhar)) {
            $errors[] = "Mother's Aadhar number must be exactly 12 digits";
        }
        
        // Validate pincode (should be 6 digits)
        $pincode = $this->input->post('pincode');
        if (!empty($pincode) && !preg_match('/^\d{6}$/', $pincode)) {
            $errors[] = "Present address pincode must be exactly 6 digits";
        }
        
        $permanent_pincode = $this->input->post('permanent_pincode');
        if (!empty($permanent_pincode) && !preg_match('/^\d{6}$/', $permanent_pincode)) {
            $errors[] = "Permanent address pincode must be exactly 6 digits";
        }
        
        // Validate phone numbers (should be 10 digits)
        $phone = $this->input->post('phone');
        if (!empty($phone) && !preg_match('/^\d{10}$/', $phone)) {
            $errors[] = "Student phone number must be exactly 10 digits";
        }
        
        $father_phone = $this->input->post('father_phone');
        if (!empty($father_phone) && !preg_match('/^\d{10}$/', $father_phone)) {
            $errors[] = "Father's phone number must be exactly 10 digits";
        }
        
        $mother_phone = $this->input->post('mother_phone');
        if (!empty($mother_phone) && !preg_match('/^\d{10}$/', $mother_phone)) {
            $errors[] = "Mother's phone number must be exactly 10 digits";
        }
        
        // Validate email formats
        $email = $this->input->post('email');
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Student email address is not valid";
        }
        
        $father_email = $this->input->post('father_email');
        if (!empty($father_email) && !filter_var($father_email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Father's email address is not valid";
        }
        
        $mother_email = $this->input->post('mother_email');
        if (!empty($mother_email) && !filter_var($mother_email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Mother's email address is not valid";
        }
        
        // If there are validation errors, return them as an array
        if (!empty($errors)) {
            return $errors;
        }
        
        // Create data array for update
        $page_data = array(
            'admission_number' => html_escape($this->input->post('admission_number')),
            'name'           => html_escape($this->input->post('name')),
            'birthday'       => html_escape($this->input->post('birthday')),
            'age'            => html_escape($this->input->post('age')),
            'sex'            => html_escape($this->input->post('sex')),
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
        $this->db->update('student', $page_data);
        
        // Handle student photo upload if provided
        if (!empty($_FILES['userfile']['name'])) {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param2 . '.jpg');
        }
        
        // Handle father's photo upload if provided
        if (!empty($_FILES['father_image']['name'])) {
            move_uploaded_file($_FILES['father_image']['tmp_name'], 'uploads/parent_image/' . $param2 . '_father.jpg');
            $this->db->where('student_id', $param2);
            $this->db->update('student', array('father_photo' => $param2 . '_father.jpg'));
        }
        
        // Handle mother's photo upload if provided
        if (!empty($_FILES['mother_image']['name'])) {
            move_uploaded_file($_FILES['mother_image']['tmp_name'], 'uploads/parent_image/' . $param2 . '_mother.jpg');
            $this->db->where('student_id', $param2);
            $this->db->update('student', array('mother_photo' => $param2 . '_mother.jpg'));
        }
        
        // Handle document uploads
        $document_fields = [
            'signature' => 'signature',
            'transfer_certificate_doc' => 'transfer_certificate_doc',
            'father_adharcard_doc' => 'father_adharcard_doc',
            'mother_adharcard_doc' => 'mother_adharcard_doc',
            'income_certificate_doc' => 'income_certificate_doc',
            'dob_proof_doc' => 'dob_proof_doc',
            'migration_certificate_doc' => 'migration_certificate_doc',
            'caste_certificate_doc' => 'caste_certificate_doc',
            'aadhar_card_doc' => 'aadhar_card_doc',
            'address_proof_doc' => 'address_proof_doc'
        ];
        
        foreach ($document_fields as $field_name => $db_field) {
            if (!empty($_FILES[$field_name]['name'])) {
                $file_extension = pathinfo($_FILES[$field_name]['name'], PATHINFO_EXTENSION);
                $file_path = 'uploads/student_documents/' . $param2 . '_' . $field_name . '.' . $file_extension;
                move_uploaded_file($_FILES[$field_name]['tmp_name'], $file_path);
                $this->db->where('student_id', $param2);
                $this->db->update('student', array($db_field => $param2 . '_' . $field_name . '.' . $file_extension));
            }
        }
        
        // Return success
        return 'success';
    }

    // the function below deletes from student table
    function deleteNewStudent($param2){
        $this->db->where('student_id', $param2);
        $this->db->delete('student');
    }

	


	
	
}


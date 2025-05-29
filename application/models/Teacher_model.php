<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Teacher_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


/**************************** The function below insert into bank and teacher tables   **************************** */
    function insertTeacherFunction (){

        try {
            // First, check if the new columns exist in the teacher table
            $teacher_columns = $this->db->list_fields('teacher');
            $bank_columns = $this->db->list_fields('bank');
            
            $bank_data['account_holder_name'] = $this->input->post('account_holder_name');
            $bank_data['account_number'] = $this->input->post('account_number');
            $bank_data['bank_name'] = $this->input->post('bank_name');
            $bank_data['branch'] = $this->input->post('branch');
            
            // Only add ifsc_code if the column exists
            if (in_array('ifsc_code', $bank_columns)) {
                $bank_data['ifsc_code'] = $this->input->post('ifsc_code');
            }

            $this->db->insert('bank', $bank_data);
            $bank_id = $this->db->insert_id();

            if(!$bank_id) {
                $this->session->set_flashdata('error_message', 'Failed to create bank record');
                redirect(base_url() . 'admin/teacher/', 'refresh');
                return;
            }

            $teacher_array = array(
                'name'                  => $this->input->post('name'),
                'role'                  => $this->input->post('role'),
                'teacher_number'        => $this->input->post('teacher_number'),
                'birthday'              => $this->input->post('birthday'),
                'sex'                   => $this->input->post('sex'),
                'religion'              => $this->input->post('religion'),
                'blood_group'           => $this->input->post('blood_group'),
                'address'               => $this->input->post('address'),
                'phone'                 => $this->input->post('phone'),
                'facebook'              => $this->input->post('facebook'),
                'twitter'               => $this->input->post('twitter'),
                'linkedin'              => $this->input->post('linkedin'),
                'qualification'         => $this->input->post('qualification'),
                'marital_status'        => $this->input->post('marital_status'),
                'password'              => sha1($this->input->post('password')),
                'date_of_joining'       => $this->input->post('date_of_joining'),
                'joining_salary'        => $this->input->post('joining_salary'),
                'status'                => 1,
                'date_of_leaving'       => ''
            );
            
            // Only add these fields if the columns exist in the database
            if (in_array('aadhar_number', $teacher_columns)) {
                $teacher_array['aadhar_number'] = $this->input->post('aadhar_number');
            }
            if (in_array('pan_number', $teacher_columns)) {
                $teacher_array['pan_number'] = $this->input->post('pan_number');
            }
            if (in_array('family_id', $teacher_columns)) {
                $teacher_array['family_id'] = $this->input->post('family_id');
            }
        
            // Handle file upload safely
            if(isset($_FILES["file_name"]["name"]) && !empty($_FILES["file_name"]["name"])) {
                $teacher_array['file_name'] = $_FILES["file_name"]["name"];
            } else {
                $teacher_array['file_name'] = '';
            }
            
            $teacher_array['email'] = $this->input->post('email');
            $teacher_array['bank_id'] = $bank_id;
            
            $check_email = $this->db->get_where('teacher', array('email' => $teacher_array['email']))->row();
            if($check_email != null) 
            {
                $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
                redirect(base_url() . 'admin/teacher/', 'refresh');
                return;
            }
            
            $this->db->insert('teacher', $teacher_array);
            $teacher_id = $this->db->insert_id();
            
            if(!$teacher_id) {
                $this->session->set_flashdata('error_message', 'Failed to create teacher record');
                redirect(base_url() . 'admin/teacher/', 'refresh');
                return;
            }
            
            // Create uploads directory if it doesn't exist
            if (!is_dir('uploads/teacher_image/')) {
                mkdir('uploads/teacher_image/', 0755, true);
            }
            
            // Handle file uploads safely
            if(isset($_FILES["file_name"]["tmp_name"]) && !empty($_FILES["file_name"]["tmp_name"])) {
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/teacher_image/" . $_FILES["file_name"]["name"]);
            }
            
            if(isset($_FILES['userfile']['tmp_name']) && !empty($_FILES['userfile']['tmp_name'])) {
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
            }
            
        } catch (Exception $e) {
            $this->session->set_flashdata('error_message', 'Error: ' . $e->getMessage());
            redirect(base_url() . 'admin/teacher/', 'refresh');
        }
    }


    function updateTeacherFunction($param2){

        // First, check if the new columns exist in the teacher table
        $teacher_columns = $this->db->list_fields('teacher');
        $bank_columns = $this->db->list_fields('bank');

        $teacher_data = array(
            'name'                  => $this->input->post('name'),
            'role'                  => $this->input->post('role'),
			'birthday'              => $this->input->post('birthday'),
        	'sex'                   => $this->input->post('sex'),
            'religion'              => $this->input->post('religion'),
            'blood_group'           => $this->input->post('blood_group'),
            'address'               => $this->input->post('address'),
            'phone'                 => $this->input->post('phone'),
            'email'                 => $this->input->post('email'),
			'facebook'              => $this->input->post('facebook'),
        	'twitter'               => $this->input->post('twitter'),
            'linkedin'              => $this->input->post('linkedin'),
            'qualification'         => $this->input->post('qualification'),
			'marital_status'        => $this->input->post('marital_status'),
            'date_of_joining'       => $this->input->post('date_of_joining'),
            'joining_salary'        => $this->input->post('joining_salary')
            );

        // Only add these fields if the columns exist in the database
        if (in_array('aadhar_number', $teacher_columns)) {
            $teacher_data['aadhar_number'] = $this->input->post('aadhar_number');
        }
        if (in_array('pan_number', $teacher_columns)) {
            $teacher_data['pan_number'] = $this->input->post('pan_number');
        }
        if (in_array('family_id', $teacher_columns)) {
            $teacher_data['family_id'] = $this->input->post('family_id');
        }

            if($this->input->post('password') && !empty($this->input->post('password'))) {
                $teacher_data['password'] = sha1($this->input->post('password'));
            }

            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $teacher_data);
            
            $teacher_info = $this->db->get_where('teacher', array('teacher_id' => $param2))->row();
            if($teacher_info && $teacher_info->bank_id) {
                $bank_data = array(
                    'account_holder_name' => $this->input->post('account_holder_name'),
                    'account_number' => $this->input->post('account_number'),
                    'bank_name' => $this->input->post('bank_name'),
                    'branch' => $this->input->post('branch')
                );
                
                // Only add ifsc_code if the column exists
                if (in_array('ifsc_code', $bank_columns)) {
                    $bank_data['ifsc_code'] = $this->input->post('ifsc_code');
                }
                
                $this->db->where('bank_id', $teacher_info->bank_id);
                $this->db->update('bank', $bank_data);
            }
            
            // Handle file uploads safely
            if(isset($_FILES['userfile']['tmp_name']) && !empty($_FILES['userfile']['tmp_name'])) {
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            }
            
            if(isset($_FILES['file_name']['tmp_name']) && !empty($_FILES['file_name']['tmp_name'])) {
                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/teacher_image/" . $_FILES["file_name"]["name"]);
                
                // Update the file name in database if new file is uploaded
                $this->db->where('teacher_id', $param2);
                $this->db->update('teacher', array('file_name' => $_FILES["file_name"]["name"]));
            }
    }


    function deleteTeacherFunction($param2){

        $teacher_info = $this->db->get_where('teacher', array('teacher_id' => $param2))->row();
        
        $this->db->where('teacher_id', $param2);
        $this->db->delete('teacher');
        
        if($teacher_info && $teacher_info->bank_id) {
            $this->db->where('bank_id', $teacher_info->bank_id);
            $this->db->delete('bank');
        }
    }
	


	
	
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Teacher extends CI_Controller { 
    /**
     * @property CI_Loader $load
     * @property CI_Session $session
     * @property CI_Input $input
     * @property CI_DB $db
     * @property CI_Config $config
     */

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->library('role_based_access');
               // $this->load->model('vacancy_model');

        // Check if user is logged in and has teacher role
        $this->role_based_access->check_access('teacher');
    }

     /*teacher dashboard code to redirect to teacher page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('teacher_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('Teacher Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / teacher dashboard code to redirect to teacher page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('teacher_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
    
            $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $this->session->userdata('teacher_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'teacher/manage_profile', 'refresh');
           
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
               $this->db->update('teacher', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'teacher/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('teacher_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }



        function manage_attendance($date = '') {
            if ($this->session->userdata('teacher_login') != 1)
                redirect(base_url(), 'refresh');
            
            $page_data['date'] = $date ? $date : date('d/m/Y');
            $page_data['page_name'] = 'manage_attendance';
            $page_data['page_title'] = get_phrase('manage_attendance');
            $this->load->view('backend/index', $page_data);
        }

        function attendance_selector() {
            if ($this->session->userdata('teacher_login') != 1)
                redirect(base_url(), 'refresh');
            
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
            $data['timestamp'] = strtotime($this->input->post('timestamp'));
            
            $query = $this->db->get_where('attendance', array(
                'class_id' => $data['class_id'],
                'section_id' => $data['section_id'],
                'timestamp' => $data['timestamp']
            ));
            
            if ($query->num_rows() < 1) {
                $students = $this->db->get_where('enroll', array(
                    'class_id' => $data['class_id'],
                    'section_id' => $data['section_id'],
                    'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
                ))->result_array();
                
                foreach ($students as $row) {
                    $attn_data['class_id'] = $data['class_id'];
                    $attn_data['section_id'] = $data['section_id'];
                    $attn_data['student_id'] = $row['student_id'];
                    $attn_data['timestamp'] = $data['timestamp'];
                    $attn_data['status'] = 1;
                    
                    $this->db->insert('attendance', $attn_data);
                }
            }
            
            redirect(base_url() . 'teacher/manage_attendance/' . $data['timestamp'], 'refresh');
        }

        function attendance_update($class_id = '', $section_id = '', $timestamp = '') {
            if ($this->session->userdata('teacher_login') != 1)
                redirect(base_url(), 'refresh');
            
            $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $active_sms_service = $this->db->get_where('settings', array('type' => 'active_sms_service'))->row()->description;
            
            $students = $this->db->get_where('enroll', array(
                'class_id' => $class_id,
                'section_id' => $section_id,
                'year' => $running_year
            ))->result_array();
            
            foreach ($students as $row) {
                $attendance_status = $this->input->post('status_' . $row['student_id']);
                $this->db->where('student_id', $row['student_id']);
                $this->db->where('timestamp', $timestamp);
                $this->db->update('attendance', array('status' => $attendance_status));
                
                if ($attendance_status == 2) {
                    if ($active_sms_service != '' || $active_sms_service != 'disabled') {
                        $student_name = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
                        $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;
                        $message = 'Your child ' . $student_name . ' is absent today.';
                        $receiver_phone = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->phone;
                        $this->sms_model->send_sms($message, $receiver_phone);
                    }
                }
            }
            
            $this->session->set_flashdata('flash_message', get_phrase('attendance_updated'));
            redirect(base_url() . 'teacher/manage_attendance/' . date('d/m/Y', $timestamp), 'refresh');
        }

        function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL) {
            
            $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
            
            
            if ($_POST) {
            redirect(base_url() . 'teacher/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
            }
            
            $classes = $this->db->get('class')->result_array();
            foreach ($classes as $key => $class) {
                if (isset($class_id) && $class_id == $class['class_id'])
                    $class_name = $class['name'];
                }
                        
            $sections = $this->db->get('section')->result_array();
                foreach ($sections as $key => $section) {
                    if (isset($section_id) && $section_id == $section['section_id'])
                        $section_name = $section['name'];
            }
            
            $page_data['month'] = $month;
            $page_data['year'] = $year;
            $page_data['class_id'] = $class_id;
            $page_data['section_id'] = $section_id;
            $page_data['page_name'] = 'attendance_report';
            $page_data['page_title'] = "Attendance Report:" . $class_name . " : Section " . $section_name;
            $this->load->view('backend/index', $page_data);
        }
    
    
        /******************** Load attendance with ajax code starts from here **********************/
        function loadAttendanceReport($class_id, $section_id, $month, $year)
        {
            $page_data['class_id'] 		= $class_id;					// get all class_id
            $page_data['section_id'] 	= $section_id;					// get all section_id
            $page_data['month'] 		= $month;						// get all month
            $page_data['year'] 			= $year;						// get all class year
            
            $this->load->view('backend/teacher/loadAttendanceReport' , $page_data);
        }
        /******************** Load attendance with ajax code ends from here **********************/
        
    
        /******************** print attendance report **********************/
        function printAttendanceReport($class_id=NULL, $section_id=NULL, $month=NULL, $year=NULL)
        {
            $page_data['class_id'] 		= $class_id;					// get all class_id
            $page_data['section_id'] 	= $section_id;					// get all section_id
            $page_data['month'] 		= $month;						// get all month
            $page_data['year'] 			= $year;						// get all class year
            
            $page_data['page_name'] = 'printAttendanceReport';
            $page_data['page_title'] = "Attendance Report";
            $this->load->view('backend/index', $page_data);
        }
        /******************** /Ends here **********************/
     /***********  The function below manages school marks ***********************/
     function marks ($exam_id = null, $class_id = null, $student_id = null){

        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id']       =  $this->input->post('exam_id'); 
            $page_data['class_id']      =  $this->input->post('class_id');
            $page_data['student_id']    =  $this->input->post('student_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['student_id'] > 0){

                redirect(base_url(). 'teacher/marks/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
                redirect(base_url(). 'teacher/marks', 'refresh');
            }
        }

        if($this->input->post('operation') == 'update_student_subject_score'){

            $select_subject_first = $this->db->get_where('subject', array('class_id' => $class_id ))->result_array();
                foreach ($select_subject_first as $key => $dispay_subject_from_subject_table){

                    $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_subject_from_subject_table['subject_id']);
                    $page_data['comment']       =   $this->input->post('comment_' . $dispay_subject_from_subject_table['subject_id']);

                    $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_subject_from_subject_table['subject_id']));
                    $this->db->update('mark', $page_data);  
                }

                $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
                redirect(base_url(). 'teacher/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');
        }

        $page_data['exam_id']       =   $exam_id;
        $page_data['class_id']      =   $class_id;
        $page_data['student_id']    =   $student_id;
        $page_data['subject_id']   =    $subject_id;
        $page_data['page_name']     =   'marks';
        $page_data['page_title']    = get_phrase('Student Marks');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/



    /***********  The function below manages school marks ***********************/
    function student_marksheet_subject ($exam_id = null, $class_id = null, $subject_id = null){

    if($this->input->post('operation') == 'selection'){

        $page_data['exam_id']       =  $this->input->post('exam_id'); 
        $page_data['class_id']      =  $this->input->post('class_id');
        $page_data['subject_id']    =  $this->input->post('subject_id');

        if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0){

            redirect(base_url(). 'teacher/student_marksheet_subject/'. $page_data['exam_id'] .'/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
        }
        else{
            $this->session->set_flashdata('error_message', get_phrase('Pleasen select something'));
            redirect(base_url(). 'teacher/student_marksheet_subject', 'refresh');
        }
    }

    if($this->input->post('operation') == 'update_student_subject_score'){

        $select_student_first = $this->db->get_where('student', array('class_id' => $class_id ))->result_array();
            foreach ($select_student_first as $key => $dispay_student_from_student_table){

                $page_data['class_score1']  =   $this->input->post('class_score1_' . $dispay_student_from_student_table['student_id']);
                $page_data['class_score2']  =   $this->input->post('class_score2_' . $dispay_student_from_student_table['student_id']);
                $page_data['class_score3']  =   $this->input->post('class_score3_' . $dispay_student_from_student_table['student_id']);
                $page_data['exam_score']    =   $this->input->post('exam_score_' . $dispay_student_from_student_table['student_id']);
                $page_data['comment']       =   $this->input->post('comment_' . $dispay_student_from_student_table['student_id']);

                $this->db->where('mark_id', $this->input->post('mark_id_' . $dispay_student_from_student_table['student_id']));
                $this->db->update('mark', $page_data);  
            }

            $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
            redirect(base_url(). 'teacher/student_marksheet_subject/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
    }

    $page_data['exam_id']       =   $exam_id;
    $page_data['class_id']      =   $class_id;
    $page_data['student_id']    =   $student_id;
    $page_data['subject_id']   =    $subject_id;
    $page_data['page_name']     =   'student_marksheet_subject';
    $page_data['page_title']    = get_phrase('Student Marks');
    $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school marks ends here ***********************/    

    /* Teacher Diary functionality */
    function my_diaries($param1 = '', $param2 = '') {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        
        try {
            $this->load->model('teacher_diary_model');
            
            // Create the table if it doesn't exist
            $this->teacher_diary_model->create_table_if_not_exists();
            
            // Create diary entry
            if ($param1 == 'create') {
                try {
                    // First make sure the table structure is updated
                    $this->teacher_diary_model->create_table_if_not_exists();
                    
                    $data = array(
                        'teacher_id' => $this->session->userdata('teacher_id'),
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'date' => $this->input->post('date'),
                        'time' => $this->input->post('time')
                    );
                    
                    // Only add class_id if it's not empty
                    if ($this->input->post('class_id') && $this->input->post('class_id') != '') {
                        $data['class_id'] = $this->input->post('class_id');
                    }
                    
                    // Only add section_id if it's not empty
                    if ($this->input->post('section_id') && $this->input->post('section_id') != '') {
                        $data['section_id'] = $this->input->post('section_id');
                    }
                    
                    // Handle attachment upload if exists
                    if ($_FILES['attachment']['name'] != '') {
                        $upload_path = FCPATH . 'uploads/teacher_diary/';
                        
                        // Create directory if it doesn't exist - with full path
                        if (!is_dir($upload_path)) {
                            // Try to create directory recursively
                            if (!mkdir($upload_path, 0777, true)) {
                                throw new Exception('Failed to create upload directory: ' . $upload_path);
                            }
                            // Set proper permissions
                            chmod($upload_path, 0777);
                        }
                        
                        // Double check that directory is writable
                        if (!is_writable($upload_path)) {
                            chmod($upload_path, 0777);
                            if (!is_writable($upload_path)) {
                                throw new Exception('Upload directory is not writable: ' . $upload_path);
                            }
                        }
                        
                        $config['upload_path'] = $upload_path;
                        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|txt';
                        $config['max_size'] = '2048'; // 2MB max
                        $config['encrypt_name'] = TRUE;
                        
                        $this->load->library('upload', $config);
                        
                        if (!$this->upload->do_upload('attachment')) {
                            $upload_error = $this->upload->display_errors('', '');
                            throw new Exception('Upload failed: ' . $upload_error);
                        } else {
                            $upload_data = $this->upload->data();
                            $data['attachment'] = $upload_data['file_name'];
                        }
                    }
                    
                    $diary_id = $this->teacher_diary_model->create_diary($data);
                    
                    if (!$diary_id) {
                        throw new Exception('Failed to create diary entry in database.');
                    }
                    
                    $this->session->set_flashdata('flash_message', get_phrase('Diary entry added successfully'));
                    redirect(base_url() . 'teacher/my_diaries', 'refresh');
                } catch (Exception $e) {
                    $this->session->set_flashdata('error_message', get_phrase('Error creating diary: ') . $e->getMessage());
                    redirect(base_url() . 'teacher/my_diaries', 'refresh');
                }
            }
            
            // Update diary entry
            if ($param1 == 'update') {
                // Check if the diary belongs to this teacher
                if (!$this->teacher_diary_model->is_diary_owner($param2, $this->session->userdata('teacher_id'))) {
                    $this->session->set_flashdata('error_message', get_phrase('You do not have permission to edit this diary'));
                    redirect(base_url() . 'teacher/my_diaries', 'refresh');
                }
                
                $data = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'date' => $this->input->post('date'),
                    'time' => $this->input->post('time'),
                    'class_id' => $this->input->post('class_id'),
                    'section_id' => $this->input->post('section_id')
                );
                
                // Handle attachment upload if exists
                if ($_FILES['attachment']['name'] != '') {
                    $config['upload_path'] = './uploads/teacher_diary/';
                    $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|txt';
                    $config['max_size'] = '2048'; // 2MB max
                    $config['encrypt_name'] = TRUE;
                    
                    $this->load->library('upload', $config);
                    
                    if ($this->upload->do_upload('attachment')) {
                        // Delete old file if exists
                        $old_diary = $this->teacher_diary_model->get_diary($param2);
                        if ($old_diary['attachment'] && file_exists('./uploads/teacher_diary/' . $old_diary['attachment'])) {
                            unlink('./uploads/teacher_diary/' . $old_diary['attachment']);
                        }
                        
                        $upload_data = $this->upload->data();
                        $data['attachment'] = $upload_data['file_name'];
                    } else {
                        $this->session->set_flashdata('error_message', $this->upload->display_errors());
                        redirect(base_url() . 'teacher/my_diaries', 'refresh');
                    }
                }
                
                $this->teacher_diary_model->update_diary($param2, $data);
                $this->session->set_flashdata('flash_message', get_phrase('Diary entry updated successfully'));
                redirect(base_url() . 'teacher/my_diaries', 'refresh');
            }
            
            // Delete diary entry
            if ($param1 == 'delete') {
                // Check if the diary belongs to this teacher
                if (!$this->teacher_diary_model->is_diary_owner($param2, $this->session->userdata('teacher_id'))) {
                    $this->session->set_flashdata('error_message', get_phrase('You do not have permission to delete this diary'));
                    redirect(base_url() . 'teacher/my_diaries', 'refresh');
                }
                
                // Delete attachment if exists
                $diary = $this->teacher_diary_model->get_diary($param2);
                if ($diary['attachment'] && file_exists('./uploads/teacher_diary/' . $diary['attachment'])) {
                    unlink('./uploads/teacher_diary/' . $diary['attachment']);
                }
                
                $this->teacher_diary_model->delete_diary($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Diary entry deleted successfully'));
                redirect(base_url() . 'teacher/my_diaries', 'refresh');
            }
            
            // Get all classes for dropdown
            $page_data['classes'] = $this->teacher_diary_model->get_all_classes();
            $page_data['diaries'] = $this->teacher_diary_model->get_diaries_by_teacher($this->session->userdata('teacher_id'));
            $page_data['page_name'] = 'my_diaries';
            $page_data['page_title'] = get_phrase('My Diaries');
            $this->load->view('backend/index', $page_data);
        } catch (Exception $e) {
            $this->session->set_flashdata('error_message', get_phrase('Error: ') . $e->getMessage());
            redirect(base_url() . 'teacher/dashboard', 'refresh');
        }
    }
    
    // AJAX function to get sections based on class_id
    function get_sections_by_class() {
        $class_id = $this->input->post('class_id');
        $this->load->model('teacher_diary_model');
        $sections = $this->teacher_diary_model->get_sections_by_class($class_id);
        
        echo '<option value="">' . get_phrase('select_section') . '</option>';
        foreach ($sections as $section) {
            echo '<option value="' . $section['section_id'] . '">' . $section['name'] . '</option>';
        }
    }
    
    function view_diary($diary_id) {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        
        try {
            $this->load->model('teacher_diary_model');
            
            // Check if diary exists
            $diary = $this->teacher_diary_model->get_diary($diary_id);
            if (empty($diary)) {
                $this->session->set_flashdata('error_message', get_phrase('Diary entry not found'));
                redirect(base_url() . 'teacher/my_diaries', 'refresh');
            }
            
            // Check if the diary belongs to this teacher
            if (!$this->teacher_diary_model->is_diary_owner($diary_id, $this->session->userdata('teacher_id'))) {
                $this->session->set_flashdata('error_message', get_phrase('You do not have permission to view this diary'));
                redirect(base_url() . 'teacher/my_diaries', 'refresh');
            }
            
            $page_data['diary'] = $diary;
            $page_data['page_name'] = 'view_diary';
            $page_data['page_title'] = get_phrase('View Diary');
            $this->load->view('backend/index', $page_data);
        } catch (Exception $e) {
            $this->session->set_flashdata('error_message', get_phrase('Error: ') . $e->getMessage());
            redirect(base_url() . 'teacher/my_diaries', 'refresh');
        }
    }
    
    function edit_diary($diary_id) {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        
        try {
            $this->load->model('teacher_diary_model');
            
            // Check if diary exists
            $diary = $this->teacher_diary_model->get_diary($diary_id);
            if (empty($diary)) {
                $this->session->set_flashdata('error_message', get_phrase('Diary entry not found'));
                redirect(base_url() . 'teacher/my_diaries', 'refresh');
            }
            
            // Check if the diary belongs to this teacher
            if (!$this->teacher_diary_model->is_diary_owner($diary_id, $this->session->userdata('teacher_id'))) {
                $this->session->set_flashdata('error_message', get_phrase('You do not have permission to edit this diary'));
                redirect(base_url() . 'teacher/my_diaries', 'refresh');
            }
            
            $page_data['diary'] = $diary;
            $page_data['page_name'] = 'edit_diary';
            $page_data['page_title'] = get_phrase('Edit Diary');
            $this->load->view('backend/index', $page_data);
        } catch (Exception $e) {
            $this->session->set_flashdata('error_message', get_phrase('Error: ') . $e->getMessage());
            redirect(base_url() . 'teacher/my_diaries', 'refresh');
        }
    }
    
    function download_diary_attachment($diary_id) {
        if ($this->session->userdata('teacher_login') != 1 && $this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        
        try {
            $this->load->model('teacher_diary_model');
            
            // Check if diary exists
            $diary = $this->teacher_diary_model->get_diary($diary_id);
            if (empty($diary)) {
                $this->session->set_flashdata('error_message', get_phrase('Diary entry not found'));
                redirect($this->session->userdata('teacher_login') == 1 ? base_url() . 'teacher/my_diaries' : base_url() . 'admin/teacher_diaries', 'refresh');
            }
            
            // Check if teacher is the owner or admin is viewing
            if ($this->session->userdata('teacher_login') == 1 && 
                !$this->teacher_diary_model->is_diary_owner($diary_id, $this->session->userdata('teacher_id'))) {
                $this->session->set_flashdata('error_message', get_phrase('You do not have permission to download this attachment'));
                redirect(base_url() . 'teacher/my_diaries', 'refresh');
            }
            
            if (!empty($diary) && !empty($diary['attachment'])) {
                $this->load->helper('download');
                $file_path = './uploads/teacher_diary/' . $diary['attachment'];
                
                if (file_exists($file_path)) {
                    force_download($file_path, NULL);
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('File not found'));
                    redirect($this->session->userdata('teacher_login') == 1 ? base_url() . 'teacher/my_diaries' : base_url() . 'admin/teacher_diaries', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_message', get_phrase('No attachment found'));
                redirect($this->session->userdata('teacher_login') == 1 ? base_url() . 'teacher/my_diaries' : base_url() . 'admin/teacher_diaries', 'refresh');
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('error_message', get_phrase('Error: ') . $e->getMessage());
            redirect($this->session->userdata('teacher_login') == 1 ? base_url() . 'teacher/my_diaries' : base_url() . 'admin/teacher_diaries', 'refresh');
        }
    }

    // Class Timetable function
    function timetable() {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        
        $page_data['page_name'] = 'timetable';
        $page_data['page_title'] = get_phrase('teacher_timetable');
        $this->load->view('backend/index', $page_data);
    }

    // Class Timetable function
    function class_timetable($param1 = '', $param2 = '') {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        
        // Get teacher's assigned classes and subjects
        $teacher_id = $this->session->userdata('teacher_id');
        
        if ($param1 == 'view') {
            $class_id = $param2;
            
            // Verify if the teacher is assigned to this class
            $this->db->where('teacher_id', $teacher_id);
            $this->db->where('class_id', $class_id);
            $is_assigned = $this->db->get('timetable')->num_rows() > 0;
            
            if (!$is_assigned) {
                $this->session->set_flashdata('error_message', get_phrase('not_authorized_to_view_this_class_timetable'));
                redirect(base_url() . 'teacher/timetable', 'refresh');
            }
            
            $page_data['class_id'] = $class_id;
            $page_data['teacher_id'] = $teacher_id;
            $page_data['page_name'] = 'timetable_view';
            $page_data['page_title'] = get_phrase('class_timetable');
            $this->load->view('backend/index', $page_data);
        } else {
            $page_data['teacher_id'] = $teacher_id;
            $page_data['page_name'] = 'class_timetable';
            $page_data['page_title'] = get_phrase('class_timetable');
            $this->load->view('backend/index', $page_data);
        }
    }

    // Calendar Timetable View for Teachers
    public function calendar_timetable($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        
        $page_data['page_name'] = 'calendar_timetable';
        $page_data['page_title'] = get_phrase('my_timetable');
        
        // Get current month and year if not specified
        $page_data['current_month'] = date('n');
        $page_data['current_year'] = date('Y');
        
        // Get classes and subjects for dropdowns
        $page_data['classes'] = $this->db->get('class')->result_array();
        $page_data['teacher_id'] = $this->session->userdata('teacher_id');
        
        $this->load->view('backend/index', $page_data);
    }
    
    // AJAX endpoint for getting teacher timetable data
    public function get_teacher_timetable_data() {
        if ($this->session->userdata('teacher_login') != 1) {
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        try {
            $teacher_id = $this->session->userdata('teacher_id');
            $month = $this->input->post('month');
            $year = $this->input->post('year');
            
            // Validate inputs
            if (!is_numeric($month) || $month < 1 || $month > 12) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid month']);
                return;
            }
            
            if (!is_numeric($year) || $year < 2000 || $year > 2100) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid year']);
                return;
            }
            
            // Get timetable data from model
            $this->load->model('calendar_timetable_model');
            $timetable = $this->calendar_timetable_model->get_teacher_timetable($teacher_id, $month, $year);
            
            // Add additional data for each entry
            $processed_timetable = [];
            foreach ($timetable as $entry) {
                // Get subject name
                $subject = $this->db->get_where('subject', ['subject_id' => $entry['subject_id']])->row();
                $entry['subject_name'] = $subject ? $subject->name : 'Unknown Subject';
                
                // Get class and section names
                $class = $this->db->get_where('class', ['class_id' => $entry['class_id']])->row();
                $entry['class_name'] = $class ? $class->name : 'Unknown Class';
                
                $section = $this->db->get_where('section', ['section_id' => $entry['section_id']])->row();
                $entry['section_name'] = $section ? $section->name : 'Unknown Section';
                
                $processed_timetable[] = $entry;
            }
            
            echo json_encode($processed_timetable);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
    // Edit calendar timetable entry - Only for entries assigned to this teacher
    public function edit_calendar_timetable_entry() {
        if ($this->session->userdata('teacher_login') != 1) {
            echo json_encode(['status' => 'error', 'message' => get_phrase('access_denied')]);
            return;
        }
        
        try {
            $entry_id = $this->input->post('id');
            $teacher_id = $this->session->userdata('teacher_id');
            
            // Check if this entry belongs to the teacher
            $entry = $this->db->get_where('calendar_timetable', [
                'id' => $entry_id,
                'teacher_id' => $teacher_id
            ])->row_array();
            
            if (!$entry) {
                echo json_encode(['status' => 'error', 'message' => get_phrase('not_authorized_to_edit_this_entry')]);
                return;
            }
            
            // Update the entry
            $data = [
                'room_number' => $this->input->post('room_number'),
                'notes' => $this->input->post('notes')
            ];
            
            $this->db->where('id', $entry_id);
            $this->db->update('calendar_timetable', $data);
            
            echo json_encode(['status' => 'success', 'message' => get_phrase('timetable_updated_successfully')]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Delete calendar timetable entry - Only for entries assigned to this teacher
    public function delete_calendar_timetable_entry() {
        if ($this->session->userdata('teacher_login') != 1) {
            echo json_encode(['status' => 'error', 'message' => get_phrase('access_denied')]);
            return;
        }
        
        try {
            $entry_id = $this->input->post('id');
            $teacher_id = $this->session->userdata('teacher_id');
            
            // Check if this entry belongs to the teacher
            $entry = $this->db->get_where('calendar_timetable', [
                'id' => $entry_id,
                'teacher_id' => $teacher_id
            ])->row_array();
            
            if (!$entry) {
                echo json_encode(['status' => 'error', 'message' => get_phrase('not_authorized_to_delete_this_entry')]);
                return;
            }
            
            // Delete the entry
            $this->db->where('id', $entry_id);
            $this->db->delete('calendar_timetable');
            
            echo json_encode(['status' => 'success', 'message' => get_phrase('timetable_deleted_successfully')]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function my_timetable() {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        
        $page_data['page_name'] = 'my_timetable';
        $page_data['page_title'] = get_phrase('my_teaching_schedule');
        $page_data['classes'] = $this->db->get('class')->result_array();
        
        $this->load->view('backend/index', $page_data);
    }

    public function get_my_timetable_data() {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Access denied']));
            return;
        }

        try {
            $teacher_id = $this->session->userdata('teacher_id');
            
            // Get all timetable entries for this teacher
            $this->db->select('t.*, c.name as class_name, s.name as section_name, sub.name as subject_name');
            $this->db->from('calendar_timetable t');
            $this->db->join('class c', 'c.class_id = t.class_id');
            $this->db->join('section s', 's.section_id = t.section_id');
            $this->db->join('subject sub', 'sub.subject_id = t.subject_id');
            $this->db->where('t.teacher_id', $teacher_id);
            $this->db->order_by('t.time_slot_start', 'ASC');
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                $this->output->set_content_type('application/json')
                    ->set_output(json_encode($query->result_array()));
            } else {
                $this->output->set_content_type('application/json')
                    ->set_output(json_encode([]));
            }
        } catch (Exception $e) {
            $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Failed to load timetable data: ' . $e->getMessage()
                ]));
        }
    }

    public function get_sections() {
        if ($this->session->userdata('teacher_login') != 1) {
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        $class_id = $this->input->post('class_id');
        
        if (!$class_id) {
            echo json_encode([]);
            return;
        }
        
        $sections = $this->db->get_where('section', ['class_id' => $class_id])->result_array();
        echo json_encode($sections);
    }
    
    public function get_subjects() {
        if ($this->session->userdata('teacher_login') != 1) {
            error_log('Teacher_Controller_get_subjects: Access denied. User not logged in or not a teacher.');
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        $class_id = $this->input->post('class_id');
        $teacher_id = $this->session->userdata('teacher_id');
        
        error_log('Teacher_Controller_get_subjects: Received class_id: ' . $class_id);
        error_log('Teacher_Controller_get_subjects: Session teacher_id: ' . $teacher_id);
        
        if (!$class_id || !$teacher_id) {
            error_log('Teacher_Controller_get_subjects: class_id or teacher_id is missing. class_id: ' . $class_id . ', teacher_id: ' . $teacher_id);
            echo json_encode([]);
            return;
        }
        
        // Fetch subjects based on class_id and teacher_id
        $this->db->where('class_id', $class_id);
        $this->db->where('teacher_id', $teacher_id);
        $query = $this->db->get('subject');
        $subjects = $query->result_array();
        
        error_log('Teacher_Controller_get_subjects: SQL Query: ' . $this->db->last_query());
        error_log('Teacher_Controller_get_subjects: Found subjects: ' . json_encode($subjects));
        
        echo json_encode($subjects);
    }
    
    public function add_timetable_entry() {
        if ($this->session->userdata('teacher_login') != 1) {
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        try {
            $data = [
                'class_id' => $this->input->post('class_id'),
                'section_id' => $this->input->post('section_id'),
                'subject_id' => $this->input->post('subject_id'),
                'teacher_id' => $this->session->userdata('teacher_id'),
                'day_of_week' => $this->input->post('day_of_week'),
                'time_slot_start' => $this->input->post('time_slot_start'),
                'time_slot_end' => $this->input->post('time_slot_end'),
                'room_number' => $this->input->post('room_number')
            ];
            
            // Validate required fields
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    echo json_encode(['status' => 'error', 'message' => ucfirst(str_replace('_', ' ', $key)) . ' is required']);
                    return;
                }
            }
            
            // Check for time slot conflicts
            $this->db->where('teacher_id', $data['teacher_id']);
            $this->db->where('day_of_week', $data['day_of_week']);
            $this->db->where("(
                (time_slot_start <= '{$data['time_slot_start']}' AND time_slot_end > '{$data['time_slot_start']}') OR
                (time_slot_start < '{$data['time_slot_end']}' AND time_slot_end >= '{$data['time_slot_end']}') OR
                (time_slot_start >= '{$data['time_slot_start']}' AND time_slot_end <= '{$data['time_slot_end']}')
            )");
            
            if ($this->db->get('calendar_timetable')->num_rows() > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Time slot conflicts with an existing class']);
                return;
            }
            
            // Insert the entry
            $this->db->insert('calendar_timetable', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Class added to schedule successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to add class to schedule'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }
    
    public function update_timetable_entry() {
        if ($this->session->userdata('teacher_login') != 1) {
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        try {
            $id = $this->input->post('timetable_id');
            $teacher_id = $this->session->userdata('teacher_id');
            
            // Check if entry exists and belongs to this teacher
            $existing = $this->db->get_where('calendar_timetable', [
                'id' => $id,
                'teacher_id' => $teacher_id
            ])->row_array();
            
            if (!$existing) {
                echo json_encode(['status' => 'error', 'message' => 'Entry not found or access denied']);
                return;
            }
            
            $data = [
                'class_id' => $this->input->post('class_id'),
                'section_id' => $this->input->post('section_id'),
                'subject_id' => $this->input->post('subject_id'),
                'day_of_week' => $this->input->post('day_of_week'),
                'time_slot_start' => $this->input->post('time_slot_start'),
                'time_slot_end' => $this->input->post('time_slot_end'),
                'room_number' => $this->input->post('room_number')
            ];
            
            // Validate required fields
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    echo json_encode(['status' => 'error', 'message' => ucfirst(str_replace('_', ' ', $key)) . ' is required']);
                    return;
                }
            }
            
            // Check for time slot conflicts (excluding current entry)
            $this->db->where('teacher_id', $teacher_id);
            $this->db->where('day_of_week', $data['day_of_week']);
            $this->db->where('id !=', $id);
            $this->db->where("(
                (time_slot_start <= '{$data['time_slot_start']}' AND time_slot_end > '{$data['time_slot_start']}') OR
                (time_slot_start < '{$data['time_slot_end']}' AND time_slot_end >= '{$data['time_slot_end']}') OR
                (time_slot_start >= '{$data['time_slot_start']}' AND time_slot_end <= '{$data['time_slot_end']}')
            )");
            
            if ($this->db->get('calendar_timetable')->num_rows() > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Time slot conflicts with an existing class']);
                return;
            }
            
            // Update the entry
            $this->db->where('id', $id);
            $this->db->update('calendar_timetable', $data);
            
            if ($this->db->affected_rows() >= 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Class schedule updated successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to update class schedule'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }
    
    public function delete_timetable_entry() {
        if ($this->session->userdata('teacher_login') != 1) {
            echo json_encode(['status' => 'error', 'message' => 'Access denied']);
            return;
        }
        
        try {
            $id = $this->input->post('id');
            $teacher_id = $this->session->userdata('teacher_id');
            
            // Check if entry exists and belongs to this teacher
            $existing = $this->db->get_where('calendar_timetable', [
                'id' => $id,
                'teacher_id' => $teacher_id
            ])->row_array();
            
            if (!$existing) {
                echo json_encode(['status' => 'error', 'message' => 'Entry not found or access denied']);
                return;
            }
            
            // Delete the entry
            $this->db->where('id', $id);
            $this->db->delete('calendar_timetable');
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Class removed from schedule successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to remove class from schedule'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }

    // Print teacher timetable
    function print_timetable() {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        $teacher_id = $this->session->userdata('teacher_id');
        $teacher_details = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
        
        if (!$teacher_details) {
            $this->session->set_flashdata('error_message', get_phrase('Teacher information not found'));
            redirect(base_url() . 'teacher/my_timetable', 'refresh');
        }
        
        // Get timetable data
        $this->db->select('calendar_timetable.*, subject.name as subject_name, teacher.name as teacher_name, class.name as class_name, section.name as section_name');
        $this->db->from('calendar_timetable');
        $this->db->join('subject', 'subject.subject_id = calendar_timetable.subject_id', 'left');
        $this->db->join('teacher', 'teacher.teacher_id = calendar_timetable.teacher_id', 'left');
        $this->db->join('class', 'class.class_id = calendar_timetable.class_id', 'left');
        $this->db->join('section', 'section.section_id = calendar_timetable.section_id', 'left');
        $this->db->where('calendar_timetable.teacher_id', $teacher_id);
        $this->db->order_by('calendar_timetable.day_of_week', 'ASC');
        $this->db->order_by('calendar_timetable.time_slot_start', 'ASC');
        
        $data['timetable_data'] = $this->db->get()->result_array();
        $data['teacher_name'] = $teacher_details->name;
        $data['page_title'] = get_phrase('Teacher Timetable');
        
        // Load the view directly without using index.php
        $this->load->view('backend/timetable_print_view', $data);
    }

    // Teacher attendance view - shows teacher's own attendance history
    function teacher_attendance_view($month = '', $year = '') {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        // Set default month and year if not provided
        if (empty($month)) $month = date('m');
        if (empty($year)) $year = date('Y');
        
        $teacher_id = $this->session->userdata('teacher_id');
        $teacher_details = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
        
        if (!$teacher_details) {
            $this->session->set_flashdata('error_message', get_phrase('Teacher information not found'));
            redirect(base_url() . 'teacher/dashboard', 'refresh');
        }
        
        // Load teacher attendance model if not already loaded
        if (!class_exists('Teacher_attendance_model')) {
            $this->load->model('teacher_attendance_model');
        }
        
        // Get attendance data for the teacher
        $page_data['teacher_id'] = $teacher_id;
        $page_data['teacher_name'] = $teacher_details->name;
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['page_name'] = 'teacher_attendance_view';
        $page_data['page_title'] = get_phrase('my_attendance_report');
        
        // Get attendance statistics
        if (method_exists($this->teacher_attendance_model, 'getTeacherAttendanceStats')) {
            $page_data['attendance_stats'] = $this->teacher_attendance_model->getTeacherAttendanceStats($teacher_id, $month, $year);
        } else {
            // Fallback: calculate stats manually
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $present_count = $this->db->where('teacher_id', $teacher_id)
                                     ->where('status', 1)
                                     ->where('month', $month)
                                     ->where('year', $year)
                                     ->get('teacher_attendance')->num_rows();
            
            $absent_count = $this->db->where('teacher_id', $teacher_id)
                                    ->where('status', 2)
                                    ->where('month', $month)
                                    ->where('year', $year)
                                    ->get('teacher_attendance')->num_rows();
            
            $late_count = $this->db->where('teacher_id', $teacher_id)
                                  ->where('status', 3)
                                  ->where('month', $month)
                                  ->where('year', $year)
                                  ->get('teacher_attendance')->num_rows();
            
            $page_data['attendance_stats'] = array(
                'present_count' => $present_count,
                'absent_count' => $absent_count,
                'late_count' => $late_count,
                'total_days' => $days_in_month
            );
        }
        
        $this->load->view('backend/index', $page_data);
    }

    // Teacher attendance report - shows detailed monthly attendance report
    function teacher_attendance_report($month = '', $year = '') {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        // Set default month and year if not provided
        if (empty($month)) $month = date('m');
        if (empty($year)) $year = date('Y');
        
        $teacher_id = $this->session->userdata('teacher_id');
        $teacher_details = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row();
        
        if (!$teacher_details) {
            $this->session->set_flashdata('error_message', get_phrase('Teacher information not found'));
            redirect(base_url() . 'teacher/dashboard', 'refresh');
        }
        
        $page_data['teacher_id'] = $teacher_id;
        $page_data['teacher_name'] = $teacher_details->name;
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['page_name'] = 'teacher_attendance_report';
        $page_data['page_title'] = get_phrase('teacher_attendance_report');
        
        $this->load->view('backend/index', $page_data);
    }

}
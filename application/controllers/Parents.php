<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Parents extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
  
    }

     /*parent dashboard code to redirect to parent page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('parent_login') != 1) redirect(base_url(), 'refresh');

        // Get the student associated with the logged-in parent
        $parent_id = $this->session->userdata('parent_id');
        $student = $this->db->get_where('student', array('parent_id' => $parent_id))->row();
        $student_id = null;
        $class_id = null;

        if ($student) {
            $student_id = $student->student_id;
            $class_id = $student->class_id;
        }

        // Initialize arrays for data
        $attendance_data = array();
        $all_teachers = array();
        $recent_payments = array();
        $start_date = null;
        $today_date = null;

        if ($student_id) {
            // Get today and the date 2 days prior
            $today_dt = new DateTime();
            $start_dt = new DateTime();
            $start_dt->modify('-2 days');

            $today_date = $today_dt->format('Y-m-d');
            $start_date = $start_dt->format('Y-m-d');

            // Fetch student's attendance for the last 3 days (inclusive)
            $this->db->select('date, status'); 
            $this->db->where('student_id', $student_id);
            $this->db->where('date >=', $start_date);
            $this->db->where('date <=', $today_date);
            $this->db->order_by('date', 'DESC');
            $attendance_query = $this->db->get('attendance');
            
            if ($attendance_query !== false && $attendance_query->num_rows() > 0) {
                foreach ($attendance_query->result() as $row) {
                    if (isset($row->date) && isset($row->status)) {
                        $attendance_data[date('Y-m-d', strtotime($row->date))] = $row->status; 
                    } else {
                        log_message('error', 'Attendance record missing date or status property for student_id: ' . $student_id);
                    }
                }
            } elseif ($attendance_query === false) {
                log_message('error', 'Database error fetching attendance for parent dashboard: ' . $this->db->error()['message']);
            }

            // Fetch all teachers (or just class teachers if needed)
            // Using the same logic as student dashboard for simplicity, fetches all teachers
            $this->db->select('teacher_id, name, role, email, phone, sex');
            $all_teachers = $this->db->get('teacher')->result_array();

            // Fetch last 4 payment records for the student
            $this->db->select('title, description, method, amount, timestamp');
            $this->db->where('student_id', $student_id);
            $this->db->order_by('timestamp', 'DESC');
            $this->db->limit(4);
            $recent_payments = $this->db->get('payment')->result_array();
        }

       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('parent Dashboard');
        $page_data['student_info'] = $student; // Pass student info
        $page_data['attendance_data'] = $attendance_data; // Pass attendance data
        $page_data['start_date'] = $start_date; // Pass start date for attendance loop
        $page_data['today_date'] = $today_date; // Pass end date for attendance loop
        $page_data['all_teachers'] = $all_teachers; // Pass teachers data
        $page_data['recent_payments'] = $recent_payments; // Pass recent payments

        $this->load->view('backend/index', $page_data);
    }
	/******************* / parent dashboard code to redirect to parent page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('parent_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
    
    
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
    
            $this->db->where('parent_id', $this->session->userdata('parent_id'));
            $this->db->update('parent', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/' . $this->session->userdata('parent_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'parents/manage_profile', 'refresh');
        }
    
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
    
            if ($data['new_password'] == $data['confirm_new_password']) {
               
               $this->db->where('parent_id', $this->session->userdata('parent_id'));
               $this->db->update('parent', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
    
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'parents/manage_profile', 'refresh');
        }
    
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('parent', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }


        function subject (){

            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $select_student_class_id = $parent_profile->class_id;

            $page_data['page_name']     = 'subject';
            $page_data['page_title']    = get_phrase('Class Subjects');
            $page_data['select_subject']  = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function teacher (){


            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $select_student_class_id = $parent_profile->class_id;

            $return_teacher_id = $this->db->get_where('subject', array('class_id' => $select_student_class_id))->row()->teacher_id;


            $page_data['page_name']     = 'teacher';
            $page_data['page_title']    = get_phrase('Class Teachers');
            $page_data['select_teacher']  = $this->db->get_where('teacher', array('teacher_id' => $return_teacher_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function class_mate() {
            if ($this->session->userdata('parent_login') != 1) redirect(base_url(), 'refresh');

            // Get the student associated with the logged-in parent
            $parent_id = $this->session->userdata('parent_id');
            $student = $this->db->get_where('student', array('parent_id' => $parent_id))->row();

            if (!$student) {
                 // Handle case where parent has no associated student
                 $this->session->set_flashdata('error_message', get_phrase('No student associated with this parent account.'));
                 redirect(base_url() . 'parents/dashboard', 'refresh');
                 return; // Stop execution
            }

            $student_id = $student->student_id;
            $class_id = $student->class_id;

            // Fetch classmates (all students in the same class, excluding the current student)
            $this->db->select('student_id, name, phone, email, sex'); // Select required fields
            $this->db->where('class_id', $class_id);
            $this->db->where('student_id !=', $student_id); // Exclude the parent's own child
            $this->db->order_by('name', 'asc'); // Order by name
            $classmates = $this->db->get('student')->result_array();

            // Prepare data for the view
            $page_data['classmates']    = $classmates; // Pass classmate data
            $page_data['page_name']     = 'class_mate';
            $page_data['page_title']    = get_phrase('Classmates'); // Changed title slightly
            $this->load->view('backend/index', $page_data);
        }

        function class_routine(){

            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $page_data['class_id']  = $parent_profile->class_id;

            $page_data['page_name']     = 'class_routine';
            $page_data['page_title']    = get_phrase('Class Timetable');
            $this->load->view('backend/index', $page_data);


        }

        function invoice($param1 = null, $param2 = null, $param3 = null){

            if($param1 == 'make_payment'){

                $invoice_id = $this->input->post('invoice_id');
                $payment_email = $this->db->get_where('settings', array('type' => 'paypal_email'))->row();
                $select_invoice = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();

                // SENDING USER TO PAYPAL TERMINAL.
                $this->paypal->add_field('rm', 2);
                $this->paypal->add_field('no_note', 0);
                $this->paypal->add_field('item_name', $select_invoice->title);
                $this->paypal->add_field('amount', $select_invoice->due);
                $this->paypal->add_field('custom', $select_invoice->invoice_id);
                $this->paypal->add_field('business', $payment_email->description);
                $this->paypal->add_field('notify_url', base_url('invoice/paypal_ipn'));
                $this->paypal->add_field('cancel_return', base_url('invoice/paypal_cancel'));
                $this->paypal->add_field('return', site_url('invoice/paypal_success'));

                $this->paypal->submit_paypal_post();
                //submitting info to the paypal teminal
            }


            if($param1 == 'paypal_ipn'){
                if($this->paypal->validate_ipn() == true){
                        $ipn_response = '';
                        foreach ($_POST as $key => $value){
                            $value = urlencode(stripslashes($value));
                            $ipn_response .= "\n$key=$value";
                        }

                    $page_data['payment_details']   = $ipn_response;
                    $page_data['payment_timestamp'] = strtotime(date("m/d/Y"));
                    $page_data['payment_method']    = '1';
                    $page_data['status']            = 'paid';
                    $invoice_id                = $_POST['custom'];
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->update('invoice', $page_data);

                    $data2['method']       =   '1';
                    $data2['invoice_id']   =   $_POST['custom'];
                    $data2['timestamp']    =   strtotime(date("m/d/Y"));
                    $data2['payment_type'] =   'income';
                    $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                    $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                    $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
                    $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                    $this->db->insert('payment' , $data2);

                }
            }

            if($param1 == 'paypal_cancel'){
                $this->session->set_flashdata('error_message', get_phrase('Payment Cancelled'));
                redirect(base_url() . 'parents/invoice', 'refresh');
                }
    
            if($param1 == 'paypal_success'){
                $this->session->set_flashdata('flash_message', get_phrase('Payment Successful'));
                redirect(base_url() . 'parents/invoice', 'refresh');
            }
           

            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            $student_profile = $parent_profile->student_id;

            $page_data['invoices']     = $this->db->get_where('invoice', array('student_id' => $student_profile))->result_array();
            $page_data['page_name']     = 'invoice';
            $page_data['page_title']    = get_phrase('All Invoices');
            $this->load->view('backend/index', $page_data);
        }

        function payment_history() {
            if ($this->session->userdata('parent_login') != 1) redirect(base_url(), 'refresh');

            // Get the student_id associated with the logged-in parent
            $parent_profile = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->row();
            
            if (!$parent_profile) {
                // Handle case where parent has no associated student
                $this->session->set_flashdata('error_message', get_phrase('No student associated with this parent account.'));
                redirect(base_url() . 'parents/dashboard', 'refresh');
                return; // Stop execution
            }
            
            $student_id = $parent_profile->student_id;

            // Fetch payment history for the student
            $this->db->select('payment_id, title, description, method, amount, timestamp'); // Select required fields
            $this->db->where('student_id', $student_id);
            $this->db->order_by('timestamp', 'desc'); // Show most recent first
            $payments = $this->db->get('payment')->result_array();

            // Prepare data for the view
            $page_data['payments']     = $payments; // Use 'payments' key for clarity
            $page_data['page_name']     = 'payment_history'; // Load the correct view file
            $page_data['page_title']    = get_phrase('Payment History');
            $this->load->view('backend/index', $page_data);
        }

        function assignment() {
            // ... existing code ...
        }

}
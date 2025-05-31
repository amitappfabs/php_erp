<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_payment_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }

        function createStudentSinglePaymentFunction(){
            $fee_items = $this->input->post('fee_items');
            $total_amount = 0;
            
            // Calculate total amount from all fee items
            if (is_array($fee_items)) {
                foreach ($fee_items as $item) {
                    $total_amount += floatval($item['amount']);
                }
            } else {
                // For backward compatibility - single fee
                $total_amount = html_escape($this->input->post('amount'));
            }

            $page_data['invoice_number']    =   html_escape($this->input->post('invoice_number')) + rand(10000, 1000000);
            $page_data['receipt_number']    =   html_escape($this->input->post('receipt_number'));
            $page_data['student_id']        =   html_escape($this->input->post('student_id'));
            
            // Fetch student details based on student_id
            $student = $this->db->get_where('student', array('student_id' => $page_data['student_id']))->row();
            
            $page_data['admission_number']  =   $student->admission_number;
            $page_data['student_name']      =   $student->name;
            
            // Fetch class name
            $class = $this->db->get_where('class', array('class_id' => $student->class_id))->row();
            $page_data['class']             =   $class->name;
            
            $page_data['title']             =   html_escape($this->input->post('title'));
            $page_data['description']       =   html_escape($this->input->post('description'));
            
            // Store the first fee type for backward compatibility 
            // but we'll mainly use the fee_items table for all fee items
            $page_data['fee_type']          =   is_array($fee_items) && !empty($fee_items) ? 
                                                $fee_items[0]['fee_type'] : 
                                                html_escape($this->input->post('fee_type'));
            
            $page_data['discount_type']     =   html_escape($this->input->post('discount_type'));
            $page_data['discount']          =   html_escape($this->input->post('discount'));
            $page_data['amount']            =   $total_amount;
            $page_data['amount_paid']       =   html_escape($this->input->post('amount_paid'));
            
            $posted_discount_type = strtolower(trim(html_escape($this->input->post('discount_type'))));
            $posted_discount_percentage = floatval(html_escape($this->input->post('discount')));

            $actual_discount_percentage = 0;
            if ($posted_discount_type != 'no discount' && $posted_discount_type != '') {
                $actual_discount_percentage = $posted_discount_percentage;
            }
            
            $amount_after_discount = $total_amount * (1 - ($actual_discount_percentage / 100));
            $page_data['due']               =   $amount_after_discount - floatval($page_data['amount_paid']);
            
            $page_data['creation_timestamp'] =   html_escape($this->input->post('creation_timestamp'));
            $page_data['payment_method']     =   html_escape($this->input->post('payment_method'));
            $page_data['status']             =   html_escape($this->input->post('status'));
            $page_data['year']               =   $this->db->get_where('settings', array('type' => 'session'))->row()->description;

            $this->db->insert('invoice', $page_data);
            $invoice_id = $this->db->insert_id();
            
            // Save all fee items
            if (is_array($fee_items)) {
                foreach ($fee_items as $item) {
                    $fee_item_data = array(
                        'invoice_id' => $invoice_id,
                        'fee_type'   => $item['fee_type'],
                        'amount'     => $item['amount'],
                        'discount'   => isset($item['discount']) ? $item['discount'] : 0,
                    );
                    $this->db->insert('fee_items', $fee_item_data);
                }
            } else {
                // For backward compatibility - insert a single fee item
                $fee_item_data = array(
                    'invoice_id' => $invoice_id,
                    'fee_type'   => html_escape($this->input->post('fee_type')),
                    'amount'     => html_escape($this->input->post('amount')),
                    'discount'   => html_escape($this->input->post('discount')),
                );
                $this->db->insert('fee_items', $fee_item_data);
            }

            $page_data2['invoice_id']   =   $invoice_id;
            $page_data2['student_id']   =   html_escape($this->input->post('student_id'));
            $page_data2['title']        =   html_escape($this->input->post('title'));
            $page_data2['description']  =   html_escape($this->input->post('description'));
            $page_data2['payment_type'] =   'income';
            $page_data2['amount']       =   $amount_after_discount;
            $page_data2['discount_type']     =   html_escape($this->input->post('discount_type'));
            $page_data2['discount']     =   html_escape($this->input->post('discount'));
            $page_data2['timestamp']    =   strtotime($this->input->post('creation_timestamp'));
            $page_data2['year']         =   $this->db->get_where('settings', array('type' => 'session'))->row()->description;
            $page_data2['method']       =   html_escape($this->input->post('payment_method'));

            $this->db->insert('payment', $page_data2);
            $payment_id = $this->db->insert_id();
            
            return $invoice_id;
        }

        function createStudentMassPaymentFunction(){
            $student_array = $this->input->post('student_id');
            $title = html_escape($this->input->post('title'));
            $description = html_escape($this->input->post('description'));
            $fee_items = $this->input->post('fee_items');
            $discount_type = html_escape($this->input->post('discount_type'));
            $discount = html_escape($this->input->post('discount'));
            $amount_paid = html_escape($this->input->post('amount_paid'));
            $status = html_escape($this->input->post('status'));
            $creation_timestamp = html_escape($this->input->post('creation_timestamp'));
            $payment_method = html_escape($this->input->post('payment_method'));
            $base_invoice_number = html_escape($this->input->post('invoice_number'));
            
            // Calculate total amount from all fee items
            $total_amount = 0;
            if (is_array($fee_items)) {
                foreach ($fee_items as $item) {
                    $total_amount += floatval($item['amount']);
                }
            } else {
                // For backward compatibility - single fee
                $total_amount = html_escape($this->input->post('amount'));
            }

            $discount_type_from_post = strtolower(trim(html_escape($this->input->post('discount_type'))));
            $discount_from_post = floatval(html_escape($this->input->post('discount')));

            $mass_actual_discount_percentage = 0;
            if ($discount_type_from_post != 'no discount' && $discount_type_from_post != '') {
                 $mass_actual_discount_percentage = $discount_from_post;
            }

            foreach($student_array as $key => $student_id){
                $page_data['invoice_number'] = $base_invoice_number + rand(10000, 1000000);
                $page_data['receipt_number'] = html_escape($this->input->post('receipt_number'));
                $page_data['student_id'] = $student_id;
                
                // Fetch student details based on student_id
                $student = $this->db->get_where('student', array('student_id' => $student_id))->row();
                
                $page_data['admission_number'] = $student->admission_number;
                $page_data['student_name'] = $student->name;
                
                // Fetch class name
                $class = $this->db->get_where('class', array('class_id' => $student->class_id))->row();
                $page_data['class'] = $class->name;
                
                $page_data['title'] = $title;
                $page_data['description'] = $description;
                
                // Store the first fee type for backward compatibility
                $page_data['fee_type'] = is_array($fee_items) && !empty($fee_items) ? 
                                        $fee_items[0]['fee_type'] : 
                                        html_escape($this->input->post('fee_type'));
                
                $page_data['discount_type'] = html_escape($this->input->post('discount_type'));
                $page_data['discount'] = $discount_from_post;
                $page_data['amount'] = $total_amount;
                $page_data['amount_paid'] = $amount_paid;

                $current_amount_after_discount = $total_amount * (1 - ($mass_actual_discount_percentage / 100));
                $page_data['due'] = $current_amount_after_discount - floatval($amount_paid);

                $page_data['creation_timestamp'] = $creation_timestamp;
                $page_data['payment_method'] = $payment_method;
                $page_data['status'] = $status;
                $page_data['year'] = $this->db->get_where('settings', array('type' => 'session'))->row()->description;

                $this->db->insert('invoice', $page_data);
                $invoice_id = $this->db->insert_id();
                
                // Save all fee items
                if (is_array($fee_items)) {
                    foreach ($fee_items as $item) {
                        $fee_item_data = array(
                            'invoice_id' => $invoice_id,
                            'fee_type'   => $item['fee_type'],
                            'amount'     => $item['amount'],
                            'discount'   => isset($item['discount']) ? $item['discount'] : 0,
                        );
                        $this->db->insert('fee_items', $fee_item_data);
                    }
                } else {
                    // For backward compatibility - insert a single fee item
                    $fee_item_data = array(
                        'invoice_id' => $invoice_id,
                        'fee_type'   => html_escape($this->input->post('fee_type')),
                        'amount'     => html_escape($this->input->post('amount')),
                        'discount'   => html_escape($this->input->post('discount')),
                    );
                    $this->db->insert('fee_items', $fee_item_data);
                }
                
                // Insert into payment table
                $page_data2['invoice_id'] = $invoice_id;
                $page_data2['student_id'] = $student_id;
                $page_data2['title'] = $title;
                $page_data2['description'] = $description;
                $page_data2['payment_type'] = 'income';
                $page_data2['amount'] = $current_amount_after_discount;
                $page_data2['discount_type'] = html_escape($this->input->post('discount_type'));
                $page_data2['discount'] = $discount_from_post;
                $page_data2['timestamp'] = strtotime($creation_timestamp);
                $page_data2['year'] = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
                $page_data2['method'] = $payment_method;
                
                $this->db->insert('payment', $page_data2);
            }
            
        }

        function takeNewPaymentFromStudent($param2){
            $page_data['invoice_id']        =   html_escape($this->input->post('invoice_id'));
            $page_data['student_id']        =   html_escape($this->input->post('student_id'));
            $page_data['title']             =   html_escape($this->input->post('title'));
            $page_data['description']       =   html_escape($this->input->post('description'));
            $page_data['amount']            =   html_escape($this->input->post('amount'));
            $page_data['payment_type']      =   'income';
            $page_data['method']            =   html_escape($this->input->post('method'));
            $page_data['timestamp']         =   strtotime($this->input->post('timestamp'));
            $page_data['amount']            =   html_escape($this->input->post('amount'));
            $page_data['year']              =   $this->db->get_where('settings', array('type' => 'session'))->row()->description;
            
            $this->db->insert('payment', $page_data);
            $payment_id = $this->db->insert_id();

            $payment_amount = html_escape($this->input->post('amount'));
            
            // Update the invoice amounts
            $this->db->where('invoice_id', $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $payment_amount, FALSE);
            $this->db->set('due', 'due - ' . $payment_amount, FALSE);
            $this->db->update('invoice');
            
            // Get the updated invoice to check if it's fully paid
            $updated_invoice = $this->db->get_where('invoice', array('invoice_id' => $param2))->row();
            
            // If due amount is 0 or negative, mark as paid
            if ($updated_invoice && $updated_invoice->due <= 0) {
                $this->db->where('invoice_id', $param2);
                $this->db->update('invoice', array('status' => '1', 'due' => 0));
            }
        }

        function updateStudentPaymentFunction($param2){
            $fee_items = $this->input->post('fee_items');
            $total_amount = 0;
            
            // Calculate total amount from all fee items
            if (is_array($fee_items)) {
                foreach ($fee_items as $item) {
                    $total_amount += floatval($item['amount']);
                }
            } else {
                // For backward compatibility - single fee
                $total_amount = html_escape($this->input->post('amount'));
            }

            $page_data['student_id']        =  html_escape($this->input->post('student_id'));
            
            // Fetch student details based on student_id
            $student = $this->db->get_where('student', array('student_id' => $page_data['student_id']))->row();
            
            $page_data['admission_number']  =   $student->admission_number;
            $page_data['student_name']      =   $student->name;
            
            // Fetch class name
            $class = $this->db->get_where('class', array('class_id' => $student->class_id))->row();
            $page_data['class']             =   $class->name;
            
            $page_data['title']             =   html_escape($this->input->post('title'));
            $page_data['description']       =   html_escape($this->input->post('description'));
            
            // Store the first fee type for backward compatibility
            $page_data['fee_type']          =   is_array($fee_items) && !empty($fee_items) ? 
                                                $fee_items[0]['fee_type'] : 
                                                html_escape($this->input->post('fee_type'));
            
            $page_data['discount_type']     =   html_escape($this->input->post('discount_type'));
            $page_data['discount']          =   html_escape($this->input->post('discount'));
            $page_data['amount']            =   $total_amount;
            $page_data['amount_paid']       =   html_escape($this->input->post('amount_paid'));

            $update_posted_discount_type = strtolower(trim(html_escape($this->input->post('discount_type'))));
            $update_posted_discount_percentage = floatval(html_escape($this->input->post('discount')));
            
            $update_actual_discount_percentage = 0;
            if ($update_posted_discount_type != 'no discount' && $update_posted_discount_type != '') {
                $update_actual_discount_percentage = $update_posted_discount_percentage;
            }

            $update_amount_after_discount = $total_amount * (1 - ($update_actual_discount_percentage / 100));
            $page_data['due']               =   $update_amount_after_discount - floatval($page_data['amount_paid']);

            $page_data['creation_timestamp'] =   html_escape($this->input->post('date'));
            $page_data['status']             =   html_escape($this->input->post('status'));
            $page_data['receipt_number']     =   html_escape($this->input->post('receipt_number'));

            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $page_data);
            
            // Delete existing fee items for this invoice
            $this->db->where('invoice_id', $param2);
            $this->db->delete('fee_items');
            
            // Save all fee items
            if (is_array($fee_items)) {
                foreach ($fee_items as $item) {
                    $fee_item_data = array(
                        'invoice_id' => $param2,
                        'fee_type'   => $item['fee_type'],
                        'amount'     => $item['amount'],
                        'discount_type'   => html_escape($this->input->post('discount_type')),
                        'discount'   => html_escape($this->input->post('discount')),
                    );
                    $this->db->insert('fee_items', $fee_item_data);
                }
            } else {
                // For backward compatibility - insert a single fee item
                $fee_item_data = array(
                    'invoice_id' => $param2,
                    'fee_type'   => html_escape($this->input->post('fee_type')),
                    'amount'     => $total_amount,
                    'discount_type'   => html_escape($this->input->post('discount_type')),
                    'discount'   => html_escape($this->input->post('discount')),
                );
                $this->db->insert('fee_items', $fee_item_data);
            }
        }

        function deleteStudentPaymentFunction($param2){
            // Delete from invoice table
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            
            // Delete from fee_items table
            $this->db->where('invoice_id', $param2);
            $this->db->delete('fee_items');
        }
        
        function getFeeItems($invoice_id) {
            $this->db->where('invoice_id', $invoice_id);
            return $this->db->get('fee_items')->result_array();
        }
        
        function addFeeItem($invoice_id) {
            $fee_item_data = array(
                'invoice_id' => $invoice_id,
                'fee_type'   => html_escape($this->input->post('fee_type')),
                'amount'     => html_escape($this->input->post('amount')),
                'discount'   => html_escape($this->input->post('discount')),
            );
            
            $this->db->insert('fee_items', $fee_item_data);
            
            // Update the total amount in the invoice table
            $this->db->select_sum('amount');
            $this->db->where('invoice_id', $invoice_id);
            $result = $this->db->get('fee_items')->row();
            $total_amount = $result->amount;
            
            $this->db->where('invoice_id', $invoice_id);
            $this->db->update('invoice', array('amount' => $total_amount, 'due' => $total_amount - $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->amount_paid));
            
            return $this->db->insert_id();
        }
        
        function deleteFeeItem($fee_item_id) {
            // Get invoice_id before deleting
            $invoice_id = $this->db->get_where('fee_items', array('fee_item_id' => $fee_item_id))->row()->invoice_id;
            
            // Delete the fee item
            $this->db->where('fee_item_id', $fee_item_id);
            $this->db->delete('fee_items');
            
            // Update the total amount in the invoice table
            $this->db->select_sum('amount');
            $this->db->where('invoice_id', $invoice_id);
            $result = $this->db->get('fee_items')->row();
            $total_amount = $result ? $result->amount : 0;
            
            $this->db->where('invoice_id', $invoice_id);
            $this->db->update('invoice', array('amount' => $total_amount, 'due' => $total_amount - $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->amount_paid));
            
            return $invoice_id;
        }
}
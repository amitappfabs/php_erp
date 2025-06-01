<?php
// Add debugging
error_log('Loading modal_view_invoice.php with param2: ' . $param2);

// Get invoice data with error handling
try {
    $invoices = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
    
    if (empty($invoices)) {
        error_log('No invoice found with ID: ' . $param2);
        echo '<div class="alert alert-danger">No invoice found with ID: ' . $param2 . '</div>';
        return;
    }
    
    foreach ($invoices as $key => $row):
        try {
            // Get student info with error handling
            $student_info = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
            if (!$student_info) {
                error_log('Student not found for invoice: ' . $param2);
                $student_info = new stdClass();
                $student_info->name = 'N/A';
                $student_info->admission_number = 'N/A';
                $student_info->phone = 'N/A';
                $student_info->father_phone = 'N/A';
                $student_info->address = 'N/A';
                $student_info->class_id = 0;
                $student_info->section_id = 0;
                $student_info->student_code = 'N/A';
            }
            
            // Get class info with error handling
            $class_info = $this->db->get_where('class', array('class_id' => $student_info->class_id))->row();
            if (!$class_info) {
                error_log('Class not found for student: ' . $student_info->class_id);
                $class_info = new stdClass();
                $class_info->name = 'N/A';
            }
            
            // Get section info with error handling
            $section_info = null;
            if ($student_info->section_id) {
                $section_info = $this->db->get_where('section', array('section_id' => $student_info->section_id))->row();
            }
            
            // Get system info with error handling
            $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
            $system_address = $this->db->get_where('settings', array('type' => 'address'))->row()->description;
            $system_phone = $this->db->get_where('settings', array('type' => 'phone'))->row()->description;
            
            // These might not exist, so use default values if not found
            $system_email_query = $this->db->get_where('settings', array('type' => 'system_email'));
            $system_email = $system_email_query->num_rows() > 0 ? $system_email_query->row()->description : 'N/A';
            
            $system_website_query = $this->db->get_where('settings', array('type' => 'website'));
            $system_website = $system_website_query->num_rows() > 0 ? $system_website_query->row()->description : 'N/A';
            
            $currency = $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
            
            // Get payment details
            $payment_history = $this->db->get_where('payment', array('invoice_id' => $row['invoice_id']))->result_array();
            
            // Get fee items
            $fee_items = $this->db->get_where('fee_items', array('invoice_id' => $row['invoice_id']))->result_array();
?>

<div class="invoice-buttons">
    <button onClick="printInvoice()" class="btn btn-rounded btn-success btn-sm"><i class="fa fa-print"></i>&nbsp;Print Receipt</button>
    <button onclick="closeModal()" class="btn btn-rounded btn-default btn-sm"><i class="fa fa-times"></i>&nbsp;Close</button>
</div>
<hr>

<div id="invoice_print">
    <div class="receipt-header">
        <table width="100%" border="0">
            <tr>
                <td width="15%" align="center">
                    <img src="<?php echo base_url('uploads/logo.svg'); ?>" style="max-height: 80px;" alt="School Logo">
                </td>
                <td width="85%" align="center">
                    <h2 style="margin: 0; font-weight: bold; text-transform: uppercase;"><?php echo $system_name; ?></h2>
                    <p style="margin: 0;"><?php echo $system_address; ?></p>
                    <p style="margin: 0;">Contact Nos.: <?php echo $system_phone; ?></p>
                    <p style="margin: 0;">Email: <?php echo $system_email; ?>, Website: <?php echo $system_website; ?></p>
                </td>
            </tr>
        </table>
        <div style="text-align: center; border-top: 2px solid #000; border-bottom: 2px solid #000; padding: 5px; margin-top: 10px;">
            <h3 style="margin: 0; font-weight: bold;">FEE RECEIPT (<?php echo date('Y').'-'.(date('Y')+1); ?>)</h3>
        </div>
    </div>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td width="50%">
                <table width="100%">
                    <tr>
                        <td width="35%"><strong>Receipt No</strong></td>
                        <td width="5%">:</td>
                        <td width="60%"><?php echo sprintf('%04d', $row['invoice_id']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td>:</td>
                        <td><?php echo $student_info->name; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Admn No</strong></td>
                        <td>:</td>
                        <td><?php echo $student_info->admission_number; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact No</strong></td>
                        <td>:</td>
                        <td><?php echo $student_info->phone; ?>, <?php echo $student_info->father_phone; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td>:</td>
                        <td><?php echo $student_info->address; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Fee Month</strong></td>
                        <td>:</td>
                        <td><?php echo date('F', $row['creation_timestamp']); ?></td>
                    </tr>
                </table>
            </td>
            <td width="50%">
                <table width="100%">
                    <tr>
                        <td width="35%"><strong>Date</strong></td>
                        <td width="5%">:</td>
                        <td width="60%"><?php echo date('d-M-Y', $row['creation_timestamp']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Class</strong></td>
                        <td>:</td>
                        <td><?php echo $class_info->name; ?> - <?php echo $section_info ? $section_info->name : 'N/A'; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Fee Book No.</strong></td>
                        <td>:</td>
                        <td><?php echo isset($student_info->student_code) ? $student_info->student_code : 'N/A'; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div style="margin-top: 15px;">
        <table width="100%" border="1" style="border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f5f5f5;">
                    <th style="padding: 8px; text-align: center;">Fee Description</th>
                    <th style="padding: 8px; text-align: center;">Previous Due</th>
                    <th style="padding: 8px; text-align: center;">Previous Adv</th>
                    <th style="padding: 8px; text-align: center;">Fees</th>
                    <th style="padding: 8px; text-align: center;">To Pay</th>
                    <th style="padding: 8px; text-align: center;">Fee Paid</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($fee_items)) {
                    // If no fee items in the new table, display the invoice's fee_type
                    ?>
                    <tr>
                        <td style="padding: 8px;"><?php echo $row['fee_type']; ?></td>
                        <td style="padding: 8px; text-align: center;">0</td>
                        <td style="padding: 8px; text-align: center;">0</td>
                        <td style="padding: 8px; text-align: right;"><?php echo $currency; ?> <?php echo number_format($row['amount'],2,".",",");?></td>
                        <td style="padding: 8px; text-align: right;"><?php echo $currency; ?> <?php echo number_format($row['amount'],2,".",",");?></td>
                        <td style="padding: 8px; text-align: right;"><?php echo $currency; ?> <?php echo number_format($row['amount_paid'],2,".",",");?></td>
                    </tr>
                <?php
                } else {
                    $total_amount = 0;
                    $total_paid = 0;
                    foreach ($fee_items as $fee_item):
                        $total_amount += $fee_item['amount'];
                        $total_paid += $row['amount_paid']; // This is not accurate but we don't have individual paid amounts
                    ?>
                    <tr>
                        <td style="padding: 8px;"><?php echo $fee_item['fee_type']; ?></td>
                        <td style="padding: 8px; text-align: center;">0</td>
                        <td style="padding: 8px; text-align: center;">0</td>
                        <td style="padding: 8px; text-align: right;"><?php echo $currency; ?> <?php echo number_format($fee_item['amount'],2,".",",");?></td>
                        <td style="padding: 8px; text-align: right;"><?php echo $currency; ?> <?php echo number_format($fee_item['amount'],2,".",",");?></td>
                        <td style="padding: 8px; text-align: right;"><?php echo $currency; ?> <?php echo number_format($fee_item['amount'],2,".",",");?></td>
                    </tr>
                    <?php 
                    endforeach;
                }
                ?>
                <tr style="border-top: 2px solid #000; font-weight: bold;">
                    <td style="padding: 8px; text-align: right;" colspan="3">Total :</td>
                    <td style="padding: 8px; text-align: right;"><?php echo $currency; ?> <?php echo number_format($row['amount'],2,".",",");?></td>
                    <td style="padding: 8px; text-align: right;"><?php echo $currency; ?> <?php echo number_format($row['amount'],2,".",",");?></td>
                    <td style="padding: 8px; text-align: right;"><?php echo $currency; ?> <?php echo number_format($row['amount_paid'],2,".",",");?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 15px;">
        <table width="100%">
            <tr>
                <td width="70%">
                    <p><strong>In Words: </strong>
                    <?php
                    // Convert amount to words
                    function numberToWords($number) {
                        $ones = array(
                            0 => "", 1 => "One", 2 => "Two", 3 => "Three", 4 => "Four", 5 => "Five", 
                            6 => "Six", 7 => "Seven", 8 => "Eight", 9 => "Nine", 10 => "Ten", 
                            11 => "Eleven", 12 => "Twelve", 13 => "Thirteen", 14 => "Fourteen", 
                            15 => "Fifteen", 16 => "Sixteen", 17 => "Seventeen", 18 => "Eighteen", 
                            19 => "Nineteen"
                        );
                        $tens = array(
                            0 => "", 2 => "Twenty", 3 => "Thirty", 4 => "Forty", 5 => "Fifty", 
                            6 => "Sixty", 7 => "Seventy", 8 => "Eighty", 9 => "Ninety"
                        );
                        $hundreds = array(
                            "Hundred", "Thousand", "Million", "Billion", "Trillion", "Quadrillion"
                        );

                        if ($number == 0) {
                            return "Zero";
                        }

                        $number = number_format($number, 2, ".", ",");
                        $number_array = explode(".", $number);
                        $number = $number_array[0];
                        
                        $words = "";
                        
                        // For numbers up to 999
                        if ($number < 1000) {
                            if ($number < 20) {
                                $words .= $ones[$number];
                            } elseif ($number < 100) {
                                $words .= $tens[floor($number/10)];
                                $remainder = $number % 10;
                                if ($remainder != 0) {
                                    $words .= " " . $ones[$remainder];
                                }
                            } else {
                                $words .= $ones[floor($number/100)] . " " . $hundreds[0];
                                $remainder = $number % 100;
                                if ($remainder != 0) {
                                    if ($remainder < 20) {
                                        $words .= " " . $ones[$remainder];
                                    } else {
                                        $words .= " " . $tens[floor($remainder/10)];
                                        $remainder = $remainder % 10;
                                        if ($remainder != 0) {
                                            $words .= " " . $ones[$remainder];
                                        }
                                    }
                                }
                            }
                        } else {
                            $words = "Exceeds handling capacity";
                        }
                        
                        // Add decimal part
                        if (isset($number_array[1]) && $number_array[1] != '00') {
                            $words .= " Point";
                            $digits = str_split($number_array[1]);
                            foreach ($digits as $digit) {
                                $words .= " " . $ones[$digit];
                            }
                        }
                        
                        return $words;
                    }
                    
                    echo numberToWords($row['amount_paid']);
                    ?>
                    </p>
                    <p><strong>Mode: </strong>
                    <?php
                    $payment_method = "Cash";
                    if (!empty($payment_history)) {
                        $latest_payment = end($payment_history);
                        if ($latest_payment['method'] == 1) $payment_method = "Cash";
                        else if ($latest_payment['method'] == 2) $payment_method = "Cheque";
                        else if ($latest_payment['method'] == 3) $payment_method = "Card";
                        else if ($latest_payment['method'] == 'paypal') $payment_method = "PayPal";
                    }
                    echo $payment_method;
                    ?>
                    </p>
                    <p><strong>Bank: </strong>
                    <?php
                    $bank_details = "";
                    if ($payment_method == "Cheque" && !empty($payment_history)) {
                        $latest_payment = end($payment_history);
                        $bank_details = isset($latest_payment['bank_details']) ? $latest_payment['bank_details'] : "";
                    }
                    echo $bank_details ? $bank_details : "_________________";
                    ?>
                    </p>
                    <p><strong>Cheque/CC/DB/DD & Inst. Date: </strong>
                    <?php
                    $instrument_date = "";
                    if (($payment_method == "Cheque" || $payment_method == "Card") && !empty($payment_history)) {
                        $latest_payment = end($payment_history);
                        $instrument_date = isset($latest_payment['instrument_date']) ? $latest_payment['instrument_date'] : "";
                    }
                    echo $instrument_date ? $instrument_date : "_________________";
                    ?>
                    </p>
                    <p>** Subject to realization of cheque.</p>
                    <p>* Optional</p>
                </td>
                <td width="30%" style="text-align: right; vertical-align: bottom;">
                    <p style="margin-top: 60px;"><strong>(CASHIER)</strong></p>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
        } catch (Exception $e) {
            error_log('Error processing invoice detail: ' . $e->getMessage());
            echo '<div class="alert alert-danger">Error processing invoice: ' . $e->getMessage() . '</div>';
        }
    endforeach;
} catch (Exception $e) {
    error_log('Error retrieving invoice: ' . $e->getMessage());
    echo '<div class="alert alert-danger">Error retrieving invoice: ' . $e->getMessage() . '</div>';
}
?>

<script type="text/javascript">
    // Function to close modal
    function closeModal() {
        $('#modal_ajax').modal('hide');
    }

    // Print invoice function
    function printInvoice() {
        var printContents = document.getElementById('invoice_print').innerHTML;
        var originalContents = document.body.innerHTML;
        
        // Create a new window for printing
        var printWindow = window.open('', '_blank', 'height=600,width=800');
        
        printWindow.document.write('<!DOCTYPE html>');
        printWindow.document.write('<html><head><title>Fee Receipt</title>');
        printWindow.document.write('<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">');
        printWindow.document.write('<style>');
        printWindow.document.write('body { font-family: Arial, sans-serif; font-size: 12px; margin: 15px; }');
        printWindow.document.write('@media print { @page { size: portrait; margin: 10mm; } }');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(printContents);
        printWindow.document.write('</body></html>');
        
        printWindow.document.close();
        printWindow.focus();
        
        // Print after a short delay to ensure content is loaded
        setTimeout(function() {
            printWindow.print();
            printWindow.close();
        }, 500);
        
        return true;
    }
</script>
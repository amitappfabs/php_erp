<?php
// Enhanced print invoice with comprehensive fee and payment details display
// Debug mode - show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<!-- Debug: Starting print invoice process for invoice_id: " . $invoice_id . " -->\n";

// Get invoice data with error handling
try {
    $invoices = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->result_array();
    
    if (empty($invoices)) {
        echo '<div class="alert alert-danger">No invoice found with ID: ' . $invoice_id . '</div>';
        return;
    }
    
    foreach ($invoices as $key => $row):
        // Get student info
        $student_info = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
        if (!$student_info) {
            $student_info = new stdClass();
            $student_info->name = 'Unknown Student';
            $student_info->admission_number = 'N/A';
            $student_info->phone = '';
            $student_info->father_phone = '';
            $student_info->address = 'N/A';
            $student_info->class_id = 0;
            $student_info->section_id = 0;
            $student_info->student_code = 'N/A';
        }
        
        // Get class info
        $class_info = $this->db->get_where('class', array('class_id' => $student_info->class_id))->row();
        if (!$class_info) {
            $class_info = new stdClass();
            $class_info->name = 'Unknown Class';
        }
        
        // Get section info
        $section_info = null;
        if ($student_info->section_id) {
            $section_info = $this->db->get_where('section', array('section_id' => $student_info->section_id))->row();
        }
        
        // Debug section loading
        echo "<!-- Debug: Student section_id: " . $student_info->section_id . " -->\n";
        if ($section_info) {
            echo "<!-- Debug: Section found: " . $section_info->name . " -->\n";
        } else {
            echo "<!-- Debug: No section found for section_id: " . $student_info->section_id . " -->\n";
        }
        
        // Get parent info
        $parent_info = null;
        if (isset($student_info->parent_id)) {
            $parent_info = $this->db->get_where('parent', array('parent_id' => $student_info->parent_id))->row();
        }
        
        // Get system info
        $currency_result = $this->db->get_where('settings', array('type' => 'currency'))->row();
        $currency = $currency_result ? $currency_result->description : '₹';
        
        // Get payment details
        $payment_history = $this->db->get_where('payment', array('invoice_id' => $row['invoice_id']))->result_array();
        
        // Get fee items
        $fee_items = $this->db->get_where('fee_items', array('invoice_id' => $row['invoice_id']))->result_array();
        
        echo "<!-- Debug: Found " . count($fee_items) . " fee items -->\n";
        
        // Payment method details
        $payment_method = "Cash";
        $payment_method_full = "Cash Payment";
        $description = "";
        
        if (!empty($payment_history)) {
            $latest_payment = end($payment_history);
            $method_code = isset($latest_payment['method']) ? $latest_payment['method'] : '2';
            switch($method_code) {
                case '1':
                    $payment_method = "Card";
                    $payment_method_full = "Credit/Debit Card";
                    break;
                case '2':
                    $payment_method = "Cash";
                    $payment_method_full = "Cash Payment";
                    break;
                case '3':
                    $payment_method = "Cheque";
                    $payment_method_full = "Bank Cheque";
                    break;
                case 'paypal':
                    $payment_method = "PayPal";
                    $payment_method_full = "PayPal Online Payment";
                    break;
            }
            
            if (isset($latest_payment['description'])) {
                $description = $latest_payment['description'];
            }
        }
        
        // Calculate discount/concession
        $discount_amount = isset($row['discount']) ? $row['discount'] : 0;
        $discount_type = isset($row['discount_type']) ? $row['discount_type'] : '';
        $concession = 0;
        
        if ($discount_amount > 0) {
            if ($discount_amount <= 100 && $discount_type != '' && $discount_type != 'no_discount') {
                $concession = ($row['amount'] * $discount_amount) / 100;
            } else {
                $concession = $discount_amount;
            }
        }
        
        // Get description from invoice if empty
        if (empty($description) && !empty($row['description'])) {
            $description = $row['description'];
        }
        
        // Prepare fee breakdown
        $fee_breakdown = array();
        
        if (!empty($fee_items)) {
            foreach ($fee_items as $fee_item) {
                $fee_breakdown[] = array(
                    'fee_type' => $fee_item['fee_type'],
                    'amount' => $fee_item['amount']
                );
            }
        } else {
            // Fallback to invoice data
            $fee_types_raw = $row['fee_type'];
            if (strpos($fee_types_raw, ',') !== false) {
                $fee_types_array = explode(',', $fee_types_raw);
                $amount_per_fee = $row['amount'] / count($fee_types_array);
                foreach ($fee_types_array as $fee_type) {
                    $fee_type = trim($fee_type);
                    if (!empty($fee_type)) {
                        $fee_breakdown[] = array(
                            'fee_type' => $fee_type,
                            'amount' => $amount_per_fee
                        );
                    }
                }
            } else {
                $fee_breakdown[] = array(
                    'fee_type' => $fee_types_raw,
                    'amount' => $row['amount']
                );
            }
        }
        
        echo "<!-- Debug: Prepared " . count($fee_breakdown) . " fee breakdown items -->\n";
        
        // Fix timestamp handling - convert string to int if needed
        $creation_timestamp = $row['creation_timestamp'];
        if (is_string($creation_timestamp)) {
            // If it's a date string like '2019-11-12', convert to timestamp
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $creation_timestamp)) {
                $creation_timestamp = strtotime($creation_timestamp);
            } else if (is_numeric($creation_timestamp)) {
                // If it's a numeric string, convert to int
                $creation_timestamp = (int)$creation_timestamp;
            } else {
                // Fallback to current time if can't parse
                $creation_timestamp = time();
            }
        }
        
        // Ensure we have a valid timestamp
        if (!$creation_timestamp || $creation_timestamp <= 0) {
            $creation_timestamp = time();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        @media print {
            @page {
                size: portrait;
                margin: 5mm;
            }
            .no-print {
                display: none;
            }
        }
        #invoice_print {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 10px;
        }
        .school-logo {
            max-height: 80px;
        }
        .receipt-title {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            padding: 5px 0;
            margin: 10px 0;
            font-weight: bold;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
        }
        .fees-table th, .fees-table td {
            border: 1px solid #000;
            text-align: center;
        }
        .fees-table th {
            background-color: #f5f5f5;
        }
        .label-cell {
            font-weight: bold;
            width: 35%;
        }
        .colon-cell {
            width: 5%;
        }
        .value-cell {
            width: 60%;
        }
        .totals-row {
            font-weight: bold;
            border-top: 2px solid #000;
        }
        .payment-summary-enhanced {
            margin-top: 10px;
            border: 1px solid #000;
        }
        .payment-summary-enhanced th {
            background-color: #f5f5f5;
            font-weight: bold;
            padding: 8px;
        }
        .payment-summary-enhanced td {
            padding: 8px;
        }
        .highlight-amount {
            color: #d9534f;
            font-weight: bold;
        }
        .discount-info {
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            padding: 8px;
            margin: 5px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin: 20px;">
        <button onclick="window.print()">Print</button>
        <button onclick="window.close()">Close</button>
    </div>

    <div id="invoice_print">
        <!-- Header Section -->
        <table border="0" width="100%">
            <tr>
                <td width="15%" align="center">
                    <img src="<?php echo base_url('uploads/school_logo.png.png'); ?>" class="school-logo" alt="School Logo">
                </td>
                <td width="85%" align="left" style="padding-left: 140px;">
                    <h2 style="margin: 0; font-weight: bold; text-transform: uppercase; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; JP International</h2>
                    <p style="margin: 0;">Sector 36, Suncity Township-I, Rohtak, Haryana 124001</p>
                    <p style="margin: 0;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Contact Nos.: 09896346876</p>
                    <p style="margin: 0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Website: https://jprtk.com/</p>
                </td>
            </tr>
        </table>
        
        <!-- Receipt Title -->
        <div class="receipt-title">
            <h3 style="margin: 0;">FEE RECEIPT (<?php echo date('Y').'-'.(date('Y')+1); ?>)</h3>
        </div>
        
        <!-- Receipt Details -->
        <table border="0" width="100%">
            <tr>
                <td width="50%" valign="top">
                    <table border="0" width="100%">
                        <tr>
                            <td class="label-cell">Receipt No</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell"><strong><?php echo sprintf('%03d', $row['invoice_id']); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Invoice ID</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell"><strong><?php echo $row['invoice_id']; ?></strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Name</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell">
                                <?php 
                                    echo $student_info->name;
                                    if ($parent_info && !empty($parent_info->name)) {
                                        echo " S/D/O " . $parent_info->name;
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Admn No</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell"><?php echo $student_info->admission_number; ?></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Class & Section</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell"><strong><?php echo $class_info->name; ?><?php if($section_info) echo ' - ' . $section_info->name; ?></strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Contact No</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell">
                                <?php 
                                    $contacts = array();
                                    if (!empty($student_info->phone)) $contacts[] = $student_info->phone;
                                    if (!empty($student_info->father_phone)) $contacts[] = $student_info->father_phone;
                                    echo implode(', ', $contacts);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-cell">Address</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell"><?php echo $student_info->address; ?></td>
                        </tr>
                    </table>
                </td>
                <td width="50%" valign="top">
                    <table border="0" width="100%">
                        <tr>
                            <td class="label-cell">Date</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell"><?php echo date('d-M-Y', $creation_timestamp); ?></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Fee Month</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell"><?php echo date('F Y', $creation_timestamp); ?></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Payment Method</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell"><strong><?php echo $payment_method_full; ?></strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">Payment Status</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell">
                                <strong style="color: <?php echo ($row['status'] == '1') ? 'green' : 'red'; ?>">
                                <?php 
                                    if ($row['status'] == '1') {
                                        echo 'PAID';
                                    } else if ($row['status'] == '2') {
                                        echo 'UNPAID';
                                    } else {
                                        echo 'PENDING';
                                    }
                                ?>
                                </strong>
                            </td>
                        </tr>
                        <?php if (!empty($description)): ?>
                        <tr>
                            <td class="label-cell">Description</td>
                            <td class="colon-cell">:</td>
                            <td class="value-cell"><?php echo htmlspecialchars($description); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </td>
            </tr>
        </table>
        
        <!-- Fee Breakdown Title -->
        <div style="margin: 10px 0; text-align: center; background-color: #f5f5f5; padding: 5px; border: 1px solid #ddd;">
            <h4 style="margin: 0;">DETAILED FEE BREAKDOWN</h4>
        </div>
        
        <!-- Fee Items Table -->
        <table class="fees-table" border="1" style="margin-top: 5px;">
            <thead>
                <tr>
                    <th>Fee Description</th>
                    <th>Previous Due</th>
                    <th>Previous Adv</th>
                    <th>Current Fees</th>
                    <th>Total To Pay</th>
                    <th>Amount Paid</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_amount = 0;
                foreach ($fee_breakdown as $fee_item) {
                    $total_amount += $fee_item['amount'];
                    ?>
                    <tr>
                        <td><strong><?php echo strtoupper(htmlspecialchars($fee_item['fee_type'])); ?></strong></td>
                        <td>0</td>
                        <td>0</td>
                        <td><?php echo $currency; ?> <?php echo number_format($fee_item['amount'],2,".",",");?></td>
                        <td><?php echo $currency; ?> <?php echo number_format($fee_item['amount'],2,".",",");?></td>
                        <td class="highlight-amount">0</td>
                    </tr>
                <?php
                }
                ?>
                <tr class="totals-row">
                    <td style="text-align: center; font-weight: bold;">GROSS TOTAL</td>
                    <td><strong>0</strong></td>
                    <td><strong>0</strong></td>
                    <td><strong><?php echo $currency; ?> <?php echo number_format($total_amount,2,".",",");?></strong></td>
                    <td><strong><?php echo $currency; ?> <?php echo number_format($total_amount,2,".",",");?></strong></td>
                    <td class="highlight-amount"><strong>0</strong></td>
                </tr>
            </tbody>
        </table>
        
        <!-- Discount Information -->
        <?php if ($concession > 0 && !empty($discount_type) && $discount_type != 'no_discount'): ?>
        <div class="discount-info">
            <table border="0" width="100%">
                <tr>
                    <td width="70%"><strong>Concession Applied:</strong> <?php echo ucwords(str_replace('_', ' ', htmlspecialchars($discount_type))); ?></td>
                    <td width="30%" align="right"><strong><?php echo $currency; ?> <?php echo number_format($concession,2,".",","); ?></strong></td>
                </tr>
            </table>
        </div>
        <?php endif; ?>
        
        <!-- Payment Summary -->
        <table class="payment-summary-enhanced" border="1" style="margin-top: 10px; width: 100%;">
            <tr style="background-color: #f5f5f5;">
                <th colspan="2" style="text-align: center; padding: 8px; font-size: 14px;">PAYMENT SUMMARY</th>
            </tr>
            <tr>
                <th style="padding: 8px; text-align: left; background-color: #f9f9f9;">Total Fee Amount</th>
                <td style="padding: 8px; text-align: right; font-weight: bold;"><?php echo $currency; ?> <?php echo number_format($row['amount'],2,".",",");?></td>
            </tr>
            <?php if ($concession > 0): ?>
            <tr>
                <th style="padding: 8px; text-align: left; background-color: #f9f9f9;">Less: Concession</th>
                <td style="padding: 8px; text-align: right; color: #d9534f; font-weight: bold;">- <?php echo $currency; ?> <?php echo number_format($concession,2,".",",");?></td>
            </tr>
            <tr>
                <th style="padding: 8px; text-align: left; background-color: #f9f9f9;">Net Amount Payable</th>
                <td style="padding: 8px; text-align: right; font-weight: bold;"><?php echo $currency; ?> <?php echo number_format($row['amount'] - $concession,2,".",",");?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <th style="padding: 8px; text-align: left; background-color: #d9edf7;">Amount Paid</th>
                <td style="padding: 8px; text-align: right; color: #5cb85c; font-weight: bold; background-color: #d9edf7;"><?php echo $currency; ?> <?php echo number_format($row['amount_paid'],2,".",",");?></td>
            </tr>
            <tr>
                <th style="padding: 8px; text-align: left; background-color: #f2dede;">Outstanding Balance</th>
                <td style="padding: 8px; text-align: right; color: #d9534f; font-weight: bold; background-color: #f2dede;"><?php echo $currency; ?> <?php echo number_format($row['due'],2,".",",");?></td>
            </tr>
            <tr>
                <th style="padding: 8px; text-align: left; background-color: #f5f5f5;">Payment Mode</th>
                <td style="padding: 8px; text-align: right; font-weight: bold; background-color: #f5f5f5;"><?php echo htmlspecialchars($payment_method_full); ?></td>
            </tr>
        </table>
        
        <!-- Footer Section -->
        <div style="margin-top: 15px;">
            <table border="0" width="100%">
                <tr>
                    <td width="70%" valign="top">
                        <!-- <p><strong>Amount in Words: </strong><?php 
                        //     $outstanding_balance = (float)$row['due'];
                        //     if ($outstanding_balance == 0) {
                        //         echo "Zero";
                        //     } else if ($outstanding_balance < 100) {
                        //         echo ucfirst(number_format($outstanding_balance, 0));
                        //     } else {
                        //         echo "Amount as stated above";
                        //     }
                        // ?> Only</p> -->
                        <?php if (!empty($row['title']) && $row['title'] != 'Fee Payment'): ?>
                        <p><strong>Payment Title: </strong><?php echo htmlspecialchars($row['title']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($description)): ?>
                        <p><strong>Remarks: </strong><?php echo htmlspecialchars($description); ?></p>
                        <?php endif; ?>
                    </td>
                    <td width="30%" valign="top">
                        <div style="text-align: right; margin-top: 30px; font-weight: bold;">
                            <p>_________________</p>
                            <p><strong>(CASHIER)</strong></p>
                            <p style="font-size: 10px; margin-top: 10px;">Date: <?php echo date('d-M-Y'); ?></p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        // Auto print when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 1000);
        };
    </script>
</body>
</html>
<?php
    endforeach;
} catch (Exception $e) {
    echo '<div style="color: red; padding: 20px;">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    echo '<div style="color: red;">File: ' . htmlspecialchars($e->getFile()) . '</div>';
    echo '<div style="color: red;">Line: ' . $e->getLine() . '</div>';
}
?>

<!-- Debug: End of print invoice process --> 
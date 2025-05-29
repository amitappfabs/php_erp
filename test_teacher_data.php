<?php
// Test script to check teacher data fetching
// Navigate to: http://localhost:8080/test_teacher_data.php

// Include CodeIgniter bootstrap
require_once(dirname(__FILE__) . '/index.php');

// Get the CI instance
$CI = &get_instance();
$CI->load->database();

echo "<h2>Teacher Data Test</h2>";
echo "<pre>";

try {
    // Get a teacher record
    echo "Testing teacher data fetching...\n\n";
    
    $teachers = $CI->db->get('teacher')->result_array();
    
    if (empty($teachers)) {
        echo "No teachers found in database.\n";
    } else {
        $teacher = $teachers[0]; // Get first teacher
        echo "First teacher data:\n";
        echo "==================\n";
        
        foreach ($teacher as $field => $value) {
            echo "$field: " . ($value ? $value : 'NULL/Empty') . "\n";
        }
        
        echo "\n\nChecking specific new fields:\n";
        echo "=============================\n";
        
        $new_fields = ['aadhar_number', 'pan_number', 'family_id'];
        foreach ($new_fields as $field) {
            if (isset($teacher[$field])) {
                echo "✓ $field: " . ($teacher[$field] ? $teacher[$field] : 'Empty') . "\n";
            } else {
                echo "✗ $field: Field does not exist in database\n";
            }
        }
        
        // Check bank data
        if (isset($teacher['bank_id']) && $teacher['bank_id']) {
            echo "\n\nBank data for teacher:\n";
            echo "=====================\n";
            
            $bank = $CI->db->get_where('bank', array('bank_id' => $teacher['bank_id']))->row_array();
            if ($bank) {
                foreach ($bank as $field => $value) {
                    echo "$field: " . ($value ? $value : 'NULL/Empty') . "\n";
                }
                
                echo "\nChecking IFSC Code:\n";
                if (isset($bank['ifsc_code'])) {
                    echo "✓ ifsc_code: " . ($bank['ifsc_code'] ? $bank['ifsc_code'] : 'Empty') . "\n";
                } else {
                    echo "✗ ifsc_code: Field does not exist in bank table\n";
                }
            } else {
                echo "No bank record found for bank_id: " . $teacher['bank_id'] . "\n";
            }
        } else {
            echo "\n\nNo bank_id found for this teacher.\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "</pre>";
echo "<p><strong>Please delete this file after testing.</strong></p>";
?> 
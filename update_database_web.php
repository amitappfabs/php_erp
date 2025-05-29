<?php
// Web-accessible database update script
// Navigate to: http://localhost:8080/update_database_web.php

// Include CodeIgniter bootstrap to access database
require_once(dirname(__FILE__) . '/index.php');

// Get the CI instance
$CI = &get_instance();
$CI->load->database();

echo "<h2>Database Update Script</h2>";
echo "<pre>";

try {
    // Check and add missing columns to teacher table
    echo "Checking teacher table structure...\n";
    
    $teacher_columns = [];
    $result = $CI->db->query("DESCRIBE teacher");
    if ($result) {
        foreach ($result->result_array() as $row) {
            $teacher_columns[] = $row['Field'];
        }
    }
    
    $new_teacher_columns = [
        'aadhar_number' => "ALTER TABLE `teacher` ADD COLUMN `aadhar_number` VARCHAR(12) NULL",
        'pan_number' => "ALTER TABLE `teacher` ADD COLUMN `pan_number` VARCHAR(10) NULL",
        'family_id' => "ALTER TABLE `teacher` ADD COLUMN `family_id` VARCHAR(50) NULL"
    ];
    
    foreach ($new_teacher_columns as $column => $sql) {
        if (!in_array($column, $teacher_columns)) {
            echo "Adding column: $column\n";
            $CI->db->query($sql);
            if ($CI->db->error()['code'] != 0) {
                echo "Error: " . $CI->db->error()['message'] . "\n";
            } else {
                echo "Successfully added $column to teacher table\n";
            }
        } else {
            echo "Column $column already exists in teacher table\n";
        }
    }
    
    // Check and add missing columns to bank table
    echo "\nChecking bank table structure...\n";
    
    $bank_columns = [];
    $result = $CI->db->query("DESCRIBE bank");
    if ($result) {
        foreach ($result->result_array() as $row) {
            $bank_columns[] = $row['Field'];
        }
    }
    
    if (!in_array('ifsc_code', $bank_columns)) {
        echo "Adding column: ifsc_code\n";
        $CI->db->query("ALTER TABLE `bank` ADD COLUMN `ifsc_code` VARCHAR(11) NULL");
        if ($CI->db->error()['code'] != 0) {
            echo "Error: " . $CI->db->error()['message'] . "\n";
        } else {
            echo "Successfully added ifsc_code to bank table\n";
        }
    } else {
        echo "Column ifsc_code already exists in bank table\n";
    }
    
    echo "\nDatabase update completed successfully!\n";
    echo "You can now delete this file for security.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "</pre>";
echo "<p><strong>Please delete this file after use for security reasons.</strong></p>";
?> 
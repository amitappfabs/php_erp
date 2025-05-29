<?php
// Standalone Database Update Script
// This script bypasses CodeIgniter routing and connects directly to the database

// Database configuration (from your CodeIgniter config)
$hostname = 'db';
$username = 'root';
$password = '';
$database = 'school';

echo "<h2>Standalone Database Update Script</h2>";
echo "<pre>";

try {
    // Create database connection
    echo "Attempting to connect to database...\n";
    echo "Host: $hostname\n";
    echo "Database: $database\n";
    echo "Username: $username\n\n";
    
    $mysqli = new mysqli($hostname, $username, $password, $database);
    
    // Check connection
    if ($mysqli->connect_error) {
        throw new Exception("Connection failed: " . $mysqli->connect_error);
    }
    
    echo "✓ Connected successfully to database: $database\n\n";
    
    // Check current table structures
    echo "Checking current table structures...\n";
    echo "====================================\n";
    
    // Check teacher table columns
    $teacher_columns = [];
    $result = $mysqli->query("DESCRIBE teacher");
    if ($result) {
        echo "Current teacher table columns:\n";
        while ($row = $result->fetch_assoc()) {
            $teacher_columns[] = $row['Field'];
            echo "  - " . $row['Field'] . " (" . $row['Type'] . ")\n";
        }
    }
    
    echo "\n";
    
    // Check bank table columns
    $bank_columns = [];
    $result = $mysqli->query("DESCRIBE bank");
    if ($result) {
        echo "Current bank table columns:\n";
        while ($row = $result->fetch_assoc()) {
            $bank_columns[] = $row['Field'];
            echo "  - " . $row['Field'] . " (" . $row['Type'] . ")\n";
        }
    }
    
    echo "\n";
    echo "Adding missing columns...\n";
    echo "========================\n";
    
    // Add missing columns to teacher table
    $new_teacher_columns = [
        'aadhar_number' => "ALTER TABLE `teacher` ADD COLUMN `aadhar_number` VARCHAR(12) NULL",
        'pan_number' => "ALTER TABLE `teacher` ADD COLUMN `pan_number` VARCHAR(10) NULL",
        'family_id' => "ALTER TABLE `teacher` ADD COLUMN `family_id` VARCHAR(50) NULL"
    ];
    
    foreach ($new_teacher_columns as $column => $sql) {
        if (!in_array($column, $teacher_columns)) {
            if ($mysqli->query($sql)) {
                echo "✓ Added teacher.$column column\n";
            } else {
                echo "✗ Error adding teacher.$column: " . $mysqli->error . "\n";
            }
        } else {
            echo "- teacher.$column already exists\n";
        }
    }
    
    // Add missing columns to bank table
    $new_bank_columns = [
        'ifsc_code' => "ALTER TABLE `bank` ADD COLUMN `ifsc_code` VARCHAR(11) NULL"
    ];
    
    foreach ($new_bank_columns as $column => $sql) {
        if (!in_array($column, $bank_columns)) {
            if ($mysqli->query($sql)) {
                echo "✓ Added bank.$column column\n";
            } else {
                echo "✗ Error adding bank.$column: " . $mysqli->error . "\n";
            }
        } else {
            echo "- bank.$column already exists\n";
        }
    }
    
    echo "\n";
    echo "Verifying changes...\n";
    echo "==================\n";
    
    // Verify teacher table
    $result = $mysqli->query("DESCRIBE teacher");
    if ($result) {
        $updated_teacher_columns = [];
        while ($row = $result->fetch_assoc()) {
            $updated_teacher_columns[] = $row['Field'];
        }
        
        foreach (['aadhar_number', 'pan_number', 'family_id'] as $field) {
            if (in_array($field, $updated_teacher_columns)) {
                echo "✓ teacher.$field is present\n";
            } else {
                echo "✗ teacher.$field is missing\n";
            }
        }
    }
    
    // Verify bank table
    $result = $mysqli->query("DESCRIBE bank");
    if ($result) {
        $updated_bank_columns = [];
        while ($row = $result->fetch_assoc()) {
            $updated_bank_columns[] = $row['Field'];
        }
        
        if (in_array('ifsc_code', $updated_bank_columns)) {
            echo "✓ bank.ifsc_code is present\n";
        } else {
            echo "✗ bank.ifsc_code is missing\n";
        }
    }
    
    echo "\n";
    echo "🎉 Database update process completed!\n";
    echo "\nYou can now:\n";
    echo "1. Test adding a new teacher\n";
    echo "2. Test editing an existing teacher\n";
    echo "3. Check the view modal for complete information\n";
    echo "\nPlease delete this file after successful testing.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "\nTroubleshooting:\n";
    echo "- Check if your Docker containers are running\n";
    echo "- Verify database connection details\n";
    echo "- Ensure the database exists\n";
}

echo "</pre>";
?> 
<?php
// Database update script for teacher form modifications
// This script adds the new fields to the teacher and bank tables

// Include CodeIgniter database configuration
require_once('application/config/database.php');

// Create database connection
$mysqli = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully to database: " . $db['default']['database'] . "\n";

// SQL queries to update the database
$queries = array(
    // Add new fields to teacher table
    "ALTER TABLE `teacher` ADD COLUMN `aadhar_number` VARCHAR(12) NULL AFTER `linkedin`",
    "ALTER TABLE `teacher` ADD COLUMN `pan_number` VARCHAR(10) NULL AFTER `aadhar_number`",
    "ALTER TABLE `teacher` ADD COLUMN `family_id` VARCHAR(50) NULL AFTER `pan_number`",
    
    // Add IFSC code field to bank table
    "ALTER TABLE `bank` ADD COLUMN `ifsc_code` VARCHAR(11) NULL AFTER `branch`"
);

// Execute each query
foreach ($queries as $query) {
    echo "Executing: " . $query . "\n";
    
    if ($mysqli->query($query) === TRUE) {
        echo "✓ Query executed successfully\n";
    } else {
        // Check if error is because column already exists
        if (strpos($mysqli->error, "Duplicate column name") !== false) {
            echo "⚠ Column already exists, skipping...\n";
        } else {
            echo "✗ Error: " . $mysqli->error . "\n";
        }
    }
    echo "\n";
}

// Verify the changes
echo "Verifying table structure...\n";

// Check teacher table structure
$result = $mysqli->query("DESCRIBE teacher");
echo "\nTeacher table columns:\n";
while ($row = $result->fetch_assoc()) {
    if (in_array($row['Field'], ['aadhar_number', 'pan_number', 'family_id'])) {
        echo "✓ " . $row['Field'] . " - " . $row['Type'] . "\n";
    }
}

// Check bank table structure
$result = $mysqli->query("DESCRIBE bank");
echo "\nBank table columns:\n";
while ($row = $result->fetch_assoc()) {
    if ($row['Field'] == 'ifsc_code') {
        echo "✓ " . $row['Field'] . " - " . $row['Type'] . "\n";
    }
}

$mysqli->close();
echo "\nDatabase update completed!\n";
?> 
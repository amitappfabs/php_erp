<?php
// Fix database by adding missing columns
require_once('application/config/database.php');

// Create database connection
$mysqli = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully to database: " . $db['default']['database'] . "\n\n";

// Check and add missing columns to teacher table
$teacher_columns = [];
$result = $mysqli->query("DESCRIBE teacher");
while ($row = $result->fetch_assoc()) {
    $teacher_columns[] = $row['Field'];
}

$new_teacher_columns = [
    'aadhar_number' => "ALTER TABLE `teacher` ADD COLUMN `aadhar_number` VARCHAR(12) NULL",
    'pan_number' => "ALTER TABLE `teacher` ADD COLUMN `pan_number` VARCHAR(10) NULL", 
    'family_id' => "ALTER TABLE `teacher` ADD COLUMN `family_id` VARCHAR(50) NULL"
];

foreach ($new_teacher_columns as $column => $sql) {
    if (!in_array($column, $teacher_columns)) {
        echo "Adding column $column to teacher table...\n";
        if ($mysqli->query($sql)) {
            echo "✓ Successfully added $column\n";
        } else {
            echo "✗ Error adding $column: " . $mysqli->error . "\n";
        }
    } else {
        echo "✓ Column $column already exists in teacher table\n";
    }
}

// Check and add missing columns to bank table
$bank_columns = [];
$result = $mysqli->query("DESCRIBE bank");
while ($row = $result->fetch_assoc()) {
    $bank_columns[] = $row['Field'];
}

if (!in_array('ifsc_code', $bank_columns)) {
    echo "\nAdding ifsc_code column to bank table...\n";
    $sql = "ALTER TABLE `bank` ADD COLUMN `ifsc_code` VARCHAR(11) NULL";
    if ($mysqli->query($sql)) {
        echo "✓ Successfully added ifsc_code\n";
    } else {
        echo "✗ Error adding ifsc_code: " . $mysqli->error . "\n";
    }
} else {
    echo "\n✓ Column ifsc_code already exists in bank table\n";
}

echo "\nDatabase update completed!\n";
$mysqli->close();
?> 
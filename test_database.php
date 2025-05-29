<?php
// Test database connection and table structure
require_once('application/config/database.php');

// Create database connection
$mysqli = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully to database: " . $db['default']['database'] . "\n\n";

// Check teacher table structure
echo "Teacher table structure:\n";
echo "========================\n";
$result = $mysqli->query("DESCRIBE teacher");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo $row['Field'] . " - " . $row['Type'] . " - " . $row['Null'] . " - " . $row['Default'] . "\n";
    }
} else {
    echo "Error: " . $mysqli->error . "\n";
}

echo "\n\nBank table structure:\n";
echo "=====================\n";
$result = $mysqli->query("DESCRIBE bank");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo $row['Field'] . " - " . $row['Type'] . " - " . $row['Null'] . " - " . $row['Default'] . "\n";
    }
} else {
    echo "Error: " . $mysqli->error . "\n";
}

// Check if new columns exist
echo "\n\nChecking for new columns:\n";
echo "=========================\n";

$new_teacher_columns = ['aadhar_number', 'pan_number', 'family_id'];
$teacher_columns = [];
$result = $mysqli->query("DESCRIBE teacher");
while ($row = $result->fetch_assoc()) {
    $teacher_columns[] = $row['Field'];
}

foreach ($new_teacher_columns as $column) {
    if (in_array($column, $teacher_columns)) {
        echo "✓ Teacher table has column: $column\n";
    } else {
        echo "✗ Teacher table missing column: $column\n";
    }
}

$bank_columns = [];
$result = $mysqli->query("DESCRIBE bank");
while ($row = $result->fetch_assoc()) {
    $bank_columns[] = $row['Field'];
}

if (in_array('ifsc_code', $bank_columns)) {
    echo "✓ Bank table has column: ifsc_code\n";
} else {
    echo "✗ Bank table missing column: ifsc_code\n";
}

$mysqli->close();
?> 
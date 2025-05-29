<?php
// Debug teacher insertion process
require_once('application/config/database.php');

// Create database connection
$mysqli = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully to database: " . $db['default']['database'] . "\n\n";

// Test 1: Check if tables exist
echo "Test 1: Checking if tables exist\n";
echo "=================================\n";

$tables = ['teacher', 'bank'];
foreach ($tables as $table) {
    $result = $mysqli->query("SHOW TABLES LIKE '$table'");
    if ($result->num_rows > 0) {
        echo "✓ Table $table exists\n";
    } else {
        echo "✗ Table $table does not exist\n";
    }
}

// Test 2: Check table structures
echo "\nTest 2: Checking table structures\n";
echo "==================================\n";

// Check teacher table
$result = $mysqli->query("DESCRIBE teacher");
$teacher_columns = [];
while ($row = $result->fetch_assoc()) {
    $teacher_columns[] = $row['Field'];
}

$required_teacher_columns = ['teacher_id', 'name', 'email', 'phone', 'bank_id', 'aadhar_number', 'pan_number', 'family_id'];
foreach ($required_teacher_columns as $column) {
    if (in_array($column, $teacher_columns)) {
        echo "✓ Teacher table has column: $column\n";
    } else {
        echo "✗ Teacher table missing column: $column\n";
    }
}

// Check bank table
$result = $mysqli->query("DESCRIBE bank");
$bank_columns = [];
while ($row = $result->fetch_assoc()) {
    $bank_columns[] = $row['Field'];
}

$required_bank_columns = ['bank_id', 'account_holder_name', 'account_number', 'bank_name', 'ifsc_code'];
foreach ($required_bank_columns as $column) {
    if (in_array($column, $bank_columns)) {
        echo "✓ Bank table has column: $column\n";
    } else {
        echo "✗ Bank table missing column: $column\n";
    }
}

// Test 3: Try inserting test data
echo "\nTest 3: Testing data insertion\n";
echo "===============================\n";

// Test bank insertion
$bank_data = [
    'account_holder_name' => 'Test User',
    'account_number' => '1234567890',
    'bank_name' => 'Test Bank',
    'branch' => 'Test Branch',
    'ifsc_code' => 'TEST0001234'
];

$bank_sql = "INSERT INTO bank (account_holder_name, account_number, bank_name, branch, ifsc_code) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($bank_sql);
$stmt->bind_param("sssss", $bank_data['account_holder_name'], $bank_data['account_number'], $bank_data['bank_name'], $bank_data['branch'], $bank_data['ifsc_code']);

if ($stmt->execute()) {
    $bank_id = $mysqli->insert_id();
    echo "✓ Bank record inserted successfully with ID: $bank_id\n";
    
    // Test teacher insertion
    $teacher_data = [
        'name' => 'Test Teacher',
        'email' => 'test' . time() . '@example.com',
        'phone' => '1234567890',
        'role' => '1',
        'teacher_number' => 'T' . time(),
        'birthday' => '1990-01-01',
        'sex' => 'male',
        'religion' => 'Test Religion',
        'blood_group' => 'A+',
        'address' => 'Test Address',
        'facebook' => '',
        'twitter' => '',
        'linkedin' => '',
        'qualification' => 'Test Qualification',
        'marital_status' => 'Single',
        'password' => sha1('password123'),
        'date_of_joining' => date('Y-m-d'),
        'joining_salary' => '50000',
        'aadhar_number' => '123456789012',
        'pan_number' => 'ABCDE1234F',
        'family_id' => 'FAM001',
        'status' => '1',
        'date_of_leaving' => '',
        'file_name' => '',
        'bank_id' => $bank_id
    ];
    
    $teacher_sql = "INSERT INTO teacher (name, email, phone, role, teacher_number, birthday, sex, religion, blood_group, address, facebook, twitter, linkedin, qualification, marital_status, password, date_of_joining, joining_salary, aadhar_number, pan_number, family_id, status, date_of_leaving, file_name, bank_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt2 = $mysqli->prepare($teacher_sql);
    $stmt2->bind_param("ssssssssssssssssssssssssi", 
        $teacher_data['name'], $teacher_data['email'], $teacher_data['phone'], $teacher_data['role'],
        $teacher_data['teacher_number'], $teacher_data['birthday'], $teacher_data['sex'], $teacher_data['religion'],
        $teacher_data['blood_group'], $teacher_data['address'], $teacher_data['facebook'], $teacher_data['twitter'],
        $teacher_data['linkedin'], $teacher_data['qualification'], $teacher_data['marital_status'], $teacher_data['password'],
        $teacher_data['date_of_joining'], $teacher_data['joining_salary'], $teacher_data['aadhar_number'], $teacher_data['pan_number'],
        $teacher_data['family_id'], $teacher_data['status'], $teacher_data['date_of_leaving'], $teacher_data['file_name'],
        $teacher_data['bank_id']
    );
    
    if ($stmt2->execute()) {
        $teacher_id = $mysqli->insert_id();
        echo "✓ Teacher record inserted successfully with ID: $teacher_id\n";
        
        // Clean up test data
        $mysqli->query("DELETE FROM teacher WHERE teacher_id = $teacher_id");
        $mysqli->query("DELETE FROM bank WHERE bank_id = $bank_id");
        echo "✓ Test data cleaned up\n";
    } else {
        echo "✗ Teacher insertion failed: " . $stmt2->error . "\n";
    }
    
} else {
    echo "✗ Bank insertion failed: " . $stmt->error . "\n";
}

echo "\nDebug completed!\n";
$mysqli->close();
?> 
<?php
// Database setup script for teacher dashboard
require_once 'application/config/database.php';

// Get database configuration
$db_config = $db['default'];

try {
    $pdo = new PDO(
        "mysql:host={$db_config['hostname']};dbname={$db_config['database']}", 
        $db_config['username'], 
        $db_config['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully\n";
    
    // Create teacher_attendance table
    $sql1 = "CREATE TABLE IF NOT EXISTS `teacher_attendance` (
        `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
        `teacher_id` int(11) NOT NULL,
        `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=undefined, 1=present, 2=absent, 3=late, 4=half_day',
        `date` date NOT NULL,
        `year` varchar(10) NOT NULL,
        `month` varchar(10) NOT NULL,
        `day` varchar(10) NOT NULL,
        PRIMARY KEY (`attendance_id`),
        KEY `teacher_id` (`teacher_id`),
        KEY `date` (`date`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    
    $pdo->exec($sql1);
    echo "teacher_attendance table created successfully\n";
    
    // Create teacher_diary table
    $sql2 = "CREATE TABLE IF NOT EXISTS `teacher_diary` (
        `diary_id` int(11) NOT NULL AUTO_INCREMENT,
        `teacher_id` int(11) NOT NULL,
        `title` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `date` date NOT NULL,
        `time` time DEFAULT NULL,
        `class_id` int(11) DEFAULT NULL,
        `section_id` int(11) DEFAULT NULL,
        `attachment` varchar(255) DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`diary_id`),
        KEY `teacher_id` (`teacher_id`),
        KEY `class_id` (`class_id`),
        KEY `section_id` (`section_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    
    $pdo->exec($sql2);
    echo "teacher_diary table created successfully\n";
    
    // Insert some sample data for testing
    $teacher_id = 1; // Assuming teacher ID 1 exists
    
    // Sample attendance data
    $sample_attendance = [
        ['teacher_id' => $teacher_id, 'status' => 1, 'date' => date('Y-m-d'), 'year' => date('Y'), 'month' => date('m'), 'day' => date('d')],
        ['teacher_id' => $teacher_id, 'status' => 1, 'date' => date('Y-m-d', strtotime('-1 day')), 'year' => date('Y'), 'month' => date('m'), 'day' => date('d', strtotime('-1 day'))],
        ['teacher_id' => $teacher_id, 'status' => 2, 'date' => date('Y-m-d', strtotime('-2 days')), 'year' => date('Y'), 'month' => date('m'), 'day' => date('d', strtotime('-2 days'))]
    ];
    
    foreach ($sample_attendance as $attendance) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO teacher_attendance (teacher_id, status, date, year, month, day) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$attendance['teacher_id'], $attendance['status'], $attendance['date'], $attendance['year'], $attendance['month'], $attendance['day']]);
    }
    echo "Sample attendance data inserted\n";
    
    // Sample diary data
    $sample_diaries = [
        [
            'teacher_id' => $teacher_id,
            'title' => 'Mathematics Class - Algebra',
            'description' => 'Today we covered basic algebraic equations and problem-solving techniques. Students showed good understanding of the concepts.',
            'date' => date('Y-m-d'),
            'time' => '10:00:00',
            'class_id' => 1,
            'section_id' => 1
        ],
        [
            'teacher_id' => $teacher_id,
            'title' => 'Science Lab Session',
            'description' => 'Conducted experiments on chemical reactions. Students were engaged and asked many questions.',
            'date' => date('Y-m-d', strtotime('-1 day')),
            'time' => '14:00:00',
            'class_id' => 2,
            'section_id' => 1
        ]
    ];
    
    foreach ($sample_diaries as $diary) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO teacher_diary (teacher_id, title, description, date, time, class_id, section_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$diary['teacher_id'], $diary['title'], $diary['description'], $diary['date'], $diary['time'], $diary['class_id'], $diary['section_id']]);
    }
    echo "Sample diary data inserted\n";
    
    echo "Database setup completed successfully!\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 
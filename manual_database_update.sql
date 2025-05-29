-- Manual Database Update SQL
-- Copy and paste these commands into your database management tool (phpMyAdmin, etc.)

-- Add new columns to teacher table
ALTER TABLE `teacher` ADD COLUMN `aadhar_number` VARCHAR(12) NULL;
ALTER TABLE `teacher` ADD COLUMN `pan_number` VARCHAR(10) NULL;
ALTER TABLE `teacher` ADD COLUMN `family_id` VARCHAR(50) NULL;

-- Add new column to bank table
ALTER TABLE `bank` ADD COLUMN `ifsc_code` VARCHAR(11) NULL;

-- Verify the changes
DESCRIBE teacher;
DESCRIBE bank; 
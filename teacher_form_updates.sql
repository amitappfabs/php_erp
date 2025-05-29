-- Teacher Form Updates SQL
-- This file contains the database modifications needed for the updated teacher form

-- Add new fields to teacher table
ALTER TABLE `teacher` 
ADD COLUMN `aadhar_number` VARCHAR(12) NULL AFTER `linkedin`,
ADD COLUMN `pan_number` VARCHAR(10) NULL AFTER `aadhar_number`,
ADD COLUMN `family_id` VARCHAR(50) NULL AFTER `pan_number`;

-- Add IFSC code field to bank table
ALTER TABLE `bank` 
ADD COLUMN `ifsc_code` VARCHAR(11) NULL AFTER `branch`;

-- Remove googleplus field from teacher table (optional - for cleanup)
-- ALTER TABLE `teacher` DROP COLUMN `googleplus`;

-- Update existing records to set default values for new fields (optional)
-- UPDATE `teacher` SET `aadhar_number` = NULL, `pan_number` = NULL, `family_id` = NULL WHERE 1;
-- UPDATE `bank` SET `ifsc_code` = NULL WHERE 1; 
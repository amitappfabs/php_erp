<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-4">
        <input type="text" id="admissionNumberSearch" class="form-control" placeholder="<?php echo get_phrase('search_by_admission_number_code_or_name');?>">
    </div>
    <div class="col-md-2">
        <button type="button" id="searchButton" class="btn btn-primary"><?php echo get_phrase('search');?></button>
    </div>
    <div class="col-md-4">
        <select id="sortOptions" class="form-control" onchange="sortStudents()">
            <option value="">-- <?php echo get_phrase('sort_by'); ?> --</option>
            <option value="admission_asc"><?php echo get_phrase('admission_number'); ?> (<?php echo get_phrase('ascending'); ?>)</option>
            <option value="admission_desc"><?php echo get_phrase('admission_number'); ?> (<?php echo get_phrase('descending'); ?>)</option>
            <option value="name_asc"><?php echo get_phrase('name'); ?> (A-Z)</option>
            <option value="name_desc"><?php echo get_phrase('name'); ?> (Z-A)</option>
        </select>
    </div>
</div>

<table id="example" class="table display">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                            <th><div><?php echo get_phrase('admission_number');?></div></th>
                            <th><div><?php echo get_phrase('student_code');?></div></th>
                            <th><div><?php echo get_phrase('Image');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('gender');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                    		<th><div><?php echo get_phrase('actions');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                    <?php $counter = 1; $students =  $this->db->get_where('student', array('class_id' => $class_id))->result_array();
                    foreach($students as $key => $student):?>         
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo $student['admission_number'];?></td>
                            <td><?php echo isset($student['student_code']) ? $student['student_code'] : ''; ?></td>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student', $student['student_id']);?>" class="img-circle" width="30"></td>
                            <td><?php echo $student['name'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class', $student['class_id']);?></td>
							<td><?php echo $student['sex'];?></td>
                            <td><?php echo $student['email'];?></td>
                            <td><?php echo $student['phone'];?></td>
							<td>
							
							<div class="btn-group btn-group-sm" role="group" aria-label="Actions">
								<a href="<?php echo base_url();?>admin/edit_student/<?php echo $student['student_id'];?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit Student">
									<i class="fa fa-edit"></i> Edit
								</a>
								<button type="button" class="btn btn-success btn-sm" onclick="showStudentView(<?php echo $student['student_id'];?>)" data-toggle="tooltip" title="View Student Details">
									<i class="fa fa-eye"></i> View
								</button>
								<button type="button" class="btn btn-danger btn-sm" onclick="confirm_modal('<?php echo base_url();?>admin/new_student/delete/<?php echo $student['student_id'];?>');" data-toggle="tooltip" title="Delete Student">
									<i class="fa fa-trash"></i> Delete
								</button>
							</div>

			
                           
        					</td>
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>

<script type="text/javascript">
$(document).ready(function() {
    document.getElementById('searchButton').addEventListener('click', function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('admissionNumberSearch');
        filter = input.value.toUpperCase();
        table = document.getElementById('example');
        tr = table.getElementsByTagName('tr');

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) { // Start from 1 to skip table header
            var tdAdmissionNumber = tr[i].getElementsByTagName('td')[1]; // Admission Number
            var tdStudentCode = tr[i].getElementsByTagName('td')[2]; // Student Code
            var tdName = tr[i].getElementsByTagName('td')[4]; // Name
            var found = false;

            if (tdAdmissionNumber) {
                var txtValueAdmission = tdAdmissionNumber.textContent || tdAdmissionNumber.innerText;
                if (txtValueAdmission.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                }
            }
            if (!found && tdStudentCode) {
                var txtValueCode = tdStudentCode.textContent || tdStudentCode.innerText;
                if (txtValueCode.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                }
            }
            if (!found && tdName) {
                var txtValueName = tdName.textContent || tdName.innerText;
                if (txtValueName.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                }
            }

            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    });

    // Optional: Clear filter when input is empty
    document.getElementById('admissionNumberSearch').addEventListener('input', function() {
        if (this.value === '') {
            document.getElementById('searchButton').click();
        }
    });

    // Initialize tooltips for action buttons
    $('[data-toggle="tooltip"]').tooltip();
});

function sortStudents() {
    var table = document.getElementById('example');
    var sortBy = document.getElementById('sortOptions').value;
    var rows, switching, i, x, y, shouldSwitch;
    
    if (!sortBy) return; // If no sort option selected, return
    
    switching = true;
    
    // Define which columns to compare based on sort option
    var columnIndex, sortOrder;
    
    if (sortBy === 'admission_asc') {
        columnIndex = 1; // Admission Number column
        sortOrder = 'asc';
    } else if (sortBy === 'admission_desc') {
        columnIndex = 1; // Admission Number column
        sortOrder = 'desc';
    } else if (sortBy === 'name_asc') {
        columnIndex = 4; // Name column
        sortOrder = 'asc';
    } else if (sortBy === 'name_desc') {
        columnIndex = 4; // Name column
        sortOrder = 'desc';
    }
    
    while (switching) {
        switching = false;
        rows = table.rows;
        
        // Loop through table rows (starting from 1 to skip header)
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            
            // Get elements to compare
            x = rows[i].getElementsByTagName("TD")[columnIndex];
            y = rows[i + 1].getElementsByTagName("TD")[columnIndex];
            
            // Get text content for comparison
            var xContent = x.textContent || x.innerText;
            var yContent = y.textContent || y.innerText;
            
            // For admission numbers, try to convert to numbers if possible
            if (columnIndex === 1 && !isNaN(xContent) && !isNaN(yContent)) {
                xContent = parseFloat(xContent);
                yContent = parseFloat(yContent);
            }
            
            // Check if rows should switch based on sort order
            if (sortOrder === 'asc') {
                if (xContent > yContent) {
                    shouldSwitch = true;
                    break;
                }
            } else {
                if (xContent < yContent) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function showStudentView(student_id) {
    // Create a modal dialog with print and close buttons
    var modal = 
    '<div class="modal fade" id="studentViewModal" tabindex="-1" role="dialog" aria-labelledby="studentViewModalLabel">' +
        '<div class="modal-dialog modal-lg" role="document">' +
            '<div class="modal-content">' +
                '<div class="modal-header">' +
                    '<h4 class="modal-title" id="studentViewModalLabel">Student Details</h4>' +
                '</div>' +
                '<div class="modal-body" style="max-height: 70vh; overflow-y: auto;">' +
                    '<div id="student_details_content">Loading...</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                    '<button type="button" class="btn btn-default" onclick="$(\'#studentViewModal\').modal(\'hide\');">Close</button>' +
                    '<button type="button" class="btn btn-primary" onclick="printStudentDetails()"><i class="fa fa-print"></i> Print</button>' +
                '</div>' +
            '</div>' +
        '</div>' +
    '</div>';
    
    // Append modal to body if it doesn't exist
    if (!$('#studentViewModal').length) {
        $('body').append(modal);
    }
    
    // Show the modal
    $('#studentViewModal').modal('show');
    
    // Load student details via AJAX
    $.ajax({
        url: '<?php echo base_url();?>admin/get_student_details/' + student_id,
        type: 'GET',
        success: function(response) {
            $('#student_details_content').html(response);
        },
        error: function() {
            $('#student_details_content').html('<div class="alert alert-danger">Error loading student details</div>');
        }
    });
}

function printStudentDetails() {
    var printContents = document.getElementById('student_details_content').innerHTML;
    var originalContents = document.body.innerHTML;
    
    // Create print window
    document.body.innerHTML = '<div class="container">' + printContents + '</div>';
    
    // Add print styles
    var style = document.createElement('style');
    style.type = 'text/css';
    style.innerHTML = '@media print { ' +
        'body { font-family: Arial, sans-serif; }' +
        '.student-info-section { margin-bottom: 20px; }' +
        '.student-info-header { background: #f5f5f5; padding: 8px; font-weight: bold; border-bottom: 2px solid #ddd; }' +
        '.info-row { display: flex; border-bottom: 1px solid #eee; }' +
        '.info-label { width: 40%; padding: 8px; font-weight: bold; }' +
        '.info-value { width: 60%; padding: 8px; }' +
        '.student-photo { text-align: center; margin-bottom: 15px; }' +
        '.student-photo img { max-width: 150px; border: 1px solid #ddd; padding: 5px; }' +
        '.no-print { display: none !important; }' +
        'body { margin: 0; padding: 15px; }' +
    '}';
    document.head.appendChild(style);
    
    // Print and restore
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
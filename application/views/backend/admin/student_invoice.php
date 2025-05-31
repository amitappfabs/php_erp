<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('unpaid_invoices');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
                                
                                <div class="row filter-container">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="invoice_search"><?php echo get_phrase('search_by_student');?></label>
                                            <input type="text" class="form-control" id="invoice_search" placeholder="<?php echo get_phrase('enter_student_name_or_admission_number');?>">
                                            <small class="text-muted">Search by student name or admission number</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="invoice_sort_by"><?php echo get_phrase('sort_by');?></label>
                                            <select class="form-control" id="invoice_sort_by" onchange="sortInvoiceHistory()">
                                                <option value=""><?php echo get_phrase('select_sorting_option');?></option>
                                                <option value="amount_asc"><?php echo get_phrase('amount');?> (<?php echo get_phrase('ascending');?>)</option>
                                                <option value="amount_desc"><?php echo get_phrase('amount');?> (<?php echo get_phrase('descending');?>)</option>
                                                <option value="date_asc"><?php echo get_phrase('date');?> (<?php echo get_phrase('ascending');?>)</option>
                                                <option value="date_desc"><?php echo get_phrase('date');?> (<?php echo get_phrase('descending');?>)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
			
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                			<th>#</th>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('total');?></div></th>
                            <th><div><?php echo get_phrase('paid');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('payment_status');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
                    		$count = 1;
                    		$this->db->where('status' , '2');
                    		$this->db->order_by('creation_timestamp' , 'desc');
                    		$invoices = $this->db->get('invoice')->result_array();
                    		foreach($invoices as $key => $row):
                    	?>
                        <tr>
                        	<td><?php echo $count++;?></td>
							<td>
								<?php 
								$student_info = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
								if ($student_info) {
									echo $student_info->name . '<br><small class="text-muted">Adm: ' . $student_info->admission_number . '</small>';
								} else {
									echo $this->crud_model->get_type_name_by_id('student', $row['student_id']);
								}
								?>
							</td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?><?php echo number_format($row['amount'],2,".",",");?></td>
                            <td><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?><?php echo number_format($row['amount_paid'],2,".",",");?></td>
							<td><?php echo $row['creation_timestamp'];?></td>
							<td>
                            <span class="label label-<?php if($row['status']=='1')echo 'success'; elseif ($row['status']=='2') echo 'danger'; else echo 'warning';?>">
                            <?php if($row ['status'] == '1'):?>
                            <?php echo 'Paid';?>
                            <?php endif;?>

                            <?php if($row ['status'] == '2'):?>
                            <?php echo 'Unpaid';?>
                            <?php endif;?>
                            </span>
							</td>

							<td>
							<?php if ($row['due'] != 0):?>
							<div class="action-buttons-container">
								<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-primary btn-sm action-btn" style="background: linear-gradient(45deg, #007bff, #0056b3); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(0,123,255,0.3); transition: all 0.3s ease;"><i class="fa fa-credit-card"></i> Pay</button></a>
							<?php endif;?>
							 
								<a href="<?php echo base_url();?>PrintInvoice/invoice/<?php echo $row['invoice_id'];?>" target="_blank"><button type="button" class="btn btn-warning btn-sm action-btn" style="background: linear-gradient(45deg, #ffc107, #e0a800); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(255,193,7,0.3); transition: all 0.3s ease;"><i class="fa fa-print"></i> Print</button></a>
								<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-success btn-sm action-btn" style="background: linear-gradient(45deg, #28a745, #1e7e34); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(40,167,69,0.3); transition: all 0.3s ease;"><i class="fa fa-edit"></i> Edit</button></a>
								<a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/student_payment/delete_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-danger btn-sm action-btn" style="background: linear-gradient(45deg, #dc3545, #c82333); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(220,53,69,0.3); transition: all 0.3s ease;"><i class="fa fa-trash"></i> Delete</button></a>
							</div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
					
				</div>
				</div>
				</div>
				</div>
				</div>
				
 <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('payment_history');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
                                
                                <div class="row filter-container">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="student_search"><?php echo get_phrase('search_by_student');?></label>
                                            <input type="text" class="form-control" id="student_search" placeholder="<?php echo get_phrase('enter_student_name_or_admission_number');?>">
                                            <small class="text-muted">Search by student name or admission number</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="class_filter"><?php echo get_phrase('filter_by_class');?></label>
                                            <select class="form-control" id="class_filter" onchange="loadSections()">
                                                <option value=""><?php echo get_phrase('all_classes');?></option>
                                                <?php
                                                $classes = $this->db->get('class')->result_array();
                                                foreach($classes as $class) {
                                                    echo '<option value="'.$class['class_id'].'">'.$class['name'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="section_filter"><?php echo get_phrase('filter_by_section');?></label>
                                            <select class="form-control" id="section_filter" onchange="filterPaymentHistory()">
                                                <option value=""><?php echo get_phrase('all_sections');?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sort_by"><?php echo get_phrase('sort_by');?></label>
                                            <select class="form-control" id="sort_by" onchange="sortPaymentHistory()">
                                                <option value=""><?php echo get_phrase('select_sorting_option');?></option>
                                                <option value="amount_asc"><?php echo get_phrase('amount');?> (<?php echo get_phrase('ascending');?>)</option>
                                                <option value="amount_desc"><?php echo get_phrase('amount');?> (<?php echo get_phrase('descending');?>)</option>
                                                <option value="date_asc"><?php echo get_phrase('date');?> (<?php echo get_phrase('ascending');?>)</option>
                                                <option value="date_desc"><?php echo get_phrase('date');?> (<?php echo get_phrase('descending');?>)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter Status Indicator -->
                                <div class="row" id="filter_status" style="margin-bottom: 10px; display: none;">
                                    <div class="col-sm-12">
                                        <div class="alert alert-info" style="margin: 0; padding: 8px 15px;">
                                            <i class="fa fa-filter"></i> <strong>Active Filters:</strong> 
                                            <span id="filter_info"></span>
                                            <button type="button" class="btn btn-xs btn-default pull-right" onclick="clearAllFilters()">
                                                <i class="fa fa-times"></i> Clear All Filters
                                            </button>
                                        </div>
                                    </div>
                                </div>

<table id="payment_history_table" class="display nowrap" cellspacing="0" width="100%">
					    <thead>
					        <tr>
					            <th><div>#</div></th>
					            <th><div><?php echo get_phrase('student');?></div></th>
					            <th><div><?php echo get_phrase('title');?></div></th>
					            <th><div><?php echo get_phrase('description');?></div></th>
					            <th><div><?php echo get_phrase('method');?></div></th>
					            <th><div><?php echo get_phrase('amount');?></div></th>
					            <th><div><?php echo get_phrase('date');?></div></th>
					            <th><div><?php echo get_phrase('actions');?></div></th>
					        </tr>
					    </thead>
					    <tbody>
					        <?php 
					        	$count = 1;
					        	$this->db->where('payment_type' , 'income');
					        	$this->db->order_by('timestamp' , 'desc');
					        	$payments = $this->db->get('payment')->result_array();
					        	foreach ($payments as $key => $row):
					        	    // Get student info for filtering
					        	    $student_info = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
					        ?>
					        <tr class="payment-row" data-class-id="<?php echo $student_info ? $student_info->class_id : ''; ?>" data-section-id="<?php echo $student_info ? $student_info->section_id : ''; ?>">
					            <td><?php echo $count++;?></td>
					            <td>
					            	<?php 
					            	if ($student_info) {
					            		echo $student_info->name . '<br><small class="text-muted">Adm: ' . $student_info->admission_number . '</small>';
					            	} else {
					            		echo $this->crud_model->get_type_name_by_id('student', $row['student_id']);
					            	}
					            	?>
					            </td>
					            <td><?php echo $row['title'];?></td>
					            <td><?php echo $row['description'];?></td>
					            <td>
					            	<?php 
					            		if ($row['method'] == 1)
					            			echo get_phrase('cash');
					            		if ($row['method'] == 2)
					            			echo get_phrase('cheque');
					            		if ($row['method'] == 3)
					            			echo get_phrase('card');
					                    if ($row['method'] == 'paypal')
					                    	echo 'paypal';
					            	    ?>
					            </td>
					            <td data-amount="<?php echo $row['amount']; ?>"><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?><?php echo number_format($row['amount'],2,".",",");?></td>
					            <td data-timestamp="<?php echo $row['timestamp']; ?>"><?php echo date('d M,Y', $row['timestamp']);?></td>
					            <td>
					            	<div class="action-buttons-container">
				                		<a href="<?php echo base_url();?>PrintInvoice/invoice/<?php echo $row['invoice_id'];?>" target="_blank"><button type="button" class="btn btn-info btn-sm action-btn" style="background: linear-gradient(45deg, #17a2b8, #117a8b); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(23,162,184,0.3); transition: all 0.3s ease;"><i class="fa fa-print"></i> Print</button></a>
				                	</div>
					            </td>
					        </tr>
					        <?php endforeach;?>
					    </tbody>
					</table>
					
<script type="text/javascript">
$(document).ready(function() {
    // Initialize payment history table with export buttons (without print)
    $('#payment_history_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
    
    // Initialize unpaid invoices table with export buttons (without print)
    if ( $.fn.dataTable.isDataTable('#example23') ) {
        $('#example23').DataTable().destroy();
    }
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
    
    // Enable search by student name manually since we're using DataTables
    $("#student_search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var table = $('#payment_history_table').DataTable();
        table.search(value).draw();
    });

    // Enable search by student name for invoices
    $("#invoice_search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var table = $('#example23').DataTable();
        table.search(value).draw();
    });
    
    // Add class filter change handler
    $("#class_filter").on("change", function() {
        filterPaymentHistory();
    });
});

function sortPaymentHistory() {
    var sortBy = $("#sort_by").val();
    var table = $('#payment_history_table').DataTable();
    
    // Sort based on selected option
    if (sortBy === "amount_asc") {
        table.order([5, 'asc']).draw(); // Column index 5 is amount
    } else if (sortBy === "amount_desc") {
        table.order([5, 'desc']).draw();
    } else if (sortBy === "date_asc") {
        table.order([6, 'asc']).draw(); // Column index 6 is date
    } else if (sortBy === "date_desc") {
        table.order([6, 'desc']).draw();
    }
}

function sortInvoiceHistory() {
    var sortBy = $("#invoice_sort_by").val();
    var table = $('#example23').DataTable();
    
    // Sort based on selected option
    if (sortBy === "amount_asc") {
        table.order([4, 'asc']).draw(); // Column index 4 is amount
    } else if (sortBy === "amount_desc") {
        table.order([4, 'desc']).draw();
    } else if (sortBy === "date_asc") {
        table.order([6, 'asc']).draw(); // Column index 6 is date
    } else if (sortBy === "date_desc") {
        table.order([6, 'desc']).draw();
    }
}

// Load sections based on selected class
function loadSections() {
    var classId = $("#class_filter").val();
    
    // Clear section dropdown
    $("#section_filter").html('<option value=""><?php echo get_phrase('all_sections');?></option>');
    
    if (classId) {
        // Make AJAX call to get sections for the selected class
        $.ajax({
            url: '<?php echo base_url();?>admin/get_sections_by_class/' + classId,
            type: 'GET',
            success: function(response) {
                // Response is already HTML options, so directly set it
                var allSectionsOption = '<option value=""><?php echo get_phrase('all_sections');?></option>';
                $("#section_filter").html(allSectionsOption + response);
            },
            error: function() {
                console.log('Error loading sections');
            }
        });
    }
    
    // Filter payment history after loading sections
    filterPaymentHistory();
}

// Filter payment history based on class and section
function filterPaymentHistory() {
    var classId = $("#class_filter").val();
    var sectionId = $("#section_filter").val();
    var searchValue = $("#student_search").val().toLowerCase();
    
    var table = $('#payment_history_table').DataTable();
    
    // Build filter info
    var filterInfo = [];
    if (classId) {
        var className = $("#class_filter option:selected").text();
        filterInfo.push("Class: " + className);
    }
    if (sectionId) {
        var sectionName = $("#section_filter option:selected").text();
        filterInfo.push("Section: " + sectionName);
    }
    if (searchValue) {
        filterInfo.push("Search: '" + searchValue + "'");
    }
    
    // Show/hide filter status
    if (filterInfo.length > 0) {
        $("#filter_info").html(filterInfo.join(', '));
        $("#filter_status").show();
    } else {
        $("#filter_status").hide();
    }
    
    // Custom filtering function
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            if (settings.nTable.id !== 'payment_history_table') {
                return true; // Only apply to payment history table
            }
            
            var row = $(table.row(dataIndex).node());
            var rowClassId = row.data('class-id');
            var rowSectionId = row.data('section-id');
            
            // Check class filter
            if (classId && rowClassId != classId) {
                return false;
            }
            
            // Check section filter
            if (sectionId && rowSectionId != sectionId) {
                return false;
            }
            
            return true;
        }
    );
    
    // Redraw table with filters applied
    table.draw();
    
    // Update record count
    setTimeout(function() {
        var visibleRows = table.rows({ filter: 'applied' }).count();
        var totalRows = table.rows().count();
        
        if (filterInfo.length > 0) {
            $("#filter_info").html(filterInfo.join(', ') + ' <small>(' + visibleRows + ' of ' + totalRows + ' records)</small>');
        }
    }, 100);
    
    // Clear custom filter to avoid stacking
    $.fn.dataTable.ext.search.pop();
}

// Clear all filters
function clearAllFilters() {
    $("#class_filter").val('');
    $("#section_filter").html('<option value=""><?php echo get_phrase('all_sections');?></option>');
    $("#student_search").val('');
    $("#filter_status").hide();
    
    // Reset table
    var table = $('#payment_history_table').DataTable();
    table.search('').draw();
}
</script>

<style>
/* ===== MODERN PURPLE AMBIENT UI DESIGN ===== */

/* Main page background with ambient purple gradient */
.content-wrapper {
    background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 25%, #ddd6fe 50%, #c4b5fd 75%, #a78bfa 100%);
    min-height: 100vh;
    padding: 20px;
}

/* Panel redesign with modern cards */
.panel {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: none;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(139, 92, 246, 0.1), 0 8px 16px rgba(139, 92, 246, 0.05);
    margin-bottom: 30px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.panel:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(139, 92, 246, 0.15), 0 12px 24px rgba(139, 92, 246, 0.08);
}

/* Panel headers with purple gradients */
.panel-heading {
    background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 50%, #c4b5fd 100%);
    color: white;
    border: none;
    padding: 20px 25px;
    font-size: 20px;
    font-weight: 700;
    letter-spacing: 0.8px;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
}

.panel-heading::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.panel-heading:hover::before {
    left: 100%;
}

.panel-heading i {
    margin-right: 15px;
    font-size: 22px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

/* Panel body styling */
.panel-body {
    padding: 30px;
    background: rgba(255, 255, 255, 0.8);
}

/* Modern form controls */
.form-group {
    margin-bottom: 25px;
}

.form-group label {
    color: #6b46c1;
    font-weight: 700;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    display: block;
}

.form-control {
    border: 2px solid rgba(139, 92, 246, 0.2);
    border-radius: 12px;
    padding: 15px 20px;
    font-size: 15px;
    font-weight: 600;
    background: rgba(255, 255, 255, 0.95);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    color: #4c1d95;
    min-height: 50px;
}

.form-control:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
    background: rgba(255, 255, 255, 1);
    outline: none;
}

.form-control option {
    padding: 10px;
    font-weight: 600;
    color: #4c1d95;
    background: white;
}

/* Enhanced placeholder styling */
.form-control::placeholder {
    color: #a78bfa;
    font-weight: 500;
    opacity: 0.8;
}

/* Filter controls container */
.filter-container {
    background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,250,252,0.95) 100%);
    border-radius: 18px;
    padding: 30px;
    margin-bottom: 25px;
    border: 2px solid rgba(139, 92, 246, 0.1);
    backdrop-filter: blur(15px);
    box-shadow: 0 10px 30px rgba(139, 92, 246, 0.08);
}

/* Filter status alert */
#filter_status .alert {
    background: linear-gradient(135deg, #ddd6fe 0%, #e9d5ff 100%);
    border: 2px solid #c4b5fd;
    border-radius: 12px;
    color: #6b46c1;
    font-weight: 600;
}

#filter_status .btn {
    background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
    border: none;
    color: white;
    border-radius: 8px;
    transition: all 0.3s ease;
    font-weight: 600;
}

#filter_status .btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

/* Enhanced table scrolling */
.table-responsive {
    border-radius: 16px;
    overflow-x: auto;
    overflow-y: hidden;
    box-shadow: 0 12px 40px rgba(139, 92, 246, 0.1);
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    position: relative;
    width: 100%;
}

.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: rgba(139, 92, 246, 0.1);
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #6b46c1 0%, #8b5cf6 100%);
}

/* Table wrapper for horizontal scroll */
.table-responsive table {
    min-width: 1200px;
    margin-bottom: 0;
    white-space: nowrap;
    width: 100%;
}

/* Remove sticky positioning - let the entire table scroll */
.table-responsive td,
.table-responsive th {
    white-space: nowrap;
    position: static;
}

table.dataTable {
    background: transparent;
    border-collapse: separate;
    border-spacing: 0;
    width: 100% !important;
}

/* Enhanced table headers */
table.dataTable thead th {
    background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 25%, #ddd6fe 75%, #c4b5fd 100%);
    color: #1e1b4b;
    border: none;
    padding: 20px 16px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-size: 13px;
    position: relative;
    white-space: nowrap;
    vertical-align: middle;
    border-bottom: 3px solid #8b5cf6;
}

table.dataTable thead th::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #8b5cf6, #a78bfa, #8b5cf6);
}

table.dataTable thead th div {
    font-weight: 700 !important;
    color: #1e1b4b !important;
    text-shadow: 0 1px 3px rgba(255,255,255,0.8);
}

table.dataTable tbody tr {
    background: rgba(255, 255, 255, 0.9);
    transition: all 0.3s ease;
}

table.dataTable tbody tr:nth-child(even) {
    background: rgba(248, 250, 252, 0.9);
}

table.dataTable tbody tr:hover {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.08) 0%, rgba(196, 181, 253, 0.08) 100%);
    transform: scale(1.002);
    box-shadow: 0 6px 20px rgba(139, 92, 246, 0.12);
}

table.dataTable tbody td {
    border: none;
    padding: 18px 16px;
    vertical-align: middle;
    border-bottom: 1px solid rgba(139, 92, 246, 0.08);
    font-weight: 600;
    color: #4c1d95;
    white-space: nowrap;
}

/* Action buttons container - no individual scrolling */
.action-buttons-container {
    display: flex;
    flex-wrap: nowrap;
    gap: 6px;
    align-items: center;
    justify-content: flex-start;
    min-width: fit-content;
    padding: 4px 0;
}

.action-btn {
    flex-shrink: 0;
    min-width: 75px;
    white-space: nowrap;
}

/* Student info styling */
.text-muted {
    color: #8b5cf6 !important;
    font-size: 12px;
    font-weight: 600;
}

/* Status labels */
.label {
    padding: 8px 14px;
    border-radius: 25px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
}

.label-success {
    background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.label-danger {
    background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.label-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

/* Enhanced vibrant buttons */
.btn.btn-sm[style*="linear-gradient"] {
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.8px !important;
    border: none !important;
    border-radius: 10px !important;
    padding: 10px 16px !important;
    margin: 3px !important;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    position: relative !important;
    overflow: hidden !important;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15) !important;
    backdrop-filter: blur(10px) !important;
    min-width: 70px;
}

.btn.btn-sm[style*="linear-gradient"]:hover {
    transform: translateY(-3px) scale(1.05) !important;
    box-shadow: 0 12px 30px rgba(0,0,0,0.25) !important;
}

.btn.btn-sm[style*="linear-gradient"]::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s;
}

.btn.btn-sm[style*="linear-gradient"]:hover::before {
    left: 100%;
}

/* Primary button enhancement */
.btn.btn-primary.btn-sm[style*="linear-gradient"] {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #1e40af 100%) !important;
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4) !important;
}

/* Warning button enhancement */
.btn.btn-warning.btn-sm[style*="linear-gradient"] {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%) !important;
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4) !important;
}

/* Success button enhancement */
.btn.btn-success.btn-sm[style*="linear-gradient"] {
    background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%) !important;
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4) !important;
}

/* Danger button enhancement */
.btn.btn-danger.btn-sm[style*="linear-gradient"] {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 50%, #b91c1c 100%) !important;
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4) !important;
}

/* Info button enhancement */
.btn.btn-info.btn-sm[style*="linear-gradient"] {
    background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #0e7490 100%) !important;
    box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4) !important;
}

/* DataTables controls styling */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
    margin: 15px 0;
    font-weight: 600;
}

.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 2px solid rgba(139, 92, 246, 0.2);
    border-radius: 10px;
    padding: 10px 15px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    font-weight: 600;
    color: #4c1d95;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    border: none;
    border-radius: 10px;
    margin: 0 3px;
    padding: 10px 15px;
    background: linear-gradient(135deg, #e9d5ff 0%, #ddd6fe 100%);
    color: #6b46c1;
    transition: all 0.3s ease;
    font-weight: 600;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #6b46c1 0%, #8b5cf6 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(107, 70, 193, 0.3);
}

/* Export buttons styling */
.dt-buttons {
    margin-bottom: 20px;
}

.dt-button {
    background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px 18px;
    margin: 0 6px;
    font-weight: 700;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    font-size: 13px;
}

.dt-button:hover {
    background: linear-gradient(135deg, #6b46c1 0%, #8b5cf6 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(139, 92, 246, 0.3);
}

/* Enhanced text styling throughout */
body, .panel-body, .table {
    font-weight: 600;
}

h1, h2, h3, h4, h5, h6 {
    font-weight: 700;
    color: #4c1d95;
}

/* Responsive design */
@media (max-width: 768px) {
    .content-wrapper {
        padding: 10px;
    }
    
    .panel {
        border-radius: 15px;
        margin-bottom: 20px;
    }
    
    .panel-body {
        padding: 20px 15px;
    }
    
    .filter-container {
        padding: 20px;
    }
    
    .btn.btn-sm[style*="linear-gradient"] {
        padding: 8px 12px !important;
        font-size: 11px !important;
        margin: 2px 1px !important;
    }
    
    table.dataTable thead th,
    table.dataTable tbody td {
        padding: 12px 8px;
        font-size: 12px;
    }
    
    /* Ensure table is responsive on mobile */
    .table-responsive table {
        min-width: 900px;
    }
    
    .action-buttons-container {
        gap: 3px;
    }
    
    .action-btn {
        min-width: 65px;
        padding: 6px 10px !important;
        font-size: 10px !important;
    }
}

/* Better action button spacing */
.action-buttons-container .action-btn {
    margin: 0 !important;
}

/* Ensure proper table cell sizing for actions */
table.dataTable td:last-child {
    min-width: 280px;
    padding: 18px 20px;
}

table.dataTable th:last-child {
    min-width: 280px;
    padding: 20px 20px;
}

/* Enhanced button styling within tables */
.action-buttons-container .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Ambient glow effects */
.panel::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(135deg, #8b5cf6, #a78bfa, #c4b5fd, #ddd6fe);
    border-radius: 22px;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.panel:hover::before {
    opacity: 0.3;
}

/* Scrollbar styling */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: rgba(139, 92, 246, 0.1);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #6b46c1 0%, #8b5cf6 100%);
}

/* Animation keyframes */
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Apply animations */
.panel {
    animation: fadeInUp 0.6s ease forwards;
}

.panel:nth-child(1) { animation-delay: 0.1s; }
.panel:nth-child(2) { animation-delay: 0.2s; }
.panel:nth-child(3) { animation-delay: 0.3s; }

/* Loading states */
.loading {
    position: relative;
    pointer-events: none;
    opacity: 0.7;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top-color: #8b5cf6;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Focus indicators for accessibility */
.form-control:focus,
.btn:focus {
    outline: 2px solid #8b5cf6;
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .no-print,
    .panel-heading,
    .dt-buttons,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        display: none !important;
    }
    
    .panel {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .table-responsive {
        overflow: visible;
    }
}
</style>
						
			
</div>
				</div>
				</div>
				</div>
				</div>
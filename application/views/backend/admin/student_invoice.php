<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('unpaid_invoices');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
                                
                                <div class="row" style="margin-bottom: 15px;">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="invoice_search"><?php echo get_phrase('search_by_student');?></label>
                                            <input type="text" class="form-control" id="invoice_search" placeholder="<?php echo get_phrase('enter_student_name');?>">
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
							<td><?php echo $this->crud_model->get_type_name_by_id('student', $row['student_id']);?></td>
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
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-primary btn-sm" style="background: linear-gradient(45deg, #007bff, #0056b3); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(0,123,255,0.3); transition: all 0.3s ease;"><i class="fa fa-credit-card"></i> Pay</button></a>
							<?php endif;?>
							 
							<a href="<?php echo base_url();?>PrintInvoice/invoice/<?php echo $row['invoice_id'];?>" target="_blank"><button type="button" class="btn btn-warning btn-sm" style="background: linear-gradient(45deg, #ffc107, #e0a800); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(255,193,7,0.3); transition: all 0.3s ease;"><i class="fa fa-print"></i> Print</button></a>
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-success btn-sm" style="background: linear-gradient(45deg, #28a745, #1e7e34); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(40,167,69,0.3); transition: all 0.3s ease;"><i class="fa fa-edit"></i> Edit</button></a>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/student_payment/delete_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-danger btn-sm" style="background: linear-gradient(45deg, #dc3545, #c82333); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(220,53,69,0.3); transition: all 0.3s ease;"><i class="fa fa-trash"></i> Delete</button></a>
							
                           
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
                                
                                <div class="row" style="margin-bottom: 15px;">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="student_search"><?php echo get_phrase('search_by_student');?></label>
                                            <input type="text" class="form-control" id="student_search" placeholder="<?php echo get_phrase('enter_student_name');?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
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
					        ?>
					        <tr>
					            <td><?php echo $count++;?></td>
					            <td><?php echo $this->crud_model->get_type_name_by_id('student', $row['student_id']);?></td>
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
					            <td >
			                <a href="<?php echo base_url();?>PrintInvoice/invoice/<?php echo $row['invoice_id'];?>" target="_blank"><button type="button" class="btn btn-info btn-sm" style="background: linear-gradient(45deg, #17a2b8, #117a8b); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(23,162,184,0.3); transition: all 0.3s ease;"><i class="fa fa-print"></i> Print</button></a>	            	
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
</script>

<style>
/* ===== COMPREHENSIVE VIBRANT BUTTON STYLES ===== */

/* Base vibrant button styles */
.btn.btn-sm[style*="linear-gradient"] {
    font-weight: 500 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    border: none !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    margin: 2px !important;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    position: relative !important;
    overflow: hidden !important;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
}

/* Hover effects for all vibrant buttons */
.btn.btn-sm[style*="linear-gradient"]:hover {
    transform: translateY(-2px) scale(1.02) !important;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2) !important;
}

/* Primary button (Pay) hover */
.btn.btn-primary.btn-sm[style*="linear-gradient"]:hover {
    background: linear-gradient(45deg, #0056b3, #004085) !important;
    box-shadow: 0 8px 16px rgba(0,123,255,0.4) !important;
}

/* Warning button (Print) hover */
.btn.btn-warning.btn-sm[style*="linear-gradient"]:hover {
    background: linear-gradient(45deg, #e0a800, #d39e00) !important;
    box-shadow: 0 8px 16px rgba(255,193,7,0.4) !important;
}

/* Success button (Edit) hover */
.btn.btn-success.btn-sm[style*="linear-gradient"]:hover {
    background: linear-gradient(45deg, #1e7e34, #155724) !important;
    box-shadow: 0 8px 16px rgba(40,167,69,0.4) !important;
}

/* Danger button (Delete) hover */
.btn.btn-danger.btn-sm[style*="linear-gradient"]:hover {
    background: linear-gradient(45deg, #c82333, #bd2130) !important;
    box-shadow: 0 8px 16px rgba(220,53,69,0.4) !important;
}

/* Info button (Download/View) hover */
.btn.btn-info.btn-sm[style*="linear-gradient"]:hover {
    background: linear-gradient(45deg, #117a8b, #0c5460) !important;
    box-shadow: 0 8px 16px rgba(23,162,184,0.4) !important;
}

/* Focus and active states */
.btn.btn-sm[style*="linear-gradient"]:focus,
.btn.btn-sm[style*="linear-gradient"]:active {
    outline: none !important;
    transform: translateY(-1px) scale(1.01) !important;
}

/* Primary focus */
.btn.btn-primary.btn-sm[style*="linear-gradient"]:focus,
.btn.btn-primary.btn-sm[style*="linear-gradient"]:active {
    box-shadow: 0 0 0 3px rgba(0,123,255,0.25), 0 6px 12px rgba(0,123,255,0.3) !important;
}

/* Warning focus */
.btn.btn-warning.btn-sm[style*="linear-gradient"]:focus,
.btn.btn-warning.btn-sm[style*="linear-gradient"]:active {
    box-shadow: 0 0 0 3px rgba(255,193,7,0.25), 0 6px 12px rgba(255,193,7,0.3) !important;
}

/* Success focus */
.btn.btn-success.btn-sm[style*="linear-gradient"]:focus,
.btn.btn-success.btn-sm[style*="linear-gradient"]:active {
    box-shadow: 0 0 0 3px rgba(40,167,69,0.25), 0 6px 12px rgba(40,167,69,0.3) !important;
}

/* Danger focus */
.btn.btn-danger.btn-sm[style*="linear-gradient"]:focus,
.btn.btn-danger.btn-sm[style*="linear-gradient"]:active {
    box-shadow: 0 0 0 3px rgba(220,53,69,0.25), 0 6px 12px rgba(220,53,69,0.3) !important;
}

/* Info focus */
.btn.btn-info.btn-sm[style*="linear-gradient"]:focus,
.btn.btn-info.btn-sm[style*="linear-gradient"]:active {
    box-shadow: 0 0 0 3px rgba(23,162,184,0.25), 0 6px 12px rgba(23,162,184,0.3) !important;
}

/* Button ripple effect */
.btn.btn-sm[style*="linear-gradient"]:before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn.btn-sm[style*="linear-gradient"]:active:before {
    width: 300px;
    height: 300px;
}

/* Action column styling */
td .btn.btn-sm[style*="linear-gradient"] {
    white-space: nowrap;
    margin: 1px 2px;
    display: inline-block;
}

/* Icon spacing */
.btn.btn-sm[style*="linear-gradient"] i {
    margin-right: 5px !important;
}

/* Responsive button styling */
@media (max-width: 768px) {
    .btn.btn-sm[style*="linear-gradient"] {
        padding: 6px 8px !important;
        font-size: 11px !important;
        margin: 1px !important;
        border-radius: 6px !important;
    }
    
    .btn.btn-sm[style*="linear-gradient"] i {
        margin-right: 3px !important;
    }
}

@media (max-width: 480px) {
    .btn.btn-sm[style*="linear-gradient"] {
        padding: 4px 6px !important;
        font-size: 10px !important;
        letter-spacing: 0.3px !important;
    }
    
    /* Stack buttons vertically on very small screens */
    td .btn.btn-sm[style*="linear-gradient"] {
        display: block !important;
        margin: 2px 0 !important;
        width: 100% !important;
    }
}

/* Animation keyframes */
@keyframes buttonPulse {
    0% { box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    50% { box-shadow: 0 6px 12px rgba(0,0,0,0.15); }
    100% { box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
}

/* Add pulse animation on load */
.btn.btn-sm[style*="linear-gradient"] {
    animation: buttonPulse 2s infinite alternate;
}

/* Stop animation on hover */
.btn.btn-sm[style*="linear-gradient"]:hover {
    animation: none !important;
}

/* Disabled state */
.btn.btn-sm[style*="linear-gradient"]:disabled {
    opacity: 0.6 !important;
    transform: none !important;
    box-shadow: none !important;
    animation: none !important;
    cursor: not-allowed !important;
}

/* Loading state */
.btn.btn-sm[style*="linear-gradient"].loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn.btn-sm[style*="linear-gradient"].loading:after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    left: 50%;
    margin: -8px 0 0 -8px;
    border: 2px solid transparent;
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .btn.btn-sm[style*="linear-gradient"] {
        border: 2px solid currentColor !important;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    .btn.btn-sm[style*="linear-gradient"] {
        transition: none !important;
        animation: none !important;
    }
    
    .btn.btn-sm[style*="linear-gradient"]:hover {
        transform: none !important;
    }
}
</style>
						
			
</div>
				</div>
				</div>
				</div>
				</div>
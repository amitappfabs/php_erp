<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('unpaid_invoices');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
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
							 
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-warning btn-sm" style="background: linear-gradient(45deg, #ffc107, #e0a800); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(255,193,7,0.3); transition: all 0.3s ease;"><i class="fa fa-print"></i> Print</button></a>
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-success btn-sm" style="background: linear-gradient(45deg, #28a745, #1e7e34); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(40,167,69,0.3); transition: all 0.3s ease;"><i class="fa fa-edit"></i> Edit</button></a>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>accountant/student_payment/delete_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-danger btn-sm" style="background: linear-gradient(45deg, #dc3545, #c82333); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(220,53,69,0.3); transition: all 0.3s ease;"><i class="fa fa-trash"></i> Delete</button></a>
							
                           
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

<table class="table" id="table-1">
					    <thead>
					        <tr>
					            <th><div>#</div></th>
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
					            <td><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?><?php echo number_format($row['amount'],2,".",",");?></td>
					            <td><?php echo date('d M,Y', $row['timestamp']);?></td>
					            <td >
			                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');"> <button type="button" class="btn btn-info btn-sm" style="background: linear-gradient(45deg, #17a2b8, #117a8b); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(23,162,184,0.3); transition: all 0.3s ease;"><i class="fa fa-print"></i> Print</button></a>	            	
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
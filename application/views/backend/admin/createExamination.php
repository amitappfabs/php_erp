<div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_exam'); ?></div>

<?php echo form_open(base_url() . 'admin/createExamination/create', array('class' => 'form-horizontal form-goups-bordered validate'));?>
					<div class="panel-body table-responsive">
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Title');?></label>
                    <div class="col-sm-12">
					
                            
                                    <input name="name" type="text" class="form-control"/ required>
                                </div>
                            </div>
							
							<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-12">
					
                           
                                    <textarea rows="3" class="form-control" name="comment" required></textarea>
                                </div>
                            </div>
							
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('date');?></label>
                    <div class="col-sm-12">
					<input class="form-control m-r-10" name="timestamp" type="date" value="<?php echo date('Y-m-d');?>" id="example-date-input" required>
                                </div>
                            </div>
                            
                           <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_exam');?></button>
							</div>
                <?php echo form_close();?>
                </div>                
			</div>
			</div>
			<!----CREATION FORM ENDS-->
	
 <div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_exam'); ?></div>
							


<div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
				<thead>

                
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('Title');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
                  
					</thead>
                    <tbody>

                    <?php $count = 1; 
                    $exams = $this->db->get('exam')->result_array();
                    foreach ($exams as $key => $exam): ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $exam ['name'];?></td>
							<td><?php echo $exam ['comment'];?></td>
							<td><?php echo $exam ['timestamp'];?></td>
							<td>
							
				    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_exam/<?php echo $exam['exam_id'];?>');"><button type="button" class="btn btn-success btn-sm" style="background: linear-gradient(45deg, #28a745, #1e7e34); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(40,167,69,0.3); transition: all 0.3s ease;"><i class="fa fa-edit"></i> Edit</button></a>
					 <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/createExamination/delete/<?php echo $exam['exam_id'];?>');"><button type="button" class="btn btn-danger btn-sm" style="background: linear-gradient(45deg, #dc3545, #c82333); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(220,53,69,0.3); transition: all 0.3s ease;"><i class="fa fa-trash"></i> Delete</button></a>
					 
			
                           
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
            <!----TABLE LISTING ENDS--->
			
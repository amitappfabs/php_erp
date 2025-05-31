
<table id="example" class="table display">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                            <th><div><?php echo get_phrase('class_name');?></div></th>
                    		<th><div><?php echo get_phrase('subject_name');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
    
                    <?php $counter = 1; $subjects =  $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                    foreach($subjects as $key => $subjects):?>         
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('class', $subjects['class_id']);?></td>
							<td><?php echo $subjects['name'];?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('teacher', $subjects['teacher_id']);?></td>
							<td>
							
				    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_subject/<?php echo $subjects['subject_id'];?>');"><button type="button" class="btn btn-success btn-sm" style="background: linear-gradient(45deg, #28a745, #1e7e34); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(40,167,69,0.3); transition: all 0.3s ease;"><i class="fa fa-pencil"></i> Edit</button></a>
					 <a href="#" onclick="confirm_modal('<?php echo base_url();?>subject/subject/delete/<?php echo $subjects['subject_id'];?>');"><button type="button" class="btn btn-danger btn-sm" style="background: linear-gradient(45deg, #dc3545, #c82333); border: none; border-radius: 8px; padding: 8px 12px; margin: 2px; box-shadow: 0 4px 8px rgba(220,53,69,0.3); transition: all 0.3s ease;"><i class="fa fa-trash"></i> Delete</button></a>
					 
			
                           
        					</td>
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>
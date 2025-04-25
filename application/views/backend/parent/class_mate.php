					
            <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('Class Mate');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <!-- <th width="80"><div><?php echo get_phrase('photo');?></div></th> -->
                            <th><div><?php echo get_phrase('Name');?></div></th>
                            <th><div><?php echo get_phrase('Phone');?></div></th>
                            <th><div><?php echo get_phrase('Email');?></div></th>
                            <th><div><?php echo get_phrase('Gender');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($classmates as $key => $row): // Use $classmates variable ?>
                        <tr>
                            <!-- <td><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']);?>" class="img-circle" width="30px"></td> -->
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['sex'];?></td>
                           
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($classmates)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center;"><?php echo get_phrase('No classmates found in this class.');?></td>
                        </tr>
                    <?php endif; ?>
						
                    </tbody>
                </table>



                </div>
            </div>
        </div>
    </div>
</div>

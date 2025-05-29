    <script type="text/javascript">
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url();?>assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);
			},
			error: function(xhr, status, error) {
				console.error("AJAX Error:", error);
				console.log("Status:", status);
				console.log("Response:", xhr.responseText);
				jQuery('#modal_ajax .modal-body').html('<div class="alert alert-danger"><strong>Error!</strong> ' + error + '<br>Status: ' + status + '</div>');
			}
		});
	}
	</script>
    
    <!-- (Ajax Modal)-->
	
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="modal_ajax">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body" style="max-height:600px; overflow-y:auto;"></div>
            </div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
	function confirm_modal(delete_url)
	{
		jQuery('#modal-4').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
	}
	</script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:left;"><strong style="color:#FFFFFF">CONFIRMATION&nbsp;!!!</strong></h4>
                </div>
                

                <div class="modal-footer" align="center">
				<div class="row">
				 <div class="col-sm-7">	
				ARE YOU SURE YOU want TO DELETE THIS INFORMATION ?
				</div>
				 <div class="col-sm-5">	
                    <a href="#" class="btn btn-success btn-rounded btn-sm" id="delete_link"><i class="fa fa-check">&nbsp;</i>Delete</a>
                    <button type="button" class="btn btn-info btn-rounded btn-sm" data-dismiss="modal"><i class="fa fa-times">&nbsp;</i>Cancel</button>
					</div>
				</div>
				</div>
            </div>
        </div>
    </div>

    <!-- Success Popup Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5cb85c; color: white;">
                    <h4 class="modal-title" id="successModalLabel">
                        <i class="fa fa-check-circle"></i> <span id="successTitle">Success</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-check-circle text-success" style="font-size: 48px; margin-bottom: 15px;"></i>
                        <p id="successMessage" style="font-size: 16px; margin-bottom: 0;"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">
                        <i class="fa fa-thumbs-up"></i> OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Popup Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #d9534f; color: white;">
                    <h4 class="modal-title" id="errorModalLabel">
                        <i class="fa fa-exclamation-triangle"></i> <span id="errorTitle">Error</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-exclamation-triangle text-danger" style="font-size: 48px; margin-bottom: 15px;"></i>
                        <div id="errorMessage" style="font-size: 14px; text-align: left; white-space: pre-line;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation Error Popup Modal -->
    <div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="validationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #f0ad4e; color: white;">
                    <h4 class="modal-title" id="validationModalLabel">
                        <i class="fa fa-exclamation-circle"></i> <span id="validationTitle">Validation Errors</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <strong><i class="fa fa-info-circle"></i> Please fix the following issues:</strong>
                    </div>
                    <div id="validationMessage" style="font-size: 14px; white-space: pre-line; max-height: 300px; overflow-y: auto;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="fa fa-edit"></i> Fix Issues
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    // Function to show success popup
    function showSuccessPopup(title, message) {
        console.log('Showing success popup:', title, message);
        $('#successTitle').text(title);
        $('#successMessage').text(message);
        $('#successModal').modal('show');
    }

    // Function to show error popup
    function showErrorPopup(title, message) {
        console.log('Showing error popup:', title, message);
        $('#errorTitle').text(title);
        $('#errorMessage').text(message);
        $('#errorModal').modal('show');
    }

    // Function to show validation error popup
    function showValidationPopup(title, message) {
        console.log('Showing validation popup:', title, message);
        $('#validationTitle').text(title);
        $('#validationMessage').text(message);
        $('#validationModal').modal('show');
    }

    // Check for popup messages from session data
    $(document).ready(function() {
        console.log('Checking for popup messages...');
        
        <?php if($this->session->flashdata('popup_success')): ?>
            <?php $popup_data = $this->session->flashdata('popup_success'); ?>
            console.log('Found success popup data:', <?php echo json_encode($popup_data); ?>);
            showSuccessPopup(<?php echo json_encode($popup_data['title']); ?>, <?php echo json_encode($popup_data['message']); ?>);
        <?php endif; ?>

        <?php if($this->session->flashdata('popup_error')): ?>
            <?php $popup_data = $this->session->flashdata('popup_error'); ?>
            console.log('Found error popup data:', <?php echo json_encode($popup_data); ?>);
            <?php if($popup_data['type'] == 'validation'): ?>
                showValidationPopup(<?php echo json_encode($popup_data['title']); ?>, <?php echo json_encode($popup_data['message']); ?>);
            <?php else: ?>
                showErrorPopup(<?php echo json_encode($popup_data['title']); ?>, <?php echo json_encode($popup_data['message']); ?>);
            <?php endif; ?>
        <?php endif; ?>
        
        console.log('Popup check completed.');
    });
    </script>
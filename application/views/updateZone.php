<title>AddUser</title>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="<?php echo base_url() ?>assets/js/jquery-1.12.4.js"></script>
  <script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
 
  <!-- BEGIN CONTENT -->
	<div class="col-md-12 inner_white mt-4">
        <div class="row">
					
          <div class="pink_bar"> <h4>Update Zone</h4> <div class="col-md-6 ml-auto pink_right"> 

</div>
						
					</div>
        </div>				 
        <div class="row mandates">
            <?php echo validation_errors('<div style="color:red">','</div>'); ?>
          <div class="table-responsive" id="table_data">
             <form action="<?php echo base_url() ?>zone/updateZoneDetails" id="updateZone" class="form-horizontal form-row-seperated"  method="POST">
                 <?php echo form_open(); ?>
                                <?php 
                                   //$id=$result['id'];
					
								//echo "<pre>"; print_r($result); exit;
								?>
											<div class="form-body">
<input type="hidden" value="<?php echo !empty($result)? $result['accountMasterId'] :'' ?>" name="accountMasterId">
<input type="hidden" value="<?php echo !empty($result)? $result['zone_id'] :'' ?>" name="zone_id"
												<div class="form-group">
										<label class="control-label col-md-3">Zone Name</label>
													<div class="col-md-9">
	<input type="text" placeholder="Enter  Zone Name" class="form-control" id="name" name="name" value="<?php echo !empty($result)? htmlspecialchars($result['name']) :'' ?>"  required/>													</div>
												</div>
											
												<div class="form-group">
										<label class="control-label col-md-3">Account Number</label>
													<div class="col-md-9">
						<input type="text" placeholder="Enter Account Number" class="form-control" id="account_number" name="account_number" value="<?php echo !empty($result)? htmlspecialchars($result['account_number']) :'' ?>" required/>													</div>
												</div>
																							
											<div class="form-actions">
												<div class="row">
				<div class="col-md-offset-3 col-md-9" style="text-align: center;">
				<button type="submit" class="btn upload_button" >
  Submit 
</button>
				
													</div>
												</div>
											</div>
										</form>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
							
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
		<script src="<?php echo base_url() ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
	$.validator.addMethod("noSpecial", function(value, element) {
	var regex = /^[a-zA-Z0-9/_-]+$/;
	    if (regex.test(value) || !value) {
        return true;
    }
    return false;
}, "No special characters allowed except '/ - _'");

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please"); 

        $("#updateZone").validate({
            rules: {
                "name": {
                    required : true,
                    lettersonly:true
                },
                "account_number": {
                    required : true,
                    digits: true,
                    minlength: 12,
                    maxlength: 12
                }
            },
            messages: {
                    name:{ requires: "Please enter zone name !",
                        lettersonly:"Please enter Letters only !"
                    
                    },
                    account_number:{
                      required : "Please enter valid account number !"
                  }
            }
        });

    </script>

<style>
.fade{
                opacity:99999999
        }
  .error {
    color:red;
    }  
	</style>

<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>

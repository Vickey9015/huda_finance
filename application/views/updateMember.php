<title>AddUser</title>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/layout/css/tokeninput_jquery-master/src/jquery.tokeninput.js"></script>
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/layout/css/tokeninput_jquery-master/styles/token-input.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/layout/css/tokeninput_jquery-master/styles/token-input-facebook.css" type="text/css" />

  <!-- BEGIN CONTENT -->
	<div class="col-md-12 inner_white mt-4">
        <div class="row">
					
          <div class="pink_bar"> <h4>Update Member</h4> <div class="col-md-6 ml-auto pink_right"> 
         

</div>
						
					</div>
        </div>				 
        <div class="row mandates">
          <div class="table-responsive" id="table_data">
              <?php echo validation_errors(); ?>
             <form action="<?php echo base_url() ?>member/updateMemberDetails" class="form-horizontal form-row-seperated"  method="POST" id="MemberForm">
                 <?php echo form_open(); ?>
                                <?php 
                                   //$id=$result['id'];
					
								//echo "<pre>"; print_r($result); exit;
								?>
								
											<div class="form-body">
												<div class="form-group">
										<label class="control-label col-md-3"> Name</label>
													<div class="col-md-9">
		<input type="hidden" value="<?php echo !empty($result)? $result['id'] :'' ?>" name="id">		
	<input type="text" placeholder="Enter  Name" class="form-control" id="name" name="name" value="<?php echo !empty($result)? htmlspecialchars($result['name']) :'' ?>" >													</div>
												</div>
											
												<div class="form-group">
										<label class="control-label col-md-3">Email</label>
													<div class="col-md-9">
						<input type="text" placeholder="Enter email" class="form-control" id="email" name="email" value="<?php echo !empty($result)? htmlspecialchars($result['email']) :'' ?>"  >													</div>
												</div>
												<div class="form-group">
										<label class="control-label col-md-3">Phone Number</label>
													<div class="col-md-9">
						<input type="text" placeholder="Enter Phone Number" class="form-control" id="phone" name="phone" value="<?php echo !empty($result)? htmlspecialchars($result['phone']) :'' ?>">													</div>
												</div>
		<!--										<div class="form-group">-->
		<!--											<label class="control-label col-md-3">Password</label>-->
		<!--											<div class="col-md-9">-->
		<!--<input type="password" placeholder="Enter Password" class="form-control" id="password" name="password"  value="<?php //echo !empty($result)? $result['password'] :'' ?>">-->
		<!--											</div>-->
		<!--										</div>-->
												<div class="form-group">
                                                <label class="control-label col-md-3">Role Type</label>
                    <div class="col-md-9">
                                            
      <select class="form-control input-sm" id="role_id" name="role_id" style="height:40px;" disabled >
            <option value="">Select Role</option>
			<option value="3" <?php if(@$result['role_id']== '3') { echo 'selected'; } ?>>SO Maker Upload</option>
			<option value="4" <?php if(@$result['role_id']== '4') { echo 'selected'; } ?>>Verifier</option>
			<option value="5" <?php if(@$result['role_id']== '5') { echo 'selected'; } ?>>Authoriser/LAO</option>
			</select>
			</div>
		</div>

		<div class="form-group">
        <label class="control-label col-md-3">Zone Name</label>
            <div class="col-md-9">
                <?php if(@$result['role_id']== '5'){  ?>
                <input type="hidden" value="<?php if($selected_zone){ echo $selected_zone[0]['zone_ids']; } ?>"  class="zone_id zone_multiple" name="zone_id" >
				<input type="text" class="form-control" id="input-local-prevent-duplicates" name="input-local-prevent-duplicates" style="display:none;">
			<span id="mul_zone_id"></span>
			    <script type="text/javascript">
                  $(document).ready(function() {
                    $("#input-local-prevent-duplicates").tokenInput("<?php echo base_url() ?>member/getByZone", {
                      theme: "facebook",
                     preventDuplicates: true,
                     prePopulate: <?php echo json_encode($user_zone_mapping, true); ?>,
                     propertyToSearch: "name",
                     onAdd: function(){
                         var catval = $(this).val();
                         console.log(catval);
                         $(".zone_id").val(catval, {
                         theme: "facebook"
                     });
                     },onDelete: function(){
                         var catval = $(this).val();
                         $(".zone_id").val(catval, {
                         theme: "facebook"
                     });
                   },
                });
             });
                </script> 
                
                <?php }else{ ?> 
                <select class="form-control input-sm" id="zone_id" name="zone_id" style="height:40px;">
            <option value=" ">Select Zone</option>
	        <?php foreach($zone_list as $zones){  ?>
            <option value="<?php echo $zones['id']; ?>" <?php if($zones['id'] == $result['zone_id']){ echo "selected"; } ?> ><?php echo htmlspecialchars($zones['name']); ?></option>
            <?php }?>
			</select>
			<?php } ?>
                
			</div>
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
		<!--<script src="<?php //echo base_url() ?>assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>-->
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>
		

<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
	$.validator.addMethod("noSpecial", function(value, element) {
	var regex = /^[a-zA-Z0-9/_-]+$/;
	    if (regex.test(value) || !value) {
        return true;
    }
    return false;
}, "No special characters allowed except '/ - _'");

$.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[a-z]/.test(value) // has a lowercase letter
       && /\d/.test(value) // has a digit
       && /[@#$%]/.test(value)
});
       $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal arg.");

        $("#MemberForm").validate({
            
            rules: {
                "name": {
                    required : true,
                    maxlength: 50

                },
                "email": {
                    required : true,
                    email: true
        
                },
                "phone": {
                    required: true,
                    maxlength: 10,
                    minlength: 10,
                    digits : true
                },
                "password": {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                    pwcheck: true
                    
                },
                zone_id: {required: true, valueNotEquals: " " }
            },
            messages: {
              name: "Please enter your firstname",
              password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 8 characters long",
                pwcheck: "Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number and one special character!"
              },
              phone: {
                required: "Please enter a mobile",
                
              },
              email:{ 
                required: "Please enter a valid email address",
              },
               zone_id: {  required: "Please select a zone type !", valueNotEquals: "Please select a zone type !" }
            }
        });

    </script>
<!--    <script type="text/javascript">-->
<!--$('#role_id').change(function() {-->
    
<!--    var selected = $(this).val();-->
<!--    console.log(selected);-->
<!--    if(selected == '5'){-->
<!--        $('#zone_label').show();-->
<!--      $('.token-input-list-facebook').show();-->
      
<!--      $('.zone_select').hide();-->
<!--      $('#mul_zone_id').html('<input type="hidden" value=""  class="zone_id zone_multiple" name="zone_id" >');-->
<!--    }else if(selected == ' '){-->
<!--        $('#zone_label').hide();-->
<!--    }-->
<!--    else{-->
<!--        $('#zone_label').show();-->
<!--       $('#mul_zone_id').html('');-->
<!--       $('.token-input-list-facebook').hide();    -->
<!--      $('.zone_select').show();-->
<!--    }-->
<!--});-->
<!--</script>-->
<style>
	.error {
    color:red;
    }  
</style>
</body>
</html>

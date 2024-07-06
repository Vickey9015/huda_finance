<title>AddUser</title>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
 
  <!-- BEGIN CONTENT -->
	<div class="col-md-12 inner_white mt-4">
        <div class="row">
					
          <div class="pink_bar"> <h4>Update Member</h4> <div class="col-md-6 ml-auto pink_right"> 

</div>
						
					</div>
        </div>				 
        <div class="row mandates">
          <div class="table-responsive" id="table_data">
             <form action="<?php echo base_url() ?>admin/updateMemberDetails" class="form-horizontal form-row-seperated"  method="POST" id="MemberForm">
                 <?php echo form_open();
								 echo validation_errors('<div style="color:red">','</div>');
								 ?>
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
						<input type="text" placeholder="Enter email" class="form-control" id="email" name="email" value="<?php echo !empty(htmlspecialchars($result))? htmlspecialchars($result['email']) :'' ?>" disabled >													</div>
												</div>
												<div class="form-group">
										<label class="control-label col-md-3">Phone Number</label>
													<div class="col-md-9">
						<input type="text" placeholder="Enter Phone Number" class="form-control" id="phone" name="phone" value="<?php echo !empty($result)? htmlspecialchars($result['phone']) :'' ?>" disabled >													</div>
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
                                            
      <select class="form-control input-sm" id="role_id" name="role_id" style="height:40px;">
            <option value="">Select Role</option>
																												<option value="7" <?php if(@$result['role_id']== '7') { echo 'selected'; } ?>>Bank Maker</option>
																												<option value="8" <?php if(@$result['role_id']== '8') { echo 'selected'; } ?>>Bank Checker</option>
			</select>
			</div>
												</div>
												<!--<div class="form-group">
                                                <label class="control-label col-md-3">Zone Type</label>
                    <div class="col-md-9">
                                            
      <select class="form-control input-sm" id="zone_id" name="zone_id" style="height:40px;">
            <option value=" ">Select Zone</option>
	        <?php foreach($zone_list as $zones){  ?>
            <option value="<?php echo $zones['id']; ?>" <?php if($zones['id'] == $result['zone_id']){ echo "selected"; } ?> ><?php echo $zones['name']; ?></option>
            <?php }?>
			</select>
			</div>
												</div>-->
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
		<script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
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
                
                role_id: {required: true, valueNotEquals: " " },
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
               role_id: { required: "Please select a role type !", valueNotEquals: "Please select a role type !" },
               zone_id: {  required: "Please select a zone type !", valueNotEquals: "Please select a zone type !" }
            }
        });

    </script>
<style>
	.error {
    color:red;
    }  
</style>
</body>
</html>

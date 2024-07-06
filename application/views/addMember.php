<style>
.header_right h3 ,.header_right select{
    display:none;
}
.token-input-list-facebook, .zone_select{
    display:none;
}
</style>
<title>AddMember</title>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">

 <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/layout/css/tokeninput_jquery-master/src/jquery.tokeninput.js"></script>
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/layout/css/tokeninput_jquery-master/styles/token-input.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/layout/css/tokeninput_jquery-master/styles/token-input-facebook.css" type="text/css" />
  
<!-- Bootstrap core CSS     -->
  <!-- BEGIN CONTENT -->
	<div class="col-md-12 inner_white mt-4">
        <div class="row">
				<?php

                if($this->session->flashdata('item')) {
                $message = $this->session->flashdata('item');
                ?>
                <div class="<?php echo htmlspecialchars($message['class']); ?>"><?php echo htmlspecialchars($message['message']); ?>
                
                </div>
                <?php
                }
                
                ?>		
          <div class="pink_bar"> <h4>Add Member</h4> <div class="col-md-6 ml-auto pink_right"> 

</div>
						
					</div>
        </div>				 
        <div class="row mandates">
          <div class="table-responsive" id="table_data">
             <form action="<?php echo base_url() ?>member/addMemberDetails" class="form-horizontal form-row-seperated"  method="POST" id="MemberForm">
                                <?php 
                                   //$id=$result['id'];
					            echo form_open();
								//echo "<pre>"; print_r($result); exit;
								?>
								<?php echo validation_errors('<div style="color:red">','</div>'); ?>
											<div class="form-body">
												<div class="form-group">
										<label class="control-label col-md-3"> Name</label>
													<div class="col-md-9">
	<input type="text" placeholder="Enter  Name" class="form-control" id="name" name="name">													</div>
												</div>
											
												<div class="form-group">
										<label class="control-label col-md-3">Email</label>
													<div class="col-md-9">
						<input type="text" placeholder="Enter Email" class="form-control" id="email" name="email">													</div>
												</div>
												<div class="form-group">
										<label class="control-label col-md-3">Phone Number</label>
													<div class="col-md-9">
						<input type="text" placeholder="Enter Phone Number" class="form-control" id="phone" name="phone">													</div>
												</div>
												
								<!-- 	<div class="form-group">
													<label class="control-label col-md-3">Password</label>
													<div class="col-md-9">
		<input type="password" placeholder="Enter Password" class="form-control" id="password" name="password">
													</div>
												</div> -->
												<div class="form-group">
                                                <label class="control-label col-md-3">Role Type</label>
                    <div class="col-md-9">
                                            
      <select class="form-control input-sm" id="role_id" name="role_id" style="height:40px;">
            <option value="0">Select Role</option>
																												<option value="3">Maker</option>
																												<option value="4" >Checker</option>
																												<option value="5">Releaser</option>
																												<option value="6">View Access</option>
                                                        <!-- <option value="9">Zonal Administrator</option> -->
			</select>
			</div>
												</div>
												
												<div class="form-group zone_type" id="zone_label" style="display:none;">
												    <input type="hidden" name="" class="pmode_id" value="">
                                                <label class="control-label col-md-3">Zone Type</label>
                    <div class="col-md-9">
                                            
                <select  class="form-control input-sm zone_select" id="zone_id" name="zone_id" style="height:40px;">
                    <option value=" ">Select Zone</option>
			    </select>
			<input type="text" class="form-control" id="input-local-prevent-duplicates" name="input-local-prevent-duplicates" style="display:none;">
			<span id="mul_zone_id"></span>
			    <script type="text/javascript">
                  $(document).ready(function() {
                    $("#input-local-prevent-duplicates").tokenInput("<?php echo base_url() ?>member/getByZone", {
                      theme: "facebook",
                     preventDuplicates: true,
                     prePopulate: JSON.parse('[]'),
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
<!--<script src="<?php //echo base_url() ?>assets/js/jquery-3.1.1.js" type="text/javascript"></script>-->
<!--        <script src="<?php //echo base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>-->
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
	$.validator.addMethod("noSpecialWithSpace", function(value, element) {
	var regex = /^[\w\-\s]+$/;
	    if (regex.test(value) || !value) {
        return true;
    }
    return false;
}, "No special characters allowed except '/ - _ '");

$.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal arg.");

        $("#MemberForm").validate({
            
            rules: {
                "name": {
                    required : true,
                    maxlength: 50,
                    noSpecialWithSpace: true

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
                
                role_id: { valueNotEquals: " " },
                // zone_id: { valueNotEquals: " " }
            },
            messages: {
              name: {
                  required: "Please enter your full name",
                  noSpecial: "Name should not contain special characters."
                  
              },
              password: {
                required: "Please enter a password",
                minlength: "Your password must be at least 8 characters long",
                pwcheck: "Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number and one special character!"
              },
              phone: {
                required: "Please enter a mobile",
                minlength: "Mobile number must be of 10 digits",
                maxlength: "Mobile number must be of 10 digits"
              },
              email:{ 
                required: "Please enter a valid email address",
              },
               role_id: { valueNotEquals: "Please select a role type !" }
            //   zone_id: { valueNotEquals: "Please select a zone type !" }
            }
        });

    </script>
<style>
	.error {
    color:red;
    }  
</style>
<!--<script type="text/javascript" src="/assets/js/jquery.tokeninput.js"></script>-->
<!--<link rel="stylesheet" type="text/css" href="/assets/css/token-input.css" /> 	-->
<script type="text/javascript">
$('#role_id').change(function() {
    
    var selected = $(this).val();
    console.log(selected);
    if(selected == '5' || selected == '6'){
        $('#zone_label').show();
      $('.token-input-list-facebook').show();
      
      $('.zone_select').hide();
      $('#mul_zone_id').html('<input type="hidden" value=""  class="zone_id zone_multiple" name="zone_id" >');
    }else if(selected == ' '){
        $('#zone_label').hide();
    }
    else{
        $('#zone_label').show();
       $('#mul_zone_id').html('');
       $('.token-input-list-facebook').hide();    
      $('.zone_select').show();
    }
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var post_url = '<?php echo base_url() ?>member/getByZone'
    $.ajax({
        type: "POST",
        url: post_url,
        data : { "id" : $(this).val(),"csrf_test_name" : $("input:hidden[name='csrf_test_name']").val() },
        success: function(response){
          var obj = JSON.parse(response);
          console.log(obj);
          if(obj){
             $.each(obj, function(value, key) {
              $("#zone_id").append("<option value="+obj[value]['id']+">"+obj[value]['name']+"</option>");
            })
          }
          
        }
    });
});
</script>
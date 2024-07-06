<title>Change Member Password</title>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<!-- BEGIN CONTENT -->
<div class="container" >
<div class="row">
<div class="col-md-12 inner_white mt-4">

    <?php
      if($this->session->flashdata('item_success')) {
        $message = $this->session->flashdata('item_success');
        ?>
         <div class="alert alert-success"><?php echo htmlspecialchars($message['message']); ?>
      </div>
      <?php
    }elseif ($this->session->flashdata('item_error')) {
     $message = $this->session->flashdata('item_error');
     ?>
     <div class="alert alert-danger"><?php echo htmlspecialchars($message['message']); ?>
      </div>
   <?php }
    ?>    

 
  <div class="row">
      
    <div class="pink_bar"> <h4>Change Password
      <?php if ($this->session->userdata('id')) {
          $userId =  $this->session->userdata('id');
      }  ?></h4> 
      <div class="col-md-6 ml-auto pink_right"> 
      </div>
    </div>
  </div>				 
  <div class="row mandates">
    <div class="table-responsive" id="table_data">
      <form action="<?php echo base_url() ?>member/changenewUserpassword/<?php echo $userId ?>" class="form-horizontal form-row-seperated"  method="POST" id="changeuserPwdForm"  >
        <?php echo form_open(); ?>
        <div class="form-body" >
          <div class="form-group" >
            <label class="control-label col-md-3">Password</label>
            <div class="col-md-12">
              <input type="password" placeholder="Enter Password" class="form-control" id="password" name="password">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3">Confirm Password</label>
            <div class="col-md-12">
              <input type="password" placeholder="Enter Confirm Password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
          </div>

          <div class="form-actions">
              <div class="col-md-offset-3 col-md-12" style="text-align: center;">
                <button type="submit" class="btn upload_button" >
                  Submit 
                </button>
              </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
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

  $.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== value;
  }, "Value must not equal arg.");
  $("#changeuserPwdForm").validate({
    rules: {
      "password": {
        required: true,
        minlength: 8,
        maxlength: 20,
        pwcheck: true

      },
       "confirm_password": {
        required: true,
        minlength: 8,
        maxlength: 20,
        pwcheck: true,
        equalTo: "#password"

      }
    },
      messages: {
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 8 characters long",
          pwcheck: "Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number and one special character!"
        },
         confirm_password: {
          required: "Please provide a confirm password",
          minlength: "Your password must be at least 8 characters long",
          pwcheck: "Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number and one special character!",
          equalTo: "Password does not match !"
        }

      }
    });

  </script>
<style>
.error {
color:red;
}  
</style>


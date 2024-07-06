<title>File List</title>
<script src="<?php echo base_url() ?>assets/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="<?php echo base_url() ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$( function() {
$( "#fromDate" ).datepicker({
  dateFormat: 'dd-mm-yy',
  maxDate: new Date() });
} );
$( function() {
$( "#toDate" ).datepicker({
  dateFormat: 'dd-mm-yy',
  maxDate: new Date() });
} );
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/css/dataTables.jqueryui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/css/buttons.jqueryui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/css/shCore.css">
<style>
		/* CodePen demo */

/* Custom dropdown */
.custom-dropdown {
  position: relative;
  display: inline-block;
  vertical-align: middle;
  margin: 10px; /* demo only */
}

.custom-dropdown select {
  background-color: #1abc9c;
  color: #fff;
  font-size: inherit;
  padding: .5em;
  padding-right: 2.5em;	
  border: 0;
  margin: 0;
  border-radius: 3px;
  text-indent: 0.01px;
  text-overflow: '';
  -webkit-appearance: button; /* hide default arrow in chrome OSX */
}

.custom-dropdown::before,
.custom-dropdown::after {
  content: "";
  position: absolute;
  pointer-events: none;
}

.custom-dropdown::after { /*  Custom dropdown arrow */
  content: "\25BC";
  height: 1em;
  font-size: .625em;
  line-height: 1;
  right: 1.2em;
  top: 50%;
  margin-top: -.5em;
}

.custom-dropdown::before { /*  Custom dropdown arrow cover */
  width: 2em;
  right: 0;
  top: 0;
  bottom: 0;
  border-radius: 0 3px 3px 0;
}

.custom-dropdown select[disabled] {
  color: rgba(0,0,0,.3);
}

.custom-dropdown select[disabled]::after {
  color: rgba(0,0,0,.1);
}

.custom-dropdown::before {
  background-color: rgba(0,0,0,.15);
}

.custom-dropdown::after {
  color: rgba(0,0,0,.4);
}

 .fade{
                opacity:99999999
        }
  .error {
    color:red;
    }  
.alert-success{
color:green;
}
.modal-backdrop {
  z-index: -1;
}
	</style>
<?php
$session_data = $this->session->all_userdata();
$role_id = $session_data['role_id'];

 ?>
  <div class="col-md-12 inner_white mt-4 dash_x">
      <div class="row">
      <div class="alert-success fade in" id="successMsg"> </div>
          <div class="pink_bar"> 

            <h4>Records List</h4> 
            <!-- <h4>Total Amount: &#x20B9; <span id="totalAmount"></span></h4> -->
            <h4> </h4>
            <div class="col-md-6 ml-auto pink_right"> </div>  
          </div>
        </div>
        <br>
        
          <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verify Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <small id="passwordModelStatus"></small>
                <p><small><b>Username:</b> <span id="modelUser"><?php echo $session_data['name'];?> </span></small></p>
                <p><small><b>Total Amount:</b> <span id="modelAmount"></span></small></p>
                <form>
                  <div class="form-group">
                    <label for="password" class="col-form-label"><small>Password:</small></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                  </div>
                  <div class="form-group" id="otpDiv" style="display: none;">
                    <label for="otp" class="col-form-label"><small>OTP:</small></label>
                    <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" id="verifyPass" class="btn btn-primary">Verify</button>
                <button type="button" id="verifyOTP" class="btn btn-success" style="display: none;">Verify</button>
              </div>
            </div>
          </div>
        </div>

        
        <?php echo validation_errors(); ?>
		<form id="link_pay_forms" method="POST" enctype="multipart/form-data" action="<?php echo base_url() ?>FileApprove/getRecords">
		    <?php echo form_open(); ?>
                                     <div class="row formpanelrow smalltablerow">
            <div class="col-md-3 zerorightpadding ml-auto" >
                                            <div class="form-group">
                                                <label><b>From Upload Date</b></label>
                  <div class="form-group input-group loc">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                      <?php  if(!empty($_REQUEST['fromDate'])){ ?>
        <input class="form-control input-sm datepickersettle" id="fromDate" NAME="fromDate" placeholder="From Date" style="height:40px;" value="<?php echo $_REQUEST['fromDate']; ?>">
      <?php }else{ ?>  
         <input class="form-control input-sm datepickersettle" id="fromDate" NAME="fromDate" placeholder="From Date" style="height:40px;" value="<?php echo date('d-m-Y'); ?>">
      <?php }  ?>
                                                </div>
                                            </div>
                                        </div>
              <div class="col-md-3 zerorightpadding ml-auto" >
                                            <div class="form-group">
                                                <label><b>To Upload Date</b></label>
<div class="form-group input-group loc">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                <?php  if(!empty($_REQUEST['toDate'])){ ?>                                            
       <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;" value="<?php echo $_REQUEST['toDate']; ?>">
      <?php }else{ ?>  
         <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;" value="<?php echo date('d-m-Y'); ?>">
      <?php }  ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto" >
                                            <!-- <div class="form-group">
                                                <label><b>Product Type</b></label>
                    <div class="form-group input-group">
                                                  
      <select class="form-control input-sm" id="annexure_type" name="annexure_type" style="height:40px;">
                                                        <option value="">All Type</option>
                                    <option value="SLCOL" >SLCOL</option>
                                 <option value="USCLN" >USCLN &nbsp;</option>
                                
																			            </select>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="col-md-2 alignCenterPhone">
                                            <div class="filler">&nbsp;</div>
                <button type="submit" class="btn btn-success " NAME="Submit" style="float: right;height: 40px;margin-top: 5px;background-color:  #9898CC;">
                                                <i class="fa fa-search fa-btn-success"></i> &nbsp;Search
                                            </button>
                                        </div>
                                        
                                        <div class="col-md-1 alignCenterPhone">
                                            <div class="filler" id="errormsg">&nbsp;</div>
                                        </div>
                                        
                                    </div>
                                </form>
        <div class="row mandates">
<div class="table-responsive" id="table_data">
   <form action="<?php echo base_url() ?>FileApprove/changeStatus" name="releaseForm" method="POST" class="form-horizontal" enctype="multipart/form-data">
       <?php echo form_open(); ?>
   <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
   <thead>
  <tr>
 <!--  <?php if($role_id == 4){ ?>
    <th scope="col"><input type="checkbox" class="checkboxAll" name="selectAll" id="selectAllDomainList" /></th><?php } ?> -->
     <!--  <th scope="col"><div class="dropdown grup_typ">
  <button class="btn grup_bt dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  SO Maker name
  </button>
  
</div></th> -->

      <th scope="col">Sno</th>
      <th scope="col">File Id</th>
      <th scope="col">Zone Name</th>
      <th scope="col">Sector No.</th>
      <th scope="col">Name of Village</th>
      <th scope="col">Date of Section 4</th>
      <th scope="col">Date of Section 6</th>
      <th scope="col">Award No.</th>
      <th scope="col">Date of Award</th>
      <th scope="col">Khewat No.</th>
      <th scope="col">Acquired Area</th>
      <th scope="col">Acre</th>
      <th scope="col">Kanal</th>
      <th scope="col">Marla</th>
      <th scope="col">Bank A/c No. of LAO</th>
      <th scope="col">Name of Beneficiary</th>
      <th scope="col">Care of</th>
      <!-- <th scope="col">Net Amount</th> -->
      <th scope="col">EDC</th>
      <th scope="col">Customer Reference No</th>
      <th scope="col">File Reference No</th>
      <!-- <th scope="col">Duplicate</th> -->
      <th scope="col">File Name</th>
      <th scope="col">Net Amount</th>
      <th scope="col">Initiated By</th>
      <th scope="col">Initiated On</th>
      <th scope="col">Authorised By</th>
      <th scope="col">Authorised On</th>
      <th scope="col">Status Desc</th>
      <th scope="col">Status</th>
      <th scope="col">Upload Date</th>
<!-- 
      $annexure['Original'] = array(
                              'serial_no'                    => 'Sno',
                              'zone'                    => 'Zone',
                              'section_no'                => 'Sector No.',
                              'village_name'           => 'Name of Village',
                              'date_section_4'            => 'Date of Section 4 Notification (DD-MM-YY)',
                              'date_section_6'                     => 'Date of Section 6 Notification (DD-MM-YY)',
                              'award_no'                   => 'Award No.',
                              'award_date'          => 'Date of Award (DD-MM-YY)',
                              'khewat_no'             => 'khewat no. of award statement',
                              'area_of_applicant'                    => 'acquired area of applicant / share',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'bank_account_no'              => 'Bank A/c No. of LAO from which payment is to be made',
                              'beneficiary_name'         => 'Name of Beneficiary',
                              'care_of'                 => 'Son of/ Daughter of/ Wife of',
                              'net_amount'                   => 'Net Amount to be Paid',
                              'edc_code'                    => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'reference_no'               => 'Customer Reference No',

                              ); 
                            
                                                [id] => 1

                  -->
      
  </tr>
  </thead>
      <tbody>
      <DIV STYLE="visibility:hidden">
      <input type="text" id="reason_file_auth" name="reason" value="">
   <input type="text" id="btn-action_auth" name="action" value="">
   <input type="text" id="btn-action_file_auth" name="action" value="">
   <input type="text" id="current_status" name="current_status" value="2">
   </div>
  
      <!-- <td><?php	echo 	htmlspecialchars($result[0]["file_name"]);	?></td>
      <td><?php	echo 	htmlspecialchars($result[0]["total_records"]);	?></td>
      <td><?php	echo 	htmlspecialchars($result[0]["is_error"]);	?></td>
      <td><?php echo date('d-m-Y', strtotime($result[0]["created_on"])); ?></td> -->

<?php
foreach ($result as $key => $value) {
  // print_r($value["id"]);
    ?>
    <tr>
    <td><?php	echo htmlspecialchars($value["id"]);	?></td>
    <!-- <td><?php	echo htmlspecialchars($value["file_id"]);	?></td> -->
    <!-- <td><?php	echo htmlspecialchars($value["zone_id"]);	?></td> -->
    <td><?php	echo htmlspecialchars($value["s_no"]);	?></td>
    <td><?php	echo htmlspecialchars($value["zone_name"]);	?></td>
    <td><?php	echo htmlspecialchars($value["sector_no"]);	?></td>
    <td><?php	echo htmlspecialchars($value["name_of_village"]);	?></td>
    <td><?php	echo htmlspecialchars($value["date_of_four_section"]);	?></td>
    <td><?php	echo htmlspecialchars($value["date_of_six_sectiom"]);	?></td>
    <td><?php	echo htmlspecialchars($value["award_no"]);	?></td>
    <td><?php	echo htmlspecialchars($value["award_date"]);	?></td>
    <td><?php	echo htmlspecialchars($value["khewat_no"]);	?></td>
    <td><?php	echo htmlspecialchars($value["acquired_area"]);	?></td>
    <td><?php	echo htmlspecialchars($value["acre"]);	?></td>
    <td><?php	echo htmlspecialchars($value["kanal"]);	?></td>
    <td><?php	echo htmlspecialchars($value["marla"]);	?></td>
    <td><?php	echo htmlspecialchars($value["bank_ac_lao"]);	?></td>
    <td><?php	echo htmlspecialchars($value["name_of_bene"]);	?></td>
    <td><?php	echo htmlspecialchars($value["care_of"]);	?></td>
    <td><?php	echo htmlspecialchars($value["is_edc"]);	?></td>
    <td><?php	echo htmlspecialchars($value["customer_ref_numer"]);	?></td>
    <td><?php	echo htmlspecialchars($value["file_ref_number"]);	?></td>
    <td><?php	echo htmlspecialchars($value["file_name"]);	?></td>
    <!-- <td><?php	echo htmlspecialchars($value["is_duplicate"]);	?></td> -->
    <!-- <td><?php	echo htmlspecialchars($value["is_empty"]);	?></td> -->
    <td><?php	echo htmlspecialchars($value["net_amount"]);	?></td>
    <td><?php	echo htmlspecialchars($value["initiation_by"]);	?></td>
    <td><?php echo date('d-m-Y H:i:s', strtotime($value["initiated_on"])); ?></td>
    <td><?php echo htmlspecialchars($value["authorised_by"]);?></td>
    <td><?php echo date('d-m-Y H:i:s', strtotime($value["authorised_on"])); ?></td>
    <td><?php echo htmlspecialchars($value["status_desc"]);?></td>
    <td>
    <?php  if($value["is_error"]==2){
          echo "<span style='color:#EA4335'><b>Validation Failed</b</span>";
        }else if($value["is_error"]==3){
          echo "<span class='text-primary'><b>Pending for Initiation</b</span>";
        }else if($value["is_error"]==4){
          echo "<span style='color:#28A74B'><b>Pending at LAO</b</span>";
        }else if($value["is_error"]==5){
          echo "<span style='color:#28A74B'><b>Approved</b</span>";
        }
        ?></td>
    <td><?php echo date('d-m-Y H:i:s', strtotime($value["created_on"])); ?></td>
    </tr>
    <?php } ?>
	        </tbody>
        </table>
        </form>
      </div>
	</div>	
</div>
        <script type="text/javascript">
          $(document).ready(function(){
    $('.checkboxAll').click(function(){
         if ($(this).is(":checked")) {
            $(".upload_button").removeAttr("disabled");
        } else {
            $(".upload_button").attr("disabled", "disabled");
        }
    });
    $('.checkbox1').change(function() {
            var chkds =  $('input:checkbox:checked').length;
            if(chkds >= 1){
              //alert('if')
              $(".upload_button").removeAttr("disabled");
            }
            else{
              //alert('else')
              $(".upload_button").prop("disabled", true);
            }
    });
});
        </script>
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
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/js/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/layout.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core componets
	Layout.init(); // init layout
});
</script>
	<script src="<?php echo base_url() ?>assets/global/scripts/datatable.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/jquery-1.12.4.js"></script>
-->

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/jquery.dataTables.js"></script>


<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/dataTables.jqueryui.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/dataTables.buttons.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/buttons.jqueryui.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/jszip.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/pdfmake.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/vfs_fonts.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/buttons.html5.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/buttons.print.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/buttons.colVis.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/syntax_shCore.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<?php $amount = moneyFormatIndia($totalAmount);  
//echo $amount; exit;
?>
<script>
	$(document).ready(function() {
    
    var table = $('#example').DataTable( {
        "aLengthMenu": [[20,40,60, -1], [20,40,60, "All"]],
       // "order": [[11,"desc"]],
         "scrollX": true,
        buttons: ['excel'],
"language": {
      "emptyTable": "No Records"
    }
    } );
 
    table.buttons().container()
        .insertBefore( '#example_filter' );

    $(".upload_button").click(function(){
      $('#exampleModal').modal('show'); 
       
      var values = new Array();
      var totalRecords = 0;
      $.each($("input[name='id[]']:checked"), function() {
        var checkVal = $(this).val();
        var fields = checkVal.split(',');
        values.push(fields[1]);
        totalRecords += parseInt(fields[1]);
      });
      console.log(totalRecords);
      $('#modelAmount').html(totalRecords);

    });

    $("#verifyPass").click(function(){
      var data = $("#password").val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('FileApprove/verifyPassword');?>',
        data: {password:data},
        success: function(data) {
          //console.log(data);
          const obj = JSON.parse(data);
          if(obj.statusCode == "NP000"){
            $('#passwordModelStatus').html('<p style="color:#28A74B;">'+ obj.message +'</p>');
            $('#otpDiv').show();
            $('#verifyPass').hide();
            $('#verifyOTP').show();
            $("#password").prop('disabled', true);
          }
          else{
            $('#passwordModelStatus').html('<p style="color:#EA4335;">'+ obj.message +'</p>');
            $('#otpDiv').hide();
          }
        }
      });
    });

    $("#verifyOTP").click(function(){
      var data = $("#otp").val();
      var id = new Array();
      $.each($("input[name='id[]']:checked"), function() {
        var checkVal = $(this).val();
        var fields = checkVal.split(',');
        id.push(fields[0]);
      });
      var ref = new Array();
      $.each($("input[name='id[]']:checked"), function() {
        var checkVal = $(this).val();
        var fields = checkVal.split(',');
        ref.push(fields[2]);
      });
      var values = new Array();
      values.push(id);
      values.push(ref);
      console.log(values);

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('FileApprove/verifyOTP');?>',
        data: {otp:data},
        success: function(data) {
          console.log(data);
          const obj = JSON.parse(data);
          if(obj.statusCode == "NP000"){
            $.ajax({
              type: 'POST',
              url: '<?php echo base_url('FileApprove/approveData');?>',
              data: {values:values},
              success: function(data) {
                const obj = JSON.parse(data);
                if(obj.statusCode == "NP000"){
                  // $('#uploadForm')[0].reset();
                  $('#successMsg').html('<p style="color:#28A74B;">'+ obj.message +'</p>');
                  location.reload();
                }
                else{
                  // $('#uploadForm')[0].reset();
                  $('#successMsg').html('<p style="color:#EA4335;">'+ obj.message +'</p>');
                  //location.reload();
                }
              }
            });
            // $('#passwordModelStatus').html('<p style="color:#28A74B;">'+ obj.message +'</p>');
            // $('#otpDiv').show();
            // $('#verifyPass').hide();
            // $('#verifyOTP').show();
          }
          else{
            $('#passwordModelStatus').html('<p style="color:#EA4335;">'+ obj.message +'</p>');
            //$('#otpDiv').hide();
          }
        }
      });
    });
  
});
	
	$('#selectAllDomainList').click (function () {
     var checkedStatus = this.checked;
    $('#example tbody tr').find('td:first :checkbox').each(function () {
        $(this).prop('checked', checkedStatus);
     });
});
	$(window).load(function ()
{
      
	jQuery('#totalAmount').html('<?php echo htmlspecialchars($amount); ?>');
	
});
	</script>
  
<script type="application/javascript">
/** After windod Load */
$(window).bind("load", function() {
  window.setTimeout(function() {
    $(".alert").fadeTo(150000, 0).slideUp(150000, function(){
        $(this).remove();
    });
}, 15000);
});


</script>

<style>
  .modal{
    padding-top: 200px;
  }
  .dash_x .pink_bar{

margin:15px;
padding:10px 0;
border-radius:10px;
background-color:#9898CC;
box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}

.dash_x .pink_bar h4{

color:#fff !important;
font-weight:500;
font-size:20px;
background:#9898CC


}
.dash_x .upload_button{
background:#9898CC !important;
color:#fff !important;
font-weight:400;
}
.dash_x .form-group{
  font-weight:400;

}
</style>

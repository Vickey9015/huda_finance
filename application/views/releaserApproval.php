<title>Annexures List</title>
<?php 
if (empty($result['fromDate']) || empty($result['toDate'])){
  $fromDate=date('d-m-Y');
  $toDate=date('d-m-Y');
 } else{
   $fromDate=$result['fromDate'];
   $toDate=$result['toDate'];
 }
 ?>
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
	</style>
<?php
$session_data = $this->session->all_userdata();
$role_id = $session_data['role_id'];
$is_view = $session_data['is_view'];
if($this->session->flashdata('item')){
    $message=$this->session->flashdata('item');
}

 ?>
  <div class="col-md-12 inner_white mt-4" ng-controller="customerCtrl">
        <div class="row">
<?php if($this->session->flashdata('item')): ?>
			<div class="<?php echo $message['class'] ?>"><?php echo htmlspecialchars($message['message']); ?>

</div>
<?php endif; ?>
          <div class="pink_bar"> <h4>Waiting For Release</h4> <h4>Total Amount: &#x20B9; <span id="totalAmount"></span></h4><div class="col-md-6 ml-auto pink_right"> 

</div>  </div>
        </div>
		<form id="link_pay_forms" method="POST" enctype="multipart/form-data" action="<?php echo base_url() ?>releaserApproval/waitingApproval">
		    <?php echo form_open();
								 echo validation_errors('<div style="color:red">','</div>');
								 ?>
                                     <div class="row formpanelrow smalltablerow">
            <div class="col-md-3 zerorightpadding" >
                                            <div class="form-group">
                                                <label><b>From Upload Date</b></label>
                  <div class="form-group input-group loc">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                       <input class="form-control input-sm datepickersettle" id="fromDate" NAME="fromDate" placeholder="From Date" style="height:40px;" value="<?php echo $fromDate; ?>">
                                                </div>
                                            </div>
                                        </div>
              <div class="col-md-3 zerorightpadding" >
                                            <div class="form-group">
                                                <label><b>To Upload Date</b></label>
<div class="form-group input-group loc">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;" value="<?php echo $toDate; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto" >
                                            <div class="form-group">
                                                <label><b>Annexure Type</b></label>
                    <div class="form-group input-group">
                                                   <!-- <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>-->
      <select class="form-control input-sm" id="annexure_type" name="annexure_type" style="height:40px;">
                                                        <option value="">All Type</option>
                                  <option value="1" <?php if ($_REQUEST['annexure_type'] == '1') { echo 'selected'; } ?>>Original</option>
                                 <option value="2" <?php if ($_REQUEST['annexure_type'] == '2') { echo 'selected'; } ?>>Lower Court &nbsp;</option>
                                  <option value="3" <?php if ($_REQUEST['annexure_type'] == '3') { echo 'selected'; } ?>>High Court &nbsp;</option>
                                  <option value="4" <?php if ($_REQUEST['annexure_type'] == '4') { echo 'selected'; } ?>>Supreme Court &nbsp;</option>
 								 <option value="5" <?php if ($_REQUEST['annexure_type'] == '5') { echo 'selected'; } ?>>DD &nbsp;</option>	
								 <option value="5" <?php if ($_REQUEST['annexure_type'] == '5') { echo 'selected'; } ?>>Supreme Court DD &nbsp;</option>
 								  <option value="6" <?php if ($_REQUEST['annexure_type'] == '6') { echo 'selected'; } ?>>Original DD &nbsp;</option>
 								  <option value="7" <?php if ($_REQUEST['annexure_type'] == '7') { echo 'selected'; } ?>>Lower Court DD &nbsp;</option>
 								  <option value="8" <?php if ($_REQUEST['annexure_type'] == '8') { echo 'selected'; } ?>>High Court DD &nbsp;</option>
								 </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 alignCenterPhone">
                                            <div class="filler">&nbsp;</div>
                <button type="submit" class="btn btn-success " NAME="Submit" style="float: right;height: 40px;margin-top: 5px;background-color: #b53363;">
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
   <form action="<?php echo base_url() ?>approvallist/changeReleaserStatus" name="releaseForm" method="POST" class="form-horizontal" enctype="multipart/form-data">
       <?php echo form_open(); ?>
   <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
   <thead>
  <tr>
  <?php if ($role_id == 5 or $role_id == 9) {?>
    <th scope="col"><input type="checkbox" class="checkboxAll" name="selectAll" id="selectAllDomainList" /></th><?php } ?>
      <th scope="col"><div class="dropdown grup_typ">
  <button class="btn grup_bt dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Maker Name 
  </button>
</div></th>
      <th scope="col">File name</th>
      <th scope="col"> <div class="dropdown grup_typ">
  <button class="btn grup_bt dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Annexure type
  </button>
  
</div></th>
      <th scope="col">Upload Date </th>
      <th scope="col">Total Records</th>
      <th scope="col">Pending With Releaser</th>
      
  </tr>
  </thead>
      <tbody>
      <DIV STYLE="visibility:hidden">
      <input type="hidden" id="reason_file" name="reason" value="">
      <input type="hidden" id="btn-action_file" name="action" value="">
	  <input type="hidden" id="current_status" name="current_status" value="3">
      </div>
							<?php 
$totalAmount = 0;
$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
if(!empty($result)){
foreach($result as $key=>$item){
	if($item["with_releaser"] != 0){
				$ref_no                  = $item["reference_number"];
                                 
				     $annexure_type      	    =    unserialize(ANNEXURE_NAME);
$path      =base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
                                   $type                    = $item["annexure_type"];
                                   $totalAmount            +=$item["with_releaser_sum"];
                                   ?>
  <tr>
  <?php if ($role_id == 5 or $role_id == 9) {?>
     <td scope="row"> 
     <label class="custom_chk">
   <input type="checkbox" name="reference_number[]"  class="checkbox1" id="color" value="<?php echo $item["reference_number"];?>">
  <span class="checkmark"></span>
</label>
      </td><?php } ?>
      <td><?php echo  $item["maker_name"]; ?></td>
      <td><a href="complexDownload" download="<?php echo  $item["file_name"]; ?>" onclick="this.href='<?php echo $path; ?>';"><?php echo  htmlspecialchars($item["file_name"]); ?></a></td>
      <td><?php	echo 	htmlspecialchars($annexure_type[$item["annexure_type"]]);	?></td>
      <td><?php echo date('d-m-Y', strtotime($item["created_on"])); ?></td>
	  <td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>"><?php  echo htmlspecialchars($item["totalRecord"]);  ?></a><br> &#x20B9; <?php  if($item["totalRecord_sum"] > 0){
				echo moneyFormatIndia(htmlspecialchars($item["totalRecord_sum"]));
				}else{
				echo '0';
				}  ?></td>
<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>/3"><?php echo  htmlspecialchars($item["with_releaser"]); ?></a> <br> &#x20B9;<span class="netAmount"> <?php  if($item["with_releaser_sum"] > 0){
				echo moneyFormatIndia(htmlspecialchars($item["with_releaser_sum"]));
				}else{
				echo '0';
				}  ?></span></td>
	</tr>
		<?php
		}
							  }
						}	  
      ?>
	   </tbody>
</table>
<?php if (($role_id == 5 or $role_id == 9) && $is_view !=1) {?>
<button type="button"  ng-click="confirmRelease($event,'reject','file')" class="btn upload_button mr-4" name="action" value="reject" style="background-color:#353535;margin-left: 35%;" disabled>Reject</button>
<button type="button"  ng-click="confirmRelease($event,'release','file')" class="btn upload_button" disabled="true">
  Release
</button>
<?php } ?>
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
              $('button.btn').removeAttr("disabled");
            }
            else{
              //alert('else')
              $('button.btn').prop("disabled", true);
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
<?php $amount                 =moneyFormatIndia($totalAmount);  
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
} );
	
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
    $(".alert").fadeTo(15000, 0).slideUp(15000, function(){
        $(this).remove();
    });
}, 15000);
});
</script>
<style>
.fade{
                opacity:99999999
        }
  .error {
    color:green;
    }  
	</style>
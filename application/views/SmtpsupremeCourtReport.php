<title>SupremeCourtReport</title>
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
	<!--<script src='http://ajax.googleapis.com/ajax/libs/prototype/1.7.1/prototype.js'></script>-->
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
  <!-- BEGIN CONTENT -->
	<div class="col-md-12 inner_white mt-4">
        <div class="row">
          <div class="pink_bar"> <h4 style="margin-left: 0%;width: 100%;">Annexures<span id="" style="margin-right:10%;"></span><span id="" style="margin-right:10%;"></span><span id="" ></span><span id=""></span></h4><div class="col-md-6 ml-auto pink_right"> 

</div>
						
					</div>
        </div>
				<nav style="margin-bottom: 8px;">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link" id="nav-home-tab" href="<?php echo base_url() ?>smtpReport/SMTPOriginalReport" role="tab" aria-controls="nav-home" aria-selected="true">Original (<?php echo htmlspecialchars($totalcount[0]['original']); ?>)</a>
    <a class="nav-item nav-link" id="nav-profile-tab" href="<?php echo base_url() ?>smtpReport/SMTPLowCourtReport" role="tab" aria-controls="nav-profile" aria-selected="false">Lower Court (<?php echo htmlspecialchars($totalcount[0]['lower_court']); ?>)</a>
    <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>smtpReport/SMTPHighCourtReport" role="tab" aria-controls="nav-contact" aria-selected="false">High Court (<?php echo htmlspecialchars($totalcount[0]['high_court']); ?>)</a>
 <a class="nav-item nav-link active" id="nav-contact-tab"  href="<?php echo base_url() ?>smtpReport/SMTPSupremeCourtReport" role="tab" aria-controls="nav-contact" aria-selected="false">Supreme Court (<?php echo htmlspecialchars($totalcount[0]['suprem_court']); ?>)</a>
 <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>smtpReport/SMTPDDReport" role="tab" aria-controls="nav-contact" aria-selected="false">DD Report (<?php echo htmlspecialchars($totalcount[0]['dd']); ?>)</a>
 
 
  </div>
</nav>
			<!--<form id="link_pay_forms" method="POST" enctype="multipart/form-data" action="<?php echo base_url() ?>report/SupremeCourtReport">
                                     <div class="row formpanelrow smalltablerow">
           <div class="col-md-2">
            <div class="form-check">
        <input class="form-check-input" name="Date" type="radio" id="released_on" value="released_on" <?php if(!isset($_POST['Date']) || (isset($_POST['Date']) && $_POST['Date'] == 'released_on')) echo ' checked="checked"'?>>
        <label class="form-check-label" for="radio121">Released Date</label>
    </div>
  
<div class="form-check">
        <input class="form-check-input" name="Date" type="radio" id="authorized_on" value="authorised_on" <?php if(!isset($_POST['Date']) || (isset($_POST['Date']) && $_POST['Date'] == 'authorised_on')) echo ' checked="checked"'?>>
        <label class="form-check-label" for="radio120">Authorized Date</label>
    </div>
<div class="form-check">
        <input class="form-check-input" name="Date" type="radio" id="upload_date" value="created_on" <?php if(!isset($_POST['Date']) || (isset($_POST['Date']) && $_POST['Date'] == 'created_on')) echo ' checked="checked"'?>>
        <label class="form-check-label" for="radio122">Upload Date</label>
    </div>  </div>
 <div class="col-md-2 zerorightpadding" style="text-align:center;
">
                                            <div class="form-group">
                                                <label>From Date</label>
                  <div class="form-group input-group loc">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                       <input class="form-control input-sm datepickersettle" id="fromDate" NAME="fromDate" placeholder="From Date" style="height:40px;" value="01-01-2018">
                                                </div>
                                            </div>
                                        </div>
              <div class="col-md-2 zerorightpadding" style="
text-align: center;">
                                            <div class="form-group">
                                                <label>To Date</label>
<div class="form-group input-group loc">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;" value="<?php echo date('d-m-Y'); ?>">
                                                </div>
                                            </div>
                                        </div>
														 				 <div class="col-md-2" >
                                            <div class="form-group">
                                                <label>Annexure Status</label>
                    <div class="form-group input-group" style="width: 105%;">
                                                   
      <select class="form-control input-sm" id="annexure_status" name="annexure_status" style="height:40px;">
<option value="">All</option>                                  
<option value="2" selected>Pending at LAO &nbsp;</option>
                                  <option value="3"<?php if ($_REQUEST['annexure_status'] == '3') { echo 'selected'; } ?>>Pending at Releaser &nbsp;</option>							
<option value="7" <?php if ($_REQUEST['annexure_status'] == '7') { echo 'selected'; } ?>>Released &nbsp;</option>
																			            </select>
                                                </div>
                                            </div>
                                        </div>
																		 <div class="col-md-2" >
                                            <div class="form-group">
                                                <label class="text-left"><b>Zone</b></label>
                    <div class="form-group input-group">
                                                   
      <select class="form-control input-sm" id="zone_id" name="zone_id" style="height:40px;">
<option value="">All</option>                                  
<option value="1" <?php if ($_REQUEST['zone_id'] == '1') { echo 'selected'; } ?>>Gurgaon &nbsp;</option>
<option value="2" <?php if ($_REQUEST['zone_id'] == '2') { echo 'selected'; } ?>>Panchkula &nbsp;</option>							
<option value="3" <?php if ($_REQUEST['zone_id'] == '3') { echo 'selected'; } ?>>Faridabad &nbsp;</option>
<option value="4" <?php if ($_REQUEST['zone_id'] == '4') { echo 'selected'; } ?>>Rohtak &nbsp;</option>
<option value="5" <?php if ($_REQUEST['zone_id'] == '5') { echo 'selected'; } ?>>Hissar &nbsp;</option>
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
                                </form>		 -->
        <div class="row mandates">
          <div class="table-responsive" id="table_data">
             <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
               <thead><tr>
                <th scope="col">Sr. No.</th>
<th scope="col">Sector no.</th>
<th scope="col">Name of Village</th>
<th scope="col">Bank A/c No. of LAO from which payment is to be made</th>
<th scope="col">Award No.</th>
<th scope="col">Date of Award (DD-MM-YY)</th>
<th scope="col">ADJ Court Order No.</th>
<th scope="col">Date of Decision by ADJ Court (DD-MM-YY)</th>
<th scope="col">High Court Order No.</th>
<th scope="col">Date of Decision by High Court (DD-MM-YY)</th>
<th scope="col">Supreme Court Order No.</th>
<th scope="col">Date of Decision by Supreme Court (DD-MM-YY)</th>
<th scope="col">Name of Beneficiary
</th>
<th scope="col">Pan No.</th>
<th scope="col">Gross Amount to be Paid
</th>
<th scope="col">TDS to be deducted  
</th>
<th scope="col">Net Amount to be paid to Beneficiary</th>
<th scope="col">IFSC code of Beneficiary</th>
<th scope="col">Bank A/c of the Beneficiary</th>
<th scope="col">EDC OR Non EDC [E= EDC, N = Non EDC]</th>
<th scope="col">10 Digit Mobile number</th>
<th scope="col">Customer Reference Number</th>
  </tr>
  </thead>
		<tbody>
			 <?php 
$grossAmount = 0;
$tdsAmount = 0;
$netAmount =0;
$totalCount=0;
$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
foreach($result as $key=>$item){
                             $ref_no                  = $item["reference_number"];
                             $annexure_status         = unserialize(ANNEXURE_STATUS);
							 $zones                   = unserialize(ZONES);
$path      =base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
                             $annexure_type           =    unserialize(ANNEXURE_NAME);
                              $grossAmount            +=$item["gross_amount_to_paid"];
							  $tdsAmount              +=$item["TDS_deducted"];
							  $netAmount              +=$item["net_amount"];
                              $totalCount             +=$item["reference_number"];
                              
                                                                 ?>
  <tr>
                          <td><?php  echo htmlspecialchars($item["serial_no"]);	?> </td>
						 <td><?php echo htmlspecialchars($item["sector_no"]); ?></td>
                         <td><?php echo htmlspecialchars($item["villlage_name"]);  ?>  </td>
						 <td><?php  echo htmlspecialchars($item["LAO_bank_account_no"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["award_no"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["award_date"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["ADJ_court_order_no"]);  ?></td>
						<td><?php  echo htmlspecialchars($item["ADJ_court_decision_date"]);  ?></td>
						<td><?php  echo htmlspecialchars($item["high_court_order_no"]);  ?></td>
						<td><?php  echo htmlspecialchars($item["high_court_decision_date"]);  ?></td>
						<td><?php  echo htmlspecialchars($item["supreme_court_order_no"]);  ?></td>
						<td><?php  echo htmlspecialchars($item["supreme_court_decision_date"]);  ?></td>
						<td><?php  echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["beneficiary_PAN"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["gross_amount_to_paid"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["TDS_deducted"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["net_amount"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["ifsc_code"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["account_number"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["is_EDC"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["mobile_number"]);  ?></td>
						 <td><?php echo htmlspecialchars($item["customer_reference_number"]); ?></td>											
	 </tr>
			 <?php
															
                            }
                        ?>
			 </tbody>
</table>
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
<?php $gAmount                 =moneyFormatIndia($grossAmount);
$tAmount                 =moneyFormatIndia($tdsAmount);
$nAmount                 =moneyFormatIndia($netAmount);
$totalCnt                =moneyFormatIndia($totalCount);
//echo $amount; exit;
?>
<script>
	$(document).ready(function() {
    var table = $('#example').DataTable( {
        "aLengthMenu": [[20,40,60, -1], [20,40,60, "All"]],
        //"order": [[11,"desc"]],
         "scrollX": true,
        buttons: ['excel'],
"language": {
      "emptyTable": "No Records"
    }
    } );
 
    table.buttons().container()
        .insertBefore( '#example_filter' );
} );

$(window).load(function ()
{
      
	jQuery('#grossAmount').html('<?php echo htmlspecialchars($gAmount); ?>');
	jQuery('#tdsAmount').html('<?php echo htmlspecialchars($tAmount); ?>');
	jQuery('#netAmount').html('<?php echo htmlspecialchars($nAmount); ?>');
	jQuery('#totalCount').html('<?php echo htmlspecialchars($totalCnt); ?>');
	
});

</script>
<style>
  .error {
    color:red;
    }
		#example_length{
			margin-right:2%;
		}
     #example_filter{
			height: 30px;
      margin-top: -4px;
		}
</style>

</body>
</html>

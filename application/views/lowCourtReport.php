<title>LowerCourtReport</title>
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
    <a class="nav-item nav-link " id="nav-home-tab"  href="<?php echo base_url() ?>report/OriginalReport" role="tab" aria-controls="nav-home" aria-selected="true">Original (<?php echo htmlspecialchars($totalcount[0]['original']); ?>)</a>
    <a class="nav-item nav-link active" id="nav-profile-tab"  href="<?php echo base_url() ?>report/LowCourtReport" role="tab" aria-controls="nav-profile" aria-selected="false">Lower Court (<?php echo htmlspecialchars($totalcount[0]['lower_court']); ?>)</a>
    <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>report/HighCourtReport" role="tab" aria-controls="nav-contact" aria-selected="false">High Court (<?php echo htmlspecialchars($totalcount[0]['high_court']); ?>)</a>
 <a class="nav-item nav-link " id="nav-contact-tab"  href="<?php echo base_url() ?>report/SupremeCourtReport" role="tab" aria-controls="nav-contact" aria-selected="false">Supreme Court (<?php echo htmlspecialchars($totalcount[0]['suprem_court']); ?>)</a>
 <a class="nav-item nav-link " id="nav-contact-tab"  href="<?php echo base_url() ?>report/DDReport" role="tab" aria-controls="nav-contact" aria-selected="false">SC DD (<?php echo htmlspecialchars($totalcount[0]['dd']); ?>)</a>
  <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>report/OriginalDDReport" role="tab" aria-controls="nav-contact" aria-selected="false">Original DD (<?php echo htmlspecialchars($totalcount[0]['original_dd']); ?>)</a>
        <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>report/LCDDReport" role="tab" aria-controls="nav-contact" aria-selected="false">LC DD (<?php echo htmlspecialchars($totalcount[0]['lowercourt_dd']); ?>)</a>
        <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>report/HCDDReport" role="tab" aria-controls="nav-contact" aria-selected="false">HC DD (<?php echo htmlspecialchars($totalcount[0]['highcourt_dd']); ?>)</a>
  </div>
</nav>
		<form id="link_pay_forms" method="POST" enctype="multipart/form-data" action="<?php echo base_url() ?>report/LowCourtReport">
		    <?php echo form_open();
								 echo validation_errors('<div style="color:red">','</div>');
								 ?>
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
    </div>  </div><div class="col-md-2 zerorightpadding" style="text-align:center;
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
                <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;" value="<?php echo htmlspecialchars(date('d-m-Y')); ?>">
                                                </div>
                                            </div>
                                        </div>
														 				 <div class="col-md-2" >
                                            <div class="form-group">
                                                <label>Annexure Status</label>
                    <div class="form-group input-group" style="width: 105%;">
                                                   <!-- <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>-->
      <select class="form-control input-sm" id="annexure_status" name="annexure_status" style="height:40px;">
<option value="">All</option>                                  
<option value="2" selected>Pending at LAO &nbsp;</option>
<option value="3"<?php if ($_REQUEST['annexure_status'] == '3') { echo 'selected'; } ?>>Pending at Releaser &nbsp;</option>							
<option value="7" <?php if ($_REQUEST['annexure_status'] == '7') { echo 'selected'; } ?>>Released &nbsp;</option>
<option value="6" <?php if ($_REQUEST['annexure_status'] == '6') { echo 'selected'; } ?>>Returned &nbsp;</option>
<option value="10" <?php if ($_REQUEST['annexure_status'] == '10') { echo 'selected'; } ?>>Reinitiated &nbsp;</option>
<option value="11" <?php if ($_REQUEST['annexure_status'] == '11') { echo 'selected'; } ?>>Disbursed &nbsp;</option>
<option value="12" <?php if ($_REQUEST['annexure_status'] == '11') { echo 'selected'; } ?>>Failed &nbsp;</option>
<option value="4" <?php if ($_REQUEST['annexure_status'] == '4') { echo 'selected'; } ?>>Rejected By LAO &nbsp;</option>
<option value="5" <?php if ($_REQUEST['annexure_status'] == '5') { echo 'selected'; } ?>>Rejected By Releaser &nbsp;</option>
																			            </select>
                                                </div>
                                            </div>
                                        </div>
          <div class="col-md-2" >
                                            <div class="form-group">
                                                <label class="text-left"><b>Zone</b></label>
                    <div class="form-group input-group">
                                                   <!-- <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>-->
      <select class="form-control input-sm" id="zone_id" name="zone_id" style="height:40px;">
              <option value="">Select Zone</option>
              <option value="All" selected>All</option>
              <?php foreach($this->session->userdata('zones_option') as $zone){ 
                  ?>
                  <option  value="<?php echo $zone['id']; ?>"><?php echo $zone['name']; ?></option>
                  <?php } ?>
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
             <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
               <thead><tr>
                 <th scope="col">file name</th>
				 <th scope="col">Zone</th>
<th scope="col">Ref. No.</th>
<th scope="col">Sector no.</th>
<th scope="col">Name of Village</th>
<th scope="col">Award No.</th>
<th scope="col">Date of Award</th>
<th scope="col">Bank A/c of LAO</th>
<th scope="col">Beneficiary name
</th>
<th scope="col">Khewat No.</th>
<th scope="col">Share in the ownership</th>
<th scope="col">Acre</th>
<th scope="col">Kanal</th>
<th scope="col">Marla</th>
<th scope="col">Pan No.</th>
<th scope="col">Gross Amount 
</th>
<th scope="col">TDS to be deducted  
</th>
<th scope="col">Net Amt.</th>
<th scope="col">IFSC Code</th>
<th scope="col">Bank A/c of the Beneficiary</th>
<th scope="col">EDC OR Non EDC</th>
<th scope="col">Mobile Number</th>
<th scope="col">Authorized On</th>
<th scope="col">Released On</th>
<th scope="col">Returned On</th>
<th scope="col">Rejected On</th>
<th scope="col">Annexure Status</th>
<th>Resubmitted</th>
  </tr>
  </thead>
		<tbody>
			 <?php 
$grossAmount = 0;
$tdsAmount = 0;
$netAmount =0;
$totalCount=0;
$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
if(!empty($result)){
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
                         <td><a href="complexDownload" download="<?php echo  $item["file_name"]; ?>" onclick="this.href='<?php echo $path; ?>';"><?php echo htmlspecialchars($item["file_name"]); ?></a></td>
						 <td><?php  echo htmlspecialchars($item['zone_name']);	?> </td>
						 <td><?php echo htmlspecialchars($item["customer_reference_number"]); ?></td>
						 <td><?php echo htmlspecialchars($item["sector_no"]); ?></td>
                         <td><?php echo htmlspecialchars($item["villlage_name"]);  ?>  </td>
						 
						 <td><?php  echo htmlspecialchars($item["award_no"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["award_date"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["LAO_bank_account_no"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["khewat_no"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["share_in_ownership"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["acre"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["kanal"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["marla"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["beneficiary_PAN"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["gross_amount_to_paid"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["TDS_deducted"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["net_amount"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["ifsc_code"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["account_number"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["is_EDC"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["mobile_number"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["authorised_on"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["released_on"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["returned_on"]);  ?></td>
						 <td><?php  echo htmlspecialchars($item["rejected_on"]);  ?></td>	
						 <td><?php  if($item["annexure_status"] == 6){
                              echo htmlspecialchars($item["is_return"]) == 1 ? "Returned" : "Returned (Failed)";
                            }else {
                            echo htmlspecialchars($annexure_status[$item["annexure_status"]]);
                            }
                                ?> 
                        </td>
						 <td><?php  
						 if(($item["annexure_status"] != 6 or $item["annexure_status"] != 11) && $item["is_resubmitted"] == 1){
						 echo 'Yes';
						 }else{
						 echo 'No';
						 }
						 ?></td>
	 </tr>
			 <?php
															
                            }
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

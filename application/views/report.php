<title>Report</title>
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
.modal-backdrop.show{
    opacity: 0;
}
</style>
  <!-- BEGIN CONTENT -->
	<div class="col-md-12 inner_white mt-4">
        <div class="row">
          <div class="pink_bar"> <h4> Reports</h4> <h4> <span id=""></span></h4><div class="col-md-6 ml-auto pink_right"> 

</div>  </div>
        </div>

				 <form id="link_pay_forms" method="POST" enctype="multipart/form-data" action="<?php echo base_url() ?>report/AllReport">
				     <?php echo form_open();
								 echo validation_errors('<div style="color:red">','</div>');
								 ?>
                                     <div class="row formpanelrow smalltablerow">

 												  <div class="col-md-2" style="margin-right:2%;">
                                            <div class="form-group">
                                                <label><b>Annexure Type</b></label>
                    <div class="form-group input-group" style="width:131%;">
                                                   <!-- <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>-->
      <select class="form-control input-sm" id="annexure_type" name="annexure_type" style="height:40px;">
                                  <option value="1" <?php if ($_REQUEST['annexure_type'] == '1') { echo 'selected'; } ?>>Original</option>
                                 <option value="2" <?php if ($_REQUEST['annexure_type'] == '2') { echo 'selected'; } ?>>Lower Court &nbsp;</option>
                                  <option value="3" <?php if ($_REQUEST['annexure_type'] == '3') { echo 'selected'; } ?>>High Court &nbsp;</option>
                                  <option value="4" <?php if ($_REQUEST['annexure_type'] == '4') { echo 'selected'; } ?>>Supreme Court &nbsp;</option>
 								 <option value="5" <?php if ($_REQUEST['annexure_type'] == '5') { echo 'selected'; } ?>>DD &nbsp;</option>
																			            </select>
                                                </div>
                                            </div>
                                        </div>
															 
                                </form>
        <div class="row mandates Original box">
<div class="table-responsive" id="table_data">
          <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
    <thead>
  <tr>
<th scope="col">file name</th>
<th scope="col">Beneficiary Name</th>
<th scope="col">Khewat No.</th>
<th scope="col">Share in the ownership</th>
<th scope="col">Acre</th>
<th scope="col">Kanal</th>
<th scope="col">Marla</th> 
<th scope="col">Award No.</th>
<th scope="col">Date of Award</th>
<th scope="col">ADJ Court Order No.</th>
<th scope="col">Date of Decision by ADJ Court</th>
      <th scope="col"> Sum of TDS to be deducted 
</th>
      <th scope="col"> Count of Transaction Amount2 
</th>

			
			<th scope="col"> Sum of Transaction Amount 
</th>
  </tr>
  </thead>
		<tbody>
			 <?php 
$totalAmount = 0;
if(!empty($result)){
foreach($result as $key=>$item){
                             $ref_no                  = $item["reference_number"];
                             $annexure_status         = unserialize(ANNEXURE_STATUS);
                             $annexure_type           =    unserialize(ANNEXURE_NAME);
                              $totalAmount            +=$item["net_amount"];
                              
                                                                 ?>
  <tr>
                         <td><?php echo htmlspecialchars($item["file_name"]); ?></td>
                         <td><?php  echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["khewat_no"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["share_in_ownership"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["acre"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["kanal"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["marla"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["award_no"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["award_date"]);  ?></td>
<td><?php  echo htmlspecialchars($item["ADJ_court_order_no"]);  ?></td>
<td><?php  echo htmlspecialchars($item["ADJ_court_decision_date"]);  ?></td>
                        <td>-</td>
                        <td>- </td>
		       <td>- </td>											
											
	 </tr>
			 <?php
															
                            }
                    }
                        ?>
			 </tbody>
</table>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>            
 </div>
</div>
      </div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
		<script src="<?php echo base_url() ?>js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/popper.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/bootstrap.min.js" type="text/javascript"></script>
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
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/FixedColumns/js/jquery.dataTables.columnFilter.js"></script>
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

$(window).load(function ()
{
	jQuery('#totalAmount').html('<?php echo htmlspecialchars($amount); ?>');
	
});
</script>
</body>
</html>

<title>Success List</title>
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

 <div class="col-md-11 inner_white mt-4">
        <div class="row">
          <div class="pink_bar"> <h4>Success List of Annexures</h4> <div class="col-md-6 ml-auto pink_right"> 

</div>  </div>
        </div>
        <?php echo validation_errors(); ?>
		 <form id="link_pay_forms" method="POST" enctype="multipart/form-data" action="<?php echo base_url() ?>successList/viewSuccess">
		     <?php echo form_open(); ?>
                                     <div class="row formpanelrow smalltablerow">
            <div class="col-md-3 zerorightpadding" style="margin-right:8%;">
                                            <div class="form-group">
                                                <label><b>From Upload Date</b></label>
                  <div class="form-group input-group loc">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                       <input class="form-control input-sm datepickersettle" id="fromDate" NAME="fromDate" placeholder="From Date" style="height:40px;">
                                                </div>
                                            </div>
                                        </div>
              <div class="col-md-3 zerorightpadding" style="margin-right:8%;">
                                            <div class="form-group">
                                                <label><b>To Upload Date</b></label>
<div class="form-group input-group loc">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 ml-auto" >
                                            <div class="form-group">
                                                <label><b>Annexure Type</b></label>
                    <div class="form-group input-group">
                                                   <!-- <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>-->
      <select class="form-control input-sm" id="annexure_type" name="annexure_type" style="height:40px;">
                                                        <option value="">Annexure Type</option>
                                  <option value="1" <?php if ($_REQUEST['annexure_type'] == '1') { echo 'selected'; } ?>>Original</option>
                                 <option value="2" <?php if ($_REQUEST['annexure_type'] == '2') { echo 'selected'; } ?>>Lower Court &nbsp;</option>
                                  <option value="3" <?php if ($_REQUEST['annexure_type'] == '3') { echo 'selected'; } ?>>High Court &nbsp;</option>
                                  <option value="4" <?php if ($_REQUEST['annexure_type'] == '4') { echo 'selected'; } ?>>Supreme Court &nbsp;</option>
 								 <option value="5" <?php if ($_REQUEST['annexure_type'] == '5') { echo 'selected'; } ?>>Supreme Court DD &nbsp;</option>
 								  <option value="6" <?php if ($_REQUEST['annexure_type'] == '6') { echo 'selected'; } ?>>Original DD &nbsp;</option>
 								  <option value="7" <?php if ($_REQUEST['annexure_type'] == '7') { echo 'selected'; } ?>>Lower Court DD &nbsp;</option>
 								  <option value="8" <?php if ($_REQUEST['annexure_type'] == '8') { echo 'selected'; } ?>>High Court DD &nbsp;</option>
																			            </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 alignCenterPhone ml-auto">
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
       
   <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
   <thead>
  <tr>
   
      <th scope="col">File name</th>
      <th scope="col"> <div class="dropdown grup_typ">
  <button class="btn grup_bt dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Annexure Type
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div></th>
      <th scope="col">Upload Date</th>
      <th scope="col">Total Records</th>
      <th scope="col">Success</th>
  </tr>
  </thead>
      <tbody>
          
							 <?php 
							 if(!empty($result)){
							 foreach($result as $key=>$item){
							     if($item["success"] != 0){
							 //print_r($item);die;
					$ref_no = $item["reference_number"];
					$annexure_type      	    =    unserialize(ANNEXURE_NAME);
                                        $type                    = $item["annexure_type"];
					//$file                    = $item["file_name"];
					//echo "<pre>===="; print_r($annexure_type);exit;
                                   ?>
  <tr>
             
<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>"><?php echo  htmlspecialchars($item["file_name"]); ?></a></td>
            <td><?php	echo 	htmlspecialchars($annexure_type[$item["annexure_type"]]);								?></td>
            <td><?php echo htmlspecialchars(date('d M Y',strtotime($item['created_on'])));  ?>  </td>
												<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>"><?php  echo htmlspecialchars($item["totalRecord"]);  ?></a></td>
												<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>/11"><?php  echo htmlspecialchars($item["success"]);  ?></a></td>   												
																								 
																									 </tr>
																									  <?php
							     }
															
                            }
                        }
                        ?>
	   </tbody>
</table>
</div>
      <!--
        <div class="col-md-3 mx-auto mt-2">
        <button type="button" class="btn upload_button mx-auto">submit to authorizer</button>
        </div>-->
     
      </div>
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

<script>
	$(document).ready(function() {
    var table = $('#example').DataTable( {
        "aLengthMenu": [[20,40,60, -1], [20,40,60, "All"]],
       // "order": [[11,"desc"]],
         "scrollX": true,
        buttons: ['excel','pdf','csv'],
"language": {
      "emptyTable": "No Records"
    }
    } );
 
    table.buttons().container()
        .insertBefore( '#example_filter' );
} );
	</script>
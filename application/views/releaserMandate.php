<title>Annexures List</title>
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

 <div class="col-md-12 inner_white mt-4">
        <div class="row">
<?php

if($this->session->flashdata('item')) {
$message = $this->session->flashdata('item');
?>
<div class="<?php echo $message['class'] ?>"><?php echo htmlspecialchars($message['message']); ?>

</div>
<?php
}

?>
          <div class="pink_bar"> <h4>List of Annexures</h4> <h4>Total Amount: &#x20B9; <span id="totalAmount"></span></h4><div class="col-md-6 ml-auto pink_right"> 

</div>  </div>
        </div>
		 <form id="link_pay_forms" method="POST" enctype="multipart/form-data" action="<?php echo base_url() ?>releaserMandate/MandateList">
		     <?php echo form_open();
								 echo validation_errors('<div style="color:red">','</div>');
								 ?>
                                     <div class="row formpanelrow smalltablerow mt-4">
            <div class="col-md-4 zerorightpadding" style="margin-right:10%;">
                                            <div class="form-group">
                                                <label><b>From Upload Date</b></label>
                  <div class="form-group input-group loc">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                       <input class="form-control input-sm datepickersettle" id="fromDate" NAME="fromDate" placeholder="From Date" style="height:40px;" value="01-01-2018">
                                                </div>
                                            </div>
                                        </div>
              <div class="col-md-4 zerorightpadding" style="margin-right:5%;">
                                            <div class="form-group">
                                                <label><b>To Upload Date</b></label>
<div class="form-group input-group loc" >
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;" value="<?php echo htmlspecialchars(date('d-m-Y')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-2 alignCenterPhone ml-auto">
                                            <div class="filler">&nbsp;</div>
                <button type="submit" class="btn btn-success " NAME="Submit" style="float: right;height: 40px;margin-top: 5px;background-color: #b53363;">
                                                <i class="fa fa-search fa-btn-success"></i> &nbsp;Search
                                            </button>
                                        </div>
                                        
                                        <div class="col-md-2 alignCenterPhone ml-auto">
                                            <div class="filler" id="errormsg">&nbsp;</div>
                                        </div>
                                        
                                    </div>
                                </form>
        <div class="row mandates">

     
                <form action="<?php echo base_url() ?>releaserMandate/changeStatus" method="POST" class="form-horizontal" enctype="multipart/form-data"> 
                <?php echo form_open(); ?>
   <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
   <thead>
  <tr>
   <!--<th scope="col">
   <input type="checkbox" name="selectAll" id="selectAllDomainList" /></th>-->
      <th scope="col">File name</th>
      <th scope="col"> <div class="dropdown grup_typ">
  <button class="btn grup_bt dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Annexure Type
  </button>
  
</div></th>
      <th scope="col">Upload Date</th>
      <th scope="col">Total Records</th>
      <th scope="col">with checker</th>
      <th scope="col">with releaser</th>
      <th scope="col">Rejected By LAO</th>
      <th scope="col">Rejected By Releaser</th>
      <th scope="col">Returned </th>
      <th scope="col">Released </th>
  </tr>
  </thead>
      <tbody>
							 <?php 
$totalAmount = 0;
$annexure_file      	    =    unserialize(ANNEXURE_TYPE);
if(!empty($result)){
foreach($result as $key=>$item){
							// print_r($item["with_checker"]);die;
					$ref_no = $item["reference_number"];
					$annexure_type      	    =    unserialize(ANNEXURE_NAME);
$path      =base_url(). '/upload/'.$annexure_file[$item["annexure_type"]].'/'.$item["file_name"];
     $type                    = $item["annexure_type"];
					$totalAmount            +=$item["totalRecord_sum"];
                                   ?>
  <tr>
           <!-- <td scope="row"> 
     <label class="custom_chk">
   <input type="checkbox" name="reference_number[]" id="color" value="<?php echo $ref_no;?>">
  <span class="checkmark"></span>
</label>
      </td>-->
												 <td><a href="complexDownload" download="<?php echo  $item["file_name"]; ?>" onclick="this.href='<?php echo $path; ?>';"><?php echo  htmlspecialchars($item["file_name"]); ?></a></td>
            <td><?php	echo 	htmlspecialchars($annexure_type[$item["annexure_type"]]);								?></td>
            <td><?php echo  htmlspecialchars($item["created_on"]);  ?>  </td>
												<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>"><?php  echo htmlspecialchars($item["totalRecord"]);  ?></a><br> &#x20B9; <?php  if($item["totalRecord_sum"] > 0){
				echo moneyFormatIndia(htmlspecialchars($item["totalRecord_sum"]));
				}else{
				echo '0';
				}  ?></td>
												<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>/2"><?php  echo htmlspecialchars($item["with_checker"]);  ?></a><br> &#x20B9; <?php  if($item["with_checker_sum"] > 0){
				echo moneyFormatIndia(htmlspecialchars($item["with_checker_sum"]));
				}else{
				echo '0';
				}  ?></td>
												<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>/3"><?php  echo htmlspecialchars($item["with_releaser"]);  ?></a><br> &#x20B9; <?php  if($item["with_releaser_sum"] > 0){
				echo moneyFormatIndia(htmlspecialchars($item["with_releaser_sum"]));
				}else{
				echo '0';
				}  ?></td>      
												<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>/4"><?php  echo htmlspecialchars($item["rejected_by_LAO"]);  ?></a><br> &#x20B9; <?php  if($item["rejected_by_LAO_sum"] > 0){
				echo moneyFormatIndia(htmlspecialchars($item["rejected_by_LAO_sum"]));
				}else{
				echo '0';
				}  ?></td>
												<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>/5"><?php  echo htmlspecialchars($item["rejected_by_releaser"]);  ?></a><br> &#x20B9; <?php  if($item["rejected_by_releaser_sum"] > 0){
				echo moneyFormatIndia(htmlspecialchars($item["rejected_by_releaser_sum"]));
				}else{
				echo '0';
				}  ?></td>   				
												<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>/6"><?php  echo htmlspecialchars($item["returned"]);  ?></a><br> &#x20B9; <?php  if($item["retuned_sum"] > 0){
				echo moneyFormatIndia(htmlspecialchars($item["retuned_sum"]));
				}else{
				echo '0';
				}    ?></td>   		
				<td><a href="<?php echo base_url() ?>innerList/InnerMandateList/<?php echo $ref_no;?>/<?php echo $type;?>/7"><?php  echo htmlspecialchars($item["released"]);  ?></a><br> &#x20B9; <?php  if($item["released_sum"] > 0){
				echo moneyFormatIndia(htmlspecialchars($item["released_sum"]));
				}else{
				echo '0';
				}    ?></td>  										
																								 
																									 </tr>
																									  <?php
															
                            }
                        }    
                        ?>
	   </tbody>
</table>
<!--<button type="submit" class="btn upload_button mr-4" style="background-color:#353535;margin-left: 35%;">Reject list</button>
<button type="submit" class="btn upload_button">
  Submit to approved
</button>-->
</form>
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
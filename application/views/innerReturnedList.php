<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="<?php echo base_url() ?>assets/js/jquery-1.12.4.js"></script>
  <script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
 
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
	.fade{
                opacity:99999999
        }
  .error {
    color:green;
    }  
	</style>

  <div class="col-md-12 mt-4 inner_white">
        <div class="row">
<?php

if($this->session->flashdata('item')) {
$message = $this->session->flashdata('item');
?>
<div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?>

</div>
<?php
}

?>

					<?php
				//	$file =$this->uri->segment('3');
					$type =$this->uri->segment('4');
					$ref_no =$this->uri->segment('3');
					$annexure_type      	    =    unserialize(ANNEXURE_NAME);?>
      <div class="pink_bar"> <h4 style="width: 100%;">Annexures </h4> </div>
        </div>
		
        <div class="row mandates">
       <div class="table-responsive" id="table_data">
<?php
$session_data = $this->session->all_userdata();
$role_id = $session_data['role_id'];
 ?>
 <?php if ($role_id == 4) {?>
		<form action="<?php echo base_url() ?>innerList/changeStatusAuth" method="POST" class="form-horizontal" enctype="multipart/form-data">		
				<?php } if ($role_id == 5 or $role_id == 9) {?>
<form action="<?php echo base_url() ?>innerList/changeStatusReleas" method="POST" class="form-horizontal" enctype="multipart/form-data">	
<?php } ?>
<?php echo form_open();
								 echo validation_errors('<div style="color:red">','</div>');
								 ?>
            <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
    <thead>
  <tr>
			<th scope="col">Beneficiary Name</th>
      <th scope="col">Khewat No.</th>
      <th scope="col">Share in the ownership</th>
      <th scope="col">Acre</th>
      <th scope="col">Kanal</th>
      <th scope="col">Marla</th>
			<th scope="col">Net Amt.</th>
			<th scope="col">IFSC Code</th>
			<th scope="col">Bank A/c of the Beneficiary</th>
      <th scope="col">Authorize On</th>
 			<th scope="col">Reference No.</th>
 			<th scope="col">Status</th>
                        <th scope="col">Reason.</th>
				<?php if ($role_id == 3) {?><th scope="col">Edit Record</th><?php }?>
  </tr>
  </thead>
		<tbody>
			 <?php 
			 if(!empty($result)){
			 foreach($result as $key=>$item){
                             $ref_no                  = $item["reference_number"];
                             $annexure_status         = unserialize(ANNEXURE_STATUS);
                             $id                      = $item["id"];
                                   ?>
  <tr>
												<td><?php  echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
                        <td><?php  echo htmlspecialchars($item["khewat_no"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["share_in_ownership"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["acre"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["kanal"]);  ?></td>
                         <td><?php  echo htmlspecialchars($item["marla"]);  ?></td>

												<td><?php  echo htmlspecialchars($item["net_amount"]);  ?></td>
												<td><?php  echo htmlspecialchars($item["ifsc_code"]);  ?></td>
												<td><?php  echo htmlspecialchars($item["account_number"]);  ?></td>
												
<td><?php  echo htmlspecialchars($item["authorised_on"]);  ?></td>										
<td><?php  echo htmlspecialchars($item["customer_reference_number"]);  ?></td>
<td><?php  echo htmlspecialchars($item["is_return"]) == 1 ? "Returned" : "Returned (Failed)";  ?></td>
<td><?php  echo htmlspecialchars($item["StatusDesc"]);  ?></td>
<?php if ($role_id == 3) {?>
		<td><a href="<?php echo base_url() ?>innerList/editReturnList/<?php echo $id; ?>" class="btn default btn-xs purple">
										  <button type="button" class="btn reason_bt" data-target="#exampleModal">
 <i class="fa fa-edit"></i> Edit
</button>
</a></td>
<?php }?>
	 </tr>
			 <?php
															
                            }
                        }    
                        ?>
			 </tbody>
</table>
<!--
<?php if ($role_id == 4) {?>
<button type="submit" name="action" value="reject" class="btn upload_button mr-4" style="background-color:#353535;margin-left: 35%;">Reject list</button>
<button type="submit" name="action" value="rsubmit" class="btn upload_button">
  Submit to releaser
</button>
<?php } if ($role_id == 5) {?>
<button type="submit" name="action" value="reject" class="btn upload_button mr-4" style="background-color:#353535;margin-left: 35%;">Reject list</button>
<button type="submit" name="action" value="rsubmit" class="btn upload_button">
  Submit to Approved
</button>
<?php } ?>
-->
</form>
			 </div>

</div>
      
       <!-- <div class="col-md-3 mx-auto">
        <button type="button" class="btn upload_button mx-auto">submit to authorizer</button>
        </div>-->
     
      </div>
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

<!-- END PAGE LEVEL SCRIPTS -->

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

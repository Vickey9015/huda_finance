<title>Pending Verifications</title>
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
.header_right h3 ,.header_right select{
    display:none;
}
	</style>

  <div class="col-md-12 inner_white mt-4" ng-controller="customerCtrl">
        <div class="row">
			<?php

if($this->session->flashdata('item')) {
$message = $this->session->flashdata('item');
?>
<div class="<?php echo $message['class']; ?>"><?php echo htmlspecialchars($message['message']); ?>

</div>
<?php
}

?>
          <div class="pink_bar"> <h4>Zone Listing</h4> <div class="col-md-6 ml-auto pink_right"> 
</div>
		  </div>
        </div>
<!--		<form id="link_pay_forms" method="POST" enctype="multipart/form-data" action="<?php //echo base_url() ?>zone/zoneView">-->
<!--                                     <div class="row formpanelrow smalltablerow">-->
<!--            <div class="col-md-4 zerorightpadding" style="margin-right:10%;">-->
<!--                                            <div class="form-group">-->
<!--                                                <label><b>From Date</b></label>-->
<!--                  <div class="form-group input-group" style="width: 140%;">-->
<!--                                                    <span class="input-group-addon">-->
<!--                                                        <i class="fa fa-calendar"></i>-->
<!--                                                    </span>-->
<!--                       <input class="form-control input-sm datepickersettle" id="fromDate" NAME="fromDate" placeholder="From Date" style="height:40px;">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--              <div class="col-md-4 zerorightpadding" style="margin-right:5%;">-->
<!--                                            <div class="form-group">-->
<!--                                                <label><b>To Date</b></label>-->
<!--<div class="form-group input-group" style="width:138%;">-->
<!--                                                    <span class="input-group-addon">-->
<!--                                                        <i class="fa fa-calendar"></i>-->
<!--                                                    </span>-->
<!--                <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                       
<!--                                        <div class="col-md-2 alignCenterPhone">-->
<!--                                            <div class="filler">&nbsp;</div>-->
<!--                <button type="submit" class="btn btn-success " NAME="Submit" style="float: right;height: 40px;margin-top: 5px; background-color:#b53363;">-->
<!--                                                <i class="fa fa-search fa-btn-success"></i> &nbsp;Search-->
<!--                                            </button>-->
<!--                                        </div>-->
                                        
<!--                                        <div class="col-md-2 alignCenterPhone">-->
<!--                                            <div class="filler" id="errormsg">&nbsp;</div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </form>-->
        <div class="row mandates">
<div class="table-responsive" id="table_data">
   <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
        <thead>
            <tr>
						<th>User Name</th>
                        <th>Change Type</th>
						<th>Old Data</th>
						<th>New Data</th>
						<th>Requested By</th>
						<th>Updated On</th>
					   <th>Action</th>
            </tr>
        </thead>
       
        <tbody>
					  <?php 
					  if(!empty($result)){
					  foreach($result as $key=>$item){
						//	echo "=======<pre>"; print_r($item); exit;
                                   ?>
          <tr>
						<td><?php echo htmlspecialchars($item["user"]); ?></td>
                        <td><?php echo htmlspecialchars($item["update_data_name"]); ?></td>
						<td><?php echo htmlspecialchars($item["old_data"]); ?></td>
                        <td><?php echo htmlspecialchars($item["new_data"]); ?></td>
                        <td><?php echo htmlspecialchars($item["maker_name"]); ?></td>
						<td><?php echo htmlspecialchars($item["created_on"]); ?></td>
    <td>
        <a href="<?php echo base_url() ?>action/approveChange/<?php echo $item["id"];?>" class="btn btn-success a-btn-slide-text" style="background-color: #b53363;">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			<i class="fa fa-check-circle"></i> Approve 
		</a>
		<a href="<?php echo base_url() ?>action/rejectChange/<?php echo $item["id"];?>" class="btn btn-success a-btn-slide-text" style="background-color: #b53363;">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			<i class="fa fa-times-circle"></i> Reject 
		</a>
	</td> 
                       </tr>
                        <?php
															//	} 
                            }
					  }
                        ?>
        </tbody>
   </table>
</div>
    
        
		
	</div>	
		
        
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
<style>
        .fade{
                opacity:99999999
        }
  .error {
    color:green;
    }  
    .dt-buttons{
		margin-top:6px;
	}
</style>
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
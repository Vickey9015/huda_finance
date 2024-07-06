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
	</style>

  <div class="col-md-11 mt-4 inner_white">
        <div class="row">
          <div class="pink_bar"> <h4>returned list</h4> <div class="col-md-6 ml-auto pink_right"> 
</div>  </div>
        </div>
		
        <div class="row mandates">
   <?php

if($this->session->flashdata('item')) {
$message = $this->session->flashdata('item');
?>
<div class="<?php echo $message['class'] ?>"><?php echo htmlspecialchars($message['message']); ?>

</div>
<?php
}

?>
   <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
   <thead>
  <tr>
    <th scope="col"><input type="checkbox" name="selectAll" id="selectAllDomainList" /></th>
      <th scope="col">Group name</th>
      <th scope="col"> <div class="dropdown grup_typ">
  <button class="btn grup_bt dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  type
  </button>
  
</div></th>
      <th scope="col">Upload Date</th>
      <th scope="col">returned Date</th>
      <th scope="col">Total Records</th>
      <th scope="col">Reason</th>
  </tr>
  </thead>
  <tr>
     <td scope="row"> 
     <label class="custom_chk">
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
      </td>
      <td>HisarXHF</td>
      <td>High Court</td>
      <td>10 MAR 2018</td>
      <td>12 MAR 2018</td>
	  <td>32</td>
	  <td><a href="#" class="return_click">Click Here</a></td>
	  
  </tr>
  <tr>
     <td scope="row"> 
          <label class="custom_chk">
  <input type="checkbox" >
  <span class="checkmark"></span>
</label>
     </td>
      <td>RohtkTR</td>
      <td> Supreme Court</td>
      <td>15 MAR 2018</td>
      <td>18 MAR 2018</td>
	  <td>42</td>
	  <td><a href "#" class="return_click">Click Here</a></td>
	 
  </tr>
  <tr>
     <td scope="row">
          <label class="custom_chk">
  <input type="checkbox" >
  <span class="checkmark"></span>
</label>
     </td>
      <td>Karnhui</td>
      <td>lower Court</td>
      <td>15 MAR 2018</td>
      <td>20 MAR 2018</td>
	  <td>12</td>
	  <td> <a href="#" class="return_click">Click Here</a></td>
	   
  </tr>
  <tr>
      <td scope="row">
           <label class="custom_chk">
  <input type="checkbox" >
  <span class="checkmark"></span>
</label>
      </td>
      <td>PKLERTY</td>
      <td>Supreme Court</td>
      <td>16 MAR 2018</td>
      <td>21 MAR 2018</td>
	  <td>54</td>
	  <td> <a href="#" class="return_click">Click Here</a></td>
	 
  </tr>
  <tr>
 <td scope="row"> 
      <label class="custom_chk">
  <input type="checkbox" >
  <span class="checkmark"></span>
</label>
 </td>
      <td>MarnIOP</td>
      <td> Lower Court</td>
      <td>16 MAR 2018</td>
      <td>22 MAR 2018</td>
	  <td>23</td>
	  <td> <a href="#" class="return_click">Click Here</a></td>
	  
	   </tr>
	     <tr>
 <td scope="row">  <label class="custom_chk">
  <input type="checkbox" >
  <span class="checkmark"></span>
</label></td>
     <td>PKLNOD</td>
      <td>High Court</td>
      <td>20 MAR 2018</td>
      <td>23 MAR 2018</td>
	  <td>15</td>
	  <td> <a href="#" class="return_click">Click Here</a></td>
	  
	   </tr>
	   
	     <tr>
 <td scope="row">   <label class="custom_chk">
  <input type="checkbox" >
  <span class="checkmark"></span>
</label></td>
      <td>HaryIO</td>
      <td>High Court</td>
      <td>21 MAR 2018</td>
      <td>27 MAR 2018</td>
	  <td>43</td>
	  <td> <a href="#" class="return_click ">Click Here</a></td>
	
	   </tr>
</table>


</div>
      
        <div class="col-md-3 mx-auto mt-2">
        <button type="button" class="btn releaser_bt mx-auto">REsubmit to releaser</button>
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

<script>
	$(document).ready(function() {
    var table = $('#example').DataTable( {
       // "aLengthMenu": [[20,40,60, -1], [20,40,60, "All"]],
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
<style>
.fade{
                opacity:99999999
        }
  .error {
    color:green;
    }  
	</style>
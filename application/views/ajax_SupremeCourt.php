<?php //print_r('hi');exit;?>
<title></title>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<script src="<?php echo base_url() ?>assets/js/jquery-1.12.4.js">
</script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js">
</script>
<script>
  $( function() {
    $( "#fromDate" ).datepicker({
      dateFormat: 'dd-mm-yy',
      maxDate: new Date() }
                               );
  }
   );
  $( function() {
    $( "#toDate" ).datepicker({
      dateFormat: 'dd-mm-yy',
      maxDate: new Date() }
                             );
  }
   );
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
    margin: 10px;
    /* demo only */
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
    -webkit-appearance: button;
    /* hide default arrow in chrome OSX */
  }
  .custom-dropdown::before,
  .custom-dropdown::after {
    content: "";
    position: absolute;
    pointer-events: none;
  }
  .custom-dropdown::after {
    /*  Custom dropdown arrow */
    content: "\25BC";
    height: 1em;
    font-size: .625em;
    line-height: 1;
    right: 1.2em;
    top: 50%;
    margin-top: -.5em;
  }
  .custom-dropdown::before {
    /*  Custom dropdown arrow cover */
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
    <div class="pink_bar"> 
      <h4 style="margin-left: 0%;width: 100%;">Annexures
        <span id="" style="margin-right:10%;">
        </span>
        <span id="" style="margin-right:10%;">
        </span>
        <span id="" >
        </span>
        <span id="">
        </span>
      </h4>
      <div class="col-md-6 ml-auto pink_right"> 
      </div>
    </div>
  </div>
  <nav class="mt-4 mb-3">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link" id="nav-home-tab" href="<?php echo base_url() ?>AnnexureReport/OriginalReport" role="tab" aria-controls="nav-home" aria-selected="true">Original (
        <?php echo htmlspecialchars($totalcount[0]['original']); ?>)
      </a>
      <a class="nav-item nav-link" id="nav-profile-tab" href="<?php echo base_url() ?>AnnexureReport/LowerCourtReport" role="tab" aria-controls="nav-profile" aria-selected="false">Lower Court (
        <?php echo htmlspecialchars($totalcount[0]['lower_court']); ?>)
      </a>
      <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>AnnexureReport/HighCourtReport" role="tab" aria-controls="nav-contact" aria-selected="false">High Court (
        <?php echo htmlspecialchars($totalcount[0]['high_court']); ?>)
      </a>
      <a class="nav-item nav-link active" id="nav-contact-tab"  href="<?php echo base_url() ?>AnnexureReport/SupremeCourtReport" role="tab" aria-controls="nav-contact" aria-selected="false">Supreme Court (
        <?php echo htmlspecialchars($totalcount[0]['suprem_court']); ?>)
      </a>
      <a class="nav-item nav-link " id="nav-contact-tab"  href="<?php echo base_url() ?>AnnexureReport/DDReport" role="tab" aria-controls="nav-contact" aria-selected="false">SC DD (
        <?php echo htmlspecialchars($totalcount[0]['dd']); ?>)
      </a>
      <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>AnnexureReport/OriginalDDReport" role="tab" aria-controls="nav-contact" aria-selected="false">Original DD (
        <?php echo htmlspecialchars($totalcount[0]['original_dd']); ?>)
      </a>
      <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>AnnexureReport/LCDDReport" role="tab" aria-controls="nav-contact" aria-selected="false">LC DD (
        <?php echo htmlspecialchars($totalcount[0]['lowercourt_dd']); ?>)
      </a>
      <a class="nav-item nav-link" id="nav-contact-tab"  href="<?php echo base_url() ?>AnnexureReport/HCDDReport" role="tab" aria-controls="nav-contact" aria-selected="false">HC DD (
        <?php echo htmlspecialchars($totalcount[0]['highcourt_dd']); ?>)
      </a>
    </div>
  </nav>
  <?php  //echo "<pre>====="; print_r($_REQUEST); exit; ?>
  <form id="link_pay_forms" method="POST" enctype="multipart/form-data" >
    <?php echo form_open();
echo validation_errors('<div style="color:red">','</div>');
?>
    <div class="row formpanelrow smalltablerow">
      <div class="col-md-2" >
        <div class="form-group">
          <label class="text-left">
            <b>File Date
            </b>
          </label>
          <div class="form-group input-group">
            <select class="form-control input-sm" id="date_type" name="date_type" style="height:40px;">
              <option value="created_on">Upload Date
              </option>
              <option value="authorised_on">Authorized Date
              </option>
              <option value="released_on">Released Date
              </option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-2 zerorightpadding" style="text-align:center;
                                                    ">
        <div class="form-group">
          <label class="text-left">
            <b>From Date
            </b>
          </label>
          <div class="form-group input-group loc">
            <span class="input-group-addon">
              <i class="fa fa-calendar">
              </i>
            </span>
            <input class="form-control input-sm datepickersettle" id="fromDate" NAME="fromDate" placeholder="From Date" style="height:40px;" value="<?php echo set_value('fromDate') ?>" autocomplete="off">
          </div>
        </div>
      </div>
      <div class="col-md-2 zerorightpadding" style="text-align: center;">
        <div class="form-group">
          <label class="text-left">
            <b>To Date
            </b>
          </label>
          <div class="form-group input-group loc">
            <span class="input-group-addon">
              <i class="fa fa-calendar">
              </i>
            </span>
            <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;" value="<?php echo set_value('toDate') ?>" autocomplete="off">
          </div>
        </div>
      </div>
      <div class="col-md-2" >
        <div class="form-group">
          <label class="text-left">
            <b>Annexure Status
            </b>
          </label>
          <div class="form-group input-group" style="width: 105%;">
            <?php  $annexure_status         = unserialize(ANNEXURE_STATUS); 
              
               unset($annexure_status['1']);
               unset($annexure_status['8']);
               unset($annexure_status['9']);

            ?>                                                 
            <select class="form-control input-sm" id="annexure_status" name="annexure_status" style="height:40px;">
              <option value="">All
              </option>           
              <?php   foreach ($annexure_status as $key => $value) { ?>
              <option value="<?php echo $key ?>" >
                <?php echo htmlspecialchars($value) ?>
              </option>
              <?php  } ?>                       
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-2" >
        <div class="form-group">
          <label class="text-left">
            <b>Zone
            </b>
          </label>
          <div class="form-group input-group">
            <select class="form-control input-sm" id="zone_id" name="zone_id" style="height:40px;">
              <option value="All">Select Zone
              </option>
              <!-- <option value="All" selected>All
              </option> -->
              <?php foreach($this->session->userdata('zones_option') as $zone){ 
?>
              <option  value="<?php echo $zone['id']; ?>">
                <?php echo htmlspecialchars($zone['name']); ?>
              </option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-2 alignCenterPhone">
        <div class="filler">&nbsp;
        </div>
        <button type="submit" id="btn-filter" class="btn btn-success " NAME="Submit" style="float: right;height: 40px;margin-top: 5px;background-color: #b53363;">
          <i class="fa fa-search fa-btn-success">
          </i> &nbsp;Search
        </button>
      </div>
      <div class="col-md-12 alignCenterPhone">
        <div class="card">
    <div class="card-header" style="font-weight: 500">Download Report</div>
    <div class="card-body" style="padding: 0.75rem">
      <?php foreach($this->session->userdata('zones_option') as $zone){ 
                  $zone_id= $zone['id']; 
                  $zone_name=$zone['name'];
                // echo $file_link= base_url()."report/Original/OA_".date('Y-m-d')."_".$zone_id.".xlsx"; 
                 $filename = "report/SupremeCourt/SC_".date('Y-m-d')."_".$zone_id.".xlsx";
                  $file_link= base_url()."report/SupremeCourt/SC_".date('Y-m-d')."_".$zone_id.".xlsx"; 

                  if(file_exists($filename)){ ?>
                   
                      <button type="submit" class="" onclick="window.location.href='<?php echo $file_link; ?>'"><?php echo htmlspecialchars($zone['name']); ?></button>
            <?php }else{ ?>
              
                      <button type="submit" class="" disabled><?php echo htmlspecialchars($zone['name']); ?></button>
          
           <?php } ?>
        
            
        <?php } ?>
    </div>
  </div>
        <div class="filler">&nbsp;
        </div>
  
      </div>
      
    
      <div class="col-md-1 alignCenterPhone">
        <div class="filler" id="errormsg">&nbsp;
        </div>
      </div>
    </div>
  </form>
  <div class="row mandates">
    <div class="table-responsive" id="table_data">
      <table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
        <thead>
          <tr> 
            <th scope="col">file name
            </th>
            <th scope="col">Zone
            </th>
            <th scope="col">Ref. No.
            </th>
            <th scope="col">Sector no.
            </th>
            <th scope="col">Name of Village
            </th>
            <th scope="col">Award No.
            </th>
            <th scope="col">Date of Award
            </th>
            <th scope="col">Bank A/c of LAO
            </th>
            <th scope="col">Beneficiary name
            </th>
            <th scope="col">Khewat No.</th>
            <th scope="col">Share in the ownership</th>
            <th scope="col">Acre</th>
            <th scope="col">Kanal</th>
            <th scope="col">Marla</th> 
            <th scope="col">ADJ Court Order No.
            </th>
            <th scope="col">Date of Decision by ADJ Court
            </th>
            <th scope="col">High Court Order No.
            </th>
            <th scope="col">Date of Decision by High Court
            </th>
            <th scope="col">Supreme Court Order No.
            </th>
            <th scope="col">Date of Decision by Supreme Court
            </th>
            <th scope="col">Pan No.
            </th>
            <th scope="col">Gross Amount 
            </th>
            <th scope="col">TDS to be deducted  
            </th>
            <th scope="col">Net Amt.
            </th>
            <th scope="col">IFSC Code
            </th>
            <th scope="col">Bank A/c of the Beneficiary
            </th>
            <th scope="col">EDC OR Non EDC
            </th>
            <th scope="col">Mobile Number
            </th>
            <th scope="col">Authorized On
            </th>
            <th scope="col">Released On
            </th>
            <th scope="col">Returned On
            </th>
            <th scope="col">Rejected On
            </th>
            <th scope="col">Status
            </th>
            <th>Resubmitted
            </th>
            <th scope="col">Reason</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- END CONTENT -->
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<script src="<?php echo base_url() ?>js/jquery.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>js/popper.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>js/bootstrap.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>assets/global/plugins/respond.min.js">
</script>
<script src="<?php echo base_url() ?>assets/global/plugins/excanvas.min.js">
</script> 
<![endif]-->
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript">
</script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript">
</script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/js/metronic.js" type="text/javascript">
</script>
<script src="<?php echo base_url();?>assets/js/layout.js" type="text/javascript">
</script>
<script>
  jQuery(document).ready(function() {
    Metronic.init();
    // init metronic core componets
    Layout.init();
    // init layout
  }
                        );
</script>
<script src="<?php echo base_url() ?>assets/global/scripts/datatable.js">
</script>
<!--<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/jquery-1.12.4.js"></script>
-->
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/jquery.dataTables.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/dataTables.jqueryui.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/dataTables.buttons.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/buttons.jqueryui.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/jszip.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/pdfmake.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/vfs_fonts.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/buttons.html5.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/buttons.print.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/buttons.colVis.js">
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/data_pdf/syntax_shCore.js">
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<?php $gAmount           =moneyFormatIndia($grossAmount);
$tAmount                 =moneyFormatIndia($tdsAmount);
$nAmount                 =moneyFormatIndia($netAmount);
$totalCnt                =moneyFormatIndia($totalCount);
//echo $amount; exit;
?>
<script type="text/javascript">
  var table;
  $(document).ready(function() {
    //datatables
    table = $('#example').DataTable({
     "aLengthMenu": [[100,200,500,1000], [100,200,500,1000]],
      dom: 'Blfrtip',
      buttons: [
        //'copyHtml5',
        'excelHtml5',
        //'csvHtml5',
        //'pdfHtml5'
      ],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo base_url() ?>AjaxReport/SupremeCourtReportByAjax",
        "type": "POST",
        //"data": $('#link_pay_forms').serialize(),
        "data": function ( data ) {
          //console.log(data);
          // data.date = $("input[type='radio'][name='Date']:checked");
          data.csrf_test_name =  $("input:hidden[name='csrf_test_name']").val();
          data.date_type = $('#date_type').val();
          data.fromDate = $('#fromDate').val();
          data.toDate = $('#toDate').val();
          data.annexure_status = $('#annexure_status').val();
          data.zone_id = $('#zone_id').val();
        }
      }
      ,
      //Set column definition initialisation properties.
      "columnDefs": [
        {
          "targets": [ 0 ], //first column / numbering column
          "orderable": true, //set not orderable
        }
        ,
      ],
    }
                                   );
    $('#btn-filter').click(function(){
      //button filter event click
      table.ajax.reload();
      //just reload table
    }
                          );
    $('#btn-reset').click(function(){
      //button reset event click
      $('#form-filter')[0].reset();
      table.ajax.reload();
      //just reload table
    }
                         );
  }
                   );
</script>
<script>
   $(document).prop('title', 'SupremeCourtReport');
</script>
</body>
</html>
<title>File List</title>
<script>
  $(function() {
    $("#fromDate").datepicker({
      dateFormat: 'dd-mm-yy',
      maxDate: new Date()
    });
  });
  $(function() {
    $("#toDate").datepicker({
      dateFormat: 'dd-mm-yy',
      maxDate: new Date()
    });
  });
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" />
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
    color: rgba(0, 0, 0, .3);
  }

  .custom-dropdown select[disabled]::after {
    color: rgba(0, 0, 0, .1);
  }

  .custom-dropdown::before {
    background-color: rgba(0, 0, 0, .15);
  }

  .custom-dropdown::after {
    color: rgba(0, 0, 0, .4);
  }

  .fade {
    opacity: 99999999
  }

  .error {
    color: red;
  }

  .alert-success {
    color: green;
  }

  .modal-backdrop {
    z-index: -1;
  }
</style>
<?php
$session_data = $this->session->all_userdata();
$role_id = $session_data['role_id'];

//echo "hlw"; print_r($annexure_status);

?>

<div class="col-md-12 inner_white mt-4 dash_x pink_bar">
  <div class="row">
      <div id="successMsg" class="alert alert-primary" style="width:96%; margin: 1% 2%; display:none;"> </div>
      <div class="pink_bar">
      <h4>Yet To Paid Transactions</h4>
      <!-- <h4>Total Amount: &#x20B9; <span id="totalAmount"></span></h4> -->
      <h4> </h4>
      <div class="col-md-6 ml-auto pink_right"> </div>
    </div>
  </div>
  <br>
  <input type="hidden" id="annexure_status" value="<?php echo $annexure_status; ?>">
  <div class="col-md-12 alignCenterPhone">
        <div class="card">
        <div class="card-header" style="font-weight: 500">Download Report</div>
        <div class="card-body" style="padding: 0.75rem">
          <?php foreach($this->session->userdata('zones_option') as $zone){ 
                      $zone_id= $zone['id']; 
                      $zone_name=$zone['name'];
                    // echo $file_link= base_url()."report/Unclaimed/UnclaimedPayment_".date('Y-m-d')."_".$zone_id.".xlsx"; 
                    $filename = "report/Unclaimed/YetToPaid/UnclaimedPayment_".date('Y-m-d')."_".$zone_id.".xlsx";
                    $file_link= base_url()."report/Unclaimed/YetToPaid/UnclaimedPayment_".date('Y-m-d')."_".$zone_id.".xlsx"; 

                      if(file_exists($filename)){ ?>
                      
                          <button type="submit" class="" onclick="window.location.href='<?php echo $file_link; ?>'"><?php echo htmlspecialchars($zone['name']); ?></button>
                <?php }else{ ?>
                  
                          <button type="submit" class="" disabled><?php echo htmlspecialchars($zone['name']); ?></button>
              
              <?php } ?>
            
                
            <?php } ?>
        </div>
      </div>
      <br>

  <div class="row formpanelrow smalltablerow">
    <div class="col-md-3 zerorightpadding ml-auto">
      <div class="form-group">
        <label><b>From Upload Date</b></label>
        <div class="form-group input-group loc">
          <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </span>
          <input class="form-control input-sm datepickersettle" id="fromDate" name="fromDate" placeholder="From Date" style="height:40px;" value="<?php echo date('d-m-Y'); ?>">
        </div>
      </div>
    </div>
    <div class="col-md-3 zerorightpadding ml-auto">
      <div class="form-group">
        <label><b>To Upload Date</b></label>
        <div class="form-group input-group loc">
          <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </span>
          <input NAME="toDate" id="toDate" class="form-control input-sm datepickersettle" placeholder="To Date" style="height:40px;" value="<?php echo date('d-m-Y'); ?>">
        </div>
      </div>
    </div>
    <div class="col-md-3 ml-auto">
    </div>
    <div class="col-md-2 alignCenterPhone">
      <div class="filler">&nbsp;</div>
      <button type="submit" class="btn btn-success dash_x upload_button" NAME="Submit" id="search" style="float: right;height: 40px;margin-top: 5px;background-color: #9898CC; border: 2px solid #9898CC;">
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
        <table class="table bg-white t_data" cellspacing="0" width="100%" id="example1">
          <thead>
            <tr>

            <th scope="col">Sno</th>
              <th scope="col">File Id</th>
              <th scope="col">Zone Name</th>
              <th scope="col">Sector No.</th>
              <th scope="col">Name of Village</th>
              <th scope="col">Date of Section 4</th>
              <th scope="col">Date of Section 6</th>
              <th scope="col">Award No.</th>
              <th scope="col">Date of Award</th>
              <th scope="col">Khewat No.</th>
              <th scope="col">Acquired Area</th>
              <th scope="col">Acre</th>
              <th scope="col">Kanal</th>
              <th scope="col">Marla</th>
              <th scope="col">Bank A/c No. of LAO</th>
              <th scope="col">Name of Beneficiary</th>
              <th scope="col">Account of Beneficiary</th>
              <th scope="col">IFSC of Beneficiary</th>
              <th scope="col">Care of</th>
              <th scope="col">EDC</th>
              <th scope="col">Customer Reference No</th>
              <th scope="col">File Reference No</th>
              <th scope="col">File Name</th>
              <th scope="col">Net Amount</th>
              <th scope="col">Initiated By</th>
              <th scope="col">Initiated On</th>
              <th scope="col">Authorised By</th>
              <th scope="col">Authorised On</th>
              <!-- <th scope="col">Status Desc</th> -->
              <th scope="col">UTR</th>
              <th scope="col">Status Code</th>
              <th scope="col">Annexure Status</th>
              <th scope="col">Upload Date</th>
              
            </tr>
          </thead>
          <tbody>
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
<script src="<?php echo base_url(); ?>assets/js/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/layout.js" type="text/javascript"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->

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
<?php $amount = moneyFormatIndia($totalAmount);
//echo $amount; exit;
?>

<!-- AdminLTE for demo purposes -->
<div class="loader" id="loading" style="display:none;">
  <img src="<?php echo base_url(); ?>assets/img/mode-circle-loading.gif" class="loader-img">
  <h5 class="loader-text">Please wait...</h5>
</div>
<style>
  body.noScroll {
    overflow: hidden;
  }

  .loader {
    position: fixed;
    top: 0;
    z-index: 9999;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7);
  }

  .loader-img {
    width: 50px;
    position: fixed;
    left: 46%;
    top: 50%;
    animation: rotation 1.2s infinite linear;
  }

  .loader-text {
    position: absolute;
    left: 44%;
    top: 61%;
  }

  .outer-div {
    background-color: #fff;
    padding: 2.5rem;
    border-radius: 10px;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>

<script>
  $(document).ready(function() {
    doSomething();
  });
  $('#search').on("click", function() {
    doSomethingWithDate();
  });

  function doSomething() {
    var annexure_status = $('#annexure_status').val();
    var key = "<?php echo $session_data['api_key'] ?>";
    //var fromDate = $('#fromDate').val();
    //var toDate = $('#toDate').val();
    // alert(key);
    $('#example1').DataTable().destroy();
    table = $('#example1').DataTable({

      "dom": 'Bfrtip',
      'lengthMenu': [
          [ 10,100,1000,5000,50000,-1],
          [ '10 rows', '100 rows', '1000 rows','5000 rows','50000 rows','all rows']
      ],
      "buttons": [
        {
          extend: 'pageLength',
          text: 'Show 10 rows'
        },
        // {
        //   extend: 'excel',
        //   text: 'Download Excel'
        // }
      ],

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "headers": {
          "api-key": key
        },
        "url": "<?php echo base_url('SuccessRecords/GetYetToPaidRecordList') ?>",
        "type": "POST",
        data: {
          annexure_status: annexure_status,
          // fromDate: fromDate,
          // toDate: toDate
        },
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [], //first column / numbering column
        "orderable": false, //set not orderable
      }, ],
      'language': {
        search: "",
        searchPlaceholder: "Search..."
      }

    });
    $('#fromDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy",
    });
    $('#toDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy",
    });
    // $('.select2').select2();
  }

  function doSomethingWithDate() {

    var annexure_status = $('#annexure_status').val();
    var key = "<?php echo $session_data['api_key'] ?>";
    var fromDate = $('#fromDate').val();
    var toDate = $('#toDate').val();
    // alert(key);
    $('#example1').DataTable().destroy();
    table = $('#example1').DataTable({

      "dom": 'Bfrtip',
      'lengthMenu': [
          [ 10,100,1000,5000,50000,-1],
          [ '10 rows', '100 rows', '1000 rows','5000 rows','50000 rows','all rows']
      ],
      "buttons": [
        {
          extend: 'pageLength',
          text: 'Show 10 rows'
        },
        // {
        //   extend: 'excel',
        //   text: 'Download Excel'
        // }
      ],

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "headers": {
          "api-key": key
        },
        "url": "<?php echo base_url('SuccessRecords/GetYetToPaidRecordList') ?>",
        "type": "POST",
        data: {
          annexure_status: annexure_status,
          fromDate: fromDate,
          toDate: toDate
        },
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [], //first column / numbering column
        "orderable": false, //set not orderable
      }, ],
      'language': {
        search: "",
        searchPlaceholder: "Search..."
      }

    });
    $('#fromDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy",
    });
    $('#toDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy",
    });
    $('.select2').select2();
  }
</script>


<style>
  .valHeader{
    font-size: 14px;
  }
  .valPara{
    font-size: 13px;
  }
  .modal{
    padding-top: 205px;
  }
  .codeRed {
    color: #EA4335;
  }

  .submit_btn {
    width: 100%;
    margin: 5px;
    padding: 10px 0;
    border-radius: 10px;
    background-color: #9898CC;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    background: #9898CC !important;
    color: #fff !important;
    font-weight: 400;
    border: 2px solid #9898CC;
  }
  .modal-backdrop{
    z-index: -1000;
  }
  .form-group{
    margin: 0px;
  }
  .col-form-label{
    margin: 0px;
  }
  .dash_x .pink_bar{
    margin:15px;
    padding:10px 0;
    border-radius:10px;
    background-color:#9898CC;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
  }
  .dash_x .pink_bar h4{
    color:#fff !important;
    font-weight:500;
    font-size:20px;
    background:#9898CC;
  }
  .dash_x .upload_button{
    background:#9898CC !important;
    color:#fff !important;
    font-weight:400;
  }
  .dash_x .form-group{
    font-weight:400;
  }
</style>
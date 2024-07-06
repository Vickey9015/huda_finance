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
$fileStatus = $status[0]['is_error'];
$userId = $session_data['id'];
$userName = $session_data['name'];
// echo "<pre>==hlw=="; print_r($session_data);
?>

<div class="col-md-12 inner_white mt-4 dash_x pink_bar">
  <div class="row">
    <div id="successMsg" class="alert alert-primary" style="width:96%; margin: 1% 2%; display:none;"> </div>
    <div class="pink_bar">
      <h4>Returned Records List</h4>
      <!-- <h4>Total Amount: &#x20B9; <span id="totalAmount"></span></h4> -->
      <h4> </h4>
      <div class="col-md-6 ml-auto pink_right"> </div>
    </div>
  </div>
  <br>

  <div class="modal fade" id="addMyModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content fixed-top" id="mainCont">
        <div class="modal-header" style="background-color:#9898CC;">
          <h5 class="modal-title" style=" background-color:#9898CC; color:white; padding-left: 15px;"><b>Waiting for Approval</b></h5>
          <button type="button" class="close" style=" background-color:#9898CC; color:white;" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- <span id="valTitle" style="display: none; padding-left: 15px;"><small>Duplicate Records</small></span> -->
          <small><span id="valMsg" style="display: none; padding-left: 15px; color: #4BB543"> </span></small>

          <div id="validationDiv" style="display: none;">
            <div id="valTitle" class="alert alert-danger"><small><strong>Warning!</strong> An existing combination of beneficiary account and amount is existing in our database, details are shown as below.</small></div>
            <table class='table' id="valTable">
              <thead>
                <tr id="valHead">
                  <th class='valHeader'>Beneficiary Name</th>
                  <th class='valHeader'>Account No</th>
                  <th class='valHeader'>Amount</th>
                  <th class='valHeader'>customer Ref No</th>
                  <th class='valHeader'>Status</th>
                  <th class='valHeader'>Updated On</th>

                </tr>
              </thead>
              <tbody id="valData"></tbody>
            </table>

            <div class="form-group" id="valCheck" style="padding-left: 15px;">
              <input type="checkbox" id="allowData" name="allowData" id="allowData">
              <label class="col-form-label "> <small> Are you sure you want to proceed ?</small></label>
            </div>
          </div>
          <form role="form" id="newModalForm">

            <input type="hidden" id="userId" value="<?php echo $userId; ?>">
            <input type="hidden" id="userName" value="<?php echo $userName; ?>">
            <input type="hidden" class="form-control" id="recordId" name="recordId" require />
            <input type="hidden" class="form-control" id="refNo" name="refNo" require />

            <div class="form-group">
              <label class="col-form-label "> <small style="padding-left: 15px;"> Beneficiary Name: </small></label>
              <div class="col-md-12">
                <input type="text" class="form-control" id="beneName" name="beneName" require />
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label "> <small style="padding-left: 15px;"> Son Of/Daughter of: </small></label>
              <div class="col-md-12">
                <input type="text" class="form-control" id="sonof" name="sonof" require />
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label "> <small style="padding-left: 15px;"> Account Number: </small></label>
              <div class="col-md-12">
                <input type="text" class="form-control" id="accNo" name="accNo" require />
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label "> <small style="padding-left: 15px;">Confirm Account Number: </small></label>
              <div class="col-md-12">
                <input type="text" class="form-control" id="reAccNo" name="reAccNo" require />
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label "> <small style="padding-left: 15px;"> Bene Mode: </small></label>
              <div class="col-md-12">
                <select class="form-select form-select-sm col-md-12" style="font-size: 15px; height:36px;" aria-label="Default select example" id="beneMode" name="beneMode" require>
                  <option selected value="">Select Mode</option>
                  <!-- <option value="1">RTGS</option> -->
                  <option value="2">RTGS/NEFT</option>
                </select>
              </div>
            </div>
            <small><small><span id="valMsgError" style="display: none; padding-left: 15px; color: red"> </span></small></small>

            <div class="form-group" id="ifscCodeBox" style="display: none;">
              <label class="col-form-label "> <small style="padding-left: 15px;"> IFSC Code: </small></label>
              <div class="col-md-12">
                <input type="text" class="form-control" id="ifscCode" name="ifscCode" require />
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label "> <small style="padding-left: 15px;"> Amount: </small></label>
              <div class="col-md-12">
                <input type="text" class="form-control" id="amount" name="amount" require readonly="readonly" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-form-label "> <small style="padding-left: 15px;"> Mobile Number: </small></label>
              <div class="col-md-12">
                <input type="text" class="form-control" id="mobile" name="mobile" require disabled />
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success submit_btn" id="btnSaveIt">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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
      <form action="<?php echo base_url() ?>FileApprove/changeStatus" name="releaseForm" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <?php echo form_open(); ?>
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
              <th scope="col">Beneficiary Mode</th>
              <th scope="col">IFSC of Beneficiary</th>
              <th scope="col">Care of</th>
              <th scope="col">EDC</th>
              <th scope="col">Customer Reference No</th>
              <th scope="col">File Reference No</th>
              <th scope="col">File Name</th>
              <th scope="col">Net Amount</th>
              <th scope="col">Mobile No</th>
              <th scope="col">Initiated By</th>
              <th scope="col">Initiated On</th>
              <th scope="col">Authorised By</th>
              <th scope="col">Authorised On</th>
              <!-- <th scope="col">Scheduled By</th>
              <th scope="col">Scheduled On</th>
              <th scope="col">Force Duplicate</th> -->
              <th scope="col">Status Desc</th>
              <th scope="col">Status</th>
              <th scope="col">Annexure Status</th>
              <th scope="col">Upload Date</th>

              <?php if ($role_id == 3) {
                echo '<th scope="col">Action</th>';
              } ?>
              <!-- <button type="button" onclick="getBeneDetails()" class="btn btn-info">Edit Data</button> -->
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </form>
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
    var ref_no = $('#ref_no').val();
    var key = "<?php echo $session_data['api_key'] ?>";
    //var fromDate = $('#fromDate').val();
    //var toDate = $('#toDate').val();
    // alert(key);
    $('#example1').DataTable().destroy();
    table = $('#example1').DataTable({

      "dom": 'Bfrtip',
      'lengthMenu': [
          [ 10, 25, 50, 100, -1 ],
          [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
      ],
      "buttons": [
        {
          extend: 'pageLength',
          text: 'Show 10 rows'
        },
        {
          extend: 'excel',
          text: 'Download Excel'
        }
      ],

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "headers": {
          "api-key": key
        },
        "url": "<?php echo base_url('returnrecords/fetchData') ?>",
        "type": "POST",
        data: {
          ref_no: ref_no,
          // fromDate: fromDate,
          // toDate: toDate
        },
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [-1], //first column / numbering column
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
    //alert('hlw')

    $( "#beneMode" ).click(function() {
      // console.log($( "#beneMode" ).val());
      if($( "#beneMode" ).val() == 1 ||  $( "#beneMode" ).val() == 2){
        $( "#ifscCodeBox" ).show();
        if($( "#beneMode" ).val() == 1 && $( "#amount" ).val() > 200000){
          $("#valMsgError").show();
          $("#valMsgError").html("Amount must be less than 2 Lakhs in case of RTGS.");
          $("#btnSaveIt").prop('disabled', true);
        }else{
          $("#valMsgError").hide();
          $("#btnSaveIt").prop('disabled', false);

        }
      }
      if($( "#beneMode" ).val() == 3 ||  $( "#beneMode" ).val() == 4 || $( "#beneMode" ).val() == '' || $( "#beneMode" ).val() == undefined){
        $('#ifscCode').val('');
        $( "#ifscCodeBox" ).hide();
        $("#btnSaveIt").prop('disabled', false);

      }
    });

    $("#newModalForm").validate({
      rules: {
        amount: {
          required: true,
          maxlength: 11,
          // digits: true,
          number: true
        },
        ifscCode: {
          required: true,
          minlength: 11,
          maxlength: 11,
        },
        accNo: {
          required: true,
          minlength: 9,
          maxlength: 18,
        },
        reAccNo: {
          required: true,
          minlength: 9,
          maxlength: 18,
          equalTo: '#accNo'
        },
        beneName: {
          required: true,
          minlength: 3,
        },
        beneMode: {
          required: true,
        },

      },
      messages: {
        amount: {
          required: "<small class='codeRed'><small>Amount is required</small></small>",
          maxlength: "<small class='codeRed'><small>Amount required less than 11 digits</small></small>",
          number: "<small class='codeRed'><small>Amount must be numeric.  Please contact IBL for further queries.</small></small>"
        },
        ifscCode: {
          required: "<small class='codeRed'><small>IFSC Code is required</small></small>",
          minlength: "<small class='codeRed'><small>IFSC Code required exact 11 digits</small></small>",
          maxlength: "<small class='codeRed'><small>IFSC Code required exact 11 digits</small></small>",
        },
        accNo: {
          required: "<small class='codeRed'><small>Account Number is required</small></small>",
          minlength: "<small class='codeRed'><small>Account Number required atleast 9 digits</small></small>",
          maxlength: "<small class='codeRed'><small>Account Number required atmost 18 digits</small></small>"
        },
        reAccNo: {
          required: "<small class='codeRed'><small>Account Number is required</small></small>",
          minlength: "<small class='codeRed'><small>Account Number required atleast 9 digits</small></small>",
          maxlength: "<small class='codeRed'><small>Account Number required atmost 18 digits</small></small>",
          equalTo: "<small class='codeRed'><small>Account Number confirmation does not match</small></small>"
        },
        beneName: {
          required: "<small class='codeRed'><small>Beneficiary Name is required</small></small>",
          minlength: "<small class='codeRed'><small>Beneficiary Name required atleast 3 characters</small></small>",
        },
        beneMode: {
          required: "<small class='codeRed'><small>Beneficiary Mode is required</small></small>",
        }
      },

      submitHandler: function(form) {
        var recordId =  $('#recordId').val();
        var beneName =  $('#beneName').val();
        var accNo = $('#accNo').val();
        var reAccNo = $('#reAccNo').val();
        var amount = $('#amount').val();
        var beneMode = $('#beneMode').val();
        var ifscCode = $('#ifscCode').val();
        var refNo = $('#refNo').val();
        // var allowData = $("input[type='checkbox']").val();
        var allowData = $("input[type='checkbox']:checked").val();
        //var allowData = $("input[type='checkbox']").prop(":checked");

        // console.log(allowData);

        $.ajax({
          url: "<?php echo base_url('returnrecords/validateData') ?>",
          type: 'POST',
          data: {recordId: recordId, beneName:beneName, accNo:accNo, reAccNo:reAccNo, ifscCode:ifscCode, refNo:refNo,  amount:amount},
          success: function(response) {
            const obj = JSON.parse(response);
            const data = obj.message;
            if(obj.statusCode == "NP000"){
              // console.log(typeof data)
              $("#valMsg").hide();
              // $("#valTable").show();
              // $("#valTitle").show();
              // $("#valCheck").show();
              $("#validationDiv").show();
              // $.each(data, function(index) {
              //   $("#valData").append("<tr>");
              //   $.each(data[index], function(key, value) {
              //     $("#valData").append("<td class='valPara'>" + value + "</td>");
              //   });
              //   $("#valData").append("</tr>");
              // });
              var str = "";
              $.each(data, function(index) {
                str +="<tr>";
                //$("#valData").append("<tr>");
                $.each(data[index], function(key, value) {
                  str +="<td class='valPara'>" + value + "</td>";
                });
               str +="</tr>";

              });
              $("#valData").html(str);
              if(allowData == 'on'){
                updateData();
              }
              // alert(str);
            }else{
                $("#valMsg").show();
                // $("#valTable").hide();
                // $("#valTitle").hide();
                // $("#valCheck").hide();
                $("#validationDiv").hide();
              if(typeof obj.message == "string"){
                $("#valMsg").html(obj.message);
                updateData();
              }else{
                $("#valMsg").html('Something went wrong');
              }
            }
          }
        });
      }

    });
  }

  function updateData(){
    var allowData = $("input[type='checkbox']:checked").val();
    var userId =  $('#userId').val();
    var userName =  $('#userName').val();

    $.ajax({
    url: "<?php echo base_url('returnrecords/updateData') ?>",
    type: 'POST',
    data: $('#newModalForm').serialize() + "&allowData=" + allowData + '&userId=' + userId + '&userName=' + userName,
    success: function(response) {
      if(response){
        //console.log(response);
        const obj = JSON.parse(response);
        // alert(response.message)
        // alert(obj.message)
        $("#successMsg").show();
        $('#successMsg').html('<small>'+obj.message+'</small>');
        $('#addMyModal').modal('toggle');
        table.ajax.reload();
      }
    }
  });
  }
  function getBeneDetails(e){
    $("#valMsg").hide();
    // $("#valTable").hide();
    // $("#valTitle").hide();
    // $("#valCheck").hide();
    $("#validationDiv").hide();
    $("#successMsg").hide();
    $('#newModalForm')[0].reset();
    $( "#ifscCodeBox" ).hide();
    $('input:checkbox').removeAttr('checked');
    $(".codeRed").hide();
    

    var getName = $('#getName_'+e).text();
    var getAmount = $('#getAmount_'+e).text();
    var getRefNo = $('#getRefNo_'+e).text();
    var sonof = $('#getsonof_'+e).text();
    var getmobile = $('#getmobile_'+e).text();
    var getId = e;

    $('#beneName').val(getName);
    $('#amount').val(getAmount);
    $('#refNo').val(getRefNo);
    $('#recordId').val(getId);
    $('#sonof').val(sonof);
    $('#mobile').val(getmobile);
    // alert(getRefNo)

  }

  function doSomethingWithDate() {

    var ref_no = $('#ref_no').val();
    var key = "<?php echo $session_data['api_key'] ?>";
    var fromDate = $('#fromDate').val();
    var toDate = $('#toDate').val();
    // alert(key);
    $('#example1').DataTable().destroy();
    table = $('#example1').DataTable({

      "dom": 'Bfrtip',
      'lengthMenu': [
          [ 10, 25, 50, 100, -1 ],
          [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
      ],
      "buttons": [
        {
          extend: 'pageLength',
          text: 'Show 10 rows'
        },
        {
          extend: 'excel',
          text: 'Download Excel'
        }
      ],

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "headers": {
          "api-key": key
        },
        "url": "<?php echo base_url('returnrecords/fetchData') ?>",
        "type": "POST",
        data: {
          ref_no: ref_no,
          fromDate: fromDate,
          toDate: toDate
        },
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [-1], //first column / numbering column
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
  window.onload = () => {
 const myInput = document.getElementById('reAccNo');
 myInput.onpaste = e => e.preventDefault();
}
</script>


<style>
  .valHeader{
    font-size: 14px;
  }
  .valPara{
    font-size: 13px;
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
  #mainCont{
    width: fit-content;
    min-width: 520px;
  }
  .modal-content{
    margin-top: 55px;
    overflow-y: scroll;
    max-height: calc(100vh - 85px);

  }
    /* .modal-content::-webkit-scrollbar {
  display: none;
} */
  .modal{
    height: 100vh;
  }

</style>
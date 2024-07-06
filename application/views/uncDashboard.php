<?php
$session_data = $this->session->all_userdata();
$role_id = $session_data['role_id'];
$zones = $session_data['zones'];
// echo"<pre>"; print_r($successData);exit;
$totalbene = 0;
$totalAmount = 0;
$unclaimedzonebene           =    unserialize(UNCLAIMEDZONEBENE);
$unclaimedzoneamount            =    unserialize(UNCLAIMEDZONEAMOUNT);
$unclaimedzonepath            =    unserialize(UNCLAIMEDZONESPATH);



//echo"<pre>--";print_r($zones);die;

if (!empty($zones)) {
  foreach ($zones as $key => $item) {
    //echo"<pre>--";print_r($unclaimedzonebene[$item["name"]]);die;

    $totalbene      += $unclaimedzonebene[$item["name"]];

    $totalAmount    += $unclaimedzoneamount[$item["name"]];
    $zonepath     = $unclaimedzonepath[$item["name"]];
  }
}


if ($role_id == 6) {
  $totalbene      = '9304';

  $totalAmount    = '16277465091.99';
  $zonepath     = 'crfiles/zone0/allzones.xlsx';
}
$path      = base_url() . $zonepath;
//echo"<pre>-";print_r($path);die;


?>
<script>
  function myFunction() {
    var x = document.getElementById("mySelect");

  }
</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<?php if ($role_id == 3 or $role_id == 5 or $role_id == 6 or $role_id == 4 or $role_id == 9) { ?>
  <div class="col-md-12 mt-4 dash_x">
    <div class="row ">
      <div class="pink_bar pink_bar_x">
        <h4 class="text-left">dashboard </h4>


        <div class="ml-auto">

          <div class="dropdown float-right">
            <select id="mySelect" onchange="myFunction()">
              <option value="YTD">YTD
              <option value="LTD">LTD
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2 dash_move">
      <div class="col-md-12 col-sm-6 mb-4">
        <div class="purple_square purple_square_x">
          <div class="purple_inner p-0">
            <h5 style="display: flex; flex-direction: column; align-items: center;">Paid Original Awards - Tranch 1</h5>
            <div class="row purple_ifo ">
              <div class="col-md-12 pro_1" style="display: flex;flex-direction: column;align-items: center;"><span><a style='text-decoration:none; color: #C03066;' href="<?php echo htmlspecialchars($path); ?>" download><?php print_r($totalbene); ?></a></span>
                <p>No of Beneficiaries</p>
              </div>
              <div class="col-md-12 pro_1" style="display: flex;flex-direction: column;align-items: center;"><span><i class="fa fa-inr" aria-hidden="true"></i> <?php print_r(moneyFormatIndia($totalAmount)); ?></span>
                <p>Amount</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-sm-6 purple_square purple_square_x p-0 m-0">
        <div class="purple_inner p-0">
          <h5 style="display: flex; flex-direction: column; align-items: center;">Original Awards - Tranch 2</h5>
        </div>
    </div>
    <div class="row mt-2 dash_move">
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="purple_square purple_square_x">
          <div class="purple_inner p-0">
            <h5>Total Beneficiaries
            </h5>
            <div class="row purple_ifo ">
              <div class="col-md-12 pro_1"><span><a style='text-decoration:none; color: #C03066;' href="<?php echo base_url() . 'SuccessRecords/TotalRecordList'; ?>"><?php print_r(htmlspecialchars($month_stats['total_record']) ?  htmlspecialchars($month_stats['total_record']) : 0); ?></a></span>
                <p>No of Beneficiaries</p>
              </div>
              <div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i> <?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['totalRecord_sum']) ? htmlspecialchars($month_stats['totalRecord_sum']) : 0)); ?></span>
                <p>Amount</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="purple_square">
          <div class="purple_inner p-0">
            <h5>Successfully Processed through RTGS/NEFT</h5>
            <div class="row purple_ifo ">
              <div class="col-md-12 pro_1"><span><a style='text-decoration:none; color: #C03066;' href="<?php echo base_url() . 'SuccessRecords/SuccessRecordList'; ?>"><?php print_r(htmlspecialchars($successData['total_bene']) ? htmlspecialchars($successData['total_bene']) : 0); ?></a></span>
                <p>No of Beneficiaries</p>
              </div>
              <div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($successData['total_amount']) ? htmlspecialchars($successData['total_amount']) : 0)); ?></span>
                <p>Amount</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="purple_square">
          <div class="purple_inner">

            <h5>Successfully Processed through DD</h5>
            <div class="row purple_ifo ">
              <div class="col-md-12  pro_1"><span><a style='text-decoration:none; color: #C03066;' href="<?php echo base_url() . 'FileApprove/getPaidRecords/5'; ?>"><?php print_r(htmlspecialchars($month_stats['approved']) ? 0 : 0); ?></a></span>
                <p>No of Beneficiaries</p>
              </div>

              <div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['rejected_by_LAO_sum']) ? htmlspecialchars($month_stats['rejected_by_LAO_sum']) : 0)); ?></span>
                <p>Amount</p>
              </div>
              <!-- <div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>rejectedList/getRejectedListByStatus/4"><?php print_r(htmlspecialchars($file_stats['rejected_by_LAO']) ? htmlspecialchars($file_stats['rejected_by_LAO']) : 0); ?></a></span><p>No of Files</p>
	
</div> -->


            </div>


          </div>
        </div>
      </div>


      <div class="col-md-4 col-sm-6 mb-4">
        <div class="purple_square" style="background:url(../image/red_rectangle.jpg) no-repeat bottom center;">
          <div class="purple_inner">

            <h5>Balance Records yet to be paid</h5>
            <div class="row purple_ifo ">

              <div class="col-md-12 pro_1"><span><a style='text-decoration:none; color: #C03066;' href="<?php echo base_url() . 'SuccessRecords/yetToPaidList'; ?>"><?php print_r(htmlspecialchars($month_stats['total_record'] - $successData['total_bene']) ?  htmlspecialchars($month_stats['total_record'] - $successData['total_bene']) : 0); ?></a></span>
                <p>No of Beneficiaries</p>
              </div>
              <div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['totalRecord_sum'] - $successData['total_amount']) ? htmlspecialchars($month_stats['totalRecord_sum'] - $successData['total_amount']) : 0)); ?></span>
                <p>Amount</p>
              </div>
              <!-- <div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>releaserApproval/approved"><?php print_r(htmlspecialchars($file_stats['released']) ? htmlspecialchars($file_stats['released']) : 0); ?></a></span><p>No of  Files</p>
	
             </div> -->


            </div>


          </div>
        </div>
      </div>
      <!--</div>
	<div class="row mt-2">-->
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="purple_square">
          <div class="purple_inner">

            <h5>Pending at LAO for Approval</h5>
            <div class="row purple_ifo ">
              <div class="col-md-12 pro_1"><span><a style='text-decoration:none; color: #C03066;' href="<?php echo base_url() . 'waitingforapproval/UpdatedRecordList'; ?>"><?php print_r(htmlspecialchars($pendingAtLAOData['total_bene']) ? htmlspecialchars($pendingAtLAOData['total_bene']) : 0); ?></a></span>
                <p>No of Beneficiaries</p>
              </div>
              <div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($pendingAtLAOData['total_amount']) ? htmlspecialchars($pendingAtLAOData['total_amount']) : 0)); ?></span>
                <p>Amount</p>
              </div>
              <!-- <div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>successList/viewSuccess"><?php print_r(htmlspecialchars($file_stats['success']) ? htmlspecialchars($file_stats['success']) : 0); ?></a></span><p>No of  Files</p>
	
</div> -->



            </div>

          </div>
        </div>
      </div>



      <div class="col-md-4 col-sm-6 mb-4">
        <div class="purple_square">
          <div class="purple_inner">

            <h5>Returned Transactions pending for Reinitiation </h5>
            <div class="row purple_ifo ">
              <div class="col-md-12 pro_1"><span><a style='text-decoration:none; color: #C03066;' href="<?php echo base_url() . 'returnrecords/ReturnedRecordList'; ?>"><?php print_r(htmlspecialchars($returnData['total_bene']) ? htmlspecialchars($returnData['total_bene']) : 0); ?></a></span>
                <p>No of Beneficiaries</p>
              </div>
              <div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($returnData['total_amount']) ? htmlspecialchars($returnData['total_amount']) : 0)); ?></span>
                <p>Amount</p>
              </div>
              <!-- <div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>returnedList/ReturnedList"><?php print_r(htmlspecialchars($file_stats['returned']) ? htmlspecialchars($file_stats['returned']) : 0); ?></a></span><p>No of  Files</p>
	
</div>
		 -->


            </div>

          </div>
        </div>
      </div>



    </div>
  </div>
  </div>
  </div>
  </div>
<?php }
if ($role_id == 10) { ?>
  <div class="col-md-11 mt-4">
    <div class="row">
      <div class="pink_bar">
        <h4>dashboard</h4>
      </div>
    </div>
    <div class="row mt-2 ">
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="purple_square">
          <div class="purple_inner">

            <h5><?php print_r(htmlspecialchars($file_stats['tota']) ? htmlspecialchars($file_stats['tota']) : 0); ?></h5>
            <p>Waiting For LOA Approval</p>
            <a href="<?php echo base_url() ?>report/OrignalReport">
              <h5><?php print_r(htmlspecialchars($month_stats['pending'])); ?></h5>
              <p>Total Records</p>
            </a>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="purple_square" style="background:url(../image/red_rectangle.jpg) no-repeat bottom center;">
          <div class="purple_inner">

            <h5><?php print_r(htmlspecialchars($file_stats['approved']) ? htmlspecialchars($file_stats['approved']) : 0); ?></h5>
            <p>Waiting For Release</p>
            <h5><?php print_r(htmlspecialchars($month_stats['approved'])); ?></h5>
            <p>Total Records</p>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="purple_square">
          <div class="purple_inner">

            <h5><?php print_r(htmlspecialchars($file_stats['pulled']) ? htmlspecialchars($file_stats['pulled']) : 0); ?></h5>
            <p>Pulled Back</p>
            <h5><?php print_r(htmlspecialchars($month_stats['pulled'])); ?></h5>
            <p>Total Records</p>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 mb-4">
        <div class="purple_square" style="background:url(../image/red_rectangle.jpg) no-repeat bottom center;">
          <div class="purple_inner">

            <h5><?php print_r(htmlspecialchars($file_stats['rejected']) ? htmlspecialchars($file_stats['rejected']) : 0); ?></h5>
            <p>Rejected Mandates</p>
            <h5><?php print_r(htmlspecialchars($month_stats['rejected'])); ?></h5>
            <p>Total Records</p>
            </a>
          </div>
        </div>
      </div>
      <!--</div>
	<div class="row mt-2">-->
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="purple_square">
          <div class="purple_inner">

            <h5><?php print_r(htmlspecialchars($file_stats['returned']) ? htmlspecialchars($file_stats['returned']) : 0); ?></h5>
            <p>Returned Mandates</p>
            <h5><?php print_r(htmlspecialchars($month_stats['returned'])); ?></h5>
            <p>Total Records</p>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="purple_square" style="background:url(../image/red_rectangle.jpg) no-repeat bottom center;">
          <div class="purple_inner">
            <!--<a href="<?php echo base_url() ?>rejectedList/RejectedList">-->
            <!--<div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
                </div>-->
            <h5><?php print_r(htmlspecialchars($file_stats['success']) ? htmlspecialchars($file_stats['success']) : 0); ?></h5>
            <p>Approved Mandates</p>
            <h5><?php echo htmlspecialchars($month_stats['success']); ?></h5>
            <p>Total Records</p>
            </a>
          </div>
        </div>
      </div>
      <!--<div class="col-md-3 col-sm-6">
            <div class="purple_square">
              <div class="purple_inner">
		<a href="<?php echo base_url() ?>uploadSheet/UploadSheet">
		      <div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                </div>
                <h5>20</h5>
                <p>Uploaded Sheets</p>
		<h5><?php echo $month_stats['total_record']; ?></h5>
                <p>Total Records</p>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="purple_square"  style="background:url(../image/red_rectangle.jpg) no-repeat bottom center;">
              <div class="purple_inner">
		<a href="<?php echo base_url() ?>mandatesList/MandatesList">
		          <div class="dropdown show ii"> <a class="btn hh " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                </div>
                <h5>8</h5>
                <p>Approved Mandates</p>
		<h5><?php echo $month_stats['approved']; ?></h5>
                <p>Total Records</p>
                </a>
              </div>
            </div>
          </div>-->

    </div>
  </div>
  </div>
  </div>
  </div>
<?php }
if ($role_id == 7) { ?>
  <div class="col-md-11 mt-4">
    <div class="row">
      <div class="pink_bar">
        <h4>dashboard</h4>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-3">
        <div class="purple_square">
          <div class="purple_inner">
            <h5>50</h5>
            <p>Waiting For LOA Approval</p>
            <a href="<?php echo base_url() ?>report/OrignalReport">
              <h5><?php print_r(htmlspecialchars($stats['pending'])); ?></h5>
              <p>Total Records</p>
            </a>
            <div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="purple_square" style="background:url(<?php echo base_url() ?>image/green_rectangle.jpg) no-repeat bottom center;">
          <div class="purple_inner">
            <h5>20</h5>
            <p>Pending Released</p>
            <h5><?php print_r(htmlspecialchars($stats['approved'])); ?></h5>
            <p>Total Records</p>
            <div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="purple_square" style="background:url(<?php echo base_url() ?>image/orange_rectangle.jpg) no-repeat bottom center;">
          <div class="purple_inner">
            <div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
            </div>
            <h5>17</h5>
            <p>Pulled Back</p>
            <h5><?php print_r(htmlspecialchars($stats['pulled'])); ?></h5>
            <p>Total Records</p>

          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="purple_square" style="background:url(<?php echo base_url() ?>image/red_rectangle.jpg) no-repeat bottom center;">
          <div class="purple_inner">
            <div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
            </div>
            <h5>10</h5>
            <p>Rejected</p>
            <h5><?php print_r(htmlspecialchars($stats['rejected'])); ?></h5>
            <p>Total Records</p>

          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-3">
        <div class="purple_square" style="background:url(<?php echo base_url() ?>image/orange_rectangle.jpg) no-repeat bottom center;">
          <div class="purple_inner">
            <h5>7</h5>
            <p>Returned Mandates</p>
            <h5><?php print_r(htmlspecialchars($stats['returned'])); ?></h5>
            <p>Total Records</p>
            <div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
              <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>-->
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="purple_square" style="background:url(<?php echo base_url() ?>image/red_rectangle.jpg) no-repeat bottom center;">
          <div class="purple_inner">
            <h5>5</h5>
            <p>Approved Mandates</p>
            <h5><?php print_r(htmlspecialchars($stats['success'])); ?></h5>
            <p>Total Records</p>
            <div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
              <!--<div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>-->
            </div>
          </div>
        </div>
      </div>
      <!--			<div class="col-md-3">
            <div class="purple_square">
              <div class="purple_inner">
                <h5>20</h5>
                <p>Uploaded Sheets</p>
		<h5><?php print_r($stats['total_record']); ?></h5>
                <p>Total Records</p>
                <div class="dropdown show ii"> <a class="btn hh " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="purple_square"  style="background:url(<?php echo base_url() ?>image/green_rectangle.jpg) no-repeat bottom center;">
              <div class="purple_inner">
                <h5>8</h5>
                <p>Approved Mandates</p>
		<h5><?php print_r($stats['approved']); ?></h5>
                <p>Total Records</p>
                <div class="dropdown show ii"> <a class="btn hh " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
    </div>
  </div>
  </div>
  </div>-->

    </div>
  </div>
  </div>
  </div>
  </div>
<?php } ?>
<style>
  .dash_x {
    margin-top: 0 !important;
    padding: 0 !important;
    font-family: 'Montserrat', sans-serif !important;
  }

  .dash_x .purple_square {
    background-color: #fff !important;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    border-radius: 10px;
    max-height: 220px;

  }

  .dash_x .purple_square h5 {
    display: flex;
    text-align: left;
    color: #fff !important;
    font-weight: 400;
    background: #989AC3;
    padding: 15px;
    height: 60px;
    border-bottom: 1px solid #838589;
    align-items: center;
    margin-bottom: 0;
    border-radius: 10px 10px 0 0;
  }

  .dash_x .purple_square .purple_ifo {
    padding-left: 20px;
  }

  .dash_x .purple_square .purple_ifo span {
    color: #C03066 !important;
    font-weight: 400;
    margin-bottom: 10px;


  }

  .dash_x .purple_square .col-md-12 {
    text-align: left;

  }

  .dash_x .purple_square .purple_ifo p {
    color: #3A4885 !important;
    text-align: left;
    margin-bottom: 10px;
    font-weight: 400;
  }

  .dash_x .pink_bar_x {
    margin: 15px;
    padding: 10px 0;
    border-radius: 10px;
    background-color: #9898CC;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
  }

  .dash_x .pink_bar_x .text-left {
    color: #fff !important;
    font-weight: 500;
    font-size: 20px;
    background: #9898CC
  }
</style>
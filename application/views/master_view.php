<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
$session_data = $this->session->all_userdata();
$role_id = $session_data['role_id'];
//echo "<pre>=gg==="; print_r($recordArray);
//$zones            		=    unserialize(ZONES);
//echo "<pre>=gg==="; print_r($zones);exit;
$zoneArray =array(); 
foreach($recordArray['waitingForLAO'] as $key=>$value){
  $zoneArray[$value['zone_id']] =$zones[$value['zone_id']];

}
//echo "<pre>=gg==="; print_r($zoneArray);
$diffZones = array_diff($zones, $zoneArray);
//echo "<pre>=gg==="; print_r($recordArray);exit;
 ?>
    <script>
        function myFunction() {
            var x = document.getElementById("mySelect");

        }
    </script>
    <?php if ($role_id == 3 or $role_id == 5 or $role_id == 6 or $role_id == 4 or $role_id == 9) {?>
<div class="col-md-12 mt-4" id="content">       
 <div class="col-md-12 mt-4">
            <div class="row ">
                <div class="pink_bar">
                    <h4 class="text-left">Master View </h4>

                    <div class="ml-auto">

                        <div class="dropdown float-right">
                            <select id="mySelect" onchange="myFunction()">
                                <option value="YTD">YTD
                                    <option value="LTD">LTD
                            </select>
<input value="Save as PDF" id="cmd" style="float: right;margin-top: 4%;" type="button">
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-2 master_move">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="purple_square">
                        <div class="purple_inner p-0">
                            <!--<a href="<?php echo base_url() ?>uploadSheet/UploadSheet">-->
                            <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->

                            <h5>Waiting For LAO Approval</h5>
				
				
				
				<?php  
				 
				foreach($recordArray['waitingForLAO'] as $key=>$value){
				    
				if($value['twith_checker']){
							   $per =round(($value['totalFile']/$value['twith_checker'])*100);
							}else{
							   $per =0;
							}  ?>			
                            <div class="col-md-12 master_box">
                                <h6 class="mr-auto"><?php echo htmlspecialchars($zones[$value['zone_id']]); ?></h6>
                                <div class="master_price ml-auto">
                                    <span><i class="fa fa-inr" aria-hidden[]="true"></i><?php echo (moneyFormatIndia(htmlspecialchars($value['totalAmount']) ));?>
						</span>
                                </div>
                                <div class="col-md-12 p-0 record_book ">
                                    <span class="m_file"><?php echo $value['twith_checker'] !=0 ? htmlspecialchars($value['totalFile']) :0; ?> files</span> <span class="m_record"><?php echo htmlspecialchars($value['twith_checker']); ?> Records</span>
                                    <div class="col-md-12 progress p-0">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $per; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
				<?php } ?>
							
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="purple_square" style="background-color:#7e909a!important;">
                        <div class="purple_inner p-0">
                            <!--<a href="<?php echo base_url() ?>mandatesList/MandatesList">-->
                            <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
                            <h5>Waiting For Release</h5>
                            <?php   foreach($recordArray['waitingForReleaser'] as $key=>$value){
                                     if($value['twith_releaser']){
							   $per =round(($value['totalFile']/$value['twith_releaser'])*100);
							}else{
							   $per =0;
							}
                             ?>
                            <div class="col-md-12 master_box">
                            	
                                <h6 class="mr-auto"><?php echo htmlspecialchars($zones[$value['zone_id']]); ?></h6>

                                <div class="master_price ml-auto"><span><i class="fa fa-inr" aria-hidden="true"></i><?php echo (moneyFormatIndia($value['totalAmount'] ));?></span></div>

                                <div class="col-md-12 p-0 record_book ">
                                    <span class="m_file"><?php echo htmlspecialchars($value['twith_releaser']) !=0 ? $value['totalFile'] :0; ?> files</span> <span class="m_record"><?php echo htmlspecialchars($value['twith_releaser']); ?> Records</span>
                                    <div class="col-md-12 progress p-0">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $per; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </div>

                            </div>
							<?php } ?>
				  
				 
						
                            </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="purple_square">
                        <div class="purple_inner">
                            <!--<a href="<?php echo base_url() ?>returnedList/ReturnedList">-->
                            <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
                            <h5>Rejected By LAO</h5>
							<?php   foreach($recordArray['rejectedByLAO'] as $key=>$value){
							if($value['trejectedby_LAO']){
							   $per =round(($value['totalFile']/$value['trejectedby_LAO'])*100);
							}else{
							   $per =0;
							}
							
							 ?>
                            <div class="col-md-12 master_box">

                                <h6 class="mr-auto"><?php echo htmlspecialchars($zones[$value['zone_id']]); ?></h6>

                                <div class="master_price ml-auto"><span><i class="fa fa-inr" aria-hidden="true"></i><?php echo (moneyFormatIndia(htmlspecialchars($value['totalAmount'] )));?></span></div>

                                <div class="col-md-12 p-0 record_book ">
                                    <span class="m_file"><?php echo htmlspecialchars($value['trejectedby_LAO']) !=0 ? htmlspecialchars($value['totalFile']) :0; ?> files</span> <span class="m_record"><?php echo htmlspecialchars($value['trejectedby_LAO']); ?> Records</span>
                                    <div class="col-md-12 progress p-0">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $per; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </div>

                            </div>
							<?php } ?>
							
                           </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="purple_square" style="background-color:#7e909a!important;">
                        <div class="purple_inner">
                            <!--<a href="<?php echo base_url() ?>rejectedList/RejectedList">-->
                            <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
                            <h5>Rejected By Releaser</h5>
							<?php   foreach($recordArray['rejectedByReleaser'] as $key=>$value){ 
							if($value['trejectedby_Releaser']){
							   $per =round(($value['totalFile']/$value['trejectedby_Releaser'])*100);
							}else{
							   $per =0;
							}
							?>
                            <div class="col-md-12 master_box">

                                <h6 class="mr-auto"><?php echo htmlspecialchars($zones[$value['zone_id']]); ?></h6>

                                <div class="master_price ml-auto"><span><i class="fa fa-inr" aria-hidden="true"></i><?php echo (moneyFormatIndia(htmlspecialchars($value['totalAmount'] )));?></span></div>

                                <div class="col-md-12 p-0 record_book ">
                                    <span class="m_file"><?php echo htmlspecialchars($value['trejectedby_Releaser']) !=0 ? htmlspecialchars($value['totalFile']) :0; ?> files</span> <span class="m_record"><?php echo htmlspecialchars($value['trejectedby_Releaser']); ?> Records</span>
                                    <div class="col-md-12 progress p-0">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $per; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </div>

                            </div>
							<?php } ?>
					
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
                            <h5>Released Transactions</h5>
							<?php   foreach($recordArray['releasedTxn'] as $key=>$value){
							if($value['treleased']){
							   $per =round(($value['totalFile']/$value['treleased'])*100);
							}else{
							   $per =0;
							}
							 ?>
                            <div class="col-md-12 master_box">

                                <h6 class="mr-auto"><?php echo htmlspecialchars($zones[$value['zone_id']]); ?></h6>

                                <div class="master_price ml-auto"><span><i class="fa fa-inr" aria-hidden="true"></i><?php echo (moneyFormatIndia(htmlspecialchars($value['totalAmount'] )));?></span></div>

                                <div class="col-md-12 p-0 record_book ">
                                    <span class="m_file"><?php echo htmlspecialchars($value['treleased']) !=0 ? htmlspecialchars($value['totalFile']) :0; ?> files</span> <span class="m_record"><?php echo htmlspecialchars($value['treleased']); ?> Records</span>
                                    <div class="col-md-12 progress p-0">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $per; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </div>

                            </div>
							<?php } ?>
					 
				 
					
                         </div>
                    </div>
                </div>
                <!--</div>
	<div class="row mt-2">-->
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="purple_square" style="background-color:#7e909a!important;">
                        <div class="purple_inner">
                            <!--<a href="<?php echo base_url() ?>returnedList/ReturnedList">-->
                            <!--  <div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
                </div>-->
                            <h5>Successful/Failed Transactions</h5>
                            <?php   foreach($recordArray['successTxn'] as $key=>$value){
                            if($value['tsuccess']){
							   $per =round(($value['totalFile']/$value['tsuccess'])*100);
							}else{
							   $per =0;
							}
                             ?>
                            <div class="col-md-12 master_box">

                                <h6 class="mr-auto"><?php echo htmlspecialchars($zones[$value['zone_id']]); ?></h6>

                                <div class="master_price ml-auto"><span><i class="fa fa-inr" aria-hidden="true"></i><?php echo (moneyFormatIndia(htmlspecialchars($value['totalAmount'] )));?></span></div>

                                <div class="col-md-12 p-0 record_book ">
                                    <span class="m_file"><?php echo htmlspecialchars($value['tsuccess']) !=0 ? $value['totalFile'] :0; ?> files</span> <span class="m_record"><?php echo htmlspecialchars($value['tsuccess']); ?> Records</span>
                                    <div class="col-md-12 progress p-0">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $per; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </div>

                            </div>
							<?php } ?>
						
                          </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="purple_square">
                        <div class="purple_inner">
                            <!--<a href="<?php echo base_url() ?>returnedList/ReturnedList">-->
                            <!--  <div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
                </div>-->
                            <h5>Returned Transactions</h5>
                            <?php   foreach($recordArray['rturnedTxn'] as $key=>$value){
                            if($value['treturned']){
							   $per =round(($value['totalFile']/$value['treturned'])*100);
							}else{
							   $per =0;
							}
                             ?>
                            <div class="col-md-12 master_box">

                                <h6 class="mr-auto"><?php echo htmlspecialchars($zones[$value['zone_id']]); ?></h6>

                                <div class="master_price ml-auto"><span><i class="fa fa-inr" aria-hidden="true"></i><?php echo (moneyFormatIndia(htmlspecialchars($value['totalAmount'] )));?></span></div>

                                <div class="col-md-12 p-0 record_book ">
                                    <span class="m_file"><?php echo htmlspecialchars($value['treturned']) !=0 ? $value['totalFile'] :0; ?> files</span> <span class="m_record"><?php echo htmlspecialchars($value['treturned']); ?> Records</span>
                                    <div class="col-md-12 progress p-0">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $per; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </div>

                            </div>
							<?php } ?>
					
                             </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="purple_square">
                        <div class="purple_inner">
                            <!--<a href="<?php echo base_url() ?>returnedList/ReturnedList">-->
                            <!--  <div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
                </div>-->
                            <h5>ReInitiated Transactions</h5>
                            <?php   foreach($recordArray['reinitiated'] as $key=>$value){
                            if($value['treturned']){
							   $per =round(($value['totalFile']/$value['treturned'])*100);
							}else{
							   $per =0;
							}
                             ?>
                            <div class="col-md-12 master_box">

                                <h6 class="mr-auto"><?php echo htmlspecialchars($zones[$value['zone_id']]); ?></h6>

                                <div class="master_price ml-auto"><span><i class="fa fa-inr" aria-hidden="true"></i><?php echo (moneyFormatIndia(htmlspecialchars($value['totalAmount'] )));?></span></div>

                                <div class="col-md-12 p-0 record_book ">
                                    <span class="m_file"><?php echo $value['treintiated'] !=0 ? $value['totalFile'] :0; ?> files</span> <span class="m_record"><?php echo htmlspecialchars($value['treintiated']); ?> Records</span>
                                    <div class="col-md-12 progress p-0">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $per; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </div>

                            </div>
							<?php } ?>
					
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
        <?php } if ($role_id == 10) {?>
            <div class="col-md-11 mt-4">
                <div class="row">
                    <div class="pink_bar">
                        <h4>dashboard</h4></div>
                </div>
                <div class="row mt-2 ">
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="purple_square">
                            <div class="purple_inner">
                                <!--<a href="<?php echo base_url() ?>uploadSheet/UploadSheet">-->
                                <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
                                <h5><?php print_r($file_stats['tota'] ? $file_stats['tota'] : 0);?></h5>
                                <p>Waiting For LOA Approval</p>
                                <a href="<?php echo base_url() ?>report/OrignalReport"><h5><?php print_r($month_stats['pending']);?></h5>
                <p>Total Records</p></a>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="purple_square" style="background:url(../image/red_rectangle.jpg) no-repeat bottom center;">
                            <div class="purple_inner">
                                <!--<a href="<?php echo base_url() ?>mandatesList/MandatesList">-->
                                <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
                                <h5><?php print_r(htmlspecialchars($file_stats['approved']) ? htmlspecialchars($file_stats['approved']) : 0);?></h5>
                                <p>Waiting For Release</p>
                                <h5><?php print_r(htmlspecialchars($month_stats['approved']));?></h5>
                                <p>Total Records</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="purple_square">
                            <div class="purple_inner">
                                <!--<a href="<?php echo base_url() ?>returnedList/ReturnedList">-->
                                <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
                                <h5><?php print_r(htmlspecialchars($file_stats['pulled']) ? htmlspecialchars($file_stats['pulled']) : 0);?></h5>
                                <p>Pulled Back</p>
                                <h5><?php print_r(htmlspecialchars($month_stats['pulled']));?></h5>
                                <p>Total Records</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="purple_square" style="background:url(../image/red_rectangle.jpg) no-repeat bottom center;">
                            <div class="purple_inner">
                                <!--<a href="<?php echo base_url() ?>rejectedList/RejectedList">-->
                                <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
                                <h5><?php print_r(htmlspecialchars($file_stats['rejected']) ? htmlspecialchars($file_stats['rejected']) : 0);?></h5>
                                <p>Rejected Mandates</p>
                                <h5><?php print_r(htmlspecialchars($month_stats['rejected']));?></h5>
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
                                <!--<a href="<?php echo base_url() ?>returnedList/ReturnedList">-->
                                <!--  <div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
                </div>-->
                                <h5><?php print_r(htmlspecialchars($file_stats['returned']) ? htmlspecialchars($file_stats['returned']) : 0);?></h5>
                                <p>Returned Mandates</p>
                                <h5><?php print_r(htmlspecialchars($month_stats['returned']));?></h5>
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
                                <h5><?php print_r(htmlspecialchars($file_stats['success']) ? htmlspecialchars($file_stats['success']) : 0);?></h5>
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
            <?php } if ($role_id != 6 or $role_id != 6 ) {?>
                <div class="col-md-11 mt-4">
                    <div class="row">
                        <div class="pink_bar">
                            <h4>dashboard</h4></div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="purple_square">
                                <div class="purple_inner" style="margin-top: -13%;">

                                    <h5>50</h5>
                                    <p>Approved</p>
                                    <a href="<?php echo base_url() ?>report/OrignalReport"><h5><?php print_r(htmlspecialchars($stats['success']));?></h5>
                <p>Total Records</p></a>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="purple_square" style="background:url(<?php echo base_url() ?>image/green_rectangle.jpg) no-repeat bottom center;">
                                <div class="purple_inner" style="margin-top: -13%;">
                                    <h5>20</h5>
                                    <p>Pending </p>
                                    <h5><?php print_r(htmlspecialchars($stats['approved']));?></h5>
                                    <p>Total Records</p>
                                    <div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="purple_square" style="background:url(<?php echo base_url() ?>image/orange_rectangle.jpg) no-repeat bottom center;">
                                <div class="purple_inner" style="margin-top: -13%;">
                                    <h5>17</h5>
                                    <p>Returned</p>
                                    <h5><?php print_r(htmlspecialchars($stats['returned']));?></h5>
                                    <p>Total Records</p>
                                    <div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="purple_square" style="background:url(<?php echo base_url() ?>image/orange_rectangle.jpg) no-repeat bottom center;">
                                <div class="purple_inner" style="margin-top: -13%;">
                                    <h5>7</h5>
                                    <p>Returned</p>
                                    <h5><?php print_r(htmlspecialchars($stats['returned']));?></h5>
                                    <p>Total Records</p>
                                    <div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                                        <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="purple_square">
                                <div class="purple_inner" style="margin-top: -13%;">
                                    <h5>20</h5>
                                    <p>Pending</p>
                                    <h5><?php print_r($stats['pending']);?></h5>
                                    <p>Total Records</p>
                                    <div class="dropdown show ii"> <a class="btn hh " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                                        <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="purple_square" style="background:url(<?php echo base_url() ?>image/green_rectangle.jpg) no-repeat bottom center;">
                                <div class="purple_inner" style="margin-top: -13%;">
                                    <h5>8</h5>
                                    <p>Approved </p>
                                    <h5><?php print_r(htmlspecialchars($stats['success']));?></h5>
                                    <p>Total Records</p>
                                    <div class="dropdown show ii"> <a class="btn hh " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                                        <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
                </div>
                </div>
                <?php } if ($role_id == 7) {?>
                    <div class="col-md-11 mt-4">
                        <div class="row">
                            <div class="pink_bar">
                                <h4>dashboard</h4></div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="purple_square">
                                    <div class="purple_inner">
                                        <h5>50</h5>
                                        <p>Waiting For LOA Approval</p>
                                        <a href="<?php echo base_url() ?>report/OrignalReport"><h5><?php print_r(htmlspecialchars($stats['pending']));?></h5>
                <p>Total Records</p></a>
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
                                        <h5><?php print_r(htmlspecialchars($stats['approved']));?></h5>
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
                                        <h5><?php print_r($stats['pulled']);?></h5>
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
                                        <h5><?php print_r(htmlspecialchars($stats['rejected']));?></h5>
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
                                        <h5><?php print_r(htmlspecialchars($stats['returned']));?></h5>
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
                                        <h5><?php print_r(htmlspecialchars($stats['success']));?></h5>
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
		<h5><?php print_r($stats['total_record']);?></h5>
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
		<h5><?php print_r($stats['approved']);?></h5>
                <p>Total Records</p>
                <div class="dropdown show ii"> <a class="btn hh " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                 <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>-->
                        </div>
                    </div>
                    </div>
                    </div>-->

                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
</div>
                    <?php } ?>
<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

<script type="text/javascript">
$(function () {

$('#cmd').click(function () {
var doc = new jsPDF();
doc.addHTML($('#content'), 15, 15, {
'background': '#fff',
'border':'2px solid white',
}, function() {
doc.save('master-view.pdf');
});
});
});
</script>
<style>
#cmd {
    background: transparent;
    border: 1px solid #fff;
    padding: 3px 11px;
    margin: 11px;
    font-size: 14px;
    color: #fff;
    font-weight: bold;
    letter-spacing: 1px;
}
</style>
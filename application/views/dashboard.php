<?php
$session_data = $this->session->all_userdata();
$role_id = $session_data['role_id'];

 ?>
<script>
function myFunction() {
    var x = document.getElementById("mySelect");
    
}
</script>
 <?php if ($role_id == 3 or $role_id == 5 or $role_id == 6 or $role_id == 4 or $role_id == 9) {?>
<div class="col-md-12 mt-4">
        <div class="row ">
		<div class="pink_bar">
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
          <div class="col-md-3 col-sm-6 mb-4">
            <div class="purple_square">
              <div class="purple_inner p-0">
		<!--<a href="<?php echo base_url() ?>uploadSheet/UploadSheet">-->
		<!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
                
                <h5>Waiting For LAO Approval</h5>
				<div class="row purple_ifo ">
				<div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i> <?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['with_checker_sum']) ? htmlspecialchars($month_stats['with_checker_sum']) : 0));?></span>	<p>Amount</p></div>
				<div class="col-md-6 pro_1"> <span><a href="<?php echo base_url() ?>approvallist/approvalWaiting/2"><?php print_r(htmlspecialchars($file_stats['with_checker']) ? htmlspecialchars($file_stats['with_checker']) : 0);?></a></span><p>No of  Files</p>

</div>
		
		<div class="col-md-6 pro_1"><span><?php print_r(htmlspecialchars($month_stats['pending']));?></span><p>No of Records</p>
	</div>
		
              </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-4">
            <div class="purple_square"  style="background-color:#7e909a!important;">
              <div class="purple_inner p-0">
		<!--<a href="<?php echo base_url() ?>mandatesList/MandatesList">-->
		  <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
				 <h5>Waiting For Release</h5>
			
					<div class="row purple_ifo ">
				<div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['with_releaser_sum']) ? htmlspecialchars($month_stats['with_releaser_sum']) : 0 ));?></span>	<p>Amount</p></div>
				<div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>releaserApproval/waitingApproval/3"><?php print_r(htmlspecialchars($file_stats['with_releaser']) ? htmlspecialchars($file_stats['with_releaser']) : 0);?></a></span><p>No of  Files</p>

</div>
		
		<div class="col-md-6 pro_1"><span><?php print_r(htmlspecialchars($month_stats['approved']));?></span><p>No of Records</p>
	</div>
		
              </div>
          
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
				<div class="row purple_ifo ">
				<div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['rejected_by_LAO_sum']) ? htmlspecialchars($month_stats['rejected_by_LAO_sum']) : 0));?></span>	<p>Amount</p></div>
				<div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>rejectedList/getRejectedListByStatus/4"><?php print_r(htmlspecialchars($file_stats['rejected_by_LAO']) ? htmlspecialchars($file_stats['rejected_by_LAO']) : 0);?></a></span><p>No of Files</p>
	
</div>
		
		<div class="col-md-6  pro_1"><span><?php print_r(htmlspecialchars($month_stats['rejected_by_LAO']));?></span><p>No of Records</p>
	</div>

              </div>
             
               
              </div>
            </div>
          </div>
       
          <div class="col-md-3 col-sm-6 mb-4">
            <div class="purple_square"  style="background-color:#7e909a!important;">
              <div class="purple_inner">
		<!--<a href="<?php echo base_url() ?>rejectedList/RejectedList">-->
		   <!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
				<h5>Rejected By Releaser</h5>
						<div class="row purple_ifo ">
						<div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i> <?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['rejected_by_releaser_sum']) ? htmlspecialchars($month_stats['rejected_by_releaser_sum']) : 0));?></span>	<p>Amount</p></div>
				<div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>rejectedList/getRejectedListByStatus/5"><?php print_r(htmlspecialchars($file_stats['rejected_by_releaser']) ? htmlspecialchars($file_stats['rejected_by_releaser']) : 0);?></a></span><p>No of Files </p>
	
</div>
		
		<div class="col-md-6 pro_1"><span><?php print_r(htmlspecialchars($month_stats['rejected_by_releaser']));?></span><p>No of Records </p>
	</div>
	
              </div>
             
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
									<div class="row purple_ifo ">
									<div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['released_sum']) ? htmlspecialchars($month_stats['released_sum']) : 0));?></span>	<p>Amount</p></div>
				<div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>releaserApproval/approved"><?php print_r(htmlspecialchars($file_stats['released']) ? htmlspecialchars($file_stats['released']) : 0);?></a></span><p>No of  Files</p>
	
</div>
		
		<div class="col-md-6 pro_1"><span><?php echo htmlspecialchars($month_stats['released']); ?></span><p>No of Records</p>
	</div>
	
              </div>
			  
              
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
				 <h5>Successful Transactions</h5>
								<div class="row purple_ifo ">
								<div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['success']) ? htmlspecialchars($month_stats['success_sum']) : 0));?></span>	<p>Amount</p></div>
				<div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>successList/viewSuccess"><?php print_r(htmlspecialchars($file_stats['success']) ? htmlspecialchars($file_stats['success']) : 0);?></a></span><p>No of  Files</p>
	
</div>
		
		<div class="col-md-6 pro_1"><span><?php print_r(htmlspecialchars($month_stats['success']));?></span><p>No of Records</p>
	</div>
		
              </div>
             
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
								<div class="row purple_ifo ">
								<div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['returned_sum']) ? htmlspecialchars($month_stats['returned_sum']) : 0));?></span>	<p>Amount</p></div>
				<div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>returnedList/ReturnedList"><?php print_r(htmlspecialchars($file_stats['returned']) ? htmlspecialchars($file_stats['returned']) : 0);?></a></span><p>No of  Files</p>
	
</div>
		
		<div class="col-md-6 pro_1"><span><?php print_r(htmlspecialchars($month_stats['returned']));?></span><p>No of Records</p>
	</div>
		
              </div>
             
              </div>
            </div>
          </div>
	
	    <div class="col-md-3 col-sm-6 mb-4">
            <div class="purple_square" style="background-color:#7e909a!important;">
              <div class="purple_inner">
		<!--<a href="<?php echo base_url() ?>returnedList/ReturnedList">-->
		            <!--  <div class="dropdown show ii"> <a class="btn hh" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Current Month </a>
                 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> </div>
                </div>-->
				 <h5>Resubmitted txns by LAO</h5>
								<div class="row purple_ifo ">
								<div class="col-md-12 pro_1"><span><i class="fa fa-inr" aria-hidden="true"></i><?php print_r(moneyFormatIndia(htmlspecialchars($month_stats['reinitiated_sum']) ? htmlspecialchars($month_stats['reinitiated_sum']) : 0));?></span>	<p>Amount</p></div>
				<div class="col-md-6 pro_1"><span><a href="<?php echo base_url() ?>mandatesList/reinitiated"><?php print_r(htmlspecialchars($file_stats['reinitiated']) ? htmlspecialchars($file_stats['reinitiated']) : 0);?></a></span><p>No of  Files</p>
	
</div>
		
		<div class="col-md-6 pro_1"><span><?php print_r(htmlspecialchars($month_stats['reinitiated']) ? htmlspecialchars($month_stats['reinitiated']) : 0);?></span><p>No of Records</p>
	</div>
		
              </div>
             
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
         <div class="pink_bar"> <h4>dashboard</h4></div>
        </div>
        <div class="row mt-2 ">
          <div class="col-md-3 col-sm-6 mb-4">
            <div class="purple_square">
              <div class="purple_inner">
		<!--<a href="<?php echo base_url() ?>uploadSheet/UploadSheet">-->
		<!--<div class="dropdown show ii"> <a class="btn hh dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 1Jan-18 to Till Date </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="#">1Jan-17</a> <a class="dropdown-item" href="#">1Jan-16</a> <a class="dropdown-item" href="#">1Jan-15</a> </div>
                </div>-->
                <h5><?php print_r(htmlspecialchars($file_stats['tota']) ? htmlspecialchars($file_stats['tota']) : 0);?></h5>
                <p>Waiting For LOA Approval</p>
		<a href="<?php echo base_url() ?>report/OrignalReport"><h5><?php print_r(htmlspecialchars($month_stats['pending']));?></h5>
                <p>Total Records</p></a>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-4">
            <div class="purple_square"  style="background:url(../image/red_rectangle.jpg) no-repeat bottom center;">
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
<?php } if ($role_id == 7) {?>
 <div class="col-md-11 mt-4">
        <div class="row">
         <div class="pink_bar"> <h4>dashboard</h4></div>
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
            <div class="purple_square"  style="background:url(<?php echo base_url() ?>image/green_rectangle.jpg) no-repeat bottom center;">
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
		<h5><?php print_r(htmlspecialchars($stats['pulled']));?></h5>
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
 <?php } ?>
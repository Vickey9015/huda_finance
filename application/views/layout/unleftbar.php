<!--<div class="col-md-2 white_bg">
      <div class="logo"><a href="#"><img src="<?php echo base_url() ?>image/Logo.jpg" alt=""></a> </div>
      <div class="aside_bar mt-5">
        <ul>
          <li class="<?php if ($this->uri->segment(2) == "dashboard") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>home/dashboard"><img src="<?php echo base_url() ?>image/icon_1.png" alt="" class="aa">Dashboard</a></li>
		  
          <li class="<?php if ($this->uri->segment(2) == "UploadSheet") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>uploadSheet/UploadSheet"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa">Upload Sheet</a></li>
		  
          <li class="<?php if ($this->uri->segment(2) == "MandatesList") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>mandatesList/MandatesList"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa">Mandates List</a></li>
		  
          <li class="<?php if ($this->uri->segment(2) == "ReturnedList") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>returnedList/ReturnedList"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa">Returned List</a></li>
		  
          <li class="<?php if ($this->uri->segment(2) == "RejectedList") {
							echo "active";
						} ?>"> <a  href="<?php echo base_url() ?>rejectedList/RejectedList"><img src="<?php echo base_url() ?>image/icon_5.png" alt="" class="aa">Rejected List</a></li>
		  
          <li class="<?php if ($this->uri->segment(2) == "setting") {
							echo "active";
						} ?>"> <a href="#"><img src="<?php echo base_url() ?>image/icon_6.png" alt="" class="aa">Settings</a></li>
        </ul>
      </div>
    </div>-->
<?php
$session_data = $this->session->all_userdata();
$role_id = $session_data['role_id'];
?>
<?php if ($role_id == 3) { ?>

	<div class="col-md-2 white_bg p-0 sidebar_x" id="sidebar">

		<div class="aside_bar mt-5" style="height: 85%; top: 0%; overflow-x: hidden; overflow-y: hidden;">
			<ul>
				<!-- </li>


          <li class="<?php if ($this->uri->segment(2) == "UploadSheet") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>uploadSheet/UploadSheet"> <div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Upload Sheet</cite>
		   <span class="tooltiptext">Upload Sheet</span></div></a>
		  </li>

          <li class="<?php if ($this->uri->segment(2) == "MandatesList") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>mandatesList/MandatesList"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Annexures</cite>
		<span class="tooltiptext">Annexures</span></div></a>
		  </li>
          <li class="<?php if ($this->uri->segment(2) == "approvalWaiting") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>approvallist/approvalWaiting/2"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Waiting For Approval</cite>
			  <span class="tooltiptext">Approval</span></div></a>
			  </li>
	   <li class="<?php if ($this->uri->segment(2) == "waitingApproval") {
						echo "active";
					} ?>"> <a href="<?php echo base_url() ?>releaserApproval/waitingApproval/3"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Waiting For Release</cite><span class="tooltiptext">Release</span></div></a> </li>
	   	  
          <li class="<?php if ($this->uri->segment(2) == "ReturnedList") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>returnedList/ReturnedList"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa"><cite>Returned Annexures</cite>
		  <span class="tooltiptext">Returned</span></div></a>
		  </li>
		

          <li class="<?php if ($this->uri->segment(2) == "RejectedList") {
							echo "active";
						} ?>"> <a  href="<?php echo base_url() ?>rejectedList/RejectedList"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_5.png" alt="" class="aa"><cite>Rejected Files</cite>
		  <span class="tooltiptext">Rejected Files</span></div></a>
		  </li>
	
	<li class="<?php if ($this->uri->segment(2) == "reInitiated") {
					echo "active";
				} ?>"> <a  href="<?php echo base_url() ?>mandatesList/reInitiated"><div class="toolt"><img src="<?php echo base_url() ?>image/auth3.png" alt="" class="aa"><cite>Resubmitted Files</cite>
		  <span class="tooltiptext">Resubmitted Files</span></div></a>
		  </li>
		  	  
	
		  	  
	<li class="<?php if ($this->uri->segment(2) == "approved") {
					echo "active";
				} ?>"> <a href="<?php echo base_url() ?>releaserApproval/approved"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Released Files</cite><span class="tooltiptext">Released Files</span></div></a> </li>
		   -->

				<?php
				if ($_SERVER['HTTP_X_REAL_IP'] == '106.223.98.196') {
				?>
					<!-- <li class="<?php if ($this->uri->segment(2) == "SMTPOriginalReport") {
										echo "active";
									} ?>"> <a href="<?php echo base_url() ?>smtpReport/SMTPOriginalReport"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_6.png" alt="" class="aa"><cite>SFTP Reports </cite><span class="tooltiptext">SFTP Reports</span></div></a></li> -->
				<?PHP } ?>
				<!-- <li class="<?php if ($this->uri->segment(2) == "Annexuredownload") {
									echo "active";
								} ?>"> <a href="<?php echo base_url() ?>download/Annexuredownload"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_7.png" alt="" class="aa"><cite>Downloads</cite>
		 <span class="tooltiptext">Downloads</span> </div></a>
		  </li>
		  <li class="<?php if ($this->uri->segment(2) == "changeuserPassword") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>member/changeuserPassword"><div class="toolt"><img src="<?php echo base_url() ?>image/change_pwd_icon.png" alt="" class="aa"><cite>Change Password</cite>
	<span class="tooltiptext">Change Password</span> </div></a>
</li> -->
				<li class="<?php if ($this->uri->segment(2) == "dashboard") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>home/dashboard">
						<div class="toolt">
							<img src="<?php echo base_url() ?>image/icon_1.png" alt="" class="aa"><cite>Dashboard</cite>

							<span class="tooltiptext">Dashboard</span>
						</div>

					</a>

				</li>
				<li class="<?php if ($this->uri->segment(2) == "uncDashboard") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>home/uncDashboard">
						<div class="toolt">
							<img src="<?php echo base_url() ?>image/icon_1.png" alt="" class="aa"><cite>Unclaimed Original Award Payments</cite>

							<span class="tooltiptext">Unclaimed Original Award Payments</span>
						</div>

					</a>

				</li>

				<li class="<?php if ($this->uri->segment(2) == "UncUploadSheet") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>uncUploadSheet/UncUploadSheet">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Upload Unclaimed Sheet</cite>
							<span class="tooltiptext">Upload Unclaimed Sheet</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "approveFiles") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>FileApprove/approveFiles/">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Master List</cite>
							<span class="tooltiptext">Master List</span>
						</div>
					</a>
				</li>
				<li class="<?php if ($this->uri->segment(2) == "SuccessRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>SuccessRecords/SuccessRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Successful Transactions</cite>
							<span class="tooltiptext">Successful Transactions</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "UpdatedRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>waitingforapproval/UpdatedRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/auth3.png" alt="" class="aa"><cite>Waiting For LAO Approval</cite>
							<span class="tooltiptext">Approval</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "ReturnedRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>returnrecords/ReturnedRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa"><cite>Returned Records List</cite>
							<span class="tooltiptext">Returned</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "ReinitiatedRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>reinitiatedrecords/ReinitiatedRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/re3.png" alt="" class="aa"><cite>Reinitiated Records List</cite>
							<span class="tooltiptext">Returned</span>
						</div>
					</a>
				</li>

				
				<li class="<?php if ($this->uri->segment(2) == "RejectedRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>rejectedrecords/RejectedRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_5.png" alt="" class="aa"><cite>Rejected Records List</cite>
							<span class="tooltiptext">Returned</span>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
<?php }
if ($role_id == 4) { ?>
	<div class="col-md-2 white_bg p-0 sidebar_x" id="sidebar">
		<div class="aside_bar mt-5" style="height: 85%; top: 0%; overflow-x: hidden; overflow-y: scroll;">
			<ul>
				<!-- <li class="<?php if ($this->uri->segment(2) == "dashboard") {
									echo "active";
								} ?>"> <a href="<?php echo base_url() ?>home/dashboard"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_1.png" alt="" class="aa"><cite>Dashboard</cite>
			   <span class="tooltiptext">Dashboard</span></div></a>
			  </li>

          <li class="<?php if ($this->uri->segment(2) == "MandatesList") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>mandatesList/MandatesList"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Annexures</cite>
		  <span class="tooltiptext">Annexures</span></div></a>
		  </li>
          
              <li class="<?php if ($this->uri->segment(2) == "approvalWaiting") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>approvallist/approvalWaiting/2"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Waiting For Approval</cite>
			  <span class="tooltiptext">Approval</span></div></a>
			  </li>
 

               <li class="<?php if ($this->uri->segment(2) == "waitingApproval") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>releaserApproval/waitingApproval/3"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Waiting For Release</cite><span class="tooltiptext">Release</span></div></a> </li>
		  
		  <li class="<?php if ($this->uri->segment(2) == "authRejectedList") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>authorizerRejected/authRejectedList"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Rejected Files</cite> <span class="tooltiptext">Rejected Files</span></div></a></li>

              <li class="<?php if ($this->uri->segment(2) == "ReturnedList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>returnedList/ReturnedList"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa"><cite>Returned Files</cite> <span class="tooltiptext">Returned</span></div></a></li> -->
				<!--          <li class="<?php if ($this->uri->segment(2) == "FailedList") {
												echo "active";
											} ?>"> <a href="<?php echo base_url() ?>returnedList/FailedList"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa"><cite>Failed Annexures</cite>-->
				<!--<span class="tooltiptext">Failed Files</span></div></a>-->
				<!--</li>-->
				<!-- <li class="<?php if ($this->uri->segment(2) == "InProcessToReleaser") {
									echo "active";
								} ?>"> <a  href="<?php echo base_url() ?>mandatesList/InProcessToReleaser"><div class="toolt"><img src="<?php echo base_url() ?>image/auth3.png" alt="" class="aa"><cite>Authorization Under Process</cite>
		  <span class="tooltiptext">Authorization Under Process</span></div></a>
		  </li>
	<li class="<?php if ($this->uri->segment(2) == "reInitiated") {
					echo "active";
				} ?>"> <a  href="<?php echo base_url() ?>mandatesList/reInitiated"><div class="toolt"><img src="<?php echo base_url() ?>image/auth3.png" alt="" class="aa"><cite>Resubmitted Files</cite>
		  <span class="tooltiptext">Resubmitted Files</span></div></a>
		  </li>
		    
		<li class="<?php if ($this->uri->segment(2) == "approved") {
						echo "active";
					} ?>"> <a href="<?php echo base_url() ?>releaserApproval/approved"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Released Files</cite><span class="tooltiptext">Approved</span></div></a> </li> -->

				<!--<li class="<?php if ($this->uri->segment(2) == "OriginalReport") {
									echo "active";
								} ?>"> <a href="<?php echo base_url() ?>report/OriginalReport"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_6.png" alt="" class="aa"><cite>Reports </cite><span class="tooltiptext">Reports</span></div></a></li>-->

				<!-- <li class="<?php if ($this->uri->segment(2) == "Annexuredownload") {
									echo "active";
								} ?>"> <a href="<?php echo base_url() ?>download/Annexuredownload"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_7.png" alt="" class="aa"><cite>Downloads</cite>
		 <span class="tooltiptext">Downloads</span></div> </a>
		  </li>
		  <li class="<?php if ($this->uri->segment(2) == "changeuserPassword") {
							echo "active";
						} ?>"> <a href="<?php echo base_url() ?>member/changeuserPassword"><div class="toolt"><img src="<?php echo base_url() ?>image/change_pwd_icon.png" alt="" class="aa"><cite>Change Password</cite>
	<span class="tooltiptext">Change Password</span> </div></a>
</li> -->
				<li class="<?php if ($this->uri->segment(2) == "dashboard") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>home/dashboard">
						<div class="toolt">
							<img src="<?php echo base_url() ?>image/icon_1.png" alt="" class="aa"><cite>Dashboard</cite>

							<span class="tooltiptext">Dashboard</span>
						</div>

					</a>

				</li>
				<li class="<?php if ($this->uri->segment(2) == "uncDashboard") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>home/uncDashboard">
						<div class="toolt">
							<img src="<?php echo base_url() ?>image/icon_1.png" alt="" class="aa"><cite>Unclaimed Original Award Payments</cite>

							<span class="tooltiptext">Unclaimed Original Award Payments</span>
						</div>

					</a>

				</li>

				<!-- <li class="<?php if ($this->uri->segment(2) == "UncUploadSheet") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>uncUploadSheet/UncUploadSheet">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Upload Unclaimed Sheet</cite>
							<span class="tooltiptext">Upload Unclaimed Sheet</span>
						</div>
					</a>
				</li> -->

				<li class="<?php if ($this->uri->segment(2) == "approveFiles") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>FileApprove/approveFiles/">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Master List</cite>
							<span class="tooltiptext">Master List</span>
						</div>
					</a>
				</li>
				<li class="<?php if ($this->uri->segment(2) == "SuccessRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>SuccessRecords/SuccessRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Successful Transactions</cite>
							<span class="tooltiptext">Successful Transactions</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "UpdatedRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>waitingforapproval/UpdatedRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/auth3.png" alt="" class="aa"><cite>Waiting For LAO Approval</cite>
							<span class="tooltiptext">Approval</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "ReturnedRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>returnrecords/ReturnedRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa"><cite>Returned Records List</cite>
							<span class="tooltiptext">Returned</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "ReinitiatedRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>reinitiatedrecords/ReinitiatedRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/re3.png" alt="" class="aa"><cite>Reinitiated Records List</cite>
							<span class="tooltiptext">Returned</span>
						</div>
					</a>
				</li>


				<li class="<?php if ($this->uri->segment(2) == "RejectedRecordList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>rejectedrecords/RejectedRecordList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_5.png" alt="" class="aa"><cite>Rejected Records List</cite>
							<span class="tooltiptext">Returned</span>
						</div>
					</a>
				</li>
				
			</ul>
		</div>
	</div>

<?php }
if ($role_id == 5) { ?>
	<div class="col-md-2 white_bg" id="sidebar">

		<div class="aside_bar mt-5">
			<ul>
				<!-- <li class="<?php if ($this->uri->segment(2) == "MasterView") {
									echo "active";
								} ?>"> <a href="<?php echo base_url() ?>masterView/MasterView"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_0.png" alt="" class="aa"><cite>Master View</cite><span class="tooltiptext">Master View </span></div></a>
			  
			  </li> -->
				<li class="<?php if ($this->uri->segment(2) == "dashboard") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>home/dashboard">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_1.png" alt="" class="aa"><cite>Dashboard</cite> <span class="tooltiptext">Dashboard</span></div>
					</a>

				</li>


				<li class="<?php if ($this->uri->segment(2) == "MandatesList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>mandatesList/MandatesList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Annexures</cite><span class="tooltiptext">Annexures</span></div>
					</a>

				</li>

				<li class="<?php if ($this->uri->segment(2) == "approvalWaiting") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>approvallist/approvalWaiting/2">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Waiting For Approval</cite>
							<span class="tooltiptext">Approval</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "waitingApproval") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>releaserApproval/waitingApproval/3">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Waiting For Release</cite><span class="tooltiptext">Release</span></div>
					</a> </li>


				<li class="<?php if ($this->uri->segment(2) == "reInitiated") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>mandatesList/reInitiated">
						<div class="toolt"><img src="<?php echo base_url() ?>image/auth3.png" alt="" class="aa"><cite>Resubmitted Files</cite>
							<span class="tooltiptext">Resubmitted Files</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "InProcessToDisbursement") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>mandatesList/InProcessToDisbursement">
						<div class="toolt"><img src="<?php echo base_url() ?>image/re3.png" alt="" class="aa"><cite>Release Under Process</cite>
							<span class="tooltiptext">Release Under Process</span>
						</div>
					</a>
				</li>
				<li class="<?php if ($this->uri->segment(2) == "approved") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>releaserApproval/approved">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Released Files</cite><span class="tooltiptext">Released Files</span></div>
					</a> </li>

				<li class="<?php if ($this->uri->segment(2) == "RejectedList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>rejectedList/RejectedList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Rejected Files</cite><span class="tooltiptext">Rejected Files</span></div>
					</a> </li>

				<li class="<?php if ($this->uri->segment(2) == "ReturnedList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>releaserReturned/ReturnedList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa"><cite>Returned Files</cite><span class="tooltiptext">Returned Files</span></div>
					</a> </li>

				<!--          <li class="<?php if ($this->uri->segment(2) == "FailedList") {
												echo "active";
											} ?>"> <a href="<?php echo base_url() ?>returnedList/FailedList"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa"><cite>Failed Annexures</cite>-->
				<!--<span class="tooltiptext">Failed Files</span></div></a>-->
				<!--</li>-->

				<li class="<?php if ($this->uri->segment(2) == "OriginalReport") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>AnnexureReport/OriginalReport">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_6.png" alt="" class="aa"><cite>Reports </cite><span class="tooltiptext">Reports</span></div>
					</a></li>
				<li class="<?php if ($this->uri->segment(2) == "Annexuredownload") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>download/Annexuredownload">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_7.png" alt="" class="aa"><cite>Downloads</cite><span class="tooltiptext">Downloads</span></div>
					</a>
				</li>
				<li class="<?php if ($this->uri->segment(2) == "changeuserPassword") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>member/changeuserPassword">
						<div class="toolt"><img src="<?php echo base_url() ?>image/change_pwd_icon.png" alt="" class="aa"><cite>Change Password</cite>
							<span class="tooltiptext">Change Password</span>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
<?php } ?>
<?php if ($role_id == 6) { ?>
	<div class="col-md-2 white_bg p-0 " id="sidebar">

		<div class="aside_bar mt-5" style="height: 85%; top: 0%; overflow-x: hidden; overflow-y: scroll;">
			<ul>
				<li class="<?php if ($this->uri->segment(2) == "MasterView") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>masterView/MasterView">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_0.png" alt="" class="aa"><cite>Master View</cite><span class="tooltiptext">Master View </span></div>
					</a>

				</li>
				<li class="<?php if ($this->uri->segment(2) == "dashboard") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>home/dashboard">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_1.png" alt="" class="aa"><cite>Dashboard</cite> <span class="tooltiptext">Dashboard</span></div>
					</a>

				</li>
				<li class="<?php if ($this->uri->segment(2) == "uncDashboard") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>home/uncDashboard">
						<div class="toolt">
							<img src="<?php echo base_url() ?>image/icon_1.png" alt="" class="aa"><cite>Unclaimed Original Award Payments</cite>

							<span class="tooltiptext">Unclaimed Original Award Payments</span>
						</div>


				<li class="<?php if ($this->uri->segment(2) == "MandatesList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>mandatesList/MandatesList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Annexures</cite><span class="tooltiptext">Annexures</span></div>
					</a>

				</li>

				<li class="<?php if ($this->uri->segment(2) == "approvalWaiting") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>approvallist/approvalWaiting/2">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Waiting For Approval</cite>
							<span class="tooltiptext">Approval</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "waitingApproval") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>releaserApproval/waitingApproval/3">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Waiting For Release</cite><span class="tooltiptext">Release</span></div>
					</a> </li>


				<li class="<?php if ($this->uri->segment(2) == "reInitiated") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>mandatesList/reInitiated">
						<div class="toolt"><img src="<?php echo base_url() ?>image/auth3.png" alt="" class="aa"><cite>Resubmitted Files</cite>
							<span class="tooltiptext">Resubmitted Files</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "InProcessToDisbursement") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>mandatesList/InProcessToDisbursement">
						<div class="toolt"><img src="<?php echo base_url() ?>image/re3.png" alt="" class="aa"><cite>Release Under Process</cite>
							<span class="tooltiptext">Release Under Process</span>
						</div>
					</a>
				</li>
				<li class="<?php if ($this->uri->segment(2) == "approved") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>releaserApproval/approved">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Released Files</cite><span class="tooltiptext">Released Files</span></div>
					</a> </li>

				<li class="<?php if ($this->uri->segment(2) == "RejectedList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>rejectedList/RejectedList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Rejected Files</cite><span class="tooltiptext">Rejected Files</span></div>
					</a> </li>

				<li class="<?php if ($this->uri->segment(2) == "ReturnedList") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>releaserReturned/ReturnedList">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa"><cite>Returned Files</cite><span class="tooltiptext">Returned Files</span></div>
					</a> </li>

				<!--          <li class="<?php if ($this->uri->segment(2) == "FailedList") {
												echo "active";
											} ?>"> <a href="<?php echo base_url() ?>returnedList/FailedList"><div class="toolt"><img src="<?php echo base_url() ?>image/icon_4.png" alt="" class="aa"><cite>Failed Annexures</cite>-->
				<!--<span class="tooltiptext">Failed Files</span></div></a>-->
				<!--</li>-->

				<li class="<?php if ($this->uri->segment(2) == "OriginalReport") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>AnnexureReport/OriginalReport">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_6.png" alt="" class="aa"><cite>Reports </cite><span class="tooltiptext">Reports</span></div>
					</a></li>
				<li class="<?php if ($this->uri->segment(2) == "Annexuredownload") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>download/Annexuredownload">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_7.png" alt="" class="aa"><cite>Downloads</cite><span class="tooltiptext">Downloads</span></div>
					</a>
				</li>
				<li class="<?php if ($this->uri->segment(2) == "changeuserPassword") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>member/changeuserPassword">
						<div class="toolt"><img src="<?php echo base_url() ?>image/change_pwd_icon.png" alt="" class="aa"><cite>Change Password</cite>
							<span class="tooltiptext">Change Password</span>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
<?php } ?>
<?php if ($role_id == 7) { ?>
	<div class="col-md-2 white_bg" id="sidebar">

		<div class="aside_bar mt-5">
			<ul>
				<li class="<?php if ($this->uri->segment(2) == "memberView" or $this->uri->segment(2) == "updateMember") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>member/memberView">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Member Listing</cite>
							<span class="tooltiptext">Member Listing</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "addMember") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>member/addMember">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Add Member</cite>
							<span class="tooltiptext">Add Member</span>
						</div>
					</a>
				</li>

				<li class="<?php if ($this->uri->segment(2) == "zoneView" or $this->uri->segment(2) == "updateZone") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>zone/zoneView">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Zone Listing</cite>
							<span class="tooltiptext">Zone Listing</span>
						</div>
					</a>
				</li>
				<li class="<?php if ($this->uri->segment(2) == "addZone") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>zone/addZone">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Add Zone</cite>
							<span class="tooltiptext">Add Zone</span>
						</div>
					</a>
				</li>
				<li class="<?php if ($this->uri->segment(2) == "assignAccount") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>zone/assignAccount">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_2.png" alt="" class="aa"><cite>Assign Account</cite>
							<span class="tooltiptext">Assign Account</span>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
<?php } ?>
<?php if ($role_id == 8) { ?>
	<div class="col-md-2 white_bg" id="sidebar">

		<div class="aside_bar mt-5">
			<ul>
				<li class="<?php if ($this->uri->segment(2) == "bankCheckerView") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>member/bankCheckerView">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Member Listing</cite>
							<span class="tooltiptext">Member Listing</span>
						</div>
					</a>
				</li>



				<li class="<?php if ($this->uri->segment(2) == "zoneView") {
								echo "active";
							} ?>"> <a href="<?php echo base_url() ?>zone/zoneView">
						<div class="toolt"><img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa"><cite>Zone Listing</cite>
							<span class="tooltiptext">Zone Listing</span>
						</div>
					</a>
				</li>
				<li class="<?php if ($this->uri->segment(2) == "pendingVerification") {
								echo "active";
							} ?>">
					<a href="<?php echo base_url() ?>action/pendingVerification">
						<div class="toolt">
							<img src="<?php echo base_url() ?>image/icon_3.png" alt="" class="aa">
							<cite>Pending Verifications</cite>
							<span class="tooltiptext">Pending Verifications</span>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</div>
<?php } ?>
<style>
	cite {
		font-style: normal;
	}

	.sidebar_x {
		font-family: 'Montserrat', sans-serif !important;
	}

	.sidebar_x .active {
		background: #9898CC;
		font-weight: 400;
		overflow: hidden;
	}

	.sidebar_x .aside_bar ul li {
		border-bottom: 1px solid #E7E9EB;
		color: #3A4885 !important;
	}
</style>
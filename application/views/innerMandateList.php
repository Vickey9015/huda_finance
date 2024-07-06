<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="<?php echo base_url() ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" />
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
		color: green;
	}
</style>

<div class="col-md-12 mt-4 inner_white" ng-controller="customerCtrl">
	<div class="row">
		<?php

		if ($this->session->flashdata('item')) {
			$message = $this->session->flashdata('item');
		?>
			<div class="<?php echo htmlspecialchars($message['class']) ?>"><?php echo htmlspecialchars($message['message']); ?>

			</div>
		<?php
		}

		?>
		<?php
		//	$file =$this->uri->segment('3');
		$type = $this->uri->segment('4');
		$ref_no = $this->uri->segment('3');
		$annexure_type      	    =    unserialize(ANNEXURE_NAME); ?>
		<div class="pink_bar">
			<h4>Annexure type : <?php echo htmlspecialchars($annexure_type[$type]);

								?> File Ref. No: <?php echo htmlspecialchars($ref_no);  ?></h4>
			<h4>Total Amount: &#x20B9; <span id="totalAmount"></span></h4>
		</div>
	</div>

	<div class="row mandates">
		<div class="table-responsive" id="table_data">
			<?php

			//echo "<pre>========"; print_r($result); exit;
			$session_data = $this->session->all_userdata();
			$role_id = $session_data['role_id'];
			$is_view = $session_data['is_view'];
			?>
			<?php if ($role_id == 4) { ?>
				<form action="<?php echo base_url() ?>innerList/changeStatusAuth" name="releaseForm" method="POST" class="form-horizontal" enctype="multipart/form-data" ng-controller="customerCtrl">
				<?php }
			if ($role_id == 5 or $role_id == 9) { ?>
					<form action="<?php echo base_url() ?>innerList/changeStatusReleas" name="releaseForm" method="POST" class="form-horizontal" enctype="multipart/form-data" ng-controller="customerCtrl">
						<!--<form class="form-horizontal" enctype="multipart/form-data">	-->
					<?php } ?>
					<?php echo form_open();
					echo validation_errors('<div style="color:red">', '</div>');
					?>
					<table class="table bg-white t_data" cellspacing="0" width="100%" id="example">
						<thead>
							<tr>
								<?php if (($role_id == 4 && ($this->uri->segment(5)== 2 or $this->uri->segment(5)== 8 or $this->uri->segment(5)== 10)) or ($role_id == 5 && $is_view !=1 && ($this->uri->segment(5) == 3 or $this->uri->segment(5)== 9  or $this->uri->segment(5)== 10))) {?>
									<th scope="col"><input type="checkbox" class="checkboxAll" name="selectAll" id="selectAllDomainList" /></th>
								<?php } ?>

								<?php if ($type == 1 or $type == 2 or $type == 3 or $type == 4 or $type == 99) { ?>
									<th scope="col">Zone</th>
									<th scope="col">Ref. No.</th>
									<th scope="col">Sector no.</th>
									<th scope="col">Name of Village</th>
								<?php	} ?>
								<?php if ($type == 1) { ?>
									<th scope="col">Date of Section</th>
									<th scope="col">Petition Filed</th>
								<?php	} ?>
								<?php if ($type == 1 or $type == 2 or $type == 3 or $type == 4 or $type == 99) { ?>
									<th scope="col">Award No.</th>
									<th scope="col">Date of Award</th>
									<th scope="col">Bank A/c No. of LAO</th>
								<?php	} ?>
								<?php if ($type == 2) { ?>
									<th scope="col">ADJ Court Order No.</th>
									<th scope="col">Date of Decision by ADJ Court</th>

								<?php	} ?>
								<?php if ($type == 4 or $type == 3 or $type == 99) { ?>
									<th scope="col">ADJ Court Order No.</th>
									<th scope="col">Date of Decision by ADJ Court</th>
									<th scope="col">High Court Order No.</th>
									<th scope="col">Date of Decision by High Court</th>
								<?php	} ?>
								<?php if ($type == 4 or $type == 99) { ?>
									<th scope="col">Supreme Court Order No.</th>
									<th scope="col">Date of Decision by Supreme Court</th>

								<?php	} ?>
								<?php if ($type == 99) { ?>
									<th scope="col">Transaction Type</th>
									<th scope="col">Beneficiary Name</th>
									<th scope="col">Khewat No.</th>
									<th scope="col">Share in the ownership</th>
									<th scope="col">Acre</th>
									<th scope="col">Kanal</th>
									<th scope="col">Marla</th>
									<th scope="col">Pan No.</th>
									<th scope="col">Gross Amt.</th>
									<th scope="col">TDS</th>
									<th scope="col">Net Amt.</th>
									<th scope="col">IFSC Code</th>
									<th scope="col">Drawee Name</th>
									<th scope="col">Drawee Location</th>
									<th scope="col">Print Location Name/Code</th>
									<th scope="col">EDC OR Non EDC</th>
									<!--<th scope="col">Beneficiary add line1</th>
				<th scope="col">Beneficiary add line2</th>
				<th scope="col">Beneficiary add line3</th>		
			<th scope="col">Beneficiary add line4</th>
			<th scope="col">Zipcode</th>
			<th scope="col">Instrument Ref No.</th>
			<th scope="col">Customer Ref No.</th>
			<th scope="col">Advising Detail1</th>
			<th scope="col">Advising Detail2</th>
			<th scope="col">Advising Detail3</th>
			<th scope="col">Advising Detail4</th>
                        <th scope="col">Advising Detail5</th>
                        <th scope="col">Advising Detail6</th>
                        <th scope="col">Cheque No.</th>
                        <th scope="col">Instrument Date</th>
						<th scope="col">MICR No</th>
						<th scope="col">Bene Email ID</th>-->
									<th scope="col">Beneficiary A/C Number</th>
									<!--<th scope="col">Value date</th>-->
									<th scope="col">DD Number</th>
									<th scope="col">Status Description</th>
									<th scope="col">Annexure Status</th>
									<!--<th scope="col">Reason</th>-->
								<?php	} ?>
								<?php if ($type == 1 or $type == 2 or $type == 3 or $type == 4) { ?>
									<th scope="col">Beneficiary Name</th>
									<th scope="col">Khewat No.</th>
									<th scope="col">Share in the ownership</th>
									<th scope="col">Acre</th>
									<th scope="col">Kanal</th>
									<th scope="col">Marla</th>
									<th scope="col">Pan No.</th>
									<th scope="col">Gross Amt.</th>
									<th scope="col">TDS</th>
									<th scope="col">Net Amt.</th>
									<th scope="col">IFSC Code</th>
									<th scope="col">Bank A/c of the Beneficiary</th>

									<th scope="col">EDC OR Non EDC</th>
									<th scope="col">Mobile No.</th>
									<th scope="col">Authorized On</th>
									<th scope="col">UTR</th>
									<th scope="col">Status Description</th>
									<th scope="col">Annexure Status</th>
									<th scope="col">Reason</th>
								<?php	} ?>

								<?php if ($type == 5) { ?>
									<th scope="col">Zone</th>
									<th scope="col">Sr. No.</th>
									<th scope="col">Ref. No.</th>
									<th scope="col">Sector No.</th>
									<th scope="col">Name of Village</th>
									<th scope="col">Bank A/c No. of LAO from which payment is to be made</th>
									<th scope="col">Award No.</th>
									<th scope="col">Date of Award (DD-MM-YY)</th>
									<th scope="col">ADJ Court Order No.</th>
									<th scope="col">Date of Decision by ADJ Court (DD-MM-YY)</th>
									<th scope="col">High Court Order No.</th>
									<th scope="col">Date of Decision by High Court (DD-MM-YY)</th>
									<th scope="col">Supreme Court order Order No.</th>
									<th scope="col">Date of Decision by Supreme Court (DD-MM-YY)</th>
									<th scope="col">Name of Beneficiary</th>
									<th scope="col">Khewat No.</th>
									<th scope="col">Share in the ownership</th>
									<th scope="col">Acre</th>
									<th scope="col">Kanal</th>
									<th scope="col">Marla</th>
									<th scope="col">PAN NO</th>
									<th scope="col">Gross Amount to be Paid</th>
									<th scope="col">TDS to be deducted</th>
									<th scope="col">Net Amount to be paid to Beneficiary</th>
									<th scope="col">DD to be issued in Favour of</th>
									<th scope="col">Print Location</th>
									<th scope="col">DD PAYABLE AT</th>
									<th scope="col">EDC OR Non EDC [E= EDC N = Non EDC]</th>
									<th scope="col">10 Digit Mobile number</th>
									<th scope="col">Authorized On</th>
									<th scope="col">DD Number</th>
									<th scope="col">Status Description</th>
									<th scope="col">Annexure Status</th>
									<th scope="col">Reason</th>


								<?php	} ?>
								<?php if ($type == 6) { ?>
									<th scope="col">Zone</th>
									<th scope="col">Sr. No.</th>
									<th scope="col">Ref. No.</th>
									<th scope="col">Sector No.</th>
									<th scope="col">Name of Village</th>
									<th scope="col">Date of Section 6 Notification (DD-MM-YY)</th>
									<th scope="col">Whether petition filed by the land owner for release of land </th>
									<th scope="col">Award No.</th>
									<th scope="col">Date of Award (DD-MM-YY)</th>
									<th scope="col">Bank A/c No. of LAO from which payment is to be made</th>
									<th scope="col">Name of Beneficiary</th>
									<th scope="col">Khewat No.</th>
									<th scope="col">Share in the ownership</th>
									<th scope="col">Acre</th>
									<th scope="col">Kanal</th>
									<th scope="col">Marla</th>
									<th scope="col">PAN NO.</th>
									<th scope="col">Gross Amount to be Paid</th>
									<th scope="col">DD to be issued in Favour of</th>
									<th scope="col">Print Location</th>
									<th scope="col">DD PAYABLE AT</th>
									<th scope="col">EDC OR Non EDC [E= EDC N = Non EDC]</th>
									<th scope="col">10- Digit Mobile Number</th>
									<th scope="col">Authorized On</th>
									<th scope="col">DD Number</th>
									<th scope="col">Status Description</th>
									<th scope="col">Annexure Status</th>
									<th scope="col">Reason</th>

								<?php	} ?>
								<?php if ($type == 7) { ?>
									<th scope="col">Zone</th>
									<th scope="col">Sr. No.</th>
									<th scope="col">Ref. No.</th>
									<th scope="col">Sector No.</th>
									<th scope="col">Name of Village</th>
									<th scope="col">Bank A/c No. of LAO from which payment is to be made</th>
									<th scope="col">Award No. </th>
									<th scope="col">Date of Award (DD-MM-YY)</th>
									<th scope="col">ADJ Court Order No.</th>
									<th scope="col">Date of Decision by ADJ Court (DD-MM-YY)</th>
									<th scope="col">Name of Beneficiary</th>
									<th scope="col">Khewat No.</th>
									<th scope="col">Share in the ownership</th>
									<th scope="col">Acre</th>
									<th scope="col">Kanal</th>
									<th scope="col">Marla</th>
									<th scope="col">PAN NO</th>
									<th scope="col">Gross Amount to be Paid</th>
									<th scope="col">TDS to be deducted</th>
									<th scope="col">Net Amount to be paid to Beneficiary</th>
									<th scope="col">DD to be issued in Favour of</th>
									<th scope="col">Print Location</th>
									<th scope="col">DD PAYABLE AT</th>
									<th scope="col">EDC OR Non EDC [E= EDC N = Non EDC]</th>
									<th scope="col">10 Digit Mobile number</th>
									<th scope="col">Authorized On</th>
									<th scope="col">DD Number</th>
									<th scope="col">Status Description</th>
									<th scope="col">Annexure Status</th>
									<th scope="col">Reason</th>


								<?php	} ?>
								<?php if ($type == 8) { ?>
									<th scope="col">Zone</th>
									<th scope="col">Sr. No.</th>
									<th scope="col">Ref. No.</th>
									<th scope="col">Sector No.</th>
									<th scope="col">Name of Village</th>
									<th scope="col">Bank A/c No. of LAO from which payment is to be made</th>
									<th scope="col">Award No.</th>
									<th scope="col">Date of Award (DD-MM-YY)</th>
									<th scope="col">ADJ Court Order No.</th>
									<th scope="col">Date of Decision by ADJ Court (DD-MM-YY)</th>
									<th scope="col">High Court Order No.</th>
									<th scope="col">Date of Decision by High Court (DD-MM-YY)</th>
									<th scope="col">Name of Beneficiary</th>
									<th scope="col">Khewat No.</th>
									<th scope="col">Share in the ownership</th>
									<th scope="col">Acre</th>
									<th scope="col">Kanal</th>
									<th scope="col">Marla</th>
									<th scope="col">PAN NO</th>
									<th scope="col">Gross Amount to be Paid</th>
									<th scope="col">TDS to be deducted</th>
									<th scope="col">Net Amount to be paid to Beneficiary</th>
									<th scope="col">DD to be issued in Favour of</th>
									<th scope="col">Print Location</th>
									<th scope="col">DD PAYABLE AT</th>
									<th scope="col">EDC OR Non EDC [E= EDC N = Non EDC]</th>
									<th scope="col">10 Digit Mobile number</th>
									<th scope="col">Authorized On</th>
									<th scope="col">DD Number</th>
									<th scope="col">Status Description</th>
									<th scope="col">Annexure Status</th>
									<th scope="col">Reason</th>



								<?php	} ?>
								<th scope="col">Audit Trail </th>

							</tr>
						</thead>
						<tbody>
							<DIV STYLE="visibility:hidden">
								<input type="text" id="reason_record" name="reason" value="">
								<input type="text" id="btn-action" name="action" value="">
							</div>
							<?php
							$totalAmount = 0;
							if (!empty($result)) {
								foreach ($result as $key => $item) {
									$ref_no                  = $item["reference_number"];
									$annexure_status         = unserialize(ANNEXURE_STATUS);
									$totalAmount            += $item["net_amount"];
							?>
									<tr class="fields">
										 <?php if (($role_id == 4 && ($this->uri->segment(5)== 2 or $this->uri->segment(5)== 8  or $this->uri->segment(5)== 10)) or ($role_id == 5 && $is_view !=1 && ($this->uri->segment(5) == 3 or $this->uri->segment(5)== 9 or $this->uri->segment(5)== 10))) {?>
											<td scope="row">
												<label class="custom_chk">
													<input type="checkbox" name="reference_number[]" class="checkbox1" id="<?php echo htmlspecialchars($item["customer_reference_number"]); ?>" value="<?php echo htmlspecialchars($item["customer_reference_number"]); ?>">

													<span class="checkmark"></span>
												</label>
											</td>
										<?php } ?>
										<?php if ($type == 1 or $type == 2 or $type == 3 or $type == 4 or $type == 99) { ?>
											<td><?php echo htmlspecialchars($item["zone_name"]); ?></td>
											<td><?php echo htmlspecialchars($item["customer_reference_number"]); ?></td>
											<td><?php echo htmlspecialchars($item["sector_no"]); ?></td>
											<td><?php echo htmlspecialchars($item["villlage_name"]);  ?> </td>
											<div id="reas"></div>
										<?php	} ?>
										<?php if ($type == 1) { ?>
											<td><?php echo htmlspecialchars($item["section_notfn_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["is_petition_filed"]);  ?></td>
										<?php	} ?>
										<?php if ($type == 1 or $type == 2 or $type == 3 or $type == 4 or $type == 99) { ?>
											<td><?php echo htmlspecialchars($item["award_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["award_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["LAO_bank_account_no"]);  ?></td>
										<?php	} ?>

										<?php if ($type == 2) { ?>
											<td><?php echo htmlspecialchars($item["ADJ_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ADJ_court_decision_date"]);  ?></td>
										<?php	} ?>

										<?php if ($type == 4 or $type == 3 or $type == 99) { ?>
											<td><?php echo htmlspecialchars($item["ADJ_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ADJ_court_decision_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["high_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["high_court_decision_date"]);  ?></td>

										<?php	} ?>
										<?php if ($type == 4 or $type == 99) { ?>
											<td><?php echo htmlspecialchars($item["supreme_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["supreme_court_decision_date"]);  ?></td>
										<?php	} ?>
										<?php if ($type == 99) { ?>
											<td><?php echo htmlspecialchars($item["transaction_type"]); ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["khewat_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["share_in_ownership"]);  ?></td>
											<td><?php echo htmlspecialchars($item["acre"]);  ?></td>
											<td><?php echo htmlspecialchars($item["kanal"]);  ?></td>
											<td><?php echo htmlspecialchars($item["marla"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_PAN"]);  ?></td>
											<td><?php echo htmlspecialchars($item["gross_amount_to_paid"]);  ?></td>
											<td><?php echo htmlspecialchars($item["TDS_deducted"]);  ?></td>
											<td class="netAmount"><?php echo htmlspecialchars($item["net_amount"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ifsc_code"]);  ?></td>
											<td><?php echo htmlspecialchars($item["drawee_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["drawee_location"]);  ?></td>
											<td><?php echo htmlspecialchars($item["print_location"]);  ?></td>
											<td><?php echo htmlspecialchars($item["is_EDC"]);  ?></td>
											<!--<td><?php echo htmlspecialchars($item["beneficiary_add_line1"]);  ?></td>
												<td><?php echo htmlspecialchars($item["beneficiary_add_line2"]);  ?></td>
												<td><?php echo htmlspecialchars($item["beneficiary_add_line3"]);  ?></td>
												<td><?php echo htmlspecialchars($item["beneficiary_add_line4"]);  ?></td>
												<td><?php echo htmlspecialchars($item["zipcode"]);  ?></td>
												<td><?php echo htmlspecialchars($item["instrument_ref_no"]);  ?></td>
												<td><?php echo htmlspecialchars($item["customer_reference_number"]);  ?></td>
												<td><?php echo htmlspecialchars($item["advising_detail1"]);  ?></td>
												<td><?php echo htmlspecialchars($item["advising_detail2"]);  ?></td>
												<td><?php echo htmlspecialchars($item["advising_detail3"]);  ?></td>
												<td><?php echo htmlspecialchars($item["advising_detail4"]);  ?></td>
												<td><?php echo htmlspecialchars($item["advising_detail5"]);  ?></td>
												<td><?php echo htmlspecialchars($item["advising_detail6"]);  ?></td>
																								
												<td><?php echo htmlspecialchars($item["cheque_no"]);	?> </td>	
												<td><?php echo htmlspecialchars($item["instrument_date"]);  ?></td>
												<td><?php echo htmlspecialchars($item["MICR_no"]);  ?></td>
												<td><?php echo htmlspecialchars($item["bene_email_id"]);  ?></td>-->
											<td><?php echo htmlspecialchars($item["account_number"]);  ?></td>
											<!--<td><?php echo htmlspecialchars($item["value_date"]);  ?></td>-->
											<td><?php echo ($item["UTR"]);  ?></td>
											<td><?php echo htmlspecialchars($item["StatusDesc"]);  ?></td>
											<td><?php echo $annexure_status[$item["annexure_status"]];	?> </td>
											<!--<td><?php echo htmlspecialchars($item["reason"]);  ?></td>	-->

										<?php	} ?>


										<?php if ($type == 1 or $type == 2 or $type == 3 or $type == 4) { ?>
											<td><?php echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["khewat_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["share_in_ownership"]);  ?></td>
											<td><?php echo htmlspecialchars($item["acre"]);  ?></td>
											<td><?php echo htmlspecialchars($item["kanal"]);  ?></td>
											<td><?php echo htmlspecialchars($item["marla"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_PAN"]);  ?></td>
											<td><?php echo htmlspecialchars($item["gross_amount_to_paid"]);  ?></td>
											<td><?php echo htmlspecialchars($item["TDS_deducted"]);  ?></td>
											<td class="netAmount"><?php echo htmlspecialchars($item["net_amount"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ifsc_code"]);  ?></td>
											<td><?php echo htmlspecialchars($item["account_number"]);  ?></td>
											<td><?php echo htmlspecialchars($item["is_EDC"]);  ?></td>
											<td><?php echo htmlspecialchars($item["mobile_number"]);  ?></td>
											<td><?php echo htmlspecialchars($item["authorised_on"]);  ?></td>
											<td><?php echo htmlspecialchars($item["UTR"]);  ?></td>
											<td><?php echo htmlspecialchars($item["StatusDesc"]);  ?></td>
											<td><?php if ($item["annexure_status"] == 6) {
													echo htmlspecialchars($item["is_return"]) == 1 ? "Returned" : "Returned (Failed)";
												} else {
													echo $annexure_status[$item["annexure_status"]];
												}
												?>
											</td>
											<td><?php echo htmlspecialchars($item["reason"]);  ?></td>
										<?php	} ?>

										<?php if ($type == 5) { ?>
											<td><?php echo htmlspecialchars($item["zone_name"]); ?></td>
											<td><?php echo htmlspecialchars($item["serial_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["customer_reference_number"]); ?></td>
											<td><?php echo htmlspecialchars($item["sector_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["villlage_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["LAO_bank_account_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["award_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["award_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ADJ_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ADJ_court_decision_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["high_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["high_court_decision_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["supreme_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["supreme_court_decision_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["khewat_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["share_in_ownership"]);  ?></td>
											<td><?php echo htmlspecialchars($item["acre"]);  ?></td>
											<td><?php echo htmlspecialchars($item["kanal"]);  ?></td>
											<td><?php echo htmlspecialchars($item["marla"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_PAN"]);  ?></td>
											<td><?php echo htmlspecialchars($item["gross_amount_to_paid"]);  ?></td>
											<td><?php echo htmlspecialchars($item["TDS_deducted"]);  ?></td>

											<td class="netAmount"><?php echo htmlspecialchars($item["net_amount"]);  ?></td>
											<td><?php echo htmlspecialchars($item["drawee_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["print_location"]);  ?></td>
											<td><?php echo htmlspecialchars($item["DD_PAYABLE_AT"]);  ?></td>
											<td><?php echo htmlspecialchars($item["is_EDC"]);  ?></td>
											<td><?php echo htmlspecialchars($item["mobile_number"]);  ?></td>
											<td><?php echo htmlspecialchars($item["authorised_on"]);  ?></td>
											<td><?php echo htmlspecialchars($item["UTR"]);  ?></td>
											<td><?php echo htmlspecialchars($item["StatusDesc"]);  ?></td>
											<td><?php if ($item["annexure_status"] == 6) {
													echo htmlspecialchars($item["is_return"]) == 1 ? "Returned" : "Returned (Failed)";
												} else {
													echo htmlspecialchars($annexure_status[$item["annexure_status"]]);
												}
												?>
											</td>
											<td><?php echo htmlspecialchars($item["reason"]);  ?></td>
										<?php	} ?>
										<?php if ($type == 6) { ?>
											<td><?php echo htmlspecialchars($item["zone_name"]); ?></td>
											<td><?php echo htmlspecialchars($item["serial_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["customer_reference_number"]); ?></td>
											<td><?php echo htmlspecialchars($item["sector_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["villlage_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["section_notfn_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["is_petition_filed"]);  ?></td>
											<td><?php echo htmlspecialchars($item["award_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["award_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["LAO_bank_account_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["khewat_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["share_in_ownership"]);  ?></td>
											<td><?php echo htmlspecialchars($item["acre"]);  ?></td>
											<td><?php echo htmlspecialchars($item["kanal"]);  ?></td>
											<td><?php echo htmlspecialchars($item["marla"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_PAN"]);  ?></td>
											<td class="netAmount"><?php echo htmlspecialchars($item["gross_amount_to_paid"]);  ?></td>
											<td><?php echo htmlspecialchars($item["drawee_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["print_location"]);  ?></td>
											<td><?php echo htmlspecialchars($item["DD_PAYABLE_AT"]);  ?></td>
											<td><?php echo htmlspecialchars($item["is_EDC"]);  ?></td>
											<td><?php echo htmlspecialchars($item["mobile_number"]);  ?></td>
											<td><?php echo htmlspecialchars($item["authorised_on"]);  ?></td>
											<td><?php echo htmlspecialchars($item["UTR"]);  ?></td>
											<td><?php echo htmlspecialchars($item["StatusDesc"]);  ?></td>
											<td><?php if ($item["annexure_status"] == 6) {
													echo htmlspecialchars($item["is_return"]) == 1 ? "Returned" : "Returned (Failed)";
												} else {
													echo htmlspecialchars($annexure_status[$item["annexure_status"]]);
												}
												?>
											</td>
											<td><?php echo htmlspecialchars($item["reason"]);  ?></td>

										<?php	} ?>
										<?php if ($type == 7) { ?>
											<td><?php echo htmlspecialchars($item["zone_name"]); ?></td>
											<td><?php echo htmlspecialchars($item["serial_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["customer_reference_number"]); ?></td>
											<td><?php echo htmlspecialchars($item["sector_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["villlage_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["LAO_bank_account_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["award_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["award_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ADJ_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ADJ_court_decision_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["khewat_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["share_in_ownership"]);  ?></td>
											<td><?php echo htmlspecialchars($item["acre"]);  ?></td>
											<td><?php echo htmlspecialchars($item["kanal"]);  ?></td>
											<td><?php echo htmlspecialchars($item["marla"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_PAN"]);  ?></td>
											<td><?php echo htmlspecialchars($item["gross_amount_to_paid"]);  ?></td>
											<td><?php echo htmlspecialchars($item["TDS_deducted"]);  ?></td>
											<td class="netAmount"><?php echo htmlspecialchars($item["net_amount"]);  ?></td>
											<td><?php echo htmlspecialchars($item["drawee_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["print_location"]);  ?></td>
											<td><?php echo htmlspecialchars($item["DD_PAYABLE_AT"]);  ?></td>
											<td><?php echo htmlspecialchars($item["is_EDC"]);  ?></td>
											<td><?php echo htmlspecialchars($item["mobile_number"]);  ?></td>
											<td><?php echo htmlspecialchars($item["authorised_on"]);  ?></td>
											<td><?php echo htmlspecialchars($item["UTR"]);  ?></td>
											<td><?php echo htmlspecialchars($item["StatusDesc"]);  ?></td>
											<td><?php if ($item["annexure_status"] == 6) {
													echo htmlspecialchars($item["is_return"]) == 1 ? "Returned" : "Returned (Failed)";
												} else {
													echo htmlspecialchars($annexure_status[$item["annexure_status"]]);
												}
												?>
											</td>
											<td><?php echo htmlspecialchars($item["reason"]);  ?></td>
										<?php	} ?>
										<?php if ($type == 8) { ?>
											<td><?php echo htmlspecialchars($item["zone_name"]); ?></td>
											<td><?php echo htmlspecialchars($item["serial_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["customer_reference_number"]); ?></td>
											<td><?php echo htmlspecialchars($item["sector_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["villlage_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["LAO_bank_account_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["award_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["award_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ADJ_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["ADJ_court_decision_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["high_court_order_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["high_court_decision_date"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["khewat_no"]);  ?></td>
											<td><?php echo htmlspecialchars($item["share_in_ownership"]);  ?></td>
											<td><?php echo htmlspecialchars($item["acre"]);  ?></td>
											<td><?php echo htmlspecialchars($item["kanal"]);  ?></td>
											<td><?php echo htmlspecialchars($item["marla"]);  ?></td>
											<td><?php echo htmlspecialchars($item["beneficiary_PAN"]);  ?></td>
											<td><?php echo htmlspecialchars($item["gross_amount_to_paid"]);  ?></td>
											<td><?php echo htmlspecialchars($item["TDS_deducted"]);  ?></td>

											<td class="netAmount"><?php echo htmlspecialchars($item["net_amount"]);  ?></td>
											<td><?php echo htmlspecialchars($item["drawee_name"]);  ?></td>
											<td><?php echo htmlspecialchars($item["print_location"]);  ?></td>
											<td><?php echo htmlspecialchars($item["DD_PAYABLE_AT"]);  ?></td>
											<td><?php echo htmlspecialchars($item["is_EDC"]);  ?></td>
											<td><?php echo htmlspecialchars($item["mobile_number"]);  ?></td>
											<td><?php echo htmlspecialchars($item["authorised_on"]);  ?></td>
											<td><?php echo htmlspecialchars($item["UTR"]);  ?></td>
											<td><?php echo htmlspecialchars($item["StatusDesc"]);  ?></td>
											<td><?php if ($item["annexure_status"] == 6) {
													echo htmlspecialchars($item["is_return"]) == 1 ? "Returned" : "Returned (Failed)";
												} else {
													echo htmlspecialchars($annexure_status[$item["annexure_status"]]);
												}
												?>
											</td>
											<td><?php echo htmlspecialchars($item["reason"]);  ?></td>
										<?php	} ?>
										<td><a href="#" ng-click="getAuditTrail($event,<?php echo htmlspecialchars($item["id"]); ?>)"> <img src="<?php echo base_url() ?>image/audit_trail.png" alt="" class="audit_icon"></a></td>
									</tr>
							<?php

								}
							}
							?>
						</tbody>
					</table>
					<?php if ($role_id == 4 && ($this->uri->segment(5) == 2 or $this->uri->segment(5)== 8 or ($this->uri->segment(5)== 10 && !empty($result)))) {?>
						<button type="button" disabled="true" ng-click="confirmRelease($event,'reject','record')" name="action" value="reject" class="btn upload_button mr-4" style="background-color:#353535;margin-left: 35%;">Reject</button>
						<?php if ($this->uri->segment(5) == 8) { ?>
							<button type="button" disabled="true" ng-click="confirmImmediate($event,'immediate','record')" class="btn upload_button">Send to Releaser Immediately</button>
						<?php } ?>
						<!--<button type="submit" name="action" value="rsubmit" class="btn upload_button">-->
						<?php if ($this->uri->segment(5) != 8) { ?>
							<button type="button" disabled="true" ng-click="confirmRelease($event,'authorization','record')" name="action" value="rsubmit" class="btn upload_button">
								 Submit to releaser
							</button>
						<?php }
					}
					if (($role_id == 5 && $is_view !=1)  && !empty($result) && ($this->uri->segment(5) == 3 or $this->uri->segment(5)== 9 or $this->uri->segment(5)== 10)) {?>
						<button type="button" disabled="true" ng-click="confirmRelease($event,'reject','record')" name="action" value="reject" id="reReject" class="btn upload_button mr-4" style="background-color:#353535;margin-left: 35%;">Reject</button>
						<?php if ($this->uri->segment(5) != 9) { ?>
							<button type="button" disabled="true" ng-click="confirmRelease($event,'release','record')" name="action" value="rsubmit" id="reRelease" class="btn upload_button">
								Release
							</button>
					<?php }
					} ?>
					</form>
		</div>

	</div>

	<!-- <div class="col-md-3 mx-auto">
        <button type="button" class="btn upload_button mx-auto">submit to authorizer</button>
        </div>-->
</div>

<!-- Modal Audit Trail -->
<div id="auditModal" class="modal fade" role="dialog" ng-controller="customerCtrl">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="display:block !important">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Audit Trail for {{audits.ref_number}}</h4>
			</div>
			<div class="modal-body" style="font-size:12px;">
				<table class="table table-striped">
					<tr>
						<td>Maker - </td>
						<td>{{audits.maker_name}}</td>
					</tr>
					<tr>
						<td>LAO -</td>
						<td>{{audits.LAO_name}}</td>
					</tr>
					<tr>
						<td>Releaser -</td>
						<td>{{audits.releaser_name}}</td>
					</tr>
					<tr>
						<td>Uploaded On -</td>
						<td>{{audits.created_on}}</td>
					</tr>
					<tr>
						<td>Authorised On -</td>
						<td>{{audits.authorised_on}}</td>
					</tr>
					<tr>
						<td>Rejected On -</td>
						<td>{{audits.rejected_on}}</td>
					</tr>
					<tr>
						<td>Released On -</td>
						<td>{{audits.released_on}}</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.checkboxAll').click(function() {
			if ($(this).is(":checked")) {
				$(".upload_button").removeAttr("disabled");
			} else {
				$(".upload_button").attr("disabled", "disabled");
			}
		});
		$('.checkbox1').change(function() {
			var chkds = $('input:checkbox:checked').length;
			if (chkds >= 1) {
				//alert('if')
				$('button.btn').removeAttr("disabled");
			} else {
				//alert('else')
				$('button.btn').prop("disabled", true);
			}
		});
	});
</script>


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
<script src="<?php echo base_url(); ?>assets/js/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/layout.js" type="text/javascript"></script>
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
<?php $amount                 = moneyFormatIndia($totalAmount);
//echo $amount; exit;
?>
<script>
	$(document).ready(function() {
    var table = $('#example').DataTable( {
        "aLengthMenu": [[20,40,60, -1], [20,40,60, "All"]],
       // "order": [[11,"desc"]],
         "scrollX": true,
        buttons: ['excel']
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
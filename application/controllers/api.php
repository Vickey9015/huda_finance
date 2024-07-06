
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Create connection to Oracle, change HOST IP and SID string!
include_once("con3.php");
//echo"<pre>";print_r($_POST);exit;

$REQUEST_ID = $_POST['REQUEST_ID'];
$COMP_CODE = $_POST['COMP_CODE'];
$PROPOSAL_NO = $_POST['PROPOSAL_NO'];
$SERIAL_NO = $_POST['SERIAL_NO'];
$INST_CODE = $_POST['INST_CODE'];
$UTILITY_CODE = $_POST['UTILITY_CODE'];
$CATEGORY_CODE = $_POST['CATEGORY_CODE'];
$PAY_MODE = $_POST['PAY_MODE'];
$COLLECTION_AMOUNT = $_POST['COLLECTION_AMOUNT'];
$MAX_COLLECTION_AMOUNT = $_POST['MAX_COLLECTION_AMOUNT'];
$ACCOUNT_TYPE = $_POST['ACCOUNT_TYPE'];
$START_DATE = $_POST['START_DATE'];
$END_DATE = $_POST['END_DATE'];
$BANK_NAME = $_POST['BANK_NAME'];
$BRANCH_NAME = $_POST['BRANCH_NAME'];
$MICR = $_POST['MICR'];
$DUE_DATE = $_POST['DUE_DATE'];
$MANDATE_STATUS = $_POST['MANDATE_STATUS'];
$MANDATE_FRESH_DATE = $_POST['MANDATE_FRESH_DATE'];
$MANDATE_SENT_DT = $_POST['MANDATE_SENT_DT'];
$MANDATE_CONF_RCVD_DT = $_POST['MANDATE_CONF_RCVD_DT'];
$REJ_CODE = $_POST['REJ_CODE'];
$REJ_REASON = $_POST['REJ_REASON'];
$UMRN = $_POST['UMRN'];
$SUCCESS_FAILURE_STATUS = $_POST['SUCCESS_FAILURE_STATUS'];
$REJECTION_REASON = $_POST['REJECTION_REASON'];
$DATETIME_CREATED = $_POST['DATETIME_CREATED'];
$DATETIME_UPDATED = $_POST['DATETIME_UPDATED'];



echo $sql = "INSERT INTO TB_CCA_NACH_MANDATE_STAGE (REQUEST_ID,COMP_CODE,PROPOSAL_NO,SERIAL_NO,INST_CODE,UTILITY_CODE,CATEGORY_CODE,PAY_MODE,COLLECTION_AMOUNT,MAX_COLLECTION_AMOUNT,ACCOUNT_TYPE,START_DATE,END_DATE,BANK_NAME,BRANCH_NAME,MICR,DUE_DATE,MANDATE_STATUS,MANDATE_FRESH_DATE,MANDATE_SENT_DT,MANDATE_CONF_RCVD_DT,REJ_CODE,REJ_REASON,UMRN,SUCCESS_FAILURE_STATUS,REJECTION_REASON,DATETIME_CREATED,DATETIME_UPDATED) 
 VALUES ('$REQUEST_ID','$COMP_CODE','$PROPOSAL_NO','$SERIAL_NO','$INST_CODE','$UTILITY_CODE','$CATEGORY_CODE','$PAY_MODE','$COLLECTION_AMOUNT','$MAX_COLLECTION_AMOUNT','$ACCOUNT_TYPE','$START_DATE','$END_DATE','$BANK_NAME','$BRANCH_NAME','$MICR','$DUE_DATE','$MANDATE_STATUS','$MANDATE_FRESH_DATE','$MANDATE_SENT_DT','$MANDATE_CONF_RCVD_DT','$REJ_CODE','$REJ_REASON','$UMRN','$SUCCESS_FAILURE_STATUS','$REJECTION_REASON','$DATETIME_CREATED','$DATETIME_UPDATED')";  
 $stmt = oci_parse($conn,$sql);
 //echo "<pre>==parse==="; print_r($stmt); echo "<hr>";
 $trst=oci_execute($stmt);
 if($trst){
	 echo "<hr>";echo "success";
	$res="success";
	return $res;
}else{
	 //echo "<hr>";echo"falied";exit;
}


 //echo "<pre>==ociexce==="; print_r($trst); echo "<hr>";exit;
/*oci_bind_by_name($compiled, ":REQUEST_ID", $REQUEST_ID);
oci_bind_by_name($compiled, ":COMP_CODE", $COMP_CODE);
oci_bind_by_name($compiled, ':PROPOSAL_NO', $PROPOSAL_NO);
oci_bind_by_name($compiled, ':SERIAL_NO', $SERIAL_NO);
oci_bind_by_name($compiled, ':INST_CODE', $INST_CODE);
oci_bind_by_name($compiled, ':UTILITY_CODE', $UTILITY_CODE);
oci_bind_by_name($compiled, ':CATEGORY_CODE', $CATEGORY_CODE);
oci_bind_by_name($compiled, ':PAY_MODE', $PAY_MODE);
oci_bind_by_name($compiled, ':COLLECTION_AMOUNT', $COLLECTION_AMOUNT);
oci_bind_by_name($compiled, ':MAX_COLLECTION_AMOUNT', $MAX_COLLECTION_AMOUNT);
oci_bind_by_name($compiled, ':ACCOUNT_TYPE', $ACCOUNT_TYPE);
oci_bind_by_name($compiled, ':START_DATE', $START_DATE);
oci_bind_by_name($compiled, ':END_DATE', $END_DATE);
oci_bind_by_name($compiled, ':BANK_NAME', $BANK_NAME);
oci_bind_by_name($compiled, ':BRANCH_NAME', $BRANCH_NAME);
oci_bind_by_name($compiled, ':MICR', $MICR);
oci_bind_by_name($compiled, ':DUE_DATE', $DUE_DATE);
oci_bind_by_name($compiled, ':MANDATE_STATUS', $MANDATE_STATUS);
oci_bind_by_name($compiled, ':MANDATE_FRESH_DATE', $MANDATE_FRESH_DATE);
oci_bind_by_name($compiled, ':MANDATE_SENT_DT', $MANDATE_SENT_DT);
oci_bind_by_name($compiled, ':MANDATE_CONF_RCVD_DT', $MANDATE_CONF_RCVD_DT);
oci_bind_by_name($compiled, ':REJ_CODE', $REJ_CODE);
oci_bind_by_name($compiled, ':REJ_REASON', $REJ_REASON);
oci_bind_by_name($compiled, ':UMRN', $UMRN);
oci_bind_by_name($compiled, ':SUCCESS_FAILURE_STATUS', $SUCCESS_FAILURE_STATUS);
oci_bind_by_name($compiled, ':REJECTION_REASON', $REJECTION_REASON);
oci_bind_by_name($compiled, ':DATETIME_CREATED', $DATETIME_CREATED);
oci_bind_by_name($compiled, ':DATETIME_UPDATED', $DATETIME_UPDATED);*/

/*$sql="INSERT INTO TB_CCA_NACH_MANDATE_STAGE(REQUEST_ID,COMP_CODE,PROPOSAL_NO,SERIAL_NO,INST_CODE,UTILITY_CODE,CATEGORY_CODE,PAY_MODE,COLLECTION_AMOUNT,MAX_COLLECTION_AMOUNT,ACCOUNT_TYPE,START_DATE,END_DATE,BANK_NAME,BRANCH_NAME,MICR,DUE_DATE,MANDATE_STATUS,MANDATE_FRESH_DATE,MANDATE_SENT_DT,MANDATE_CONF_RCVD_DT,MANDATE_CONF_RCVD_DT,REJ_CODE,$REJ_REASON,UMRN,SUCCESS_FAILURE_STATUS,REJECTION_REASON,DATETIME_CREATED,DATETIME_UPDATED) VALUES('".'{$REQUEST_ID}'."','".'{$COMP_CODE}'."','".'{$PROPOSAL_NO}'."','".'{$SERIAL_NO}'."','".'{$INST_CODE}'."','".'{$UTILITY_CODE}'."','".'{$CATEGORY_CODE}'."','".'{$PAY_MODE}'."','".'{$COLLECTION_AMOUNT}'."','".'{$MAX_COLLECTION_AMOUNT}'."','".'{$ACCOUNT_TYPE}'."','".'{$START_DATE}'."','".'{$END_DATE}'."','".'{$BANK_NAME}'."','".'{$BRANCH_NAME}'."','".'{$MICR}'."','".'{$MICR}'."','".'{$DUE_DATE}'."','".'{$MANDATE_STATUS}'."','".'{$MANDATE_FRESH_DATE}'."',,'".'{$MANDATE_SENT_DT}'."','".'{$MANDATE_CONF_RCVD_DT}'."','".'{$MANDATE_CONF_RCVD_DT}'."','".'{$REJ_CODE}'."','".'{$REJ_REASON}'."','".'{$SUCCESS_FAILURE_STATUS}'."','".'{$REJECTION_REASON}'."','".'{$DATETIME_CREATED}'."','".'{$DATETIME_UPDATED}'."')";

$compiled = oci_parse($conn,$sql);*/
//$res = oci_execute($compiled);
//echo"<pre>$res";print_r($res);
?>
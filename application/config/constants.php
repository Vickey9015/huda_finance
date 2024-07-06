<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',                                        'rb');
define('FOPEN_READ_WRITE',                                  'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',        'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',   'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',                          'ab');
define('FOPEN_READ_WRITE_CREATE',                     'a+b');
define('FOPEN_WRITE_CREATE_STRICT',                   'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',        'x+b');

$annexure['Original'] = array(
                              'serial_no'                    => 'Sr. No.',
                              'sector_no'                    => 'Sector No.',
                              'villlage_name'                => 'Name of Village',
                              'section_notfn_date'           => 'Date of Section 6 Notification (DD-MM-YY)',
                              'is_petition_filed'            => 'Whether petition filed by the land owner for release of land',
                              'award_no'                     => 'Award No.',
                              'award_date'                   => 'Date of Award (DD-MM-YY)',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'beneficiary_name'             => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'              => 'PAN NO.',
                              'gross_amount_to_paid'         => 'Gross Amount to be Paid',
                              'TDS_deducted'                 => 'TDS to be deducted',
                              'net_amount'                   => 'Net Amount to be paid to Beneficiary',
                              'ifsc_code'                    => 'IFSC code of Beneficiary',
                              'account_number'               => 'Bank A/c of the Beneficiary',
                              'is_EDC'                       => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                => '10- Digit Mobile Number',
                              'customer_reference_number'    => 'Customer Reference Number',

                            
                              );
                              
                              
 $annexure['Original_DD'] = array(
                              'serial_no'                    => 'Sr. No.',
                              'sector_no'                    => 'Sector No.',
                              'villlage_name'                => 'Name of Village',
                              'section_notfn_date'           => 'Date of Section 6 Notification (DD-MM-YY)',
                              'is_petition_filed'            => 'Whether petition filed by the land owner for release of land',
                              'award_no'                     => 'Award No.',
                              'award_date'                   => 'Date of Award (DD-MM-YY)',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'beneficiary_name'             => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'              => 'PAN NO.',
                              'gross_amount_to_paid'         => 'Gross Amount to be Paid',
                              'drawee_name'                  => 'DD to be issued in Favour of',
                              'print_location'               => 'Print Location',
                              'DD_PAYABLE_AT'                => 'DD PAYABLE AT',
                              'is_EDC'                       => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                => '10- Digit Mobile Number',
                             
                              );                             
$annexure['LowerCourt'] = array(
                              'serial_no'                    => 'Sr. No.',
                              'sector_no'                    => 'Sector No.',
                              'villlage_name'                => 'Name of Village',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'                     => 'Award No.',
                              'award_date'                   => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'           => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'      => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'beneficiary_name'             => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'              => 'PAN NO',
                              'gross_amount_to_paid'         => 'Gross Amount to be Paid',
                              'TDS_deducted'                 => 'TDS to be deducted',
                              'net_amount'                   => 'Net Amount to be paid to Beneficiary',
                              'ifsc_code'                    => 'IFSC code of Beneficiary',
                              'account_number'               => 'Bank A/c of the Beneficiary',
                              'is_EDC'                       => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                => '10 Digit Mobile number',
                              'customer_reference_number'    => 'Customer Reference Number',
                             
                              );
                              
 $annexure['LowerCourt_DD'] = array(
                              'serial_no'                    => 'Sr. No.',
                              'sector_no'                    => 'Sector No.',
                              'villlage_name'                => 'Name of Village',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'                     => 'Award No.',
                              'award_date'                   => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'           => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'      => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'beneficiary_name'             => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'              => 'PAN NO',
                              'gross_amount_to_paid'         => 'Gross Amount to be Paid',
                              'TDS_deducted'                 => 'TDS to be deducted',
                              'net_amount'                   => 'Net Amount to be paid to Beneficiary',
                              'drawee_name'                  => 'DD to be issued in Favour of',
                              'print_location'               => 'Print Location',
                              'DD_PAYABLE_AT'                => 'DD PAYABLE AT',
                              'is_EDC'                       => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                => '10 Digit Mobile number',
                             
                              );                             
$annexure['HighCourt'] = array(
                              'serial_no'                    => 'Sr. No.',
                              'sector_no'                    => 'Sector No.',
                              'villlage_name'                => 'Name of Village',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'                     => 'Award No.',
                              'award_date'                   => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'           => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'      => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'high_court_order_no'          => 'High Court Order No.',
                              'high_court_decision_date'     => 'Date of Decision by High Court (DD-MM-YY)',
                              'beneficiary_name'             => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'              => 'PAN NO',
                              'gross_amount_to_paid'         => 'Gross Amount to be Paid',
                              'TDS_deducted'                 => 'TDS to be deducted',
                              'net_amount'                   => 'Net Amount to be paid to Beneficiary',
                              'ifsc_code'                    => 'IFSC code of Beneficiary',
                              'account_number'               => 'Bank A/c of the Beneficiary',
                              'is_EDC'                       => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                => '10 Digit Mobile number',
                              'customer_reference_number'    => 'Customer Reference Number',
                             
                              );
                              
$annexure['HighCourt_DD'] = array(
                              'serial_no'                    => 'Sr. No.',
                              'sector_no'                    => 'Sector No.',
                              'villlage_name'                => 'Name of Village',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'                     => 'Award No.',
                              'award_date'                   => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'           => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'      => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'high_court_order_no'          => 'High Court Order No.',
                              'high_court_decision_date'     => 'Date of Decision by High Court (DD-MM-YY)',
                              'beneficiary_name'             => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'              => 'PAN NO',
                              'gross_amount_to_paid'         => 'Gross Amount to be Paid',
                              'TDS_deducted'                 => 'TDS to be deducted',
                              'net_amount'                   => 'Net Amount to be paid to Beneficiary',
                              'drawee_name'                  => 'DD to be issued in Favour of',
                              'print_location'               => 'Print Location',
                              'DD_PAYABLE_AT'                => 'DD PAYABLE AT',
                              'is_EDC'                       => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                => '10 Digit Mobile number',
                             
                              );                              
$annexure['SupremeCourt'] = array(
                              'serial_no'                    => 'Sr. No.',
                              'sector_no'                    => 'Sector No.',
                              'villlage_name'                => 'Name of Village',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'                     => 'Award No.',
                              'award_date'                   => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'           => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'      => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'high_court_order_no'          => 'High Court Order No.',
                              'high_court_decision_date'     => 'Date of Decision by High Court (DD-MM-YY)',
                              'supreme_court_order_no'       => 'Supreme Court order Order No.',
                              'supreme_court_decision_date'  => 'Date of Decision by Supreme Court (DD-MM-YY)',
                              'beneficiary_name'             => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'              => 'PAN NO',
                              'gross_amount_to_paid'         => 'Gross Amount to be Paid',
                              'TDS_deducted'                 => 'TDS to be deducted',
                              'net_amount'                   => 'Net Amount to be paid to Beneficiary',
                              'ifsc_code'                    => 'IFSC code of Beneficiary',
                              'account_number'               => 'Bank A/c of the Beneficiary',
                              'is_EDC'                       => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                => '10 Digit Mobile number',
                              'customer_reference_number'    => 'Customer Reference Number',
                             
                              );

                              
$annexure['DD'] = array(
                              'serial_no'                    => 'Sr. No.',
                              'sector_no'                    => 'Sector No.',
                              'villlage_name'                => 'Name of Village',
                              'LAO_bank_account_no'          => 'Bank A/c No. of LAO from which payment is to be made',
                              'award_no'                     => 'Award No.',
                              'award_date'                   => 'Date of Award (DD-MM-YY)',
                              'ADJ_court_order_no'           => 'ADJ Court Order No.',
                              'ADJ_court_decision_date'      => 'Date of Decision by ADJ Court (DD-MM-YY)',
                              'high_court_order_no'          => 'High Court Order No.',
                              'high_court_decision_date'     => 'Date of Decision by High Court (DD-MM-YY)',
                              'supreme_court_order_no'       => 'Supreme Court order Order No.',
                              'supreme_court_decision_date'  => 'Date of Decision by Supreme Court (DD-MM-YY)',
                              'beneficiary_name'             => 'Name of Beneficiary',
                              'khewat_no'                    => 'Khewat No.',
                              'share_in_ownership'           => 'Share in the ownership',
                              'acre'                         => 'Acre',
                              'kanal'                        => 'Kanal',
                              'marla'                        => 'Marla',
                              'beneficiary_PAN'              => 'PAN NO',
                              'gross_amount_to_paid'         => 'Gross Amount to be Paid',
                              'TDS_deducted'                 => 'TDS to be deducted',
                              'net_amount'                   => 'Net Amount to be paid to Beneficiary',
                              'drawee_name'                  => 'DD to be issued in Favour of',
                              'print_location'               => 'Print Location',
                              'DD_PAYABLE_AT'                => 'DD PAYABLE AT',
                              'is_EDC'                       => 'EDC OR Non EDC [E= EDC N = Non EDC]',
                              'mobile_number'                => '10 Digit Mobile number',
                             
                              
                              ); 
                              
$annexure['DD_OUTPUT'] = array(
                              'record_identifier'                    => 'Record Identifier',
                              'transaction_type'                     => 'Transaction Type',
                              'customer_id'                          => 'Customer ID',
                              'transaction_amount'                   => 'Transaction Amount',
                              'beneficiary_name'                     => 'Benefirciary Name',
                              'drawee_location'                      => 'Drawee Location',
                              'print_location'                       => 'Print Location Name/Code',
                              'beneficiary_add_line1'                => 'Beneficiary add line1',
                              'beneficiary_add_line2'                => 'Beneficiary add line2',
                              'beneficiary_add_line3'                => 'Beneficiary add line3',
                              'beneficiary_add_line4'                => 'Beneficiary add line4',
                              'zipcode'                              => 'Zipcode',
                              'instrument_ref_no'                    => 'Instrument Ref No.',
                              'customer_reference_number'            => 'Customer Ref No.',
                              'advising_detail1'                     => 'Advising Detail1',
                              'advising_detail2'                     => 'Advising Detail2',
                              'advising_detail3'                     => 'Advising Detail3',
                              'advising_detail4'                     => 'Advising Detail4',
                              'advising_detail5'                     => 'Advising Detail5',
                              'advising_detail6'                     => 'Advising Detail6',
                              'cheque_no'                            => 'Cheque No.',
                              'instrument_date'                      => 'Instrument Date',
                              'MICR_no'                              => 'MICR No',
                              'bene_email_id'                        => 'Bene Email ID',
                              'LAO_bank_account_no'                  => 'Debit A/C Number',
                             
                              
                              
                              );       
$annexureDDOutput['Original_DD'] = array(
                              'record_identifier'                    => 'Record Identifier',
                              'transaction_type'                     => 'Transaction Type',
                              'customer_id'                          => 'Customer ID',
                              'transaction_amount'                   => 'Transaction Amount',
                              'section_notfn_date'                   => 'Date of Section 6 Notification (DD-MM-YY)',
                              'is_petition_filed'                    => 'Whether petition filed by the land owner for release of land',
                              'beneficiary_name'                     => 'Benefirciary Name',
                              'drawee_location'                      => 'Drawee Location',
                              'print_location'                       => 'Print Location Name/Code',
                              'beneficiary_add_line1'                => 'Beneficiary add line1',
                              'beneficiary_add_line2'                => 'Beneficiary add line2',
                              'beneficiary_add_line3'                => 'Beneficiary add line3',
                              'beneficiary_add_line4'                => 'Beneficiary add line4',
                              'zipcode'                              => 'Zipcode',
                              'instrument_ref_no'                    => 'Instrument Ref No.',
                              'customer_reference_number'            => 'Customer Ref No.',
                              'advising_detail1'                     => 'Advising Detail1',
                              'advising_detail2'                     => 'Advising Detail2',
                              'advising_detail3'                     => 'Advising Detail3',
                              'advising_detail4'                     => 'Advising Detail4',
                              'advising_detail5'                     => 'Advising Detail5',
                              'advising_detail6'                     => 'Advising Detail6',
                              'cheque_no'                            => 'Cheque No.',
                              'instrument_date'                      => 'Instrument Date',
                              'MICR_no'                              => 'MICR No',
                              'bene_email_id'                        => 'Bene Email ID',
                              'LAO_bank_account_no'                  => 'Debit A/C Number',
                             
                              
                              
                              );  
$annexureDDOutput['LowerCourt_DD'] = array(
                              'record_identifier'                    => 'Record Identifier',
                              'transaction_type'                     => 'Transaction Type',
                              'customer_id'                          => 'Customer ID',
                              'transaction_amount'                   => 'Transaction Amount',
                              'section_notfn_date'                   => 'Date of Section 6 Notification (DD-MM-YY)',
                              'is_petition_filed'                    => 'Whether petition filed by the land owner for release of land',
                              'beneficiary_name'                     => 'Benefirciary Name',
                              'drawee_location'                      => 'Drawee Location',
                              'print_location'                       => 'Print Location Name/Code',
                              'beneficiary_add_line1'                => 'Beneficiary add line1',
                              'beneficiary_add_line2'                => 'Beneficiary add line2',
                              'beneficiary_add_line3'                => 'Beneficiary add line3',
                              'beneficiary_add_line4'                => 'Beneficiary add line4',
                              'zipcode'                              => 'Zipcode',
                              'instrument_ref_no'                    => 'Instrument Ref No.',
                              'customer_reference_number'            => 'Customer Ref No.',
                              'advising_detail1'                     => 'Advising Detail1',
                              'advising_detail2'                     => 'Advising Detail2',
                              'advising_detail3'                     => 'Advising Detail3',
                              'advising_detail4'                     => 'Advising Detail4',
                              'advising_detail5'                     => 'Advising Detail5',
                              'advising_detail6'                     => 'Advising Detail6',
                              'cheque_no'                            => 'Cheque No.',
                              'instrument_date'                      => 'Instrument Date',
                              'MICR_no'                              => 'MICR No',
                              'bene_email_id'                        => 'Bene Email ID',
                              'LAO_bank_account_no'                  => 'Debit A/C Number',
                             
                              
                              
                              ); 
$annexureDDOutput['HighCourt_DD'] = array(
                              'record_identifier'                    => 'Record Identifier',
                              'transaction_type'                     => 'Transaction Type',
                              'customer_id'                          => 'Customer ID',
                              'transaction_amount'                   => 'Transaction Amount',
                              'section_notfn_date'                   => 'Date of Section 6 Notification (DD-MM-YY)',
                              'is_petition_filed'                    => 'Whether petition filed by the land owner for release of land',
                              'beneficiary_name'                     => 'Benefirciary Name',
                              'drawee_location'                      => 'Drawee Location',
                              'print_location'                       => 'Print Location Name/Code',
                              'beneficiary_add_line1'                => 'Beneficiary add line1',
                              'beneficiary_add_line2'                => 'Beneficiary add line2',
                              'beneficiary_add_line3'                => 'Beneficiary add line3',
                              'beneficiary_add_line4'                => 'Beneficiary add line4',
                              'zipcode'                              => 'Zipcode',
                              'instrument_ref_no'                    => 'Instrument Ref No.',
                              'customer_reference_number'            => 'Customer Ref No.',
                              'advising_detail1'                     => 'Advising Detail1',
                              'advising_detail2'                     => 'Advising Detail2',
                              'advising_detail3'                     => 'Advising Detail3',
                              'advising_detail4'                     => 'Advising Detail4',
                              'advising_detail5'                     => 'Advising Detail5',
                              'advising_detail6'                     => 'Advising Detail6',
                              'cheque_no'                            => 'Cheque No.',
                              'instrument_date'                      => 'Instrument Date',
                              'MICR_no'                              => 'MICR No',
                              'bene_email_id'                        => 'Bene Email ID',
                              'LAO_bank_account_no'                  => 'Debit A/C Number',
                             
                              
                              
                              ); 
$annexureType           = array('1' => 'Original', '2' => 'LowerCourt','3'=>'HighCourt','4'=>'SupremeCourt','5'=>'DD','6'=>'Original_DD','7'=>'LowerCourt_DD','8'=>'HighCourt_DD');
$annexureName           = array('1' => 'Original', '2' => 'Lower Court','3'=>'High Court','4'=>'Supreme Court','5'=>'DD','6'=>'Original DD','7'=>'LowerCourt DD','8'=>'HighCourt DD');
$annexure_column_length = array('original' => '18', 'lower_court' => '18','high_court' => '20', 'suprem_court' => '22','original_dd'=>'16','lower_court_dd'=>'18','high_court_dd'=>'20');
$annexureStatus = array('1' => 'Set', '2' => 'Pending at LAO','3'=>'Pending at Releaser','4'=>'Rejected By LAO','5'=>'Rejected By releaser','6'=>'Returned','7'=>'Sent To Bank','8'=> 'In process to Releaser', '9'=> 'In process for Disbursal','10'=> 'Reinitiated', '11'=> 'Disbursement Successful', '12'=> 'Disbursement Failed');

$zones                  = array('1' => 'Gurgaon', '2' => 'Panchkula','3'=>'Faridabad','4'=>'Rohtak','5'=>'Hissar');

define('ANNEXURE', serialize($annexure));
define('ANNEXURE_DD', serialize($annexureDDOutput));
define('ANNEXURE_TYPE', serialize($annexureType));
define('ANNEXURE_NAME', serialize($annexureName));
define('ANNEXURE_COLUMN_LENGTH', serialize($annexure_column_length));
define('ANNEXURE_STATUS', serialize($annexureStatus));
define('ZONES', serialize($zones));



define('TBL_ACCOUNT_MASTER',             'account_master');
define('TBL_ADMIN_USER',                 'admin_user');
define('TBL_ANNEXURE',                   'annexure');
define('TBL_ANNEXURE_FILE_STATUS',       'annexure_file_status');
define('TBL_ANNEXURE_TEMP',              'annexure_temp');
define('TBL_ANNEXURE_ZONE',              'annexure_zone');
define('TBL_AUTH_ANNEXURE',              'auth_annexure');
define('TBL_BENEFICIARY_INFO',           'beneficiary_info');
define('TBL_BENEFICIARY_PAYMENT_INFO',   'beneficiary_payment_info');
define('TBL_FILE_MASTER',                'file_master');
define('TBL_PERMISSION',                 'permission');
define('TBL_ROLE',                       'role');
define('TBL_ROLE_PERM',                  'role_perm');
define('TBL_STATUS_MASTER',              'status_master');
define('TBL_USER',                       'user');
define('TBL_USER_ROLE',                  'user_role');
define('TBL_USER_ZONE_MAPPING',          'user_zone_mapping');
define('TBL_ZONE_MASTER',                'zone_master');
define('CIBB_TITLE',     ' &mdash; CIBB Forum');

define('CUSTOMER_ID',     '10538451');

define('RELEASER_SUBMITED_MESSAGE',     'Record(s) submitted successfully to Releaser');
define('UPDATE_RETURNED_MESSAGE',       'Record(s) updated successfully');
define('APPROVED_SUBMITED_MESSAGE',     'Record(s) submitted successfully for disbursement');
define('DISBURSEMENT_SUBMITED_MESSAGE', 'Record(s) submitted successfully for disbursement');
define('REJECTED_MESSAGE',              'Record(s) rejected successfully');
define('APPROVED_MESSAGE',              'Record(s) approved successfully');

define('NON_ANNEXURE_FILE_MESSAGE',     'Incorrect format. Kindly upload correct annexures.');

define('EMPTY_ANNEXURE_FILE_MESSAGE',     'Annexure file empty.');

define('ANNEXURE_UPLOADED_MESSAGE',     'File uploaded successfully');
define('ORITINAL_XLS_COLUMN_MISMATCH_MESSAGE',    'Columns mismatch. Please upload correct Annexure file.');
define('LOWER_XLS_COLUMN_MISMATCH_MESSAGE',    'Columns mismatch. Please upload correct Annexure file.');
define('HIGH_XLS_COLUMN_MISMATCH_MESSAGE',    'Columns mismatch. Please upload correct Annexure file.');
define('SUPREME_XLS_COLUMN_MISMATCH_MESSAGE',    'Columns mismatch. Please upload correct Annexure file.');
define('DD_XLS_COLUMN_MISMATCH_MESSAGE',    'Columns mismatch. Please upload correct Annexure file.');
define('FILE_EXIST_MESSAGE',    'File with this name already exists. Please upload different file.');
define('SELECT_ANNEXURE_MESSAGE',    'Please select correct annexure type');
define('MEMBER_ADDED_MESSAGE',       'Member added successfuly');
define('MEMBER_UPDATED_MESSAGE',     'Member updated successfuly');
define('MEMBER_STATUS_MESSAGE',     'Member Status Updated Successfuly');
define('ZONE_ADDED_MESSAGE',       'Zone added successfuly');
define('ZONE_UPDATED_MESSAGE',     'Zone updated successfuly');



define('DD_UPLOAD_IN',     '/home/colftpuser1/HUDA/DD_Upload/IN/');
define('DD_UPLOAD_OUT',    '/home/colftpuser1/HUDA/DD_Upload/OUT/');
define('DD_UPLOAD_ARCHIVE','/home/colftpuser1/HUDA/DD_Upload/ARCHIVE/');
define('HC_IN',            '/home/colftpuser1/HUDA/Higher_Court/IN/');
define('HC_OUT',           '/home/colftpuser1/HUDA/Higher_Court/OUT/');
define('HC_ARCHIVE',       '/home/colftpuser1/HUDA/Higher_Court/ARCHIVE/');
define('LC_IN',            '/home/colftpuser1/HUDA/Lower_Court/IN/');
define('LC_OUT',           '/home/colftpuser1/HUDA/Lower_Court/OUT/');
define('LC_ARCHIVE',       '/home/colftpuser1/HUDA/Lower_Court/ARCHIVE/');
define('OA_IN',            '/home/colftpuser1/HUDA/Original_Award/IN/');
define('OA_OUT',           '/home/colftpuser1/HUDA/Original_Award/OUT/');
define('OA_ARCHIVE',       '/home/colftpuser1/HUDA/Original_Award/ARCHIVE/');
define('SC_IN',            '/home/colftpuser1/HUDA/Supreme_Court/IN/');
define('SC_OUT',           '/home/colftpuser1/HUDA/Supreme_Court/OUT/');
define('SC_ARCHIVE',       '/home/colftpuser1/HUDA/Supreme_Court/ARCHIVE/');


$unclaimedannexure = array(
    's_no'                    => 'Sno',
    'zone_name'                    => 'Zone',
    'sector_no'                => 'Sector No.',
    'name_of_village'           => 'Name of Village',
    'date_of_four_section'            => 'Date of Section 4 Notification (DD-MM-YY)',
    'date_of_six_sectiom'                     => 'Date of Section 6 Notification (DD-MM-YY)',
    'award_no'                   => 'Award No.',
    'award_date'          => 'Date of Award (DD-MM-YY)',
    'khewat_no'             => 'khewat no. of award statement',
    'acquired_area'                    => 'acquired area of applicant / share',
    'acre'                         => 'Acre',
    'kanal'                        => 'Kanal',
    'marla'                        => 'Marla',
    'bank_ac_lao'              => 'Bank A/c No. of LAO from which payment is to be made',
    'name_of_bene'         => 'Name of Beneficiary',
    'care_of'                 => 'Son of/ Daughter of/ Wife of',
    'net_amount'                   => 'Net Amount to be Paid',
    'is_edc'                    => 'EDC OR Non EDC [E= EDC N = Non EDC]',
    'customer_ref_numer'               => 'Customer Reference No.',

    );

define('UNCLAIMEDANNEXURE', serialize($unclaimedannexure));

$unclaimedzonebene           = array('FARIDABAD' => '5939', 'GURGAON' => '2647','GURGAONALL' => '2647','HISAR'=>'316','PANCHKULA'=>'268','PANCHKULAALL'=>'268','ROHTAK'=>'134','ROHTAKALL'=>'134');
$unclaimedzoneamount         = array('FARIDABAD' => '2232396977', 'GURGAON' => '10267860484.99','GURGAONALL' => '10267860484.99','HISAR'=>'1352465862','PANCHKULA'=>'2334162222','PANCHKULAALL'=>'2334162222','ROHTAK'=>'90579546','ROHTAKALL'=>'90579546');
$unclaimedzonespath          = array('FARIDABAD' => 'crfiles/zone4/faridabad.xlsx', 'GURGAON' => 'crfiles/zone2/gurugram.xlsx','GURGAONALL' => 'crfiles/zone2/gurugram.xlsx','HISAR'=>'crfiles/zone3/hisar.xlsx','PANCHKULA'=>'crfiles/zone1/panchkula.xlsx','PANCHKULAALL'=>'crfiles/zone1/panchkula.xlsx','ROHTAK'=>'crfiles/zone5/rohtak.xlsx','ROHTAKALL'=>'crfiles/zone5/rohtak.xlsx','ALLZONES'=>'crfiles/zone0/allzones.xlsx');

define('UNCLAIMEDZONEBENE', serialize($unclaimedzonebene));
define('UNCLAIMEDZONEAMOUNT', serialize($unclaimedzoneamount));
define('UNCLAIMEDZONESPATH', serialize($unclaimedzonespath));
$unclaimedannexurestatus = array('1' => 'Set',
                        '2' => 'Pending At LAO',
                        '3'=>'Approved By LAO',
                        '4'=>'Rejected By LAO',
                        '5'=>'Rejected By releaser',
                        '6'=>'Returned',
                        '7'=>'Send to bank',
                        '8'=> 'In process to Releaser',
                        '9'=> 'In process for Disbursal',
                        '10'=> 'Reinitiated',
                        '11'=> 'Disbursement Successful',
                        '12'=> 'Disbursement Failed'
                        );

define('UNCLAIMEDANNEXURESTATUS', serialize($unclaimedannexurestatus));
$errorStatus = array('1' => 'Pending Validation', '2' => 'Validation Failed', '3' => 'Pending for Initiation', '4' => 'Pending at LAO', '5' => 'Approve');
define('UNCLAIMEDERRORSTATUS', serialize($errorStatus));

define('SHA512ENCKEY',   'MTRiZmE2YmIxNDg3NWU0NWJiYTAyOGEyMWVkMzgw');
define('ENCTYPE',   'sha512');

/* End of file constants.php */
/* Location: ./application/config/constants.php */
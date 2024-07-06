<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config = array(
        'addZone' => array(
                array(
                        'field' => 'name',
                        'label' => 'Zone Name',
                        'rules' => 'trim|required|min_length[4]|max_length[18]|alpha_numeric'
                ),
                array(
                        'field' => 'account_number',
                        'label' => 'Zone Account Name',
                        'rules' => 'trim|required|min_length[12]|max_length[12]|numeric'
                )
        ),'date' => array(
                array(
                        'field' => 'fromDate',
                        'label' => 'Start Date',
                        'rules' => 'trim|required|min_length[10]|max_length[10]|valid_date'
                ),
                array(
                        'field' => 'toDate',
                        'label' => 'End Date',
                        'rules' => 'trim|required|min_length[10]|max_length[10]|valid_date'
                )
        ),'addMember' => array(
                array(
                        'field' => 'role_id',
                        'label' => 'Role',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[1]|numeric'
                ),
                array(
                        'field' => 'zone_id',
                        'label' => 'Zone',
                        'rules' => 'trim|required|xss_clean|min_length[1]|strip_tags|regex_match[/^([a-zA-Z0-9,])+$/i]'
                ),
                array(
                        'field' => 'name',
                        'label' => 'User Name',
                        'rules' => 'trim|required|xss_clean|min_length[3]|max_length[18]|xss_clean|regex_match[/^([-a-z_ ])+$/i]'
                ),
                array(
                        'field' => 'phone',
                        'label' => 'Mobile Number',
                        'rules' => 'trim|required|xss_clean|min_length[10]|max_length[10]|numeric'
                ),
                array(
                        'field' => 'email',
                        'label' => 'Email Id',
                        'rules' => 'trim|xss_clean|required|valid_email'
                )
        ),'updateMember' => array(
                array(
                        'field' => 'id',
                        'label' => 'Id',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[3]|numeric'
                ),
                array(
                        'field' => 'zone_id',
                        'label' => 'Zone',
                        'rules' => 'trim|required|xss_clean'
                ),
                array(
                        'field' => 'name',
                        'label' => 'User Name',
                        'rules' => 'trim|required|xss_clean|min_length[3]|max_length[18]|xss_clean|regex_match[/^([-a-z_ ])+$/i]'
                )
        ),
        'updateZoneDetails' => array(
                 array(
                        'field' => 'name',
                        'label' => 'Zone Name',
                        'rules' => 'trim|required|min_length[4]|max_length[18]|alpha_numeric'
                ),
                array(
                        'field' => 'account_number',
                        'label' => 'Zone Account Name',
                        'rules' => 'trim|required|min_length[12]|max_length[12]|numeric'
                ),
                array(
                        'field' => 'zone_id',
                        'label' => 'Zone',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[2]|numeric'
                ),
                array(
                        'field' => 'accountMasterId',
                        'label' => 'Id',
                        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[3]|numeric'
                )
        ),
        'changePassword' => array(
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|required|xss_clean|min_length[8]'
                )
        ),'report' => array(
                array(
                        'field' => 'fromDate',
                        'label' => 'Start Date',
                        'rules' => 'trim|xss_clean|required|min_length[10]|max_length[10]|valid_date'
                ),array(
                        'field' => 'toDate',
                        'label' => 'To Date',
                        'rules' => 'trim|xss_clean|required|min_length[10]|max_length[10]|valid_date'
                ),
                array(
                        'field' => 'annexure_type',
                        'label' => 'Annexure Type',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[1]|numeric'
                ),
                array(
                        'field' => 'annexure_status',
                        'label' => 'Annexure Status',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[2]|numeric'
                ),
                array(
                        'field' => 'Fromamount',
                        'label' => 'Amount',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[10]|alpha_numeric'
                ),
                array(
                        'field' => 'toamount',
                        'label' => 'Amount',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[10]|alpha_numeric'
                ),
                array(
                        'field' => 'beneficiary_name',
                        'label' => 'Beneficiary Name',
                        'rules' => 'trim|xss_clean|min_length[3]|max_length[16]|alpha'
                ),
                array(
                        'field' => 'Date',
                        'label' => 'Date',
                        'rules' => 'trim|xss_clean|min_length[10]|max_length[10]|valid_date'
                ),
                array(
                        'field' => 'customer_reference_number',
                        'label' => 'Reference Number',
                        'rules' => 'trim|xss_clean|min_length[12]|max_length[18]|alpha_numeric'
                )
        ),'originalReport' => array(
                array(
                        'field' => 'fromDate',
                        'label' => 'Start Date',
                        'rules' => 'trim|xss_clean|required|min_length[10]|max_length[10]|valid_date'
                ),array(
                        'field' => 'toDate',
                        'label' => 'End Date',
                        'rules' => 'trim|xss_clean|required|min_length[10]|max_length[10]|valid_date'
                ),
                array(
                        'field' => 'annexure_status',
                        'label' => 'Annexure Status',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[2]|numeric'
                ),
                array(
                        'field' => 'Date',
                        'label' => 'Date',
                        'rules' => 'trim|xss_clean|min_length[3]|max_length[20]|alpha_dash'
                ),
                array(
                        'field' => 'zone_id',
                        'label' => 'Zone',
                        'rules' => 'trim|xss_clean|min_length[1]|max_length[3]|alpha_numeric'
                )
        ),'updateReturned' => array(
                array(
                        'field' => 'id',
                        'label' => 'Id',
                        'rules' => 'trim|required|xss_clean|min_length[1]|numeric'
                ),
                array(
                        'field' => 'ifsc_code',
                        'label' => 'IFSC',
                        'rules' => 'trim|required|xss_clean|min_length[11]|max_length[11]|alpha_numeric'
                ),
                array(
                        'field' => 'account_number',
                        'label' => 'Account Number',
                        'rules' => 'trim|required|xss_clean|min_length[6]|max_length[20]|numeric'
                ),
                array(
                        'field' => 'mobile_number',
                        'label' => 'Mobile Number',
                        'rules' => 'trim|xss_clean|min_length[10]|max_length[10]|numeric'
                ),
                array(
                        'field' => 'beneficiary_name',
                        'label' => 'Beneficiary Name',
                        'rules' => 'trim|required|xss_clean|min_length[3]|max_length[28]|xss_clean|regex_match[/^([-a-z_ ])+$/i]'
                ),
                array(
                        'field' => 'customer_reference_number',
                        'label' => 'Customer Reference Number',
                        'rules' => 'trim|xss_clean|min_length[10]|max_length[28]|alpha_numeric'
                ),
                array(
                        'field' => 'reference_number',
                        'label' => 'Reference Number',
                        'rules' => 'trim|xss_clean|min_length[3]|max_length[28]|alpha_numeric'
                )
        ),
);

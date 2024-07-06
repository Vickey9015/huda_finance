<?php 
class MY_Form_validation extends CI_Form_validation {

public function __construct($rules = array())
{
    parent::__construct($rules);
}


public function valid_date($date)
{
    $d = DateTime::createFromFormat('d-m-Y', $date);
    return $d && $d->format('d-m-Y') === $date;
}

function alpha_dash_space($str)
{
    return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
} 

}
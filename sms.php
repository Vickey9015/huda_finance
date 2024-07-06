<?php 
//print_r(phpinfo());exit;
$input_xml = '<Root>
<ChnlId>737634634</ChnlId>
<Key>gsdsd73232387whwje</Key>
<Row>
<RefId>32323</RefId>
<MobNo>9555661901</MobNo>
<Msg>Message Text1</Msg>
</Row>
<Row>
	<RefId>3746343</RefId>
	<MobNo>984343443</MobNo>
	<Msg>jsdjsdsd</Msg>
</Row>
</Root>';
 
 
           // $URL = "http://10.24.66.73:83/SendSms";
 
			$url = "http://10.24.66.73:83/SendSms";

            //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
    // Following line is compulsary to add as it is:
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                        "xmlRequest=" . $input_xml);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
            $data = curl_exec($ch);
            if(curl_errno($ch)){
                echo 'Request Error:' . curl_error($ch);
            }
            curl_close($ch);
    
            //convert the XML result into array
            $array_data = json_decode(json_encode(simplexml_load_string($data)), true);
    
            print_r('<pre>');
            print_r($array_data);
            print_r('</pre>');
 
?>
<?php 
//echo "<pre>==ddd====";exit; //exit;
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
/*if(in_array  ('curl', get_loaded_extensions())) {
    echo "CURL is available on your web server";
}
else{
    echo "CURL is not available on your web server";
}*/
       //echo"<pre>serverdetails:";print_r($_SERVER);exit;
       /* $uername = PROD_USERNAME;
        $password =PROD_PASSWORD;
		$base = base64_encode(PROD_USERNAME.':'.PROD_PASSWORD);*/
        //$base = base64_encode('4333047:RKTQ96qopk');
        $certPass = 'nupay123';
        $curl = curl_init();
        //curl_setopt($curl, );
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://sky.yesbank.in:444/app/live/upi/meTransCollectSvc",
          CURLOPT_PORT => "444",
         // CURLOPT_URL => PROD_FUND_TRANSFER,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          //CURLOPT_SSLVERSION=>CURL_SSLVERSION_TLSv1_0,
          // CURLOPT_USERPWD=>"$uername:$password",
          CURLOPT_SSL_VERIFYPEER=>true,
          CURLOPT_SSL_VERIFYHOST=>0,
          //CURLOPT_CAINFO=>"/etc/apache2/ssl/cacert.pem",
          //CURLOPT_SSLKEY=>"/etc/apache2/ssl/private.pem",
          CURLOPT_SSLCERT=>"/etc/apache2/ssl/mycert.pem",
          CURLOPT_CAINFO=>"/etc/apache2/ssl/cacert.pem",
          CURLOPT_SSLKEY=>"/etc/apache2/ssl/private.pem",
          // CURLOPT_SSLCERT=>"selfsigned.pem",
          CURLOPT_SSLCERTPASSWD=>$certPass,
          //CURLOPT_SSL_CIPHER_LIST=>'SSLv3',
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          //CURLOPT_POSTFIELDS => $requestXML,
        CURLOPT_POSTFIELDS =>"{\"requestMsg\":\"D757185ACE6E0CEC1E872159C1D1E57D33F18C03932DD520DD2B7D39813C3DD468EF4157D70A50B9A9518F9DDC14615652DF87C4E843E689909F51765C2DB24DBC4E3999A7BFDAABFFDF6C4B8E5AD3A10E5A009FF8F64B1290AD39878F742395\",\"pgMerchantId\":\"YES0000001299294\"}",
          CURLOPT_HTTPHEADER => array(
		  "X-IBM-Client-Id:40efca70-94d6-4fdb-b4f5-051c76d807fa",
"X-IBM-Client-Secret:fM3nE7mA5dK6gC3pY4lO5uF5eF2cE4lF3dB3uL8jN4hP5fR5tS",
"content-type:application/json; charset=UTF-8",
"accept:application/json; charset=UTF-8"
            // "authorization: Basic dGVzdGNsaWVudDpPeFljb29sQDEyMw==",
            //"authorization: Basic ".$base,
           // "cache-control: no-cache",
            //"content-type: text/xml",
            //"postman-token: 838e836e-4672-f45d-9d14-f6a3149268e6",
            //"x-ibm-client-id: 40efca70-94d6-4fdb-b4f5-051c76d807fa",
            //"x-ibm-client-secret: fM3nE7mA5dK6gC3pY4lO5uF5eF2cE4lF3dB3uL8jN4hP5fR5tS"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        //return $parse    =xml2array($response);
        
        //echo "<pre>==ddd===="; print_r($parse); //exit;
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo "Response:".$response;
        }

?>
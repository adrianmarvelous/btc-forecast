<?php
    /* API URL */
    $url = '10.255.248.66/espj/web_service/login.php';
        
    /* Init cURL resource */
    $ch = curl_init($url);
        
    /* Array Parameter Data */
    $data = ['username'=>'tes1', 'password'=>'tes1'];
        
    /* pass encoded JSON string to the POST fields */
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
    /* set the content type json */
    $headers = [];
    $headers[] = 'Content-Type:application/json';
    $token = "";
    $headers[] = "Authorization: Bearer ".$token;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
    /* set return type json */
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
    /* execute request */
    $result = curl_exec($ch);
         
    /* close cURL resource */
    curl_close($ch);

    print_r($result);


?>
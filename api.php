<?php
/*$arr=[2,4,5];
echo json_encode($arr);*/

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.company-information.service.gov.uk/search?q=tdm',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Authorization: 85e82baa-403d-4b9d-b8f5-8166ff53aad3'
    ),
));
$response = curl_exec($curl);
curl_close($curl);
echo $response;
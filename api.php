<?php
function api_company_return($data)
{
    echo json_encode($data);
    die();
};
function debug_home($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
header('Access-Control-Allow-Origin:*');
$output['status']='without_params'; //status
if(isset($_POST['search_param'])&&($_POST['search_param'])) {
    $search_param=trim(urlencode($_POST['search_param']));
    $curl = curl_init();
    curl_setopt_array($curl, array(
        //  CURLOPT_URL => 'https://api.company-information.service.gov.uk/search?items_per_page=211&q='.$search_param,
        // CURLOPT_URL => 'https://api.company-information.service.gov.uk/advanced-search/companies?items_per_page=211&company_name_includes=tdm&size=1000',
        CURLOPT_URL => 'https://api.company-information.service.gov.uk/search/companies?items_per_page=211&q='.$search_param,
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
    $response=json_decode($response,1);
    if(!$response['total_results'] || !isset($response['items']) || empty($response['items'])) {
        $output['status']='free'; //status
        api_company_return($output);
    } else {
        $items=$response['items'];
        $items_filtered=array_filter($items,function($item) {
            return $item['company_status']=='active';
        });
        if(!count($items_filtered))  { $output['status']='free'; api_company_return($output); } //status
        $search_param=str_replace(['+'],['[\s]+'],trim($search_param));
        $search_param=str_replace(['limited','ltd'],[''],strtolower($search_param));
        $pattern='/^[\s]*'.$search_param.'[\s]*(ltd|limited)*[\s]*$/ui';
        $array_matched=array_filter($items_filtered,function($item) use($pattern) {
            return preg_match($pattern,$item['title']);
        });
        if(count($array_matched)) {$output['status']='busy'; api_company_return($output);} //status
        $output['status']='free'; //status
        api_company_return($output);
    }

}
api_company_return($output);
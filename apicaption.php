<?php
function api_caption_return($data)
{
    echo json_encode($data);
    die();
};
header('Access-Control-Allow-Origin:*');
if(isset($_POST['get_caption'])&&($_POST['get_caption']==1)) {
    $data=[
        'default'=>[
            'title'=>'Is Your Company Name Available?',
            'description'=>'Enter your desired company name below to ckeck on Companies House..',
            'inputPlaceholder'=> "Enter your desired company name",
            'btnText'=>"Check Now default",
            'helpText'=>'',
            'helpLink'=>''],
        'busy'=>[
            'title'=>'Sorrry COMPANY-NAME is Already Register',
            'description'=>'Please try a different name...',
            'inputPlaceholder'=>"Enter your desired company name",
            'btnText'=>"Check Now busy",
            'helpText'=>'Need hepl?Get tips on how name a company',
            'helpLink'=>'/help'],
        'free'=>[
            'title'=>'Congratulation COMPANY-NAME Is Available',
            'description'=>'Secure your chosen name before its too late...',
            'inputPlaceholder'=>"Enter your desired company name",
            'btnText'=>"Check Now free",
            'helpText'=>'',
            'helpLink'=>''],

    ];
    api_caption_return($data);
}


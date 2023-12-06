<?php
session_start();
$cUrl = curl_init();

 $options = array(
     CURLOPT_URL => 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-fgcou/endpoint/getPenggunaByUsernamePassword?username=' . $_GET['username'] . '&password='.md5($_GET['password']),
     CURLOPT_CUSTOMREQUEST => 'GET',
     CURLOPT_RETURNTRANSFER  => true,
    //  CURLOPT_POSTFIELDS => http_build_query(array(
    //      'username' => $_GET['username'],
    //      'password' => $_GET['password']
    //  )) 
 );

 curl_setopt_array($cUrl, $options);

 $response = curl_exec($cUrl);

 $data= json_decode($response);

 curl_close($cUrl);

 if(count($data)){
    //terdaftar
    $_SESSION['username'] =  $_GET['username'];

 } else{
    //Tidak Terdaftar
 }

 header('Location:index.php')
?>
<?php
    session_start();

    if(empty($_SESSION['username'])) {
        header('Location: login.php');
    }

    $id = $_GET['id'];

    $cUrl = curl_init();

    $options = array(
        CURLOPT_URL => 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-fgcou/endpoint/deleteDosenById?id='.$id,
        CURLOPT_CUSTOMREQUEST => 'DELETE'
    );

    curl_setopt_array($cUrl, $options);
    $response = curl_exec($cUrl);
    $data = json_decode($response);
    curl_close($cUrl);

    // if ($response) {
    //     echo 'Berhasil';
    // } else {
    //     echo 'Gagal';
    // }

    header('Location: index.php');
?>
<?php
    session_start();

    if(empty($_SESSION['username'])) {
        header('Location: login.php');
    }

    $id = $_GET['id'];
    $nama = $_GET['nama'];
    $jenis_kelamin = $_GET['jenis_kelamin'];
    $usia = $_GET['usia'];
    $prodi = array(
        'kode' => $_GET['kode_prodi'],
        'nama' => $_GET['nama_prodi']
    );

    if(empty($id)) {
        // Insert
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-fgcou/endpoint/insertDosen';
        $customrequest = 'POST';
        
    } else {
        // Update
        $url = 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-fgcou/endpoint/updateDosen';
        $customrequest = 'PUT';
    }

    $cUrl = curl_init();

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => $customrequest,
        CURLOPT_POSTFIELDS => http_build_query(array(
            'id' => $id,
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'usia' => $usia,
            'prodi' => json_encode($prodi)
        ))
    );

    curl_setopt_array($cUrl, $options);

    $response = curl_exec($cUrl);

    curl_close($cUrl);

    if($response) {
        header('Location: index.php');
    } else {
        echo 'Failed';
    }

?>
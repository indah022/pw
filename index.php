<?php
    session_start();

    if(empty($_SESSION['username'])){
        header('Location:login.php');
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMAK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <?php
            if (! empty($_SESSION['username'])){
                echo '<div class="text-end mt-5">
                User Login: <span class="fw-bold">'.$_SESSION['username'].'</span>
                <a href="signout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>';
            }
        ?>
        <h1>SIMAK</h1>
        <h2>Dosen</h2>
        <div class="text-center">
        <a href="javascript:void(0);" class="btn btn-primary btn-md mb-3" id="add">Tambah</a></div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="table-info text-center">
                    <th>Aksi</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia</th>
                    <th>Program Studi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $cUrl = curl_init();
                    $options = array(
                        CURLOPT_URL => 'https://ap-southeast-1.aws.data.mongodb-api.com/app/application-0-fgcou/endpoint/getAllDosen',
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_RETURNTRANSFER => true
                    );
                    curl_setopt_array($cUrl, $options);
                    $response = curl_exec($cUrl);
                    $data = json_decode($response);
                    curl_close($cUrl);
                    // echo $data[1] -> nama;
                    foreach($data as $row) :
                        // LOOPING DATA
                        echo '<tr>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-warning btn-sm edit" data-id="'.$row->_id.'">Ubah</a>
                                    <a href="delete.php?id='.$row -> _id.' " class="btn btn-sm btn-danger"
                                    onclick="return confirm(\'Apakah anda yakin menghapus data?\');">Hapus</a>
                                </td>
                                <td> '.(empty($row -> nama) ? '' : $row -> nama).' </td>
                                <td> '.(empty($row -> jenis_kelamin) ? '' : $row -> jenis_kelamin).' </td>
                                <td> '.(empty($row -> usia) ? '' : $row -> usia).' </td>
                                <td> '.(empty($row -> prodi) ? '' : $row -> prodi -> nama.' ('.$row -> prodi -> kode.')').'</td>
                            </tr>';
                    endforeach;
                ?>
            </tbody>
        </table>
        Total <?php echo count($data); ?> Data
    </div>
    
    <!-- MODAL -->
    <div class="modal" tabindex="-1" id="modalDosen">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formDosen" action="save.php" method="get">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                            <input type="hidden" id="id" name="id">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="pria" value="Pria" checked>
                                <label class="form-check-label" for="pria">
                                    Pria
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="wanita" value="Wanita">
                                <label class="form-check-label" for="wanita">
                                    Wanita
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="usia" class="form-label">Usia</label>
                            <input type="number" class="form-control" id="usia" name="usia" placeholder="Usia" required>
                        </div>
                        <div class="mb-3">
                            <label for="kode_prodi" class="form-label">Kode Program Studi</label>
                            <input type="text" class="form-control" id="kode_prodi" name="kode_prodi" placeholder="Kode Program Studi" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_prodi" class="form-label">Nama Program Studi</label>
                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" placeholder="Nama Program Studi" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm" form="formDosen">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
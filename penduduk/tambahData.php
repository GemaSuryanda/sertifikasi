<?php

require '../connect.php';


// ambil data dari form
$nikPenduduk = $_POST['nikPenduduk'];
$namaPenduduk = $_POST['namaPenduduk'];
$idKelurahan = $_POST['idKelurahan'];


$sql = "INSERT INTO penduduk (nik, nama_penduduk, id_kelurahan) VALUES ('$nikPenduduk', '$namaPenduduk', '$idKelurahan)";

if (mysqli_query($conn, $sql)) {
    echo 'Data berhasil disimpan';
} else {
    echo "Data tidak disimpan";
}

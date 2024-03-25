<?php

require '../connect.php';


// ambil data dari form
$namaKelurahan = $_POST['namaKelurahan'];
$namaKecamatan = $_POST['namaKecamatan'];

// mengambil data dari databasel
$sql = "SELECT * FROM kelurahan";
$result = mysqli_query($conn, $sql);


// query menyimpan data kek tabel 
$id =  mysqli_num_rows($result) + 1;
$newId = 'Kel' . $id;

$sql = "INSERT INTO kelurahan (nama_kelurahan, nama_kecamatan) VALUES ('$namaKelurahan', '$namaKecamatan')";

if (mysqli_query($conn, $sql)) {
    echo 'Data berhasil disimpan';
} else {
    echo "Data tidak disimpan";
}

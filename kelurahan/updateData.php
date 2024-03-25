<?php

require "../connect.php";

// Ambil data yang dikirim melalui AJAX
$id = $_POST['id']; // Anda perlu memastikan bahwa nilai 'id' sudah tersedia dari AJAX
$nama_kelurahan = $_POST['namaKelurahan']; // Misalnya, ini adalah input untuk nama kelurahan
$nama_kecamatan = $_POST['namaKecamatan']; // Misalnya, ini adalah input untuk nama kecamatan

// Query SQL untuk mengupdate data
$sql = "UPDATE kelurahan SET nama_kelurahan='$nama_kelurahan', nama_kecamatan='$nama_kecamatan' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil diupdate";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

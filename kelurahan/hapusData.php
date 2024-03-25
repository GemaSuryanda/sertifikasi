<?php

require "../connect.php";

$id = $_POST['id'];


// Query SQL untuk mengupdate data
$sql = "DELETE FROM kelurahan WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil dihapus";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
